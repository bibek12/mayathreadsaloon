<?php

namespace App\Http\Controllers\Service;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use View;
use Auth;
use App\Http\Controllers\Controller;
use App\Service;

class ServiceController extends Controller
{
    protected $rules =
    [
        'service_name' => 'required|min:2|max:200|',
        'service_content' => 'required|min:2|max:500|',
        'service_image' => 'required'
    ];
    public function index()
    {
        $data['services']=Service::all();
        return view('service.index',$data);
    }

   
    public function store(Request $request)
    {

        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $service = new Service();
            if ($request->hasFile('service_image')) {
            //get image
            $image = $request->file('service_image')->getClientOriginalName();  
            // $image = $request->student_name.'.png';
            //store iamge to path 
            $path = public_path().'/assets/service/';
            $request->file('service_image')->move($path, $image);
            }
            else{
                 $image=null; 
            }
            $service->service_name = $request->service_name;
            $service->service_content = $request->service_content;
            $service->service_image =$image;
            $service->save();
            return response()->json($service);
        }
    }


    public function update(Request $request)
    {
      
        // return Input::all();exit;
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
             if ($request->hasFile('service_image')) {
            //get image
            $image = $request->file('service_image')->getClientOriginalName();  
            // $image = $request->student_name.'.png';
            //store iamge to path 
            $path = public_path().'/assets/service/';
            $request->file('service_image')->move($path, $image);
            }
            else{
                 $image=null; 
            }
            $service = Service::findOrFail($request->service_id);
            $service->service_name = $request->service_name;
            $service->service_content = $request->service_content;
            if($image != null){
                $service->service_image =$image;
            }
            $service->save();
            return response()->json($service);
        }
    }

    public function destroy($id)
    {
        $service = Service::findOrFail($id);
        $service->delete();
        return response()->json($service);
    }

    public function changeStatus() 
    {
        $id = Input::get('id');
        $service = Service::findOrFail($id);
        $service->is_active = !$service->is_active;
        $service->save();
        return response()->json($service);
    }
}
