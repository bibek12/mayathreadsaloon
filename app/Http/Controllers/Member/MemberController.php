<?php

namespace App\Http\Controllers\Member;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use View;
use Auth;
use App\Http\Controllers\Controller;
use App\Member;

class MemberController extends Controller
{
    protected $rules =
    [
        'member_name' => 'required|min:2|max:100|regex:/^[a-z ,.\'-]+$/i',
        'member_post' => 'required|min:2|max:500|regex:/^[a-z ,.\'-]+$/i',
        'member_image' => 'required'
    ];
    public function index()
    {
        $data['members']=Member::all();
        return view('member.index',$data);
    }

   
    public function store(Request $request)
    {

        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $member = new Member();
            if ($request->hasFile('member_image')) {
            //get image
            $image = $request->file('member_image')->getClientOriginalName();  
            // $image = $request->student_name.'.png';
            //store iamge to path 
            $path = public_path().'/assets/member/';
            $request->file('member_image')->move($path, $image);
            }
            else{
                 $image=null; 
            }
            $member->member_name = $request->member_name;
            $member->member_post = $request->member_post;
            $member->member_image =$image;
            $member->save();
            return response()->json($member);
        }
    }


    public function update(Request $request)
    {
      
        // return Input::all();exit;
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
             if ($request->hasFile('member_image')) {
            //get image
            $image = $request->file('member_image')->getClientOriginalName();  
            // $image = $request->student_name.'.png';
            //store iamge to path 
            $path = public_path().'/assets/member/';
            $request->file('member_image')->move($path, $image);
            }
            else{
                 $image=null; 
            }
            $member = Member::findOrFail($request->member_id);
            $member->member_name = $request->member_name;
            $member->member_post = $request->member_post;
            if($image != null){
                $member->member_image =$image;
            }
            $member->save();
            return response()->json($member);
        }
    }

    public function destroy($id)
    {
        $member = Member::findOrFail($id);
        $member->delete();
        return response()->json($member);
    }

    public function changeStatus() 
    {
        $id = Input::get('id');
        $member = Member::findOrFail($id);
        $member->is_active = !$member->is_active;
        $member->save();
        return response()->json($member);
    }
}
