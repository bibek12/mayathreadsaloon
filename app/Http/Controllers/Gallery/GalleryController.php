<?php

namespace App\Http\Controllers\Gallery;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use View;
use Auth;
use App\Http\Controllers\Controller;
use App\Gallery;

class GalleryController extends Controller
{
    protected $rules =
    [
        'gallery_name' => 'required|min:2|max:100|regex:/^[a-z ,.\'-]+$/i',
        'gallery_title' => 'required|min:2|max:100|regex:/^[a-z ,.\'-]+$/i',
        'gallery_image' => 'required'
    ];
    public function index()
    {
        $data['gallerys']=Gallery::all();
        return view('gallery.index',$data);
    }

   
    public function store(Request $request)
    {

        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $gallery = new Gallery();
            if ($request->hasFile('gallery_image')) {
            //get image
            $image = $request->file('gallery_image')->getClientOriginalName();  
            // $image = $request->student_name.'.png';
            //store iamge to path 
            $path = public_path().'/assets/gallery/';
            $request->file('gallery_image')->move($path, $image);
            }
            else{
                 $image=null; 
            }
            $gallery->gallery_name = $request->gallery_name;
            $gallery->gallery_title = $request->gallery_title;
            $gallery->gallery_image =$image;
            $gallery->save();
            return response()->json($gallery);
        }
    }


    public function update(Request $request)
    {
      
        // return Input::all();exit;
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
             if ($request->hasFile('gallery_image')) {
            //get image
            $image = $request->file('gallery_image')->getClientOriginalName();  
            // $image = $request->student_name.'.png';
            //store iamge to path 
            $path = public_path().'/assets/gallery/';
            $request->file('gallery_image')->move($path, $image);
            }
            else{
                 $image=null; 
            }
            $gallery = Gallery::findOrFail($request->gallery_id);
            $gallery->gallery_name = $request->gallery_name;
            $gallery->gallery_title= $request->gallery_title;
            if($image != null){
                $gallery->gallery_image =$image;
            }
            $gallery->save();
            return response()->json($gallery);
        }
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        $gallery->delete();
        return response()->json($gallery);
    }

    public function changeStatus() 
    {
        $id = Input::get('id');
        $gallery = Gallery::findOrFail($id);
        $gallery->is_active = !$gallery->is_active;
        $gallery->save();
        return response()->json($gallery);
    }
}
