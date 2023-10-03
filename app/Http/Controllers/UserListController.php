<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserListController extends Controller
{
    public function userListPage(){
        $user = User::when(request('searchKey'), function($query){
            $key = request('searchKey');
            $query->orWhere('name', 'like', "%".$key."%")
                  ->orWhere('address', 'like', "%".$key."%")
                  ->orWhere('gender', 'like', "%".$key."%");
        })
        ->where('role','user')->paginate(2);
        return view('admin.account.user.list',compact('user'));
    }
    public function userDetail($id){
        $user = User::where('id',$id)->first();
        return view('admin.account.user.detail',compact('user'));
    }
    public function userDelete($id){
        User::where('id',$id)->delete();
        return redirect()->route('userList#listPage')->with(['deleteSuccess' => 'User account delete success...']);
    }
    public function userChangePage($id){
        $user = User::where('id',$id)->first();
        return view('admin.account.user.userChangeRole',compact('user'));
    }
    public function userChangeRole($id, Request $request){
        $data = $this->roleData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('userList#listPage');
    }
    private function roleData($request){
        return [
            'role' => $request->role
        ];
    }
}
