<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\User;
use DB;

class RoleController extends Controller
{
    //
    public function AllPermission(){

        $permissions = Permission::all();
        return view('backend.pages.permission.all_permission', compact('permissions'));
    }

    public function AddPermission(){

        return view('backend.pages.permission.add_permission');
    }

    public function StorePermission(Request $request){

        Permission::create([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission created succesfully',
            'alert-type' => 'success',
        );
            
        return redirect()->route('all.permission')->with($notification);
    }

    public function EditPermission($id){

        $permission = Permission::findOrFail($id);
        return view('backend.pages.permission.edit_permission', compact('permission'));
    }

    public function UpdatePermission(Request $request){

        $per_id = $request->id;
        
        Permission::findOrFail($per_id)->update([
            'name' => $request->name,
            'group_name' => $request->group_name,
        ]);

        $notification = array(
            'message' => 'Permission updated succesfully',
            'alert-type' => 'success',
        );
            
        return redirect()->route('all.permission')->with($notification);
    }

    public function DeletePermission($id){

        Permission::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Permission deleted succesfully',
            'alert-type' => 'success',
        );
            
        return redirect()->back()->with($notification);
    }

    public function AllRoles(){

        $roles = Role::all();
        return view('backend.pages.roles.all_roles', compact('roles'));
    }

    public function AddRole(){
        
        return view('backend.pages.roles.add_role');
    }

    public function StoreRole(Request $request){

        Role::create([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role created succesfully',
            'alert-type' => 'success',
        );
            
        return redirect()->route('all.roles')->with($notification);
    }

    public function EditRole($id){

        $role = Role::findOrFail($id);
        return view('backend.pages.roles.edit_role', compact('role'));
    }

    public function UpdateRole(Request $request){

        $role_id = $request->id;

        Role::findOrFail($role_id)->update([
            'name' => $request->name,
        ]);

        $notification = array(
            'message' => 'Role updated succesfully',
            'alert-type' => 'success',
        );
            
        return redirect()->route('all.roles')->with($notification);
    }

    public function DeleteRole($id){

        Role::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Role deleted succesfully',
            'alert-type' => 'success',
        );
            
        return redirect()->back()->with($notification);
    }

    public function AddRolesPermission(){

        $roles = Role::all();
        $permissions = Permission::all();
        $permission_groups = User::getpermissionGroups();
        return view('backend.pages.roles.add_roles_permission', compact('roles', 'permissions','permission_groups'));
    }

    public function RolePermissionStore(Request $request){

        $data = array();
        $permissions = $request->permission;

        foreach($permissions as $key => $item){
            $data['role_id'] = $request->role_id;
            $data['permission_id'] = $item;
            DB::table('role_has_permissions')->insert($data);
        }

        $notification = array(
            'message' => 'Role Permission assigned succesfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.roles.permission')->with($notification);
    }

    public function AllRolesPermission(){

        $roles = Role::all();
        return view('backend.pages.roles.all_roles_permission', compact('roles'));
    }
}
