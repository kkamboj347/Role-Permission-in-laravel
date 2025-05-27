<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;


class UserController extends Controller implements HasMiddleware
{
     public static function middleware(): array {
        return [
            new Middleware('permission:view users', only: ['index']),
            new Middleware('permission:edit users', only: ['edit']),
            // new Middleware('permission:create users', only: ['create']),
            // new Middleware('permission:delete users', only: ['destroy']),
        ];
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $users= User::latest()->paginate(10);
        return view('users.list',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // 
        $user = User::findOrFail($id);
        $roles = Role::orderBy('name','ASC')->get();
        $hasRole= $user->roles->pluck('id');
        return view('users.edit', ['user'=>$user,'roles'=>$roles,'hasRole'=>$hasRole]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $validated = Validator::make($request->all(),[
            'name' => 'required| min:5',
            'email' =>'required|email|unique:users,email,'.$id.',id'
        ]);
        if($validated->fails()) {
            return redirect()->route('users.edit',$id)->withInput()->withErrors($validated);
        }
        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        $user->syncRoles($request->role);
        return redirect()->route('users.index')->with('success', 'User Updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
