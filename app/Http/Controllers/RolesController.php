<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class RolesController extends Controller
{
    //index
    public function index()
    {
        $roles = Role::orderBy('name', 'asc')->get();
        return view('users.roles', compact('roles'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'permission' => 'required',
            'express' => 'required'
        ]);

        $express = $request->express;
        $permission = array_keys($request->get('permission'));

        if (!$express) {
            $name = Role::where('name', $request->name)->first();
            if ($name) {
                return to_route('rolesAndPermissions')->with('error', 'Role Already Exist');
            }
            $role = Role::create(['name' => $request->get('name')]);
            $role->syncPermissions($permission);

            return to_route('rolesAndPermissions')->with('success', 'Role Added Successfully');
        } else {
            $role = Role::findorfail($express);
            $role->update($request->only('name'));
            $role->syncPermissions($permission);
            return to_route('rolesAndPermissions')->with('success', 'Role Updated Successfully');
        }
    }
    public function destroy($id)
    {
        $role = Role::findorfail($id);
        $role->delete();
        return to_route('rolesAndPermissions')->with('success', 'Role Deleted Successfully');
    }
}
