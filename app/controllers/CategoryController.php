<?php

use microchip\category\CategoryRepo;
use microchip\product\ProductRepo;

use microchip\category\CategoryRegManager;
use microchip\category\CategoryUpdManager;

class CategoryController extends \BaseController {

	protected $categoryRepo;
    protected $productRepo;

	public function __construct(
		CategoryRepo	$categoryRepo,
        ProductRepo     $productRepo
	)
	{
		$this->categoryRepo	= $categoryRepo;
        $this->productRepo  = $productRepo;
	}

	/**
	 * Display a listing of the resource.
	 * GET /category
	 *
	 * @return Response
	 */
	public function index()
	{
		if ( Request::ajax() ) return $this->categoryRepo->getAll('all', 'name', 'ASC');

		$categories = $this->categoryRepo->getAll('paginate', 'name', 'asc');

		foreach($categories as $category)
		{
			$category->description = substr( $category->description, 0, 117 ) . '...';
		}

		return View::make('category/index', compact('categories'));
	}

	/**
	 * Show the form for creating a new resource.
	 * GET /category/create
	 *
	 * @return Response
	 */
	public function create()
	{
		return View::make('category/create');
	}

	/**
	 * Store a newly created resource in storage.
	 * POST /category
	 *
	 * @return Response
	 */
	public function store()
	{
		$category	= $this->categoryRepo->newCategory();
		$manager	= new CategoryRegManager($category, Input::all());
		$manager->save();

		if ( Request::ajax() ) {
			$response = $this->msg200 + [ 'data' => $category ];

			return Response::json($response);
		}

		return Redirect::route('category.show', [$category->slug, $category->id]);
	}

	/**
	 * Display the specified resource.
	 * GET /category/{slug}/{id}
	 *
	 * @param  string $slug
	 * @param  int  $id
	 * @return Response
	 */
	public function show($slug, $id)
	{
		$category = $this->categoryRepo->find($id);
		$this->notFoundUnless($category);

		if ( Request::ajax() ) return Response::json($category);

        $products = $this->productRepo->getByCategory($id);

		return View::make('category/show', compact('category', 'products'));
	}

	/**
	 * Show the form for editing the specified resource.
	 * GET /category/{slug}/{id}/edit
	 *
	 * @param  string $slug
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($slug, $id)
	{
		$category = $this->categoryRepo->find($id);
		$this->notFoundUnless($category);

		return View::make('category/edit', compact('category'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /category/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$category = $this->categoryRepo->find($id);
		$this->notFoundUnless($category);

		$manager = new CategoryUpdManager($category, Input::all());
		$manager->save();

		if ( Request::ajax() ) {
			$response = $this->msg200 + [ 'data' => $category ];

			return Response::json($response);
		}

		return Redirect::route('category.show', [$category->slug, $category->id]);
	}

	/**
	 * Remove the specified resource from storage.
	 * DELETE /category/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		$category = $this->categoryRepo->find($id);
		$this->notFoundUnless($category);

		$this->categoryRepo->destroy($id);

		$this->destroyFile($category->image, 'default');

		if ( Request::ajax() )
		{
			$response = $this->msg200 + [ 'data' => $category ];

			return Response::json($response);
		}

		return Redirect::route('category.index');
	}

	/**
	 * Busca elementos que coincidan con el termino recibido
	 */
	public function search()
	{
		$terms = \Input::get('terms');

		if ( Request::ajax() ) {
			$results = $this->categoryRepo->search($terms, 'ajax');

			return Response::json($results);
		} else {
			$results = $this->categoryRepo->search($terms);

			foreach($results as $category)
			{
				$category->description = substr( $category->description, 0, 117 ) . '...';
			}

			return View::make('category/search', compact('results', 'terms'));
		}
	}

}