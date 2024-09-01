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

//Route::get('user-factory', 'TestController@userFactory');
//Route::get('subscribers-factory', 'TestController@subscribersFactory');

Route::group(['middleware' => 'web', 'namespace' => 'Frontend'], function () {
    Route::get('/', 'HomeController@index');

    Route::get('test-template', function (){
        $data = \App\BackendModel\Contact::first();
        $destination = \App\BackendModel\Destination::find($data->destination_id);
       return view('email-templates.inquiry-alert', compact('data', 'destination'));
    });

    Route::group(['prefix' => 'top-destination'], function () {
        Route::get('{slug}', 'TopDestinationController@detail');
        Route::post('{slug}/submit-review', 'TopDestinationController@submitReview');
        Route::get('{id}/book', 'TopDestinationController@bookTopDestination');
        Route::get('{id}/inquiry', 'TopDestinationController@inquiry');
        Route::get('lists/all', 'TopDestinationController@all');
    });

    Route::group(['prefix' => 'tour-package'], function () {
        Route::get('{slug}', 'TourPackageController@detail');
        Route::post('{slug}/submit-review', 'TourPackageController@submitReview');
        Route::get('{id}/book', 'TourPackageController@bookTourPackage');
        Route::get('{id}/inquiry', 'TourPackageController@inquiry');
        Route::get('lists/all', 'TourPackageController@all');
    });

    Route::group(['prefix' => 'our-team'], function () {
        Route::get('/', 'OurTeamController@index');
    });


    Route::match(['get', 'post'], 'login', 'UserController@login')->name('login');

    Route::get('social-login/{provider}', 'UserController@redirectToProvider');
    Route::get('social-login/{provider}/callback', 'UserController@handleProviderCallback');

    Route::get('login/resend-activation-link', 'UserController@resendActivationLink');
    Route::match(['get', 'post'], 'register', 'UserController@register');


    Route::get('email-verification', 'UserController@emailVerification');
    Route::get('token-expired', 'UserController@tokenExpired');


    Route::get('send-email', 'UserController@sendEmail');


    Route::get('my-account', 'UserController@myAccount')->middleware('auth');
    Route::post('my-account/update', 'UserController@updateMyAccount')->middleware('auth');;
    Route::post('my-account/change-password', 'UserController@changePassword')->middleware('auth');;

    Route::get('logout', 'UserController@logout');
    Route::get('about-us', 'AboutUsController@aboutUs');
    Route::get('terms-and-conditions', 'TermsController@termsAndCondition');
    Route::get('travel-insurance', 'TravelInsuranceController@travelInsurance');

    Route::get('activate-your-account/{id}', function ($id){
        if(!\Illuminate\Support\Facades\Session::has('reg-token'))
        {
            return redirect('/');
        }
       return view('frontend.activate-your-account', compact('id'));
    });




    Route::get('submit-subscription-email', 'SubscriptionController@index');
    Route::get('verify-subscription-email', 'SubscriptionController@verify');
    Route::get('subscription-verified', 'SubscriptionController@verified');




    Route::get('feedback', 'ContactController@index');
    Route::post('feedback/submit', 'ContactController@submit');
});


