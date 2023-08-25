<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Image;

class UserController extends Controller
{
    // Logout
    public function Logout(Request $request){
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
            return redirect('/');
    }
    // Logout end

    // All User
    public function AllUser(){
        $current_user_id =Auth::id();
        $users=User::where('id','!=',$current_user_id)->orderBy('id','DESC')->get();
        return view('pages.user.user_all',compact('users'));
    }
    // All User end

    // Add User
    public function AddUser(){
        return view('pages.user.user_add');
    }
    // Add User end

    // Store User
    public function StoreUser(Request $request){
        $image = $request->file('image');
        $name_gen = hexdec(uniqid()).'_user.'.$image->getClientOriginalExtension();
        Image::make($image)->resize(120,120)->save('uploads/users/'.$name_gen);
        $save_url = 'uploads/users/'.$name_gen;
        User::insert([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=>Hash::make($request->password),
            'username'=>$request->username,
            'phone'=>$request->phone,
            'address'=>$request->address,
            'role'=>$request->role,
            'status'=>$request->status,
            'image'=>$save_url,
            'remember_token' => Str::random(60),
            'created_at'=> Carbon::now(),
        ]);
        $notification = array(
            'message' => 'User Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->route('all.user')->with($notification);
    }
    // Store User end

    // Edit User
    public function EditUser($id){
        $user=User::where('id',$id)->first();
        return view('pages.user.user_edit',compact('user'));
    }
    // Edit User end

    // Update User
    public function UpdateUser(Request $request,$id){
        $image = $request->file('image');

        if($image){
            @unlink(User::findOrFail($id)->image);
            $name_gen = hexdec(uniqid()).'_user.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(120,120)->save('uploads/users/'.$name_gen);
            $save_url = 'uploads/users/'.$name_gen;
            User::findOrFail($id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'username'=>$request->username,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'role'=>$request->role,
                'status'=>$request->status,
                'image'=>$save_url,
                'remember_token' => Str::random(60),
                'updated_at'=> Carbon::now(),
            ]);
            $notification = array(
                'message' => 'User Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.user')->with($notification);
        }else{
            User::findOrFail($id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'username'=>$request->username,
                'phone'=>$request->phone,
                'address'=>$request->address,
                'status'=>$request->status,
                'role'=>$request->role,
                'remember_token' => Str::random(60),
                'updated_at'=> Carbon::now(),
            ]);
            $notification = array(
                'message' => 'User Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.user')->with($notification);
        }
    }
    // Update User end

    // Edit User
    public function DeleteUser($id){
        $user=User::findOrFail($id);
        @unlink($user->image);
        $user->delete();
        $notification = array(
            'message' => 'User Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }
    // Edit User end

}
