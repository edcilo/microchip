<?php

use microchip\user\UserRepo;
use microchip\profile\ProfileRepo;
use microchip\department\DepartmentRepo;
use microchip\sale\SaleRepo;
use microchip\user\UserRegManager;
use microchip\user\UserUpdManager;
use microchip\profile\ProfileRegManager;
use microchip\profile\ProfileUpdManager;

class UserController extends \BaseController
{
    protected $userRepo;
    protected $profileRepo;
    protected $departmentRepo;
    protected $saleRepo;

    public function __construct(
        UserRepo        $userRepo,
        ProfileRepo        $profileRepo,
        DepartmentRepo    $departmentRepo,
        SaleRepo        $saleRepo
    ) {
        $this->userRepo            = $userRepo;
        $this->profileRepo        = $profileRepo;
        $this->departmentRepo    = $departmentRepo;
        $this->saleRepo         = $saleRepo;
    }

    /**
     * Display a listing of the resource.
     * GET /user.
     *
     * @return Response
     */
    public function index()
    {
        if (Request::ajax()) {
            return $this->userRepo->getActive(1, 'all', 'username', 'ASC');
        }

        $users = $this->userRepo->getActive(1, 'paginate', 'username', 'asc');

        return View::make('user/index', compact('users'));
    }

    /**
     * Muestra una lista de los registros enviados a papelera.
     */
    public function trash()
    {
        if (Request::ajax()) {
            return $this->userRepo->getActive(0, 'all', 'username', 'ASC');
        }

        $users = $this->userRepo->getActive(0, 'paginate', 'username', 'asc');

        return View::make('user/trash', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     * GET /user/create.
     *
     * @return Response
     */
    public function create()
    {
        $department_list    = $this->departmentRepo->lists('name', 'id');

        return View::make('user/create', compact('department_list'));
    }

    /**
     * Store a newly created resource in storage.
     * POST /user.
     *
     * @return Response
     */
    public function store()
    {
        $validate = $this->userRepo->checkPassword(Input::get('password'));
        if ($validate) {
            return Redirect::back()->withInput()->with('bad_password', 'La contraseña ya existe en la base de datos.');
        }

        $user        = $this->userRepo->newUser();
        $manager    = new UserRegManager($user, Input::all());
        $manager->save();

        $data        = Input::all() + ['user_id' => $user->id] + ['slug' => $user->slug];
        $profile    = $this->profileRepo->newProfile();
        $manager    = new ProfileRegManager($profile, $data);
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $user];

            return Response::json($response);
        }

        return Redirect::route('user.show', [$user->slug, $user->id]);
    }

    /**
     * Display the specified resource.
     * GET /user/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function show($slug, $id)
    {
        $user = $this->userRepo->find($id);
        $this->notFoundUnless($user);

        if (Request::ajax()) {
            return Response::json($user);
        }

        $sales = $this->saleRepo->getByUser($id);

        return View::make('user/show', compact('user', 'sales'));
    }

    /**
     * Show the form for editing the specified resource.
     * GET /user/{id}/edit.
     *
     * @param int $id
     *
     * @return Response
     */
    public function edit($slug, $id)
    {
        $user = $this->userRepo->find($id);
        $this->notFoundUnless($user);

        $department_list    = $this->departmentRepo->lists('name', 'id');

        return View::make('user/edit', compact('user', 'department_list'));
    }

    public function editProfile($slug, $id)
    {
        $profile = $this->profileRepo->find($id);
        $this->notFoundUnless($profile);
        $user = $profile->user;

        return View::make('user/edit_profile', compact('profile', 'user'));
    }

    /**
     * Update the specified resource in storage.
     * PUT /user/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function update($id)
    {
        $user = $this->userRepo->find($id);
        $this->notFoundUnless($user);

        $manager = new UserUpdManager($user, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $user];

            return Response::json($response);
        }

        return Redirect::route('user.show', [$user->slug, $user->id]);
    }

    public function updateProfile($id)
    {
        $profile = $this->profileRepo->find($id);
        $this->notFoundUnless($profile);

        $manager = new ProfileUpdManager($profile, Input::all());
        $manager->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $profile];

            return Response::json($response);
        }

        return Redirect::route('user.show', [$profile->user->slug, $profile->user->id]);
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
        $user = $this->userRepo->find($id);
        $this->notFoundUnless($user);

        $user->active = 0;
        $user->save();
        $user->profile->fired = date('Y-m-d');
        $user->profile->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $user];

            return Response::json($response);
        }

        return Redirect::route('user.index');
    }

    public function restore($id)
    {
        $user = $this->userRepo->find($id);
        $this->notFoundUnless($user);

        $user->active = 1;
        $user->save();
        $user->profile->hired = date('Y-m-d');
        $user->profile->save();

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $user];

            return Response::json($response);
        }

        return Redirect::route('user.trash');
    }

    /**
     * Remove the specified resource from storage.
     * DELETE /user/{id}.
     *
     * @param int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepo->find($id);
        $this->notFoundUnless($user);

        $this->destroyFile($user->profile->photo, 'default');

        $this->userRepo->destroy($id);

        if (Request::ajax()) {
            $response = $this->msg200 + ['data' => $user];

            return Response::json($response);
        }

        return Redirect::route('user.trash');
    }

    public function pay($id)
    {
        $user = $this->userRepo->find($id);
        $this->notFoundUnless($user);

        $user->profile->current = 0;
        $user->profile->save();

        if (Request::ajax()) {
            return Response::json($user);
        }

        return Redirect::back();
    }

    /**
     * Busca elementos que coincidan con el termino recibido.
     */
    public function search()
    {
        $terms = \Input::get('terms');

        if (Request::ajax()) {
            return $this->profileRepo->search($terms, 'ajax');
        } else {
            $results = $this->profileRepo->search($terms);

            return View::make('user/search', compact('results', 'terms'));
        }
    }
}
