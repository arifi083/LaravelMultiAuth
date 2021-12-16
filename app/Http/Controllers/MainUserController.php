<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;
use Auth;

class MainUserController extends Controller
{
    public function Logout(){
        Auth::logout();
        return redirect()->route('login');
    }


    public function UserProfile(){
        $id=Auth::user()->id;
        $user=User::find($id);
        return view('user.profile.user_profile',compact('user'));
    }


    public function UserProfileEdit(){
        $id=Auth::user()->id;
        $user=User::find($id);
        return view('user.profile.user_profile_edit',compact('user'));
    }

    public function UserProfileStore(Request $request){

        $data = User::find(Auth::user()->id);
        $data->name = $request->name;
        $data->email = $request->email;
        

        if($request->file('profile_photo_path')){
            $file=$request->file('profile_photo_path');
            @unlink(public_path('upload/user_images/'.$data->profile_photo_path));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/user_images'),$filename);
            $data['profile_photo_path']=$filename;
        }
        $data->save();
        $notification = array(
			'message' => 'User Profile Updated Successfully',
			'alert-type' => 'success'
		);
        return redirect()->route('user.profile')->with($notification);

    }


    public function UserChangePassword(){
        $id=Auth::user()->id;
        $user=User::find($id);
        return view('user.profile.change_password',compact('user'));
    }


    public function UserPasswordUpdate(Request $request){
        $validateData = $request->validate([
			'oldpassword' => 'required',
			'password' => 'required|confirmed',
		]);

        $hashedPassword=Auth::user()->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $user = User::find(Auth::id());
            $user->password = Hash::make($request->password);
            $user->save();
            Auth::logout();
            return redirect()->route('login');
        }
        else{
            return redirect()->back();
        }
    }



    //admin 
    public function AdminProfile(){
        
        $admin=Admin::find(1);
        return view('admin.profile.admin_profile_view',compact('admin'));
    }



    public function AdminProfileEdit(){

        
        $editData=Admin::find(1); 
        return view('admin.profile.admin_profile_edit',compact('editData'));
    }

    public function AdminProfileStore(Request $request){

       
        $data=Admin::find(1);
        $data->name = $request->name;
        $data->email = $request->email;
        
        if($request->file('profile_photo_path')){
            $file=$request->file('profile_photo_path');
            @unlink(public_path('upload/admin_images/'.$data->profile_photo_path));
            $filename=date('YmdHi').$file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'),$filename);
            $data['profile_photo_path']=$filename;
        }
        $data->save();
        $notification = array(
            'message' => 'Admin profile Updated Successfully',
            'alert-type' => 'success'
        ); 

        return redirect()->route('admin.profile')->with($notification);
    }


    public function AdminChangePassword(){
        return view('admin.profile.admin_change_password');
    }


    public function AdminUpdateChangePassword(Request $request){
        
		$validateData = $request->validate([
			'oldpassword' => 'required',
			'password' => 'required|confirmed',
		]);

        $hashedPassword= Admin::find(1)->password;
        if(Hash::check($request->oldpassword,$hashedPassword)){
            $admin = Admin::find(1);
            $admin->password=Hash::make($request->password);
            $admin->save();
            Auth::logout();
            return redirect()->route('admin.logout');
        }
        else{
            return redirect()->back();
        }
    }//end method 



}
