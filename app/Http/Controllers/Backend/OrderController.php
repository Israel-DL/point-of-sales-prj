<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Order;
use App\Models\Orderdetails;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use DB;

class OrderController extends Controller
{
    //
    public function FinalInvoice(Request $request){

        $rtotal = floatval(str_replace(',', '', $request->total));
        $rpay = floatval(str_replace(',', '', $request->pay));
        $mtotal = $rtotal - $rpay;

        $data = array();
        $data['customer_id'] = $request->customer_id;
        $data['order_date'] = $request->order_date;
        $data['order_status'] = $request->order_status;
        $data['total_products'] = $request->total_products;
        $data['sub_total'] = $request->sub_total;
        $data['vat'] = $request->vat;
        $data['invoice_no'] = 'EPOS'.mt_rand(10000000,99999999);
        $data['total'] = $request->total;
        $data['payment_status'] = $request->payment_status;
        $data['pay'] = $request->pay;
        $data['due'] = $mtotal;
        $data['created_at'] = Carbon::now();

        $order_id = Order::insertGetId($data);
        $contents = Cart::content();

        $pdata = array();
        foreach($contents as $content){
            $pdata['order_id'] = $order_id;
            $pdata['product_id'] = $content->id;
            $pdata['quantity'] = $content->qty;
            $pdata['unitcost'] = $content->price;
            $pdata['total'] = $content->total;

            $insert = Orderdetails::insert($pdata);
        }

        $notification = array(
            'message' => 'Order Completed succesfully',
            'alert-type' => 'success',
        );

        Cart::destroy();

        return redirect()->route('pending.order')->with($notification);

    }

    public function PendingOrder(){

        $orders = Order::where('order_status','pending')->get();
        return view('backend.order.pending_order', compact('orders'));
    }

    public function OrderDetails($order_id){

        $order = Order::where('id',$order_id)->first();
        $orderItem = Orderdetails::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();
        return view('backend.order.order_details', compact('order','orderItem'));
    }

    public function OrderStatusUpdate(Request $request){

        $order_id = $request->id;

        $product = Orderdetails::where('order_id',$order_id)->get();

        foreach($product as $item){
            Product::where('id',$item->product_id)->update(['product_store' => DB::raw('product_store-'.$item->quantity)]);
        }

        Order::findOrFail($order_id)->update(['order_status' => 'confirmed']);

        $notification = array(
            'message' => 'Order Confirmed successfully',
            'alert-type' => 'success',
        );

        return redirect()->route('confirmed.order')->with($notification);
    }

    public function ConfirmedOrder(){

        $orders = Order::where('order_status','confirmed')->get();
        return view('backend.order.confirmed_order', compact('orders'));
    }

    public function ManageStocks(){

        $product = Product::latest()->get();
        return view('backend.stocks.all_stocks', compact('product'));
    }

    public function OrderInvoiceDownload($order_id){

        $order = Order::where('id',$order_id)->first();
        $orderItem = Orderdetails::with('product')->where('order_id',$order_id)->orderBy('id','DESC')->get();

        $pdf = Pdf::loadView('backend.order.order_invoice', compact('order','orderItem'))->setPaper('a4')->setOption([
            'tempDir' => public_path(),
            'chroot' => public_path(),
        ]);
        return $pdf->download('invoice.pdf');
    }

    public function PendingDueOrders(){

        $alldue = Order::where('due','>','0')->orderBy('id', 'DESC')->get();
        return view('backend.order.pending_due_orders', compact('alldue'));
    }

    public function OrderDueAjax($id){

        $order = Order::findOrFail($id);
        return response()->json($order);
    }

    public function UpdateDue(Request $request){

        $order_id = $request->id;
        $due_amount = $request->due;
        $pay_amount = $request->pay;

        $allorder = Order::findOrFail($order_id);
        $maindue = $allorder->due;
        $maindpay = $allorder->pay;

        $paid_due = $maindue - $due_amount;
        $paid_pay = $maindpay + $due_amount;

        Order::findOrFail($order_id)->update([
            'due' => $paid_due,
            'pay' => $paid_pay,
        ]);

        $notification = array(
            'message' => 'Due Amount Updated succesfully',
            'alert-type' => 'success',
        );
        return redirect()->route('pending.due.orders')->with($notification);
    }

    public function CompletedDueOrders(){

        $comp_due = Order::where('due','<=','0')->orderBy('id', 'DESC')->get();
        return view('backend.order.completed_due_orders', compact('comp_due'));
    }
}
