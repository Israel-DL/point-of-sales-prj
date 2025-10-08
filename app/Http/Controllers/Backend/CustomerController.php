<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class CustomerController extends Controller
{
    //
    public function AllCustomer(){

        $customer = Customer::latest()->get();
        return view('backend.customer.all_customer', compact('customer'));
    }

    public function AddCustomer(){

        return view('backend.customer.add_customer');
    }

    public function CustomerStore(Request $request){

        $validateData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:customers|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');

        if ($image) {
            
            $manager = new ImageManager(new Driver());
            
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            
            $manager->read($image)->resize(300, 300)->save(public_path('upload/customer/' . $name_gen));
            
            $save_url = 'upload/customer/' . $name_gen;
        
        } else {
            $save_url = null;
        }

        Customer::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Customer created succesfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.customer')->with($notification);
    }

    public function EditCustomer($id){

        $customer = Customer::findOrFail($id);
        return view('backend.customer.edit_customer', compact('customer'));
    }

    public function UpdateCustomer(Request $request){

        $customer_id = $request->id;
        $customer = Customer::findOrFail($customer_id);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'updated_at' => Carbon::now(),
        ];

        if ($request->file('image')) {

            $image = $request->file('image');
            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            // Delete old image if exists
            if ($customer->image && file_exists(public_path($customer->image))) {
                unlink(public_path($customer->image));
            }

            $manager->read($image)->resize(300, 300)->save(public_path('upload/customer/' . $name_gen));

            $data['image'] = 'upload/customer/' . $name_gen;
        }
        
        $customer->update($data);
        
        $notification = [
            'message' => $request->file('image') ? 'Customer data updated with new image successfully' : 'Customer data updated without image successfully',
            'alert-type' => 'success',
        ];
        
        return redirect()->route('all.customer')->with($notification);
    }

    public function DeleteCustomer($id){

        $customer_img = Customer::findOrFail($id);
        $img = $customer_img->image;
        unlink($img);

        Customer::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Customer deleted succesfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

}
