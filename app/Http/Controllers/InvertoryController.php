<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Invertory;
use Carbon\Carbon;
use Image;
class InvertoryController extends Controller
{
    // Start Invertory Setting Method
    public function SettingInvertory(){
        $invertory = Invertory::first();
        return view('pages.settings.invertory_setting',compact('invertory'));
    }
    // End Invertory Setting Method

    // Start Invertory Setting Update Method
    public function UpdateInvertorySetting(Request $request,$id){

        $image = $request->file('image');
        if($image){
            @unlink(Invertory::findOrFail($id)->image);
            $name_gen = hexdec(uniqid()).'_invertory.'.$image->getClientOriginalExtension();
            Image::make($image)->resize(120,120)->save('uploads/settings/'.$name_gen);
            $save_url = 'uploads/settings/'.$name_gen;

            Invertory::findOrFail($id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'mobile'=>$request->mobile,
                'address'=>$request->address,
                'image'=>$save_url,
                'updated_at'=> Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Invertory Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            Invertory::findOrFail($id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'phone'=>$request->phone,
                'mobile'=>$request->mobile,
                'address'=>$request->address,
                'updated_at'=> Carbon::now(),
            ]);
            $notification = array(
                'message' => 'Invertory Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }
    }
    //End Invertory Setting Update Method

}
