<?php

namespace App\Http\Controllers\Region;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Office;

class UsersController extends Controller
{
    //regionUsers
    public function regionUsers()
    {
        $users = User::where('role', 'region')->where('region_id', auth()->user()->region_id)->get();
        return view('users.region.index', compact('users'));
    }
    public function storeRegionUser(Request $request)
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
            'role' => 'region',
            'region_id' => auth()->user()->region_id
        ]);
        User::create($request->all());
        return back()->with('success', 'User created successfully');
    }
    public function updateRegionUser(Request $request, $id)
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
            'region_id' => auth()->user()->region_id
        ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return back()->with('success', 'User updated successfully');
    }
    public function destroyRegionUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }
    // parishUsers
    public function parishUsers()
    {
        $users = User::where('role', 'parish')->where('region_id', auth()->user()->region_id)->get();
        $region = Office::findorfail(auth()->user()->region_id)->reg_number;
        $parishes = Office::where('type', 'parish')->where('region_number', $region)->get();
        return view('users.region.parish', compact('users', 'parishes'));
    }
    public function storeParishUser(Request $request)
    {

        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users|numeric|digits:10',
            'username' => 'required|unique:users',
            'parish' => 'required',
        ]);
        // merge password , role
        $request->merge([
            'password' => bcrypt('12345678'),
            'role' => 'parish',
            'region_id' => auth()->user()->region_id,
            'parish_id' => $request->parish,
        ]);
        User::create($request->all());
        return back()->with('success', 'User created successfully');
    }
    public function updateParishUser(Request $request, $id)
    {
        $request->validate([
            'id' => 'required',
            'name' => 'required',
            'email' => 'required|unique:users,email,' . $id,
            'phone' => 'required|unique:users,phone,' . $id,
            'username' => 'required|unique:users,username,' . $id,
            'parish' => 'required',
        ]);
        // merge
        $request->merge([
            'region_id' => auth()->user()->region_id,
            'parish_id' => $request->parish,
        ]);
        $user = User::findOrFail($id);
        $user->update($request->all());
        return back()->with('success', 'User updated successfully');
    }
    public function destroyParishUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return back()->with('success', 'User deleted successfully');
    }

    public function localChurchUsers()
    {
        $users = User::where('role', 'local church')->where('region_id', auth()->user()->region_id)->get();
        $region = Office::findorfail(auth()->user()->region_id)->reg_number;
        $parishes = Office::where('type', 'parish')->where('region_number', $region)->get();
        return view('users.region.local_church', compact('users', 'parishes'));
    }
    public function storeLocalChurchUser(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'phone' => 'required|unique:users|numeric|digits:10',
            'username' => 'required|unique:users',
            'parish' => 'required',
            'local_church' => 'required',
        ]);
        // merge password , role
        $request->merge([
            'password' => bcrypt('12345678'),
            'role' => 'local church',
            'region_id' => auth()->user()->region_id,
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
              'parish' => 'required',
              'local_church' => 'required',
         ]);
         // merge
         $request->merge([
              'region_id' => auth()->user()->region_id,
              'parish_id' => Office::where('reg_number', $request->parish)->first()->id,
              'local_church_id' => Office::where('reg_number', $request->local_church)->first()->id,
         ]);
         $user = User::findOrFail($id);
         $user->update($request->all());
         return back()->with('success', 'User updated successfully');
    }
     public function destroyLocalChurchUser($id)
     {
          $user = User::findOrFail($id);
          $user->delete();
          return back()->with('success', 'User deleted successfully');
     }

}
