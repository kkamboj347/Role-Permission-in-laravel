<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Validator;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class RoleController extends Controller implements HasMiddleware
{
     public static function middleware(): array {
        return [
            new Middleware('permission:view roles', only: ['index']),
            new Middleware('permission:edit roles', only: ['edit']),
            new Middleware('permission:create roles', only: ['create']),
            new Middleware('permission:create roles', only: ['destroy']),
        ];
    }

    //This method will show the roles pages
    public function index() {
     $roles = Role::orderBy('name','ASC')->paginate(2);
     return view("roles.list",['roles'=>$roles]);
    }

    // This method will create the role page
    public function create() {
        $permissions = Permission::orderBy('name','ASC')->get();
        return view('roles.create',["permissions"=>$permissions]);
    }

    // This method will insert in a role in DB 
    public function store(Request $request) {
        $validated = Validator::make($request->all(),[
            'name'=>'required|unique:roles|min:3'
        ]);
        if($validated->passes()) {
            //dd($request -> permission);
            $role = Role::create(['name'=>$request->name]);
            if(!empty($request->permission)) {
                foreach($request->permission as $name) {
                    $role->givePermissionTo($name);
                }
            }
            return redirect()->route('roles.index')->with('success','Roles Added Successfully!');
        }else {
            return redirect()->route('roles.create')->withInput()->withErrors($validated);
        }

    }

    // This method will edit the roles
        public function edit($id) {
            $role = Role::findOrFail($id);
            $hasPermissions = $role->permissions->pluck('name');
            //check the permission value using dd variable 
            //dd($permission);
            $permissions = Permission::orderBy('name','ASC')->get();
            return view('roles.edit',['role'=>$role,'hasPermissions' => $hasPermissions, 'permissions' =>$permissions ]);

        }

    // 
    public function update($id, Request $request) {
        $role = Role::findOrFail($id);
        $validated = Validator::make($request->all(),[
            'name'=>'required|unique:roles,name,'.$id.',id'
        ]);
        if ($validated->passes()) {
            $role->name = $request->name;
            $role->save();
            if(!empty($request->permission)) {
                $role->syncPermissions($request->permission);
            } else {
                $role->syncPermissions([]);
            }
            return redirect()->route('roles.index')->with('Roles Updated Successfully!');
        } else {
            return redirect()->route('roles.edit',$id)->withInput()->withErrors($validated);
        }
    }

    // 
    public function destroy(Request $request) {
        $id = $request->id;
        $role = Role::find($id);
        if($role == null) {
            session()->flash('error', 'Role Not Found');
            return response()->json([
                'status'=>false
            ]);
        }
        $role->delete();
        session()->flash('success',"Role Deleted Successfully!");
        return response()->json([
            'status'=>true
        ]);

    }
}
