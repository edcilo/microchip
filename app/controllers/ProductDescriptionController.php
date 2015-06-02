<?php

use microchip\productDescription\ProductDescriptionRepo;
use microchip\category\CategoryRepo;
use microchip\mark\MarkRepo;
use microchip\productDescription\ProductDescriptionRegManager;
use microchip\productDescription\ProductDescriptionUpdManager;

class ProductDescriptionController extends \BaseController
{
    protected $descriptionRepo;
    protected $categoryRepo;
    protected $markRepo;

    public function __construct(
        ProductDescriptionRepo    $productDescriptionRepo,
        CategoryRepo            $categoryRepo,
        MarkRepo                $markRepo
    ) {
        $this->descriptionRepo    = $productDescriptionRepo;
        $this->categoryRepo        = $categoryRepo;
        $this->markRepo            = $markRepo;
    }

    /**
     * Show the form for creating a new resource.
     * GET /productdescription/create.
     *
     * @return Response
     */
    public function create($slug, $id)
    {
        $type = 'Producto';

        $category_list    = ['' => 'Selecciona...'] + $this->categoryRepo->lists('name', 'id');
        $mark_list        = ['' => 'Selecciona...'] + $this->markRepo->lists('name', 'id');

        return View::make('productDescription/create', compact('id', 'category_list', 'mark_list', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /productdescription.
     *
     * @return Response
     */
    public function store()
    {
        $description    = $this->descriptionRepo->newDescription();
        $manager    = new ProductDescriptionRegManager($description, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $description];

            return Response::json($response);
        }

        return Redirect::route('product.show', [$description->product->slug, $description->product->id]);
    }

    /**
     * Show the form for editing the specified resource.
     * GET /productdescription/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($slug, $id)
    {
        $product = $this->descriptionRepo->find($id);
        $this->notFoundUnless($product);

        $category_list    = ['' => 'Selecciona...'] + $this->categoryRepo->lists('name', 'id');
        $mark_list        = ['' => 'Selecciona...'] + $this->markRepo->lists('name', 'id');

        $type = 'product';
        $tipo = 'Producto';

        return View::make('productDescription/edit', compact('type', 'tipo', 'id', 'category_list', 'mark_list', 'product'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /productdescription/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $description = $this->descriptionRepo->find($id);
        $this->notFoundUnless($description);

        $manager = new ProductDescriptionUpdManager($description, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $description];

            return Response::json($response);
        }

        return Redirect::route('product.show', [$description->product->slug, $description->product->id]);
    }
}
