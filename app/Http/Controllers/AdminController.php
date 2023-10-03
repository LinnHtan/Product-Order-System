<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    //detail page
    public function detailPage(){
        return view('admin.account.detail');
    }
    //edit page
    public function editPage(){
        return view('admin.account.edit');
    }

    //password change page
    public function changePasswordPage(){
        return view('admin.account.changePassword');
    }

    //password change
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
    //update account
    public function update($id, Request $request){
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
        return redirect()->route('admin#editPage')->with(['updateSuccess' => 'Profile update success...']);
    }
    //admin list
    public function list(){
        $admin = User::when(request('searchKey'), function($query){
            $key = request('searchKey');
            $query->orWhere('name', 'like', "%".$key."%")
                  ->orWhere('address', 'like', "%".$key."%")
                  ->orWhere('gender', 'like', "%".$key."%");
        })
        ->where('role','admin')
        ->paginate(4);
        return view('admin.account.list',compact('admin'));
    }
    //admin delete
    public function delete($id){
        User::where('id',$id)->delete();
        return redirect()->route('admin#listPage')->with(['deleteSuccess' => 'Admin account delete success...']);
    }
    //admin changeRole page
    public function changeRole($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.changeRole',compact('account'));
    }
    //admin change role
    public function change($id, Request $request){
        $data = $this->changeRoleData($request);
        User::where('id',$id)->update($data);
        return redirect()->route('admin#listPage');
    }
    //admin detail
    public function adminDetail($id){
        $account = User::where('id',$id)->first();
        return view('admin.account.adminDetail',compact('account'));
    }

    //change role data
    private function changeRoleData($request){
        return [
            'role' => $request->role
        ];
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
