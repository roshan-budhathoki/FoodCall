<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Menu;
use App\Models\Cart;
use App\Models\driver;
use App\Models\Restaurant;
use Illuminate\Support\Facades\DB;

class Homecontroller extends Controller
{
    public function index(){
        if(session('user_type') == "admin"){
            return redirect(route('admin'));
        }
        $restaurants = DB::table('restaurants')
                ->limit(6)
                ->get();
        $checks = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select('carts.id', 'menus.image', 'menus.productname', 'menus.price', 'carts.quantity')->get();
        $totals = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select(DB::raw('menus.price * carts.quantity as total'))->get();
        $sum = 0;
        foreach($totals as $total){
            $sum += $total->total;
        }
        $count = cart::where('user_id',session('user'))->count();
        return view('frontend.index', compact(['restaurants', 'checks', 'sum', 'count']));
    }

    public function admin(){
        if(!session('user') || session('user_type') != "admin") {
            return redirect('/');
        }
        $users = Login::where('user_type', '=', 'User')->get();
        $username = session('username');
        return view('admin.admin', compact(['users', 'username']));
    }

    public function adminMenu(){
        $dropdown=restaurant::all();
        $data=menu::all();
        return view('admin.adminMenu', ['dropdown' => $dropdown])->with(compact('data'));
    }

    public function adminRestaurant(){
        $data=restaurant::all();
        return view('admin.adminRestaurant',compact("data"));
    }

    public function adminOrder(){
        $driverselect = DB::table('drivers')->get();
        $orders = DB::table('orders')->join('checkout_details', 'checkout_details.id', 'orders.User_id')->join('logins', 'logins.id', 'checkout_details.User_id')->select('orders.id', 'checkout_details.id as user_id', 'username', 'checkout_details.address', 'checkout_details.contact', 'Order_status', 'Subtotal', 'Total')->get();
        $order_driver = DB::table('orders')->join('driver_orders', 'driver_orders.order_id', 'orders.id')->leftJoin('drivers', 'drivers.id', 'driver_orders.driver_id')->get();
        return view('admin.adminOrder', ['driverselect' => $driverselect])->with (compact("orders", "order_driver"));
    }

    public function adminOrderDetails($id, $orderId){
        $orders = DB::table('orders')->where('orders.id', $orderId)->join('sub_orders', 'orders.id', 'sub_orders.order_id')->join('menus', 'menus.id', 'sub_orders.product_id')->get();
        $details = DB::table('checkout_details')->where('checkout_details.id', $id)->join('logins', 'logins.id', 'checkout_details.User_id')->select('username')->first();
        return view('admin.adminOrderDetails', compact("orders", "details"));
    }

    public function restaurant(){
        $data=restaurant::all();
        $count = cart::where('user_id',session('user'))->count();
        $checks = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select('carts.id', 'menus.image', 'menus.productname', 'menus.price', 'carts.quantity')->get();
        $totals = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select(DB::raw('menus.price * carts.quantity as total'))->get();
        $sum = 0;
        foreach($totals as $total){
            $sum += $total->total;
        }
        return view('frontend.restaurant',compact("data", "count", "checks", "sum"));
    }

    public function menu1(){
        $menu=restaurant::all();
        $data=menu::all();
        $count = cart::where('user_id',session('user'))->count();
        $checks = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select('carts.id', 'menus.image', 'menus.productname', 'menus.price', 'carts.quantity')->get();
        $totals = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select(DB::raw('menus.price * carts.quantity as total'))->get();
        $sum = 0;
        foreach($totals as $total){
            $sum += $total->total;
        }
        return view('frontend.menu1',compact("menu","checks", "count", "sum"));
    }

    public function checkout(){
        $register=login::all();
        $checks = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select('carts.id', 'menus.image', 'menus.productname', 'menus.price', 'carts.quantity')->get();
        $totals = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select(DB::raw('menus.price * carts.quantity as total'))->get();
        $user = Login::where('id', session('user'))->first();
        $sum = 0;
        foreach($totals as $total){
            $sum += $total->total;
        }
        $count = cart::where('user_id',session('user'))->count();
        return view('frontend.checkout', compact("register", "checks","sum", "count", "user"));
    }

    public function profile(){
        $register=login::all();
        $checks = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select('carts.id', 'menus.image', 'menus.productname', 'menus.price', 'carts.quantity')->get();
        $totals = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select(DB::raw('menus.price * carts.quantity as total'))->get();
        $user = Login::where('id', session('user'))->first();
        $sum = 0;
        foreach($totals as $total){
            $sum += $total->total;
        }
        $count = cart::where('user_id',session('user'))->count();
        return view('frontend.profile', compact("checks","sum", "count", "user"));
    }

    public function editprofile(Request $request){
        $register = Login::where('id', session('user'))->first();

        $register->username = $request->username;
        $register->adderess = $request->address;
        $register->email = $request->email;
        $register->contact = (int)$request->contact;
        $register->save();
        session(['user' => $register->id, 'user_type' => $register->user_type, 'username' => $register->username]);
        return redirect()->back();
    }
    
