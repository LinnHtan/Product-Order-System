<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    //user home page
    public function home(){
        $product = Product::orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('product','category','cart','history'));
    }

    //password change page
    public function changePasswordPage(){
        return view('user.account.change');
    }
    //change password page
    public function changePassword(Request $request){
        $this->passwordValidationCheck($request);

        $currentUserId = Auth::user()->id;
        $user = User::select('password')->where('id',$currentUserId)->first();
        $dbHashValue = $user->password;

        if(Hash::check($request->oldPassword, $dbHashValue)){
          $data = [
              'password' => Hash::make($request-> newPassword)
          ];
          User::where('id',Auth::user()->id)->update($data);

          return back()->with(['changeSuccess' => 'Password change success...']);
        }else{
          return back()->with(['notMatch' => 'The credential do not Match. Try again!']);
        }
    }
    //user detail page
    public function detailPage(){
        return view('user.account.detail');
    }

     //user profile change page
     public function profileChangePage(){
        return view('user.account.profile.edit');
    }

    //user profile change
    public function profileChange($id, Request $request){
        $this->accountValidationCheck($request);
        $data = $this->getUserData($request);

        $dbImage = User::select('image')->where('id', $id)->first();
        $dbImage = $dbImage->image;

        if ($request->hasFile('image')) {

            if ($dbImage != null) {

                Storage::delete('public/' . $dbImage);
            }

            $fileName = uniqid() . $request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public', $fileName);
            $data['image'] = $fileName;
        } else {

            $data['image'] = $dbImage;
        }

        User::where('id', $id)->update($data);
        return redirect()->route('user#detailPage')->with(['updateSuccess' => 'Profile update success...']);
    }
    //user filter
    public function filter($id){
        $product = Product::where('category_id',$id)->orderBy('created_at','desc')->get();
        $category = Category::get();
        $cart = Cart::where('user_id',Auth::user()->id)->get();
        $history = Order::where('user_id',Auth::user()->id)->get();
        return view('user.main.home',compact('product','category','cart','history'));
    }
    //product detail page
    public function productDetailPage($id){
        $product = Product::where('id',$id)->first();
        $productList = Product::get();
        return view('user.main.detail',compact('product','productList'));
    }
    //cart list page
    public function cartListPage(){
        $cart = Cart::select('carts.*','products.name as product_name','products.price as product_price','products.image as product_image')
        ->leftJoin('products','products.id','carts.product_id')
        ->where('carts.user_id',Auth::user()->id)
        ->get();
        $totalPrice = 0;
        foreach($cart as $c){
            $totalPrice += $c->product_price*$c->qty;
        }
        return view('user.cart.cart',compact('cart','totalPrice'));
    }
    //cart history page
    public function history(){
        $order = Order::where('user_id',Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('user.cart.history',compact('order'));
    }


    //user data update
    private function getUserData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'image' => $request->image,
            'gender' => $request->gender,
            'address' => $request->address,
            'updated_at' => Carbon::now()
        ];
    }

    //user data validation
    private function accountValidationCheck($request){
        $validation = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image' => 'mimes:jpg,png,jpeg,webp|file',
            'gender' => 'required',
            'address' =>  'required',
        ];
        Validator::make($request->all(),$validation)->validate();
    }
     //password validation
     private function passwordValidationCheck($request){
        $validation = [
            'oldPassword' => 'required|min:6',
            'newPassword' => 'required|min:6',
            'confirmPassword' => 'required|min:6|same:newPassword',
        ];
        Validator::make($request->all(),$validation)->validate();
    }

}

