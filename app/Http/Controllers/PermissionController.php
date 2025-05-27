<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Permission;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Routing\Controllers\Middleware;

class PermissionController extends Controller implements HasMiddleware 
{
     public static function middleware(): array {
        return [
            new Middleware('permission:view permissions', only: ['index']),
            new Middleware('permission:edit permissions', only: ['edit']),
            new Middleware('permission:create permissions', only: ['create']),
            new Middleware('permission:delete permissions', only: ['destroy']),
        ];
    }

    // This method will show permission page
    public function index() {
        $permissions = Permission::orderBy('created_at','DESC')->paginate(10);
        return view('permissions.list',[
            'permissions'=>$permissions
        ]);
    }

    // This method wil show create a permission
    public function create() {
        return view('permissions.create');
    }

    // This method will insert a permission in DB
    public function store(Request $request) {
        $validated = Validator::make($request->all(),[
            'name'=>'required| unique:permissions|min:3'
        ]);
        
        if ($validated->passes()) {
         Permission::create(['name'=>$request->name]);
         return redirect()->route('permissions.index')->with('success',"Permission Added Successfully!");
        } else {
            return redirect()->route('permissions.create')->withInput()->withErrors($validated);
        }

    }

    // This method will edit permission 
    public function edit($id) {
        $permission = Permission::findOrFail($id);
        return view('permissions.edit',["permission"=>$permission]);
    }

    // This method will update a permission
    public function update($id, Request $request) {
        $permission = Permission::findOrFail($id);
        $validated = Validator::make($request->all(),[
            'name'=>'required|min:3|unique:permissions,name,'.$id.',id',
        ]);
        if($validated->passes()) {
            $permission->name = $request->name;
            $permission->save();
            return redirect()->route('permissions.index')->with("success","Permission Updated Successfully!");
        } else {
            return redirect()->route('permissions.edit',$id)->withInput()->withErrors($validated);
        }
    }

    // This methoda will delete a permission 
    public function destroy(Request $request) {
        $id = $request->id;
        $permission = Permission::find($id);
        if($permission == null) {
            session()->flash('error','Permission Not Found');
            return response()->json([
                'status'=>false
            ]);
        }
        $permission->delete();
        session()->flash('success','Permission Deleted Successfully!');
        return response()->json([
            "status"=>true
        ]);
    }
}
