<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//frontend index
Route::get('/', 'Frontend\FrontendController@index');
Route::get('/frontindex', 'Frontend\FrontendController@index');
//frontend about
Route::get('/frontabout', 'Frontend\FrontendController@about');
//frontend Service
Route::get('/frontservice', 'Frontend\FrontendController@service');
//frontend Gallery
Route::get('/frontgallery', 'Frontend\FrontendController@gallery');
//frontend Contact
Route::get('/frontcontact', 'Frontend\FrontendController@contact');
//frontend testimonials 
// Route::get('/fronttestimonial', 'Frontend\FrontendController@testimonial');


Route::group(['middleware' => 'auth'], function () {
    Route::get('/admin', function () {
        return view('home');
    });
    //    Route::get('/link1', function ()    {
    //        // Uses Auth Middleware
    //    });
        /*====================================================================================
       |                        About routes                      | 
        ====================================================================================== */

        Route::resource('abouts','About\AboutController');
        Route::post('abouts/change_about_status', array('as' => 'change_about_status', 'uses' => 'About\AboutController@changeStatus'));
        Route::post('about_edit','About\AboutController@update');
         /*====================================================================================
       |                        Member routes                      | 
        ====================================================================================== */

        Route::resource('members','Member\MemberController');
        Route::post('members/change_member_status', array('as' => 'change_member_status', 'uses' => 'Member\MemberController@changeStatus'));
        Route::post('member_edit','Member\MemberController@update');
        /*====================================================================================
       |                        Service routes                      | 
        ====================================================================================== */

        Route::resource('services','Service\ServiceController');
        Route::post('services/change_service_status', array('as' => 'change_service_status', 'uses' => 'Service\ServiceController@changeStatus'));
        Route::post('service_edit','Service\ServiceController@update');
         /*====================================================================================
       |                        Gallery routes                      | 
        ====================================================================================== */

        Route::resource('galleries','Gallery\GalleryController');
        Route::post('galleries/change_gallery_status', array('as' => 'change_gallery_status', 'uses' => 'Gallery\GalleryController@changeStatus'));
        Route::post('gallery_edit','Gallery\GalleryController@update');
        /*====================================================================================
       |                        Contact routes                      | 
        ====================================================================================== */

        Route::resource('contacts','Contact\ContactController');
        Route::post('contacts/change_contact_status', array('as' => 'change_contact_status', 'uses' => 'Contact\ContactController@changeStatus'));
        Route::post('contact_edit','Contact\ContactController@update');
         /*====================================================================================
       |                        Price routes                      | 
        ====================================================================================== */

        Route::resource('prices','Price\PriceController');
        Route::post('prices/change_price_status', array('as' => 'change_price_status', 'uses' => 'Price\PriceController@changeStatus'));
        Route::post('price_edit','Price\PriceController@update');
         /*====================================================================================
       |                        Banner routes                      | 
        ====================================================================================== */

        Route::resource('banners','Banner\BannerController');
        Route::post('banners/change_banner_status', array('as' => 'change_banner_status', 'uses' => 'Banner\BannerController@changeStatus'));
        Route::post('banner_edit','Banner\BannerController@update');

         /*====================================================================================
       |                        Testimonial routes                      | 
        ====================================================================================== */

        Route::resource('testimonials','Testimonial\TestimonialController');
        Route::post('testimonials/change_testimonial_status', array('as' => 'change_testimonial_status', 'uses' => 'Testimonial\TestimonialController@changeStatus'));
        Route::post('testimonial_edit','Testimonial\TestimonialController@update');
      
      

    //Please do not remove this if you want adminlte:route and adminlte:link commands to works correctly.
    #adminlte_routes
});
