<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Product;
use App\Models\OrderList;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    //ajax list page
    public function productList(Request $request){
        if($request->status == 'asc'){
            $data = Product::orderBy('created_at','asc')->get();
        }else{
            $data = Product::orderBy('created_at','desc')->get();
        }
        return response()->json($data);
    }

    //ajax add to cart
    public function addToCart(Request $request){
        $data = $this->getOrderData($request);
        // logger($data);
        Cart::create($data);
        $response = [
            'message' => 'Add to card complete',
            'status' => 'success'
        ];
        return response()->json($response,200);
    }
    //order
    public function order(Request $request){
        $total = 0;
    foreach($request->all() as $item){
        $data = OrderList::create([
            'user_id' => $item['user_id'],
            'product_id' => $item['product_id'],
            'qty' => $item['qty'],
            'total' => $item['total'],
            'order_code' => $item['order_code'],
        ]);
        $total += $data->total;
    }
    Cart::where('user_id',Auth::user()->id)->delete();
    Order::create([
        'user_id' => Auth::user()->id,
        'order_code' => $data->order_code,
        'total_price' => $total + 3000
    ]);

    return response()->json([
        'status' => 'success'
    ],200);

    }
    //clear cart
    public function clearCart(){
        Cart::where('user_id',Auth::user()->id)->delete();
        return response()->json([
            'status' => 'success'
        ],200);
    }
    //clear current product
    public function clearCurrentProduct(Request $request){
        Cart::where('user_id',Auth::user()->id)
        ->where('product_id',$request->productId)
        ->where('id',$request->orderId)
        ->delete();
    }
    //increase view count
    public function increaseViewCount(Request $request){
        $product = Product::where('id',$request->productId)->first();

        $viewCount = [
            'view_count' => $product->view_count + 1
        ];
        Product::where('id',$request->productId)->update($viewCount);
    }
    //get order data
    private function getOrderData($request){
        return [
            'user_id' => $request->userId,
            'product_id' => $request->productId,
            'qty' => $request->count,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }
}
