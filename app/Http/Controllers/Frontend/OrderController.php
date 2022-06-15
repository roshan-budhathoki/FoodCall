<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\DriverOrder;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\driver;
use App\Models\CheckoutDetail;
use App\Models\SubOrder;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function checkoutorder(Request $request){
        $checks = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select('menus.id', 'menus.image', 'menus.productname', 'menus.price', 'carts.quantity')->get();
        $totals = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select(DB::raw('menus.price * carts.quantity as total'))->get();
        $sum = 0;
        foreach($totals as $total){
            $sum += $total->total;
        }
        $checkout = new CheckoutDetail();
        $checkout->address = $request->address;
        $checkout->contact = $request->contact;
        $checkout->email = $request->email;
        $checkout->user_id = session('user');
        $checkout->note = $request->note;
        $checkout->save();

        $order = new order();
        $order->subtotal = $sum;
        $order->charge = 30;
        $order->total = $sum+30;
        $order->user_id = $checkout->id;
        $order->order_status = "Pending";
        $order->save();

        $driver_order = new DriverOrder();
        $driver_order->driver_id = -1;
        $driver_order->order_id = $order->id;
        $driver_order->save();

        foreach ($checks as $check){
            $suborder = new suborder();
            $suborder->product_id = $check->id;
            $suborder->product_quantity = $check->quantity;
            $suborder->order_id = $order->id;
            $suborder->save();
        }
        Cart::where('user_id', session('user'))->delete();

        return redirect('/orderhistory')->with(["success" => "added to cart"]);
    }

    public function orderhistory(){
        $checks = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select('carts.id', 'menus.image', 'menus.productname', 'menus.price', 'carts.quantity')->get();
        $totals = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select(DB::raw('menus.price * carts.quantity as total'))->get();
        $sum = 0;
        foreach($totals as $total){
            $sum += $total->total;
        }
        $details = CheckoutDetail::where('User_id', session('user'))->select('id')->get();
        $orders = DB::table('orders')->whereIn('User_id', $details)->join('sub_orders', 'orders.id', 'sub_orders.order_id')->join('menus', 'menus.id', 'sub_orders.product_id')->orderBy('orders.created_at',)->get();
        $count = cart::where('user_id',session('user'))->count();
        $orderNumbers = DB::table('orders')->whereIn('User_id', $details)->leftJoin('driver_orders', 'driver_orders.order_id', 'orders.id' )->orderBy('orders.created_at', 'desc')->get();
        $driver_orders  = DB::table('driver_orders')->get();
        return view('frontend.orderhistory', compact("checks","sum", "count", "orders", "orderNumbers", "driver_orders"));
    }

    public function updatequantity(Request $request){
        $quantity = $request->quantity;
        if ($quantity < 1){
            $quantity = 1;
        }
        $cart = Cart::where('id', $request->id)->first();
        $cart->quantity = $quantity;
        $cart->save();

        $checks = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select('carts.id', 'menus.image', 'menus.productname', 'menus.price', 'carts.quantity')->get();
        $totals = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select(DB::raw('menus.price * carts.quantity as total'))->get();
        $sum = 0;
        foreach($totals as $total){
            $sum += $total->total;
        }
        $count = cart::where('user_id',session('user'))->count();
        return view('frontend.cartItem',compact("checks", "sum", "count"));
    }


    public function adminAddriver(){
        $data=driver::all();
        return view('admin.adminAddriver', compact("data"));
    }

    public function driverList(){
        $data=driver::all();
        return view('admin.driverList', compact("data"));
    }

    public function driveradd(Request $request){
        $data = new driver();

        $data->username=$request->username;
        $data->email=$request->email;
        $data->adderess=$request->adderess;
        $data->contact=$request->contact;
        $data->lisenceNumber=$request->lisenceNumber;
        $data->password=$request->password;

        $data->save();
        return redirect()->back();
    }

    public function assinedorder(){
        $orders = DB::table('orders')->join('checkout_details', 'checkout_details.id', 'orders.User_id')->join('logins', 'logins.id', 'checkout_details.User_id')->select('orders.id', 'checkout_details.id as user_id', 'username', 'checkout_details.address', 'checkout_details.contact', 'Order_status', 'Subtotal', 'Total')->get();
        $assigned_orders= DB::table('driver_orders')->where('driver_id', session('user'))->join('orders', 'driver_orders.order_id', 'orders.id')->get();
        return view('driver.assinedorder', compact('orders', 'assigned_orders'));
    }

    public function assignorder(Request $request){
        $drivername = explode("," , $request->driver_order)[0];
        $order = intval(explode("," , $request->driver_order)[1]);

        $driver_id = driver::where('username', $drivername)->first();

        $driver_order = DriverOrder::where('order_id', $order)->first();
        $driver_order->driver_id = $driver_id->id;
        $driver_order->save();

        return response()->json(["success"=>"driver assigned"]);
    }
    public function changeOrderStatus(Request $request){
        $order_status = explode("," , $request->order_status)[0];
        $order_id = intval(explode("," , $request->order_status)[1]);

        $order = Order::where('id', $order_id)->first();
        $order->Order_status = $order_status;
        $order->save();
        return response()->json(["success" => "order is changed."]);

    }

    public function assinedorderdetail($id, $orderId){
        $orders = DB::table('orders')->where('orders.id', $orderId)->join('sub_orders', 'orders.id', 'sub_orders.order_id')->join('menus', 'menus.id', 'sub_orders.product_id')->get();
        $details = DB::table('checkout_details')->where('checkout_details.id', $id)->join('logins', 'logins.id', 'checkout_details.User_id')->select('username')->first();
        return view('driver.assinedorderdetail', compact("orders", "details"));
    }


}
