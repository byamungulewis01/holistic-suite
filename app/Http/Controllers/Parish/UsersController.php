<?php

namespace App\Http\Controllers\Parish;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Office;

class UsersController extends Controller
{
    //parishUsers
    public function parishUsers()
    {
        $users = User::where('role', 'parish')->where('parish_id', auth()->user()->parish_id)->get();
        return view('users.parish.index', compact('users'));
    }
    public function storeParishUser(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users|numeric|digits:10',
            'username' => 'required|unique:users',
        ]);
        // merge password , role
        $request->merge([
            'password' => bcrypt('12345678'),
            'role' => 'parish',
            'region_id' => auth()->user()->region_id,
            'parish_id' => auth()->user()->parish_id
        ]);
        User::create($request->all());
        return back()->with('success', 'User created successfully');
    }
    // updateParishUser

    public function updateParishUser(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'username' => 'required|unique:users,username,' . $id,
        ]);
        // merge
        $request->merge([
            'region_id' => auth()->user()->region_id,
            'parish_id' => auth()->user()->parish_id
        ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return back()->with('success', 'User updated successfully');
    }
    // destroyParishUser
    public function destroyParishUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
    // localChurchUsers
    public function localChurchUsers()
    {
        $users = User::where('role', 'local church')->where('parish_id', auth()->user()->parish_id)->get();
        $parish = Office::findOrFail(auth()->user()->parish_id)->reg_number;
        $local_churches = Office::where('type', 'local-church')->where('parish_number', $parish)->get();
        return view('users.parish.local_church', compact('users', 'local_churches'));
    }
    // storeLocalChurchUser
    public function storeLocalChurchUser(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users|numeric|digits:10',
            'username' => 'required|unique:users',
            'local_church' => 'required',
        ]);
        // merge password , role
        $request->merge([
            'password' => bcrypt('12345678'),
            'role' => 'local church',
            'region_id' => auth()->user()->region_id,
            'parish_id' => auth()->user()->parish_id,
            'local_church_id' => $request->local_church,
        ]);
        User::create($request->all());
        return back()->with('success', 'User created successfully');
    }
    // updateLocalChurchUser
    public function updateLocalChurchUser(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'username' => 'required|unique:users,username,' . $id,
            'local_church' => 'required',
        ]);
        // merge
        $request->merge([
            'region_id' => auth()->user()->region_id,
            'parish_id' => auth()->user()->parish_id,
            'local_church_id' => $request->local_church,
        ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return back()->with('success', 'User updated successfully');
    }
    // destroyLocalChurchUser
    public function destroyLocalChurchUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
}
