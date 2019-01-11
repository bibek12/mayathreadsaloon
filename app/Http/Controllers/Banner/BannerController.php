<?php

namespace App\Http\Controllers\Banner;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use View;
use Auth;
use App\Http\Controllers\Controller;
use App\Banner;

class BannerController extends Controller
{
    protected $rules =
    [
        'banner_name' => 'required|min:2|max:300|regex:/^[a-z ,.\'-]+$/i',
        'banner_content' => 'required|min:2|max:500|regex:/^[a-z ,.\'-]+$/i',
        'banner_moto' => 'required|min:2|max:500|regex:/^[a-z ,.\'-]+$/i',
        'banner_image' => 'required'
    ];
    public function index()
    {
        $data['banners']=Banner::all();
        return view('banner.index',$data);
    }

   
    public function store(Request $request)
    {

        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $banner = new Banner();
            if ($request->hasFile('banner_image')) {
            //get image
            $image = $request->file('banner_image')->getClientOriginalName();  
            // $image = $request->student_name.'.png';
            //store iamge to path 
            $path = public_path().'/assets/banner/';
            $request->file('banner_image')->move($path, $image);
            }
            else{
                 $image=null; 
            }
            $banner->banner_name = $request->banner_name;
            $banner->banner_moto = $request->banner_moto;
            $banner->banner_content = $request->banner_content;
            $banner->banner_image =$image;
            $banner->save();
            return response()->json($banner);
        }
    }


    public function update(Request $request)
    {
      
        // return Input::all();exit;
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
             if ($request->hasFile('banner_image')) {
            //get image
            $image = $request->file('banner_image')->getClientOriginalName();  
            // $image = $request->student_name.'.png';
            //store iamge to path 
            $path = public_path().'/assets/banner/';
            $request->file('banner_image')->move($path, $image);
            }
            else{
                 $image=null; 
            }
            $banner = Banner::findOrFail($request->banner_id);
            $banner->banner_name = $request->banner_name;
            $banner->banner_moto = $request->banner_moto;
            $banner->banner_content = $request->banner_content;
            if($image != null){
                $banner->banner_image =$image;
            }
            $banner->save();
            return response()->json($banner);
        }
    }

    public function destroy($id)
    {
        $banner = Banner::findOrFail($id);
        $banner->delete();
        return response()->json($banner);
    }

    public function changeStatus() 
    {
        $id = Input::get('id');
        $banner = Banner::findOrFail($id);
        $banner->is_active = !$banner->is_active;
        $banner->save();
        return response()->json($banner);
    }
}
