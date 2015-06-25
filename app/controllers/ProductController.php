<?php

use microchip\product\ProductRepo;
use microchip\series\SeriesRepo;
use microchip\configuration\ConfigurationRepo;
use microchip\product\ProductFormat;
use microchip\product\ProductRegManager;
use microchip\product\ProductUpdManager;
use microchip\productDescription\ProductDescriptionRepo;
use microchip\category\CategoryRepo;
use microchip\mark\MarkRepo;
use microchip\productDescription\ProductDescriptionRegManager;
use microchip\productDescription\ProductDescriptionUpdManager;

class ProductController extends \BaseController
{
    protected $productRepo;
    protected $seriesRepo;
    protected $configRepo;
    protected $productFormat;
    protected $descriptionRepo;
    protected $categoryRepo;
    protected $markRepo;

    public function __construct(
        ProductRepo             $productRepo,
        SeriesRepo              $seriesRepo,
        ProductFormat           $productFormat,
        ProductDescriptionRepo  $descriptionRepo,
        CategoryRepo            $categoryRepo,
        MarkRepo                $markRepo,
        ConfigurationRepo       $configurationRepo
    ) {
        $this->productRepo      = $productRepo;
        $this->seriesRepo       = $seriesRepo;
        $this->productFormat    = $productFormat;
        $this->descriptionRepo  = $descriptionRepo;
        $this->categoryRepo     = $categoryRepo;
        $this->markRepo         = $markRepo;
        $this->configRepo       = $configurationRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /product.
     *
     * @return Response
     */
    public function indexProducts()
    {
        if (Request::ajax()) {
            return $this->productRepo->getType('Producto', 1, 'all', 'barcode', 'ASC');
        }

        $products = $this->productRepo->getType('Producto', 1, 'paginate', 'barcode', 'asc');
        $type     = 'product';
        $tipo      = 'producto';

        return View::make('product/index_product', compact('type', 'tipo', 'products'));
    }

    public function indexServices()
    {
        if (Request::ajax()) {
            return $this->productRepo->getType('Servicio', 1, 'all', 'barcode', 'ASC');
        }

        $services = $this->productRepo->getType('Servicio', 1, 'paginate', 'barcode', 'asc');
        $type     = 'service';
        $tipo     = 'servicio';

        return View::make('product/index_service', compact('type', 'tipo', 'services'));
    }

    /**
     * Muestra una lista de los registros enviados a papelera.
     */
    public function trash()
    {
        if (Request::ajax()) {
            return $this->productRepo->getActive(0, 'all', 'barcode', 'ASC');
        }

        $products = $this->productRepo->getActive(0, 'paginate', 'barcode', 'asc');
        $type     = 'product';
        $tipo     = 'producto';

        return View::make('product/trash', compact('products', 'type', 'tipo'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /product/create.
     *
     * @return Response
     */
    public function create($type)
    {
        if ($type == 'service') {
            $s_type = 'Servicio';
        } elseif ($type == 'product') {
            $s_type = 'Producto';

            $category_list    = ['' => 'Selecciona...'] + $this->categoryRepo->lists('name', 'id', 'name');
            $mark_list        = ['' => 'Selecciona...'] + $this->markRepo->lists('name', 'id', 'name');
        } else {
            App::abort(404);
        }

        return View::make('product/create', compact('type', 's_type', 'category_list', 'mark_list'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /product.
     *
     * @return Response
     */
    public function store()
    {
        $data = Input::all();

        $product    = $this->productRepo->newProduct();
        $manager    = new ProductRegManager($product, $data);
        $manager->save();

        if ($product->type == 'Producto') {
            $data['product_id'] = $product->id;
            $description = $this->descriptionRepo->newDescription();
            $manager     = new ProductDescriptionRegManager($description, $data);
            $manager->save();
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $product];

            return Response::json($response);
        }

        return Redirect::route('product.show', [$product->slug, $product->id]);
    }

    /**
     * Display the specified resource.
     * GET /product/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($slug, $id)
    {
        $product = $this->productRepo->find($id);
        $this->notFoundUnless($product);

        if (Request::ajax()) {
            return Response::json($product);
        }

        $series = $this->seriesRepo->getSeriesByProduct($product->id);

        $this->productFormat->formatData($product);
        $tipo = $product->type;
        $type = ($tipo == 'Producto') ? 'product' : 'service';

        return View::make('product/show', compact('type', 'tipo', 'product', 'series'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /product/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($slug, $id)
    {
        $product = $this->productRepo->find($id);
        $this->notFoundUnless($product);

        $product->r_type = ($product->type == 'Servicio') ? 'service' : 'product';
        $s_type = $product->type;
        $tipo = $product->type;

        if ($tipo == 'Producto') {
            $type = 'product';

            $category_list    = ['' => 'Selecciona...'] + $this->categoryRepo->lists('name', 'id', 'name');
            $mark_list        = ['' => 'Selecciona...'] + $this->markRepo->lists('name', 'id', 'name');
        } else {
            $type = 'service';
        }
        //$type = ($tipo == 'Producto') ? 'product' : 'service';


        return View::make('product/edit', compact('type', 'tipo', 'product', 's_type', 'category_list', 'mark_list'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /product/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $data = Input::all();

        $product = $this->productRepo->find($id);
        $this->notFoundUnless($product);

        $manager = new ProductUpdManager($product, $data);
        $manager->save();

        if ($product->type == 'Producto') {
            $manager = new ProductDescriptionUpdManager($product->pDescription, $data);
            $manager->save();
        }

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $product];

            return Response::json($response);
        }

        return Redirect::route('product.show', [$product->slug, $product->id]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /product/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $product = $this->productRepo->find($id);
        $this->notFoundUnless($product);
        $type = $product->type;

        $this->productRepo->destroy($id);

        $this->destroyFile($product->image, 'default');

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $product];

            return Response::json($response);
        }

        if ($type == 'Producto') {
            return Redirect::route('product.index.product');
        } else {
            return Redirect::route('product.index.service');
        }
    }

    /**
     * Busca elementos que coincidan con el termino recibido.
     */
    public function search($type)
    {
        $tipo = ($type == 'product') ? 'Producto' : 'Servicio';

        $terms = \Input::get('terms');

        if (Request::ajax()) {
            return $this->productRepo->search($terms, $tipo, 'ajax');
        }

        $results = $this->productRepo->search($terms, $tipo);

        foreach ($results as $product) {
            $product->s_description = substr($product->s_description, 0, 117).'...';
            $this->productFormat->formatData($product);
        }

        return View::make('product/search', compact('type', 'tipo', 'results', 'terms'));
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
        $product = $this->productRepo->find($id);
        $this->notFoundUnless($product);

        $product->active = 0;
        $product->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $product];

            return Response::json($response);
        }

        return Redirect::back()->with('message', "El $product->type $product->barcode se envio a la papelera correctamente.");
    }

    public function restore($id)
    {
        $product = $this->productRepo->find($id);
        $this->notFoundUnless($product);

        $product->active = 1;
        $product->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $product];

            return Response::json($response);
        }

        return Redirect::back()->with('message', "El $product->type $product->barcode se recupero de la papelera correctamente.");
    }

    public function printBarcode($product_id)
    {
        $product = $this->productRepo->find($product_id);
        $this->notFoundUnless($product);

        $configuration = $this->configRepo->find(1);

        $pdf = PDF::loadView('product.layout_print_barcode', compact('product', 'configuration'))->setPaper([
            0, 0,
            $configuration->with_real_paper_barcode,
            $configuration->height_real_paper_barcode
        ]);

        return $pdf->stream();
    }
}
