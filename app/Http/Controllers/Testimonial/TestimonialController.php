<?php

namespace App\Http\Controllers\Testimonial;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use View;
use Auth;
use App\Http\Controllers\Controller;
use App\Testimonial;

class TestimonialController extends Controller
{
    protected $rules =
    [
        'testimonial_name' => 'required|min:2|max:100|regex:/^[a-z ,.\'-]+$/i',
        //'testimonial_post' => 'required|min:2|max:200|regex:/^[a-z ,.\'-]+$/i',
        'testimonial_content' => 'required',
        'testimonial_image' => 'required'
    ];
    public function index()
    {
        $data['testimonials']=Testimonial::all();
        return view('testimonial.index',$data);
    }

   
    public function store(Request $request)
    {

        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $testimonial = new Testimonial();
            if ($request->hasFile('testimonial_image')) {
            //get image
            $image = $request->file('testimonial_image')->getClientOriginalName();  
            // $image = $request->student_name.'.png';
            //store iamge to path 
            $path = public_path().'/assets/testimonial/';
            $request->file('testimonial_image')->move($path, $image);
            }
            else{
                 $image=null; 
            }
            $testimonial->testimonial_name = $request->testimonial_name;
            $testimonial->testimonial_post = $request->testimonial_post;
            $testimonial->testimonial_content = $request->testimonial_content;
            $testimonial->testimonial_image =$image;
            $testimonial->save();
            return response()->json($testimonial);
        }
    }


    public function update(Request $request)
    {
      
        // return Input::all();exit;
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
             if ($request->hasFile('testimonial_image')) {
            //get image
            $image = $request->file('testimonial_image')->getClientOriginalName();  
            // $image = $request->student_name.'.png';
            //store iamge to path 
            $path = public_path().'/assets/testimonial/';
            $request->file('testimonial_image')->move($path, $image);
            }
            else{
                 $image=null; 
            }
            $testimonial = Testimonial::findOrFail($request->testimonial_id);
            $testimonial->testimonial_name = $request->testimonial_name;
            $testimonial->testimonial_post = $request->testimonial_post;
            $testimonial->testimonial_content = $request->testimonial_content;
            if($image != null){
                $testimonial->testimonial_image =$image;
            }
            $testimonial->save();
            return response()->json($testimonial);
        }
    }

    public function destroy($id)
    {
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->delete();
        return response()->json($testimonial);
    }

    public function changeStatus() 
    {
        $id = Input::get('id');
        $testimonial = Testimonial::findOrFail($id);
        $testimonial->is_active = !$testimonial->is_active;
        $testimonial->save();
        return response()->json($testimonial);
    }
}
