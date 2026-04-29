<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateusersRequest;
use App\Http\Requests\UpdateusersRequest;
use App\Repositories\usersRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use App\Models\Roles;
use Spatie\Permission\Models\Role as SpRole;
use App\Models\User as User;

class usersController extends AppBaseController
{
    /** @var usersRepository $usersRepository*/
    private $usersRepository;

    public function __construct(usersRepository $usersRepo)
    {
        $this->usersRepository = $usersRepo;
    }

    public function index(Request $request)
    {
        $users = $this->usersRepository->all();
        return view('users.index')->with('users', $users);
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(CreateusersRequest $request)
    {
        $input = $request->all();
        $users = $this->usersRepository->create($input);
        Flash::success('Users saved successfully.');
        return redirect(route('users.index'));
    }

    public function show($id)
    {
        $users = $this->usersRepository->find($id);
        if (empty($users)) {
            Flash::error('Users not found');
            return redirect(route('users.index'));
        }
        return view('users.show')->with('users', $users);
    }

    public function edit($id)
    {
        $users = $this->usersRepository->find($id);
        if (empty($users)) {
            Flash::error('Users not found');
            return redirect(route('users.index'));
        }
        return view('users.edit')->with('users', $users);
    }

    public function update($id, UpdateusersRequest $request)
    {
        $users = $this->usersRepository->find($id);
        if (empty($users)) {
            Flash::error('Users not found');
            return redirect(route('users.index'));
        }
        $users = $this->usersRepository->update($request->all(), $id);
        Flash::success('Users updated successfully.');
        return redirect(route('users.index'));
    }

    public function destroy($id)
    {
        $users = $this->usersRepository->find($id);
        if (empty($users)) {
            Flash::error('Users not found');
            return redirect(route('users.index'));
        }
        $this->usersRepository->delete($id);
        Flash::success('Users deleted successfully.');
        return redirect(route('users.index'));
    }

    public function assignRoles($id)
    {
        $user = User::findOrFail($id);
        $roles = SpRole::all();
        return view('users.assignroles')
            ->with('user', $user)->with('roles',$roles);
    }

    public function updateRoles($id, Request $request)
    {
        $user = User::findOrFail($id);;
        $roles = SpRole::all();
        foreach($roles as $role) {
            if (isset($request->role[$role->id])) {
                $user->assignRole($role);
            }
            else {
                $user->removeRole($role);
            }
        }
        Flash::success('Roles updated successfully.');
        return redirect(route('roles.index'));
    }
}