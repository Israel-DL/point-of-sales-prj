<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\ProductCategory;

class ProductCategoryController extends Controller
{
    //
    public function AllProductCategory(){

        $category = ProductCategory::latest()->get();
        return view('backend.product_category.all_product_category', compact('category'));
    }

    public function StoreProductCategory(Request $request){

        ProductCategory::insert([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Category created succesfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.product.category')->with($notification);
    }

    public function EditProductCategory($id){

        $category = ProductCategory::findOrFail($id);
        return view('backend.product_category.edit_product_category', compact('category'));
    }

    public function UpdateProductCategory(Request $request){

        $category_id = $request->id;

        ProductCategory::findOrFail($category_id)->update([
            'category_name' => $request->category_name,
            'created_at' => Carbon::now(),
        ]);

        $notification = array(
            'message' => 'Product Category updated succesfully',
            'alert-type' => 'success',
        );
        
        return redirect()->route('all.product.category')->with($notification);
    }

    public function DeleteProductCategory($id){

        ProductCategory::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Product Category deleted succesfully',
            'alert-type' => 'success',
        );
        
        return redirect()->back()->with($notification);
    }
}
