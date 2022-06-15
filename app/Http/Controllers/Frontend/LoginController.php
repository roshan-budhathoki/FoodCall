<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Login;
use App\Models\Cart;
use App\Models\Menu;
use App\Models\Restaurant;
use App\Models\driver;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    public function login(Request $request){
        $fields = Validator::make($request->all(), [
            'email' => 'required|string',
            'password' => 'required|string',
        ]); 
        if($fields->fails()){
            $error = $fields->errors()->all();
            return response()->json(['errors'=>reset($error)]);
        }
        $user = Login::where('email', $request->email)->first();
        $driver = driver::where('email', $request->email)->first();
        

        if(!$user && !$driver){ 

                $error = "Username and password does not match";
            return response()->json(['errors'=> $error]);   
        }
        elseif($user){
            if(!Hash::check($request->password, $user->password)) {
                return response()->json(['errors' => "password doesnot match"]);
            }
            session(['user' => $user->id, 'user_type' => $user->user_type, 'username' => $user->username]);
            return response()->json(['success'=> ['Verified user', $user->user_type]]); 
        }else{
            if($request->password != $driver->password) {
                return response()->json(['errors' => "password doesnot match"]);
            }
            session(['user' => $driver->id, 'user_type' => "driver", 'username' => $driver->username]);
            return response()->json(['success'=> ['Verified user', "driver"]]); 
        }
    }
    

    
    public function register(Request $request){
        
        $fields = Validator::make($request->all(), [
            'username' => 'required|string',
            'address' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string',
        ]);  
        if($fields->fails()){
            $error = $fields->errors()->all();
            return response()->json(['errors'=>reset($error)]);
        }
        if((int)$request->contact == 0){
            return response()->json(['errors'=>"Invalid contact details"]);
        }
        $register = new Login;
        $register->username = $request->username;
        $register->adderess = $request->address;
        $register->email = $request->email;
        $register->password = bcrypt($request->password);
        $register->contact = $request->contact;
        $register->user_type = "User";
        $register->save();

        if($register){
            return response()->json(['success'=> 'User Added']);
        }
    }

    public function logout(Request $request){
        if(session('user')){
            $request->session()->flush();
            return redirect('/');
        }
    }


    public function addcart(Request $request ,$id){
            $menu=menu::find($id);
            $check = DB::table('carts')->where('user_id', '=', session('user'))->where('menu_id', '=', $id)->first();
            if($check){
                return response()->json(["success" => "Menu is arleady added"]);
            }
            $newcart = $menu->productname . " is added";
    
            $cart=new cart();

            $cart->user_id=session('user');
            $cart->menu_id=$menu->id;
            $cart->quantity=1;
            
            $cart->save();

            return response()->json(["success" => $newcart]);
    }

    public function changePassword(Request $request){
        $user = Login::where('id', session('user'))->first();

        if(!Hash::check($request->oldPassword, $user->password)){
            return redirect()->back()->with(['error'=>'Oldpassword does not match.']);
        }

        if($request->newPassword != $request->confirmPassword){
            return redirect()->back()->with(['error'=>'new password and confirm password does not match.']);
        }

        $user->password = bcrypt($request->newPassword);
        $user->save();
        
        return redirect()->back()->with(['success'=>'Password is successfully changed']);
    }

    public function cartsItem(Request $request){
        // $totalcount = cart::where('user_id',session('user'))->count();
        // return response()->json
        return cart::where('user_id',session('user'))->count();

    }
    
}