    public function changepassword(){
        $checks = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select('carts.id', 'menus.image', 'menus.productname', 'menus.price', 'carts.quantity')->get();
        $totals = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select(DB::raw('menus.price * carts.quantity as total'))->get();
        $sum = 0;
        foreach($totals as $total){
            $sum += $total->total;
        }
        $count = cart::where('user_id',session('user'))->count();
        return view('frontend.changepassword', compact("checks","sum", "count"));
    }

    


    public function deleterestaurant($id){
        $res=restaurant::find($id);
        if ($res != null ){
            $res->delete();
        }
        $data=menu::find($id);
        // $data->delete();
        return redirect()->back();
    }

    public function deletemenu($id){
        $data=menu::find($id);
        $data->delete();
        return redirect()->back();
    }



    public function addrestaurant(Request $request){
        $data = new restaurant;

        $image=$request->image;

        $imagename =time().'.'.$image->getClientOriginalExtension();
            $request->image->move('restaurantimage',$imagename);

            $data->image=$imagename;

            $data->restaurantname=$request->restaurantname;
            $data->location=$request->location;
            $data->foodtype=$request->foodtype;
            $data->save();
            return redirect()->back();
    }

    public function editrestaurant($id){
        $editData = Restaurant::where('id', $id)->first();
        return redirect()->back()->with(['editData' => $editData]);
    }

    public function updaterestaurant(Request $request , $id){
        $editData = Restaurant::where('id', $id)->first();
        $image=$request->image;

        $imagename =time().'.'.$image->getClientOriginalExtension();
            $request->image->move('restaurantimage',$imagename);

            $editData->image=$imagename;

            $editData->restaurantname=$request->restaurantname;
            $editData->location=$request->location;
            $editData->foodtype=$request->foodtype;
            $editData->save();
            return redirect()->back();
    }

    public function restaurantselect(Request $request){
        $dropdown = new restaurantmenu();

            $dropdown->restaurantname=$request->restaurantname;
            
            $data->save();
            return redirect()->back();
    }


    public function driverselect(Request $request){
        $driverselect = new driver;

            $driverselect->username=$request->username;
            
            $data->save();
            return redirect()->back();
    }





    public function addmenu(Request $request){
        $data = new menu;

        $image=$request->image;
        $imagename =time().'.'.$image->getClientOriginalExtension();
            $request->image->move('menuimage',$imagename);

            $request->image=$imagename;
            
            $data->restaurantname=$request->restaurant_name;
            $data->productname=$request->productname;
            $data->category=$request->category;
            $data->price=$request->price;
            $data->image=$imagename;
            $data->save();
            return redirect()->back();
    }


    public function editmenu($id){
        $editmenu = menu::where('id', $id)->first();
        return redirect()->back()->with(['editmenu' => $editmenu]);
    }

    public function getmenu(Request $request){
        if($request->restaurant_name == "Select a restaurants"){
            $data = menu::all();
            return view('frontend.menupart', compact("data"));
        }
        $data = menu::where('restaurantname', $request->restaurant_name)->get();
        return view('frontend.menupart', compact("data"));
    }

    public function restaurantmenu(Request $request){
        $restaurant = restaurant::where('restaurantname', $request->restaurantname)->first();
        $menus = menu::where('restaurantname', $request->restaurantname)->get();
        $checks = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select('carts.id', 'menus.image', 'menus.productname', 'menus.price', 'carts.quantity')->get();
        $totals = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select(DB::raw('menus.price * carts.quantity as total'))->get();
        $sum = 0;
        foreach($totals as $total){
            $sum += $total->total;
        }
        $count = cart::where('user_id',session('user'))->count();
        return view('frontend.menu1',compact("menus","restaurant","checks", "sum", "count")); 
    }

    public function updatemenu(Request $request , $id){
        $editmenu = menu::where('id', $id)->first();
        $image=$request->image;

        $imagename =time().'.'.$image->getClientOriginalExtension();
            $request->image->move('menuimage',$imagename);

            $request->image=$imagename;
            
            $editmenu->restaurantname=$request->restaurant_name;
            $editmenu->productname=$request->productname;
            $editmenu->category=$request->category;
            $editmenu->price=$request->price;
            $editmenu->image=$imagename;
            $editmenu->save();
            return redirect()->back();
    }

    public function updatecart(Request $request){
        $checks = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select('carts.id', 'menus.image', 'menus.productname', 'menus.price', 'carts.quantity')->get();
        $totals = DB::table('carts')->where('user_id', '=', session('user'))->join('menus', 'carts.menu_id', '=', 'menus.id')->select(DB::raw('menus.price * carts.quantity as total'))->get();
        $sum = 0;
        foreach($totals as $total){
            $sum += $total->total;
        }
        $count = cart::where('user_id',session('user'))->count();
        return view('frontend.cartItem',compact("checks", "sum", "count")); 
    }

    public function deletecart(Request $request){
        cart::destroy($request->id);
        restaurant::destroy($request->id);
        return redirect()->back();
    }
}