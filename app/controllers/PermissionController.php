<?php

use microchip\permission\PermissionRepo;
use microchip\user\UserRepo;

use microchip\permission\PermissionUpdateManager;

class PermissionController extends \BaseController {

    protected $permissionRepo;
    protected $userRepo;

    public function __construct(
        PermissionRepo  $permissionRepo,
        UserRepo        $userRepo
    )
    {
        $this->permissionRepo   = $permissionRepo;
        $this->userRepo         = $userRepo;
    }

	/**
	 * Display a listing of the resource.
	 * GET /permission
	 *
	 * @return Response
	 */
	public function index()
	{
        if ( Request::ajax() ) return $this->permissionRepo->getAll('all', 'name', 'ASC');

        $permissions = $this->permissionRepo->getAll('paginate', 'name', 'asc');

        return View::make('permission/index', compact('permissions'));
	}

    public function show($id)
    {
        $permission = $this->permissionRepo->find($id);
        $this->notFoundUnless($permission);

        if ( Request::ajax() ) return Response::json($permission);

        return View::make('permission/show', compact('permission'));
    }

	/**
	 * Show the form for editing the specified resource.
	 * GET /permission/{id}/edit
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		$permission = $this->permissionRepo->find($id);
        $this->notFoundUnless($permission);

        return View::make('permission.edit', compact('permission'));
	}

	/**
	 * Update the specified resource in storage.
	 * PUT /permission/{id}
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		$permission = $this->permissionRepo->find($id);
        $this->notFoundUnless($permission);

        $manager = new PermissionUpdateManager($permission, Input::all());
        $manager->save();

        if ( Request::ajax() ) {
            $response = $this->msg200 + [ 'data' => $permission ];

            return Response::json($response);
        }

        return Redirect::route('permission.show', [$id]);
	}

    public function editUser($id)
    {
        $user = $this->userRepo->find($id);
        $this->notFoundUnless($user);

        $permissions = $this->permissionRepo->getWithoutPermission($user->permissions_array);

        return View::make('user/permission', compact('user', 'permissions'));
    }

    public function updateUser($id)
    {
        $data = Input::all() + ['user_id' => $id];

        if ( $this->validation($data) )
        {
            if ( Request::ajax() )
            {
                return Response::json($this->error_messages);
            }

            return Redirect::back()->withInput()->withErrors($this->error_messages);
        }

        $user = $this->userRepo->find($id);
        $this->notFoundUnless($user);

        $user->permissions()->attach(Input::get('permission_id'));

        if ( Request::ajax() )
        {
            $response = $this->msg200 + [ 'data' => $user->permissions ];

            return Response::json($response);
        }

        return Redirect::back()->with('message', 'Los permisos se asignarón correctamente.');
    }

    public function destroyUser($id)
    {
        $data = Input::all() + ['user_id' => $id];

        if ( $this->validation($data) )
        {
            if ( Request::ajax() )
            {
                return Response::json($this->error_messages);
            }

            return Redirect::back()->withInput()->withErrors($this->error_messages);
        }

        $user = $this->userRepo->find($id);
        $this->notFoundUnless($user);

        $user->permissions()->detach(Input::get('permission_id'));

        if ( Request::ajax() )
        {
            $response = $this->msg200 + [ 'data' => $user->permissions ];

            return Response::json($response);
        }

        return Redirect::back()->with('message', 'Los permisos se eliminarón correctamente.');
    }

    public function validation($data)
    {
        $validator = Validator::make(
            $data,
            [
                'user_id'		=> 'required|exists:users,id',
                'permission_id'	=> 'required|exists:permissions,id'
            ]
        );

        if ($validator->passes())
        {
            return false;
        }

        $this->error_messages = $validator->messages();
        return true;
    }

}