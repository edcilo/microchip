<?php

use microchip\purchase\PurchaseRepo;
use microchip\product\ProductRepo;
use microchip\provider\ProviderRepo;
use microchip\inventoryMovement\InventoryMovementRepo;
use microchip\configuration\ConfigurationRepo;
use microchip\bank\BankRepo;
use microchip\cheque\ChequeRepo;
use microchip\purchase\PurchaseRegManager;
use microchip\purchase\PurchaseUplUpdManager;

class PurchaseController extends \BaseController
{
    protected $purchaseRepo;
    protected $productRepo;
    protected $providerRepo;
    protected $movementRepo;
    protected $bankRepo;
    protected $chequeRepo;
    protected $configurationRepo;

    public function __construct(
        PurchaseRepo            $purchaseRepo,
        ProductRepo                $productRepo,
        ProviderRepo            $providerRepo,
        InventoryMovementRepo    $inventoryMovementRepo,
        BankRepo                $bankRepo,
        ChequeRepo                $chequeRepo,
        ConfigurationRepo        $configurationRepo
    ) {
        $this->purchaseRepo            = $purchaseRepo;
        $this->productRepo            = $productRepo;
        $this->providerRepo            = $providerRepo;
        $this->movementRepo            = $inventoryMovementRepo;
        $this->bankRepo                = $bankRepo;
        $this->chequeRepo            = $chequeRepo;
        $this->configurationRepo    = $configurationRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /purchase.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->purchaseRepo->getAll('all', 'folio', 'ASC');
        }

        $purchases = $this->purchaseRepo->getAll('paginate', 'id', 'DESC');

        return View::make('purchase/index', compact('purchases'));
    }

    public function incomplete()
    {
        if (Request::ajax()) {
            return $this->purchaseRepo->getIncomplete('all', 'folio', 'ASC');
        }

        $purchases = $this->purchaseRepo->getIncomplete('paginate', 'id', 'DESC');

        return View::make('purchase/incomplete', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /purchase/create.
     *
     * @return Response
     */
    public function create()
    {
        $provider_list    = [0 => 'Selecciona...'] + $this->providerRepo->lists('name', 'id', 'name');
        $iva            = $this->configurationRepo->first()->iva;

        return View::make('purchase/create', compact('provider_list', 'iva'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /purchase.
     *
     * @return Response
     */
    public function store()
    {
        $data = Input::all() + ['user_id' => Auth::user()->id];

        $valid = $this->purchaseRepo->validateFolio($data['provider_id'], $data['folio']);
        if (!$valid) {
            return Redirect::back()->withInput()->withErrors(['folio' => 'El folio ya existe']);
        }

        $purchase   = $this->purchaseRepo->newPurchase();
        $manager    = new PurchaseRegManager($purchase, $data);
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $purchase];

            return Response::json($response);
        }

        return Redirect::route('purchase.show', [$purchase->folio, $purchase->id]);
    }

    /**
     * Display the specified resource.
     * GET /purchase/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($slug, $id)
    {
        $purchase = $this->purchaseRepo->find($id);
        $this->notFoundUnless($purchase);

        if (Request::ajax()) {
            return Response::json($purchase);
        }

        $bank_list   = ['' => 'Selecciona...'] + $this->bankRepo->lists_active('name', 'id', 'name');
        $cheque_list = ['' => 'Selecciona...'] + $this->chequeRepo->getListAvailable();

        return View::make('purchase/show', compact('purchase', 'method_list', 'type_list', 'bank_list', 'cheque_list'));
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /purchase/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
    }

    public function upload($id)
    {
        $purchase = $this->purchaseRepo->find($id);

        return View::make('purchase/upload', compact('purchase'));
    }

    public function save($id)
    {
        $purchase = $this->purchaseRepo->find($id);
        $this->notFoundUnless($purchase);

        $manager  = new PurchaseUplUpdManager($purchase, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $purchase];

            return Response::json($response);
        }

        return Redirect::route('purchase.show', [$purchase->folio, $purchase->id]);
    }

    public function stopRegisterMovements($purchase_id)
    {
        $purchase = $this->purchaseRepo->find($purchase_id);
        $this->notFoundUnless($purchase);
        $message = '';

        if (count($purchase->movements)) {
            $purchase->progress_4 = 0;
            $purchase->save();
        } else {
            $message = 'Antes de terminar el alta de productos, al menos se debe capturar un producto.';
        }

        return Redirect::back()->with('message', $message);
    }

    /**
     * Busca elementos que coincidan con el termino recibido.
     */
    public function search()
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            $results = $this->purchaseRepo->search($terms, 'ajax');

            return Response::json($results);
        } else {
            $results = $this->purchaseRepo->search($terms);

            return View::make('purchase/search', compact('results', 'terms'));
        }
    }
}