Route::get('admin/login', 'Admin\LoginController@index');
Route::post('admin/login/validate', 'Admin\LoginController@validation');
Route::group(['middleware' => 'auth.admin', 'prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('dashboard', 'DashboardController@index');
    Route::get('bookings', 'BookingController@booking');
    Route::get('booking/acknowledge/{id}', 'BookingController@bookingAck');

    Route::group(['prefix' => 'banner'], function () {
        Route::get('/', 'BannerController@index');
        Route::get('create', 'BannerController@create');
        Route::post('submit', 'BannerController@submit');
        Route::get('{id}/edit', 'BannerController@edit');
        Route::post('{id}/update', 'BannerController@update');
        Route::get('{id}/delete', 'BannerController@delete');
        Route::get('{id}/orderup', 'BannerController@orderUp');
        Route::get('{id}/orderdown', 'BannerController@orderDown');
        Route::get('{id}/inactivate', 'BannerController@inactivate');
        Route::get('{id}/activate', 'BannerController@activate');
    });


    Route::group(['prefix' => 'destinations'], function () {
        Route::get('/', 'DestinationController@index');
        Route::get('create', 'DestinationController@create');
        Route::post('submit', 'DestinationController@submit');
        Route::get('{id}/featured-images', 'DestinationController@featuredImages');
        Route::post('{id}/featured-images/submit', 'DestinationController@submitFeaturedImages');
        Route::get('{id}/featured-images/delete', 'DestinationController@deleteFeaturedImages');
        Route::get('{id}/itineraries', 'DestinationController@itineraries');
        Route::get('{id}/reviews', 'DestinationController@reviews');
        Route::get('{id}/reviews/approve', 'DestinationController@approveReview');
        Route::get('{id}/reviews/delete', 'DestinationController@deleteReview');
        Route::get('{id}/reviews/disapprove', 'DestinationController@disapproveReview');
        Route::post('{id}/itineraries/submit', 'DestinationController@submitItineraries');
        Route::post('{id}/itineraries/update', 'DestinationController@updateItineraries');
        Route::get('{id}/itineraries/delete', 'DestinationController@deleteItineraries');
        Route::get('{id}/edit', 'DestinationController@edit');
        Route::post('{id}/update', 'DestinationController@update');
        Route::get('{id}/view', 'DestinationController@view');
        Route::get('{id}/delete', 'DestinationController@delete');
        Route::get('{id}/untop', 'DestinationController@untop');
        Route::get('{id}/top', 'DestinationController@top');
        Route::get('{id}/publish', 'DestinationController@publish');
        Route::get('{id}/unpublish', 'DestinationController@unpublish');
    });


    Route::group(['prefix' => 'guides'], function () {
        Route::get('/', 'GuidesController@index');
        Route::get('create', 'GuidesController@create');
        Route::post('submit', 'GuidesController@submit');
        Route::get('{id}/edit', 'GuidesController@edit');
        Route::post('{id}/update', 'GuidesController@update');
        Route::get('{id}/delete', 'GuidesController@delete');
    });

    Route::group(['prefix' => 'our-team'], function () {
        Route::get('/', 'TeamsController@index');
        Route::get('create', 'TeamsController@create');
        Route::post('submit', 'TeamsController@submit');
        Route::get('{id}/edit', 'TeamsController@edit');
        Route::post('{id}/update', 'TeamsController@update');
        Route::get('{id}/delete', 'TeamsController@delete');
    });

    Route::group(['prefix' => 'about-us'], function () {
        Route::get('/', 'AboutUsController@index');
        Route::post('submit', 'AboutUsController@submit');
        Route::post('{id}/update', 'AboutUsController@submit');
    });

    Route::group(['prefix' => 'staffs'], function () {
        Route::get('/', 'SubAdminsController@index');
        Route::post('create', 'SubAdminsController@create');
        Route::post('{id}/update', 'SubAdminsController@update');
        Route::get('{id}/roles', 'SubAdminsController@roles');
        Route::get('{id}/suspend', 'SubAdminsController@suspend');
        Route::get('{id}/activate', 'SubAdminsController@activate');
        Route::post('{id}/roles/submit', 'SubAdminsController@submitRoles');
    });

    Route::group(['prefix' => 'terms-and-conditions'], function () {
        Route::get('/', 'TermsController@index');
        Route::post('submit', 'TermsController@submit');
        Route::post('{id}/update', 'TermsController@update');
    });

    Route::group(['prefix' => 'travel-insurance'], function () {
        Route::get('/', 'InsuranceController@index');
        Route::post('submit', 'InsuranceController@submit');
        Route::post('{id}/update', 'InsuranceController@update');
    });

    Route::group(['prefix' => 'feedbacks'], function () {
        Route::get('/', 'FeedbackController@index');
    });

    Route::group(['prefix' => 'inquiries'], function () {
        Route::get('/', 'InquiryController@index');
    });


    Route::group(['prefix' => 'contact-info'], function () {
        Route::get('/', 'ContactInfoController@index');
        Route::post('submit', 'ContactInfoController@submit');
        Route::post('{id}/update', 'ContactInfoController@update');
    });

    Route::group(['prefix' => 'customers'], function () {
        Route::get('/', 'UsersController@index');
        Route::get('{id}/change-status', 'UsersController@changeStatus');
    });

    Route::group(['prefix' => 'social-media-links'], function () {
        Route::get('/', 'SocialMediaLinks@index');
        Route::get('create', 'SocialMediaLinks@create');
        Route::post('submit', 'SocialMediaLinks@submit');
        Route::get('{id}/remove', 'SocialMediaLinks@remove');
    });

    Route::group(['prefix' => 'newsletter-subscribers'], function () {
        Route::get('/', 'NewsLetterSubscribers@index');
        Route::get('{id}/change-status', 'NewsLetterSubscribers@changeStatus');
        Route::get('{id}/delete', 'NewsLetterSubscribers@deleteSubscribers');
    });

    Route::group(['prefix' => 'clients-testimony'], function () {
        Route::get('/', 'TestimonyController@index');
        Route::get('add', 'TestimonyController@add');
        Route::post('submit', 'TestimonyController@submit');
        Route::get('{id}/edit', 'TestimonyController@edit');
        Route::get('{id}/activate', 'TestimonyController@activate');
        Route::get('{id}/inactivate', 'TestimonyController@inactivate');
        Route::post('{id}/update', 'TestimonyController@update');
    });

    Route::group(['prefix' => 'notification-emails'], function () {
        Route::get('/', 'NotificationEmailsController@index');
        Route::post('submit', 'NotificationEmailsController@submit');
        Route::post('{id}/update', 'NotificationEmailsController@update');
    });

    Route::get('profile', 'ProfileController@index');
    Route::get('profile/update', 'ProfileController@update');

    Route::get('access-denied', function () {
        return view('admin.403');
    });

    Route::get('logout', 'LoginController@logout');
});
