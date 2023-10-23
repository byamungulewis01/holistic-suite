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
            'post' => 'required',
        ]);

        // merge password , role
        $request->merge([
            'password' => bcrypt('12345678'),
            'role' => 'headquarter']);

        $user = User::where('role', 'headquarter')->where('post', 1)->first();
        if ($request->post == 1) {
            if ($user) {
                return back()->with('warning', 'Header Paster Arleady existy');
            }
        } else {
            if (!$user) {
                return back()->with('warning', 'Must First Add Head Paster');
            }
        }
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
            'post' => 'required',
        ]);

        $header = User::where('role', 'headquarter')->where('post', 1)->whereNot('id', $id)->first();
        if ($request->post == 1) {
            if ($header) {
                return back()->with('warning', 'Header Paster Arleady existy');
            }
        } else {
            if (!$header) {
                return back()->with('warning', 'Must First Add Head Paster');
            }
        }

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
        $users = User::where('role', 'region')->orderBy('region_id')->get();
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
            'post' => 'required',
        ]);
        // merge password , role
        $request->merge([
            'password' => bcrypt('12345678'),
            'role' => 'region',
            'region_id' => $request->region,
        ]);
        $user = User::where('role', 'region')->where('region_id', $request->region)->where('post', 1)->first();
        if ($request->post == 1) {
            if ($user) {
                return back()->with('warning', 'Header Paster Arleady existy');
            }
        } else {
            if (!$user) {
                return back()->with('warning', 'Must First Add Head Paster');
            }
        }
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
        $header = User::where('role', 'region')->where('post', 1)->where('region_id', $request->region)->whereNot('id', $id)->first();
        if ($request->post == 1) {
            if ($header) {
                return back()->with('warning', 'Header Paster Arleady existy');
            }
        } else {
            if (!$header) {
                return back()->with('warning', 'Must First Add Head Paster');
            }
        }
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
            'post' => 'required',
        ]);

        $region_id = Office::where('reg_number', $request->region)->first()->id;
        $parish_id = Office::where('reg_number', $request->parish)->first()->id;
        // merge password , role
        $request->merge([
            'password' => bcrypt('12345678'),
            'role' => 'parish',
            'region_id' => $region_id,
            'parish_id' => $parish_id,
        ]);
        $user = User::where('role', 'parish')->where('parish_id', $parish_id)->where('post', 1)->first();
        if ($request->post == 1) {
            if ($user) {
                return back()->with('warning', 'Header Paster Arleady existy');
            }
        } else {
            if (!$user) {
                return back()->with('warning', 'Must First Add Head Paster');
            }
        }

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
            'post' => 'required',
        ]);
        // merge

        $region_id = Office::where('reg_number', $request->region)->first()->id;
        $parish_id = Office::where('reg_number', $request->parish)->first()->id;

        $request->merge([
            'region_id' => $region_id,
            'parish_id' => $parish_id,
        ]);
        $header = User::where('role', 'parish')->where('post', 1)->where('parish_id', $parish_id)->whereNot('id', $id)->first();
        if ($request->post == 1) {
            if ($header) {
                return back()->with('warning', 'Header Paster Arleady existy');
            }
        } else {
            if (!$header) {
                return back()->with('warning', 'Must First Add Head Paster');
            }
        }
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
            'post' => 'required',
        ]);
        // merge password , role
        $region_id = Office::where('reg_number', $request->region)->first()->id;
        $parish_id = Office::where('reg_number', $request->parish)->first()->id;
        $local_church_id = Office::where('reg_number', $request->local_church)->first()->id;
        $request->merge([
            'password' => bcrypt('12345678'),
            'role' => 'local church',
            'region_id' => $region_id,
            'parish_id' => $parish_id,
            'local_church_id' => $local_church_id,
        ]);

        $user = User::where('role', 'local church')->where('local_church_id', $local_church_id)->where('post', 1)->first();
        if ($request->post == 1) {
            if ($user) {
                return back()->with('warning', 'Header Paster Arleady existy');
            }
        } else {
            if (!$user) {
                return back()->with('warning', 'Must First Add Head Paster');
            }
        }

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
            'post' => 'required',
        ]);
        $local_church_id = Office::where('reg_number', $request->local_church)->first()->id;
        // merge
        $request->merge([
            'region_id' => Office::where('reg_number', $request->region)->first()->id,
            'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
            'local_church_id' => $local_church_id,
        ]);
        $header = User::where('role', 'local church')->where('local_church_id', $local_church_id)->where('post', 1)->whereNot('id',$id)->first();
        if ($request->post == 1) {
            if ($header) {
                return back()->with('warning', 'Header Paster Arleady existy');
            }
        } else {
            if (!$header) {
                return back()->with('warning', 'Must First Add Head Paster');
            }
        }
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
