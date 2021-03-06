<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\Admin\UserDataTable;
use App\Http\Requests\Admin\CreateUserRequest;
use App\Http\Requests\Admin\UpdateUserRequest;
use App\Repositories\Admin\UserRepository;
use Spatie\Permission\Models\Role;
use Flash;
use App\Http\Controllers\AppBaseController;
use Response;
use App\User;

class UserController extends AppBaseController
{
    /** @var  UserRepository */
    private $userRepository;

    public function __construct(UserRepository $userRepo)
    {
        $this->userRepository = $userRepo;
    }

    /**
     * Display a listing of the User.
     *
     * @param UserDataTable $userDataTable
     * @return Response
     */
    public function index(UserDataTable $userDataTable)
    {
        return $userDataTable->render('admin.users.index');
    }

    /**
     * Show the form for creating a new User.
     *
     * @return Response
     */
    public function create()
    {
        $rolesUser = Role::where("name",'!=',"admin")->get();
        $roles = ['0' => 'Ver Roles'];
        foreach($rolesUser as $rolUser){
            $roles[$rolUser->id] = $rolUser->name;
        }
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created User in storage.
     *
     * @param CreateUserRequest $request
     *
     * @return Response
     */
    public function store(CreateUserRequest $request)
    {
        $request['password'] = bcrypt("cambiame");
        $role = Role::find($request['role_id']);

        $input = $request->all();

        $user = $this->userRepository->create($input);

        $user = User::where('id',$user->id)->first();

        $user->assignRole($role);

        Flash::success('User saved successfully.');

        return redirect(route('admin.users.index'));
    }

    /**
     * Display the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        return view('admin.users.show')->with('user', $user);
    }

    /**
     * Show the form for editing the specified User.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $user = User::find($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }
        $rolesUser = Role::where("name",'!=',"admin")->get();
        $roles = ['0' => 'Ver Roles'];
        foreach($rolesUser as $rolUser){
            $roles[$rolUser->id] = $rolUser->name;
        }

        return view('admin.users.edit',compact('user','roles'));
    }

    /**
     * Update the specified User in storage.
     *
     * @param  int              $id
     * @param UpdateUserRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateUserRequest $request)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }
        $role = Role::find($request['role_id']);

        $user = $this->userRepository->update($request->all(), $id);

        $user = User::where('id',$user->id)->first();

        $user->assignRole($role);

        Flash::success('User updated successfully.');

        return redirect(route('admin.users.index'));
    }

    /**
     * Remove the specified User from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $user = $this->userRepository->findWithoutFail($id);

        if (empty($user)) {
            Flash::error('User not found');

            return redirect(route('admin.users.index'));
        }

        $this->userRepository->delete($id);

        Flash::success('User deleted successfully.');

        return redirect(route('admin.users.index'));
    }
}
