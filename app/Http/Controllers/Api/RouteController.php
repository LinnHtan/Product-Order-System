<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Contact;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use GuzzleHttp\Psr7\Response;
use App\Http\Controllers\Controller;

class RouteController extends Controller
{   //get method
    public function productList(){
        $data = Product::get();
        return response()->json($data, 200);
    }

    public function categoryList(){
        $data = Category::get();
        return response()->json($data, 200);
    }

    public function list(){
        $product = Product::get();
        $category = Category::get();
        $data = [
            'category' => $category,
            'product' => $product
        ];
        return response()->json($data, 200);
    }

    public function userList(){
        $data = User::get();
        return response()->json($data, 200);
    }

    //post method
    public function createUser(Request $request){
       $data = [
        'name' => $request->name,
        'email' => $request->email,
        'password'=> $request ->password,
        'phone' => $request->phone,
        'gender' => $request->gender,
        'address' => $request->address,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
       ];
      $response = User::create($data);
      return response()->json($response, 200);
    }

    public function createCategory(Request $request){
       $data = [
        'name' => $request->name,
        'created_at' => Carbon::now(),
        'updated_at' => Carbon::now()
       ];
      $response = Category::create($data);
      return response()->json($response, 200);
    }

    public function createContact(Request $request){
       $data = $this->contactData($request);
       $response = Contact::create($data);
       return response()->json($response, 200);
    }

    //delete
    public function deletePostCategory(Request $request){

        $data = Category::where('id',$request->test_id)->first();
        if(isset($data)){
            Category::where('id',$request->test_id)->delete();
            return response()->json(['status' => true, 'message'=> 'delete success'], 200);
        }
        return response()->json(['status'=> false , 'message'=>'there is no category'], 200);
    }

    public function deleteGetCategory($id){
        $data = Category::where('id',$id)->first();
        if(isset($data)){
            Category::where('id',$id)->delete();
            return response()->json(['status' => true, 'message'=> 'delete success with get method'], 200);
        }
        return response()->json(['status'=> false , 'message'=>'there is no category with get method'], 200);
    }
    //detail
    public function detailPostProduct(Request $request){
        $data = Product::where('id',$request->id)->first();
        if(isset($data)){
            return response()->json(['status' => true, 'message'=> $data ], 200);
        }
        return response()->json(['status'=> false , 'message'=>'there is no category with post method'], 200);
    }

    public function detailGetProduct($id){
        $data = Product::where('id',$id)->first();
        if(isset($data)){
            return response()->json(['status' => true, 'message'=> $data ], 200);
        }
        return response()->json(['status'=> false , 'message'=>'there is no category with get method'], 200);
    }

    //update product
    public function updateProduct(Request $request){
        $data = $this->productData($request);
        $productId = $request->updated_id;

        $dataId = Product::where('id', $productId)->first();

        if(isset($dataId)){
            Product::where('id', $productId)->update($data);
            return response()->json(['status' => true , 'message' => $data], 200);

        }
        return response()->json(['status' => false , 'message' => 'Ops error']);

    }
    //update contact
    public function updateContact(Request $request){
        $data = $this->contactUpdateData($request);
        $databaseId = $request->contact_id;

        $dataId = Contact::where('id',$databaseId)->first();
        if(isset($dataId)){
            Contact::where('id', $databaseId)->update($data);
            return response()->json(['status' => true , 'message' => 'update success' , 'contact' => $data]);
        }
        return response()->json(['status' => false , 'message' => 'Ops errors']);
    }

    private function contactUpdateData($request){
        return [
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
            'updated_at' => Carbon::now()
        ];
    }



    private function productData($request){
        return [
            'category_id' => $request->id,
            'name' => $request-> name ,
            'description' => $request-> description ,
            'price' => $request-> price ,
            'waiting_time' => $request->  time,
            'view_count' => $request->  viewCount,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ];
    }



    private function contactData ($request){
    return [
            'name' => $request->name,
            'email' => $request->email ,
            'message' => $request->message ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
           ];
    }
}
