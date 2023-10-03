<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class CategoryController extends Controller
{
    //direct list page
    public function listPage(){
        $category = Category::when(request('searchKey'), function ($query){
            $key = request('searchKey');
            $query->where('name', 'like', "%" . $key . "%");
        })
        ->orderBy('id','desc')
        ->paginate(4);
        return view('admin.category.list',compact('category'));
    }
    //direct create page
    public function createPage(){
        return view('admin.category.create');
    }
    //create category data
    public function create (Request $request){
        $this->categoryValidationCheck($request);
        $data = $this->categoryData($request);
        Category::create($data);
        return redirect()->route('category#listPage')->with(['createSuccess' => 'Category create success ...']);

    }
    //delete category
    public function delete ($id){
        Category::where('id',$id)->delete();
        return back()->with(['deleteSuccess' => 'Category delete success ...']);
    }
    //edit category
    public function edit($id){
        $name = Category::where('id',$id)->first();
        return view('admin.category.edit',compact('name'));
    }
    //update category
    public function update($id, Request $request){
        $this->categoryUpdateValidationCheck($request , $id);
        $data = $this->categoryData($request);
        Category::where('id', $id)->update($data);
        return redirect()->route("category#listPage");
     }
    //category validation
    private function categoryValidationCheck($request){
        $validation = [
            'categoryName' => 'required|unique:categories,name'
        ];
        Validator::make($request->all(),$validation)->validate();
    }
    //category update validation
    private function categoryUpdateValidationCheck($request, $id){
        $validation = [
            'categoryName' => 'required|unique:categories,name,'.$id
        ];
        Validator::make($request->all(),$validation)->validate();
    }
    //category data
    private function categoryData ($request){
        return [
            'name' => $request->categoryName
        ];
    }
}
