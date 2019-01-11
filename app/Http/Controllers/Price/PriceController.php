<?php

namespace App\Http\Controllers\Price;
use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use View;
use Auth;
use App\Http\Controllers\Controller;
use App\Price;

class PriceController extends Controller
{
    protected $rules =
    [
        'title' => 'required|min:2|max:100|regex:/^[a-z ,.\'-]+$/i',
       
    ];
    public function index()
    {
        $data['prices']=Price::all();
        return view('price.index',$data);
    }

   
    public function store(Request $request)
    {

        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $price = new Price();
            $price->title = $request->title;
            $price->cost = $request->cost;
            $price->save();
            return response()->json($price);
        }
    }


    public function update(Request $request)
    {
      
        // return Input::all();exit;
        $validator = Validator::make(Input::all(), $this->rules);
        if ($validator->fails()) {
            return Response::json(array('errors' => $validator->getMessageBag()->toArray()));
        } else {
            $price = Price::findOrFail($request->price_id);
            $price->title = $request->title;
            $price->cost = $request->cost;
            $price->save();
            return response()->json($price);
        }
    }

    public function destroy($id)
    {
        $price = Price::findOrFail($id);
        $price->delete();
        return response()->json($price);
    }

    public function changeStatus() 
    {
        $id = Input::get('id');
        $price = Price::findOrFail($id);
        $price->is_active = !$price->is_active;
        $price->save();
        return response()->json($price);
    }
}
