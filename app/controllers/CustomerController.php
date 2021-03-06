<?php

use microchip\customer\CustomerRepo;
use microchip\customerReferral\CustomerReferralRepo;
use microchip\customer\CustomerRegManager;
use microchip\customer\CustomerUpdManager;
use microchip\customer\CustomerCardUpdateManager;
use microchip\customerReferral\CustomerReferralRegManager;

class CustomerController extends \BaseController
{
    protected $customerRepo;
    protected $referralRepo;

    protected $classification_list    = ['Cliente' => 'Cliente', 'Distribuidor' => 'Distribuidor'];
    protected $concept_list            = ['Ninguno' => 'Ninguno', 'Persona Física' => 'Persona Física', 'Persona Moral' => 'Persona Moral'];

    public function __construct(
        CustomerRepo            $customerRepo,
        CustomerReferralRepo    $customerReferralRepo
    ) {
        $this->customerRepo        = $customerRepo;
        $this->referralRepo        = $customerReferralRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /customer.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->customerRepo->getActive(1, 'all', 'name', 'ASC');
        }

        $customers                = $this->customerRepo->getActive(1, 'paginate', 'name', 'asc');
        $classification_list    = $this->classification_list;
        $concept_list            = $this->concept_list;

        return View::make('customer/index', compact('customers', 'classification_list', 'concept_list'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /customer/create.
     *
     * @return Response
     */
    public function create()
    {
        $classification_list    = $this->classification_list;
        $concept_list            = $this->concept_list;

        return View::make('customer.create', compact('classification_list', 'concept_list'));
    }

    public function createMin()
    {
        $classification_list    = $this->classification_list;
        $concept_list            = $this->concept_list;

        return View::make('customer.create_min', compact('classification_list', 'concept_list'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /customer.
     *
     * @return Response
     */
    public function store()
    {
        $data = Input::all();

        $data['customer'] = (isset($data['customer'])) ? 1 : 0;

        $customer = $this->customerRepo->newCustomer();
        $manager  = new CustomerRegManager($customer, $data);
        $manager->save();

        if ($data['customer']) {
            $data     = Input::only('customer_id', 'observations') + ['referred_id' => $customer->id, 'expiration' => Input::get('expiration_referrals')];
            $referral = $this->referralRepo->newReferred();
            $manager  = new CustomerReferralRegManager($referral, $data);
            $manager->save();
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $customer];

            return Response::json($response);
        }

        if (Input::get('close')) {
            return Redirect::route('customer.confirm', $customer->id);
        }

        return Redirect::route('customer.show', [$customer->slug, $customer->id]);
    }

    /**
     * Display the specified resource.
     * GET /customer/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($slug, $id)
    {
        $customer = $this->customerRepo->find($id);
        $this->notFoundUnless($customer);

        if (Request::ajax()) {
            return Response::json($customer);
        }

        $sales = $customer->sales()->where('classification', 'Venta')->orderBy('folio_sale', 'desc')->paginate();
        $orders = $customer->sales()->where('classification', 'Pedido')->orderBy('folio_separated', 'desc')->paginate();
        $services = $customer->sales()->where('classification', 'Servicio')->orderBy('folio_service', 'desc')->paginate();
        $prices = $customer->sales()->where('classification', 'Cotización')->orderBy('folio_price', 'desc')->paginate();

        return View::make('customer/show', compact('customer', 'sales', 'orders', 'services', 'prices'));
    }

    public function confirm($id)
    {
        $customer = $this->customerRepo->find($id);
        $this->notFoundUnless($customer);

        return View::make('customer.confirm', compact('customer'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /customer/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($slug, $id)
    {
        $customer = $this->customerRepo->find($id);
        $this->notFoundUnless($customer);

        $classification_list    = $this->classification_list;
        $concept_list            = $this->concept_list;

        return View::make('customer/edit', compact('customer', 'classification_list', 'concept_list'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /customer/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $data = Input::all();
        $data['customer'] = (isset($data['customer'])) ? 1 : 0;

        $customer = $this->customerRepo->find($id);
        $this->notFoundUnless($customer);

        $manager = new CustomerUpdManager($customer, $data);
        $manager->save();

        if ($data['customer']) {
            if (!is_null($customer->referrer)) {
                $customer->referrer->delete();
            }

            $data     = Input::only('customer_id', 'observations') + ['referred_id' => $customer->id, 'expiration' => Input::get('expiration_referrals')];
            $referral = $this->referralRepo->newReferred();
            $manager  = new CustomerReferralRegManager($referral, $data);
            $manager->save();
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $customer];

            return Response::json($response);
        }

        return Redirect::route('customer.show', [$customer->slug, $customer->id]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /customer/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $customer = $this->customerRepo->find($id);
        $this->notFoundUnless($customer);

        if ($customer->id != 1) {
            $this->customerRepo->destroy($id);
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $customer];

            return Response::json($response);
        }

        return Redirect::route('customer.trash');
    }

    /**
     * Muestra una lista de los registros enviados a papelera.
     */
    public function trash()
    {
        if (Request::ajax()) {
            return $this->customerRepo->getActive(0, 'all', 'name', 'ASC');
        }

        $customers = $this->customerRepo->getActive(0, 'paginate', 'name', 'asc');

        return View::make('customer/trash', compact('customers'));
    }

    /**
     * Elimina de forma temporal a un degistro
     * GET /provider/{id}/softDelete.
     *
     * @param int $id
     *
     * @return Response
     */
    public function softDelete($id)
    {
        $customer = $this->customerRepo->find($id);
        $this->notFoundUnless($customer);

        if ($customer->id != 1) {
            $customer->active = 0;
            $customer->save();
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $customer];

            return Response::json($response);
        }

        return Redirect::back();
    }

    public function restore($id)
    {
        $customer = $this->customerRepo->find($id);
        $this->notFoundUnless($customer);

        $customer->active = 1;
        $customer->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $customer];

            return Response::json($response);
        }

        return Redirect::back();
    }

    public function cardEdit($id)
    {
        $customer = $this->customerRepo->find($id);

        return View::make('customer/editCard', compact('customer'));
    }

    public function cardUpdate($id)
    {
        $customer = $this->customerRepo->find($id);
        $manager = new CustomerCardUpdateManager($customer, \Input::all());
        $manager->save();

        if (Request::ajax()) {
            $data = [
                'response' => '200',
                'msg'      => 'El monedero se registro exitosamente',
            ];

            return Response::json($data);
        }

        return Redirect::route('customer.show', [$customer->slug, $customer->id]);
    }

    /**
     * Busca elementos que coincidan con el termino recibido.
     */
    public function search()
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            return $this->customerRepo->search($terms, 'ajax', Input::get('active'));
        } else {
            $results = $this->customerRepo->search($terms);

            return View::make('customer/search', compact('results', 'terms'));
        }
    }

    public function getCustomer($id) {
        $data = $this->msg404;

        $customer = $this->customerRepo->find($id);

        if (!is_null($customer)) {
            $customer->expiration_date = $customer->expiration_date;
            $data = $this->msg200 + $customer->toArray();
        }

        return Response::json($data);
    }

    public function getCustomerByCard()
    {
        $data = $this->msg404;
        $card_id = Input::get('card_id');

        $customer = $this->customerRepo->getByCard($card_id);

        if (!is_null($customer)) {
            $customer->expiration_date = $customer->expiration_date;
            $data = $this->msg200 + $customer->toArray();
        }

        return Response::json($data);
    }
}
