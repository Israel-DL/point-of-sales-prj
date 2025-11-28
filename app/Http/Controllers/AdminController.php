<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    //
    public function AdminDestroy(Request $request): RedirectResponse {

        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $notification = array(
            'message' => 'Come back soon',
            'alert-type' => 'success',
        );

        return redirect('/logout')->with($notification);
    }// End Method

    public function AdminLogoutPage(){

        return view('admin.admin_logout');
    }// End Method

    public function AdminProfile(){

        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile_view', compact('adminData'));
    }// End Method

    public function AdminStoreProfile(Request $request){

        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_image/'.$data->photo));
            $filename = date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_image'),$filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Profile Updated Successfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }// End Method

    public function ChangePassword(){

        return view('admin.admin_change_password');
    }// End Method
    
    public function UpdatePassword(Request $request){

        //Validation
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match Old Password
        if (!Hash::check($request->old_password, auth::user()->password)) {

            # code...
            $notification = array(
                'message' => 'Old Password doesnt match!!',
                'alert-type' => 'error',
            );

            return back()->with($notification);
        }

        // Update the password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        $notification = array(
            'message' => 'Password updated successfully',
            'alert-type' => 'success',
        );
        
        return back()->with($notification);
        
    }// End Method


    //////////////////////// All Admin User Methods ////////////////////////
    public function AllAdmin(){

        $alladminuser = User::latest()->get();
        return view('backend.admin.all_admin', compact('alladminuser'));
    }

    public function AddAdmin(){
        
        $roles = Role::all();
        return view('backend.admin.add_admin', compact('roles'));
    }

    public function StoreAdmin(Request $request){

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        $user->save();

        if ($request->roles){
            $role = Role::find($request->roles);
            $user->assignRole($role);
        }

        $notification = array(
            'message' => 'Admin User Created Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.admin')->with($notification);
    }

    public function EditAdmin($id){

        $roles = Role::all();
        $adminuser = User::findOrFail($id);
        return view('backend.admin.edit_admin', compact('adminuser','roles'));
    }

    public function UpdateAdmin(Request $request){

        $admin_id = $request->id;

        $user = User::findOrFail($admin_id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->save();

        $user->roles()->detach();
        if ($request->roles){
            $role = Role::find($request->roles);
            $user->assignRole($role);
        }

        $notification = array(
            'message' => 'Admin User Updated Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.admin')->with($notification);
    }

    public function DeleteAdmin($id){

        $user = User::findOrFail($id);
        if(!is_null($user)){
            $user->delete();
        }
        
        $notification = array(
            'message' => 'Admin User Deleted Successfully',
            'alert-type' => 'success',
        );
        
        return redirect()->back()->with($notification);
    }
}
