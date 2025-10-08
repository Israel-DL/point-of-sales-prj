<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class SupplierController extends Controller
{
    //
    public function AllSupplier(){

        $supplier = Supplier::latest()->get();
        return view('backend.supplier.all_supplier', compact('supplier'));
    }

    public function AddSupplier(){

        return view('backend.supplier.add_supplier');
    }

    public function SupplierStore(Request $request){
        
        $validateData = $request->validate([
            'name' => 'required|max:200',
            'email' => 'required|unique:customers|max:200',
            'phone' => 'required|max:200',
            'address' => 'required|max:400',
            'shopname' => 'required|max:200',
            'account_holder' => 'required|max:200',
            'account_number' => 'required',
            'type' => 'required',
            'image' => 'required',
        ]);

        $image = $request->file('image');

        if ($image) {
            
            $manager = new ImageManager(new Driver());
            
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            
            $manager->read($image)->resize(300, 300)->save(public_path('upload/supplier/' . $name_gen));
            
            $save_url = 'upload/supplier/' . $name_gen;
        
        } else {
            $save_url = null;
        }

        Supplier::insert([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'type' => $request->type,
            'account_holder' => $request->account_holder,
            'account_number' => $request->account_number,
            'bank_name' => $request->bank_name,
            'bank_branch' => $request->bank_branch,
            'city' => $request->city,
            'image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Supplier created succesfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.supplier')->with($notification);
    }

    public function EditSupplier($id){

        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.edit_supplier', compact('supplier'));
    }

    public function UpdateSupplier(Request $request){

        $supplier_id = $request->id;
        $supplier = Supplier::findOrFail($supplier_id);
        
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
            'shopname' => $request->shopname,
            'type' => $request->type,
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
            if ($supplier->image && file_exists(public_path($supplier->image))) {
                unlink(public_path($supplier->image));
            }

            $manager->read($image)->resize(300, 300)->save(public_path('upload/supplier/' . $name_gen));

            $data['image'] = 'upload/supplier/' . $name_gen;
        }
        
        $supplier->update($data);
        
        $notification = [
            'message' => $request->file('image') ? 'Supplier data updated with new image successfully' : 'Supplier data updated without image successfully',
            'alert-type' => 'success',
        ];
        
        return redirect()->route('all.supplier')->with($notification);
    }

    public function DeletesSupplier($id){

        $supplier_img = Supplier::findOrFail($id);
        $img = $supplier_img->image;
        unlink($img);

        Supplier::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Supplier deleted succesfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }

    public function DetailsSupplier($id){
        
        $supplier = Supplier::findOrFail($id);
        return view('backend.supplier.supplier_details', compact('supplier'));
    }
}
