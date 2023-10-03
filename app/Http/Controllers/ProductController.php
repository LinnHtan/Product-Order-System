<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //product list page
    public function list(){
        $product = Product::select('products.*','categories.name as category_name')
        ->when(request('searchKey'), function($query){
            $key = request('searchKey');
            $query->where('products.name', 'like', "%" . $key . "%");
        })
        ->leftJoin('categories','products.category_id','categories.id')
        ->orderBy('products.created_at','desc')
        ->paginate(3);
        return view('admin.product.product',compact('product'));
    }

    //product create page
    public function createPage(){
        $category = Category::select('id','name')->get();
        return view('admin.product.create',compact('category'));
    }

    //product create
    public function create(Request $request){

        $this->getCreateDataValidation($request,'create');
        $data = $this->getCreateData($request);

        if($request->hasFile('image')){
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }
        Product::create($data);
        return redirect()->route('products#list');

    }

    //product delete
    public function delete($id){
        Product::where('id',$id)->delete();
        return redirect()->route('products#list')->with(['deleteSuccess' => 'product delete success..']);
    }

    //product detail
    public function detail($id){
        $product = Product::select('products.*','categories.name as category_name')
        ->leftJoin('categories','products.category_id','categories.id')
        ->where('products.id',$id)->first();
        return view('admin.product.detail',compact('product'));
    }

    //product edit
    public function edit($id){
        $product = Product::where('id',$id)->first();
        $category = Category::get();
        return view('admin.product.edit',compact('product','category'));
    }
    //product update
    public function update($id, Request $request){
        $this->getCreateDataValidation($request,'update',$id);
        $data = $this->getCreateData($request);

        $oldImage = Product::where('id',$id)->first();
        $oldImage = $oldImage->image;
        if($request->hasFile('image')){

            if($oldImage != null){
                Storage::delete('public/'.$oldImage);
            }
            $fileName = uniqid().$request->file('image')->getClientOriginalName();
            $request->file('image')->storeAs('public',$fileName);
            $data['image'] = $fileName;
        }else{
            $data['image'] = $oldImage;
        }
        Product::where('id',$request->id)->update($data);
        return redirect()->route('products#list');

    }
    //get data
    private function getCreateData($request){
        return [
            'name' => $request->name,
            'description' => $request->description,
            'category_id' => $request->category,
            'image' => $request->image,
            'price' => $request->price,
            'waiting_time' => $request->waitingTime,
            'updated_at' => Carbon::now()
        ];
    }
    //product create validation
    private function getCreateDataValidation($request,$status){
        $validation = [
            'name' => 'required|min:5|unique:products,name,'.$request->id,
            'description' => 'required',
            'category' => 'required',
            'price' => 'required',
            'waitingTime' => 'required',
        ];
        $validation['image'] = $status == "create" ? 'required|mimes:jpg,jpeg,png,webp|file' : 'mimes:jpg,jpeg,png,webp|file';

        Validator::make($request->all(),$validation)->validate();
    }
}
