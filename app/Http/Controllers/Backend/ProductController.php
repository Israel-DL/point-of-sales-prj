<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Supplier;
use Carbon\Carbon;
use Intervention\Image\ImageManager;
use Intervention\Image\Drivers\Gd\Driver;

class ProductController extends Controller
{
    //
    public function AllProduct(){

        $product = Product::latest()->get();
        return view('backend.product.all_product', compact('product'));
    }

    public function AddProduct(){

        $productCategory = ProductCategory::latest()->get();
        $supplier = Supplier::latest()->get();
        return view('backend.product.add_product', compact('productCategory','supplier'));
    }

    public function StoreProduct(Request $request){

        $image = $request->file('product_image');

        if ($image) {
            
            $manager = new ImageManager(new Driver());
            
            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            
            $manager->read($image)->resize(300, 300)->save(public_path('upload/products/' . $name_gen));
            
            $save_url = 'upload/products/' . $name_gen;
        
        } else {
            $save_url = null;
        }

        Product::insert([
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'product_image' => $save_url,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product created succesfully',
            'alert-type' => 'success',
        );

        return redirect()->route('all.product')->with($notification);
    }

    public function EditProduct($id){

        $product = Product::findOrFail($id);
        $productCategory = ProductCategory::latest()->get();
        $supplier = Supplier::latest()->get();
        return view('backend.product.edit_product', compact('product', 'productCategory', 'supplier'));
    }

    public function UpdateProduct(Request $request){

        $product_id = $request->id;
        $product = Product::findOrFail($product_id);
        
        $data = [
            'product_name' => $request->product_name,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'product_code' => $request->product_code,
            'product_garage' => $request->product_garage,
            'product_store' => $request->product_store,
            'buying_date' => $request->buying_date,
            'expire_date' => $request->expire_date,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'updated_at' => Carbon::now(),
        ];

        if ($request->file('product_image')) {

            $image = $request->file('product_image');
            $manager = new ImageManager(new Driver());

            $name_gen = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();

            // Delete old image if exists
            if ($product->product_image && file_exists(public_path($product->image))) {
                unlink(public_path($product->product_image));
            }

            $manager->read($image)->resize(300, 300)->save(public_path('upload/products/' . $name_gen));

            $data['product_image'] = 'upload/products/' . $name_gen;
        }
        
        $product->update($data);
        
        $notification = [
            'message' => $request->file('product_image') ? 'Product data updated with new image successfully' : 'Product data updated without image successfully',
            'alert-type' => 'success',
        ];
        
        return redirect()->route('all.product')->with($notification);
    }

    public function DeleteProduct($id){
        
        $product_img = Product::findOrFail($id);
        $img = $product_img->product_image;
        unlink($img);

        Product::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product deleted succesfully',
            'alert-type' => 'success',
        );

        return redirect()->back()->with($notification);
    }
}
