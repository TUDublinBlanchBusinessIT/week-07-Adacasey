<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreaterolesRequest;
use App\Http\Requests\UpdaterolesRequest;
use App\Repositories\rolesRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Response;
use Spatie\Permission\Models\Role as SpRole;
use Spatie\Permission\Models\Permission as SpPermission;

class rolesController extends AppBaseController
{
    private $rolesRepository;

    public function __construct(rolesRepository $rolesRepo)
    {
        $this->rolesRepository = $rolesRepo;
    }

    public function index(Request $request)
    {
        $roles = $this->rolesRepository->all();
        return view('roles.index')->with('roles', $roles);
    }

    public function create()
    {
        return view('roles.create');
    }

    public function store(CreaterolesRequest $request)
    {
        $input = $request->all();
        $roles = $this->rolesRepository->create($input);
        Flash::success('Roles saved successfully.');
        return redirect(route('roles.index'));
    }

    public function show($id)
    {
        $roles = $this->rolesRepository->find($id);
        if (empty($roles)) {
            Flash::error('Roles not found');
            return redirect(route('roles.index'));
        }
        return view('roles.show')->with('roles', $roles);
    }

    public function edit($id)
    {
        $roles = $this->rolesRepository->find($id);
        if (empty($roles)) {
            Flash::error('Roles not found');
            return redirect(route('roles.index'));
        }
        return view('roles.edit')->with('roles', $roles);
    }

    public function update($id, UpdaterolesRequest $request)
    {
        $roles = $this->rolesRepository->find($id);
        if (empty($roles)) {
            Flash::error('Roles not found');
            return redirect(route('roles.index'));
        }
        $roles = $this->rolesRepository->update($request->all(), $id);
        Flash::success('Roles updated successfully.');
        return redirect(route('roles.index'));
    }

    public function destroy($id)
    {
        $roles = $this->rolesRepository->find($id);
        if (empty($roles)) {
            Flash::error('Roles not found');
            return redirect(route('roles.index'));
        }
        $this->rolesRepository->delete($id);
        Flash::success('Roles deleted successfully.');
        return redirect(route('roles.index'));
    }

    public function assignPermissions($id)
    {
        $role = SpRole::findOrFail($id);
        $permissions = SpPermission::all();
        return view('roles.assignpermissions')
            ->with('role', $role)->with('permissions',$permissions);
    }

    public function updatePermissions($id, Request $request)
    {
        $role = SpRole::findOrFail($id);;
        $permissions = SpPermission::all();
        foreach($permissions as $permission) {
            if (isset($request->permission[$permission->id])) {
                $role->givePermissionTo($permission);
            }
            else {
                $role->revokePermissionTo($permission);
            }
        }
        Flash::success('Roles updated successfully.');
        return redirect(route('roles.index'));
    }
}