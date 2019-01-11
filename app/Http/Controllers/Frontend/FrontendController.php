<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Support\Facades\Input;
use Illuminate\Http\Request;
use Validator;
use Response;
use View;
use Auth;
use App\Http\Controllers\Controller;
use App\Price;
use App\Contact;
use App\About;
use App\Service;
use App\Banner;
use App\Gallery;
use App\Member;
use App\Testimonial;

class FrontendController extends Controller
{
    //
    /*==========================================================================
			Index page	
    ============================================================================*/
    public function index()
    {
        $data['pricedata']=Price::all();
        $data['aboutdata']=About::all();
        $data['servicedata']=Service::all();
        $data['bannerdata']=Banner::active()->get();
        $data['contactdata']=Contact::latest()->first();
        $data['gallerydata']=Gallery::all();
        $data['memberdata']=Member::all();
        $data['testimonialdata']=Testimonial::all();
        return view('frontend.index',$data);
    }
    /*==========================================================================
			About page	
    ============================================================================*/
    public function about()
    {
        $data['pricedata']=Price::all();
        $data['aboutdata']=About::all();
        $data['servicedata']=Service::all();
        $data['bannerdata']=Banner::all();
        $data['contactdata']=Contact::latest()->first();
        $data['gallerydata']=Gallery::all();
        $data['memberdata']=Member::all();
        return view('frontend.about',$data);
    }
    /*==========================================================================
            Service page  
    ============================================================================*/
    public function service()
    {
        $data['pricedata']=Price::all();
        $data['aboutdata']=About::all();
        $data['servicedata']=Service::all();
        $data['bannerdata']=Banner::all();
        $data['contactdata']=Contact::latest()->first();
        $data['gallerydata']=Gallery::all();
        $data['memberdata']=Member::all();
        return view('frontend.service',$data);
    }
    /*==========================================================================
            Gallery page  
    ============================================================================*/
    public function gallery()
    {
        $data['pricedata']=Price::all();
        $data['aboutdata']=About::all();
        $data['servicedata']=Service::all();
        $data['bannerdata']=Banner::all();
        $data['contactdata']=Contact::latest()->first();
        $data['gallerydata']=Gallery::all();
        $data['memberdata']=Member::all();
        return view('frontend.gallery',$data);
    }
    /*==========================================================================
            Contact page  
    ============================================================================*/
    public function contact()
    {
        $data['pricedata']=Price::all();
        $data['aboutdata']=About::all();
        $data['servicedata']=Service::all();
        $data['bannerdata']=Banner::all();
        $data['contactdata']=Contact::latest()->first();
        $data['gallerydata']=Gallery::all();
        $data['memberdata']=Member::all();
        return view('frontend.contact',$data);
    }
}
