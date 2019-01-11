<?php

namespace App\Http\Controllers\About;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use View;
use Auth;
use App\Http\Controllers\Controller;
use App\About;

class AboutController extends Controller
{
    protected $rules =
    [

        'title' => 'required|min:2|max:100',
        'content' => 'required|min:2|max:1000',
        'image' => 'required'
    ];
    public function index()
    {
        $data['abouts']=About::all();
        return view('about.index',$data);
    }

   
    public function store(Request $request)
    {

        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $about = new About();
            if ($request->hasFile('image')) {
            //get image
            $image = $request->file('image')->getClientOriginalName();  
            // $image = $request->student_name.'.png';
            //store iamge to path 
            $path = public_path().'/assets/about/';
            $request->file('image')->move($path, $image);
            }
            else{
                 $image=null; 
            }
            $about->title = $request->title;
            $about->content = $request->content;
            $about->image =$image;
            $about->save();
            return response()->json($about);
        }
    }


    public function update(Request $request)
    {
      
        // return Input::all();exit;
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
             if ($request->hasFile('image')) {
            //get image
            $image = $request->file('image')->getClientOriginalName();  
            // $image = $request->student_name.'.png';
            //store iamge to path 
            $path = public_path().'/assets/about/';
            $request->file('image')->move($path, $image);
            }
            else{
                 $image=null; 
            }
            $about = About::findOrFail($request->about_id);
            $about->title = $request->title;
            $about->content = $request->content;
            if($image != null){
                $about->image =$image;
            }
            $about->save();
            return response()->json($about);
        }
    }

    public function destroy($id)
    {
        $about = About::findOrFail($id);
        $about->delete();
        return response()->json($about);
    }

    public function changeStatus() 
    {
        $id = Input::get('id');
        $about = About::findOrFail($id);
        $about->is_active = !$about->is_active;
        $about->save();
        return response()->json($about);
    }
}
