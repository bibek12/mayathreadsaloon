<?php

namespace App\Http\Controllers\Contact;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use View;
use Auth;
use App\Http\Controllers\Controller;
use App\Contact;

class ContactController extends Controller
{
    protected $rules =
    [
        'contact_name' => 'required|string',
        'contact_phone' => 'required',
        'contact_address' => 'required',
        'contact_email' => 'required|min:2|max:100|regex:/^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$/i',
        'contact_facebook' => 'required',
        'contact_twitter'=>'required'
    ];
    public function index()
    {
        $data['contacts']=Contact::all();
        return view('contact.index',$data);
    }

   
    public function store(Request $request)
    {

        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $contact = new Contact();
            $contact->contact_name = $request->contact_name;
            $contact->contact_phone = $request->contact_phone;
            $contact->contact_address = $request->contact_address;
            $contact->contact_email = $request->contact_email;
            $contact->contact_facebook = $request->contact_facebook;
            $contact->contact_twitter = $request->contact_twitter;
            

            $contact->save();
            return response()->json($contact);
        }
    }


    public function update(Request $request)
    {
      
        // return Input::all();exit;
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $contact = Contact::findOrFail($request->contact_id);
            $contact->contact_name = $request->contact_name;
            $contact->contact_phone = $request->contact_phone;
            $contact->contact_email = $request->contact_email;
            $contact->contact_facebook = $request->contact_facebook;
            $contact->contact_address = $request->contact_address;
            $contact->contact_twitter = $request->contact_twitter;
            $contact->save();
            return response()->json($contact);
        }
    }

    public function destroy($id)
    {
        $contact = Contact::findOrFail($id);
        $contact->delete();
        return response()->json($contact);
    }

    public function changeStatus() 
    {
        $id = Input::get('id');
        $contact = Contact::findOrFail($id);
        $contact->is_active = !$contact->is_active;
        $contact->save();
        return response()->json($contact);
    }
}
