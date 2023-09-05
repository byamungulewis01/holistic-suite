<?php

namespace App\Http\Controllers;

use App\Models\Office;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    //headquarterUsers
    public function headquarterUsers()
    {
        $users = User::where('role', 'headquarter')->get();
        return view('users.headquarter.index', compact('users'));
    }
    // storeHeadquarterUser
    public function storeHeadquarterUser(Request $request)
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
            'role' => 'headquarter',
        ]);
        User::create($request->all());
        return back()->with('success', 'User created successfully');
    }
    // updateHeadquarterUser
    public function updateHeadquarterUser(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'username' => 'required|unique:users,username,' . $id,
        ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return back()->with('success', 'User updated successfully');
    }
    // destroyHeadquarterUser
    public function destroyHeadquarterUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }

    // regionUsers
    public function regionUsers()
    {
        $users = User::where('role', 'region')->get();
        $regions = Office::where('type', 'region')->get();
        return view('users.headquarter.region', compact('users', 'regions'));
    }
    // storeRegionUser
    public function storeRegionUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users|numeric|digits:10',
            'username' => 'required|unique:users',
            'region' => 'required',
        ]);
        // merge password , role
        $request->merge([
            'password' => bcrypt('12345678'),
            'role' => 'region',
            'region_id' => $request->region,
        ]);
        User::create($request->all());
        return back()->with('success', 'User created successfully');
    }
    // updateRegionUser
    public function updateRegionUser(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'username' => 'required|unique:users,username,' . $id,
            'region' => 'required',
        ]);
        // merge
        $request->merge([
            'region_id' => $request->region,
        ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return back()->with('success', 'User updated successfully');
    }
    // destroyRegionUser
    public function destroyRegionUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }

    // parishUsers
    public function parishUsers()
    {
        $regions = Office::where('type', 'region')->get();
        return view('users.headquarter.parish', compact('regions'));
    }
    // parishUsersApi
    public function parishUsersApi()
    {
        $users = User::where('role', 'parish')->with('region', 'parish')->get();
        return response()->json($users);
    }

    // singleParishUsersApi
    public function singleParishUsersApi($id)
    {
        $users = User::where('role', 'parish')->where('parish_id', $id)->with('region', 'parish')->get();
        return response()->json($users);
    }

    // storeParishUser
    public function storeParishUser(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users|numeric|digits:10',
            'username' => 'required|unique:users',
            'region' => 'required',
            'parish' => 'required',
        ]);
        // merge password , role
        $request->merge([
            'password' => bcrypt('12345678'),
            'role' => 'parish',
            'region_id' => Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
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
            'region' => 'required',
            'parish' => 'required',
        ]);
        // merge
        $request->merge([
            'region_id' => Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
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
        $regions = Office::where('type', 'region')->get();
        return view('users.headquarter.local_church', compact('regions'));
    }
    // localChurchUsersApi
    public function localChurchUsersApi()
    {
        $users = User::where('role', 'local church')->with('region', 'parish', 'localChurch')->get();
        return response()->json($users);
    }
    // singleLocalChurchUsersApi
    public function singleLocalChurchUsersApi($id)
    {
        $users = User::where('role', 'local church')->where('local_church_id', $id)->with('region', 'parish', 'localChurch')->get();
        return response()->json($users);
    }

    // storeLocalChurchUser
    public function storeLocalChurchUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users|numeric|digits:10',
            'username' => 'required|unique:users',
            'region' => 'required',
            'parish' => 'required',
            'local_church' => 'required',
        ]);
        // merge password , role
        $request->merge([
            'password' => bcrypt('12345678'),
            'role' => 'local church',
            'region_id' => Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
            'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
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
            'region' => 'required',
            'parish' => 'required',
            'local_church' => 'required',
        ]);
        // merge
        $request->merge([
            'region_id' => Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
            'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
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
