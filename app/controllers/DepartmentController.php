<?php

use microchip\department\DepartmentRepo;
use microchip\department\DepartmentRegManager;
use microchip\department\DepartmentUpdManager;

class DepartmentController extends \BaseController
{
    protected $departmentRepo;

    public function __construct(
        DepartmentRepo    $departmentRepo
    ) {
        $this->departmentRepo    = $departmentRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /department.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->departmentRepo->getAll('all', 'name', 'ASC');
        }

        $departments = $this->departmentRepo->getAll('paginate', 'name', 'asc');

        foreach ($departments as $department) {
            $department->description = substr($department->description, 0, 117).'...';
        }

        return View::make('department/index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /department/create.
     *
     * @return Response
     */
    public function create()
    {
        return View::make('department/create');
    }

    /**
     * Store a newly created resource in storage.
     * POST /department.
     *
     * @return Response
     */
    public function store()
    {
        $department    = $this->departmentRepo->newDepartment();
        $manager    = new DepartmentRegManager($department, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $department];

            return Response::json($response);
        }

        return Redirect::route('department.show', [$department->slug, $department->id]);
    }

    /**
     * Display the specified resource.
     * GET /department/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($slug, $id)
    {
        $department = $this->departmentRepo->find($id);
        $this->notFoundUnless($department);

        if (Request::ajax()) {
            return Response::json($department);
        }

        return View::make('department/show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /department/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($slug, $id)
    {
        $department = $this->departmentRepo->find($id);
        $this->notFoundUnless($department);

        return View::make('department/edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /department/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $department = $this->departmentRepo->find($id);
        $this->notFoundUnless($department);

        $manager = new DepartmentUpdManager($department, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $department];

            return Response::json($response);
        }

        return Redirect::route('department.show', [$department->slug, $department->id]);
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /department/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $department = $this->departmentRepo->find($id);
        $this->notFoundUnless($department);

        $this->departmentRepo->destroy($id);

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $department];

            return Response::json($response);
        }

        return Redirect::route('department.index');
    }

    /**
     * Busca elementos que coincidan con el termino recibido.
     */
    public function search()
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            $results = $this->departmentRepo->search($terms, 'ajax');

            return Response::json($results);
        } else {
            $results = $this->departmentRepo->search($terms);

            foreach ($results as $department) {
                $department->description = substr($department->description, 0, 117).'...';
            }

            return View::make('department/search', compact('results', 'terms'));
        }
    }
}
