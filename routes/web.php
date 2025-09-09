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

/*********************General Function for Both (Front-end & Back-end) ***********************/
Route::get('/clear-cache', function() {

    Artisan::call('config:clear');
	Artisan::call('view:clear');
    $exitCode = Artisan::call('route:clear');
    $exitCode = Artisan::call('route:cache');
     /* $exitCode = \Artisan::call('BirthDate:birthdate');
        $output = \Artisan::output();
        return $output;  */
    // return what you want
});

/*********************Exception Handling ***********************/
Route::get('/exception', 'ExceptionController@index')->name('exception');
Route::post('/exception', 'ExceptionController@index')->name('exception');


//Login and Register
Auth::routes();

// Frontend Route
//Home Page
Route::get('/', 'HomeController@index')->name('home');
Route::get('/index', 'HomeController@index')->name('home');
//Route::get('/about-us', 'HomeController@about')->name('about');
Route::get('/testimonials', 'HomeController@testimonial')->name('testimonial');
Route::get('/ourservices', 'HomeController@ourservices')->name('ourservices');
Route::get('/ourservices/{slug}', 'HomeController@servicesdetail')->name('servicesdetail');
Route::get('/blog', 'HomeController@blog')->name('blog');
Route::get('/search_result', 'HomeController@search_result')->name('search_result');

//Route::get('/blogs/{slug}', 'HomeController@blogdetail')->name('blogdetail');
Route::get('/contact', 'HomeController@contactus');
Route::post('/contact_lawyer', 'HomeController@contact');

Route::get('stripe/{appointmentId}', 'HomeController@stripe');
Route::post('stripe', 'HomeController@stripePost')->name('stripe.post1');

Route::get('/book-an-appointment', 'HomeController@bookappointment')->name('bookappointment');
Route::get('/book-an-appointment1', 'HomeController@bookappointment1')->name('bookappointment1');
Route::post('/book-an-appointment/store', 'AppointmentBookController@store');
Route::post('/book-an-appointment/storepaid', 'AppointmentBookController@storepaid')->name('stripe.post');
Route::post('/getdatetime', 'HomeController@getdatetime');
Route::post('/getdatetimebackend', 'HomeController@getdatetimebackend');


Route::post('/getdisableddatetime', 'HomeController@getdisableddatetime');
Route::get('/refresh-captcha', 'HomeController@refresh_captcha');
//Route::get('/mission-vision', 'HomeController@missionvision')->name('mission_vision');
Route::get('page/{slug}', 'HomeController@Page')->name('page.slug');
Route::get('sicaptcha', 'HomeController@sicaptcha')->name('sicaptcha');
Route::post('enquiry-contact', 'PackageController@enquiryContact')->name('query.contact');
Route::get('thanks', 'PackageController@thanks')->name('thanks');
Route::get('invoice/secure/{slug}', 'InvoiceController@invoice')->name('invoice');
Route::get('/invoice/download/{id}', 'InvoiceController@customer_invoice_download')->name('invoice.customer_invoice_download');
Route::get('/invoice/print/{id}', 'InvoiceController@customer_invoice_print')->name('invoice.customer_invoice_print');
Route::get('/profile', 'HomeController@myprofile')->name('profile');
/*---------------Agent Route-------------------*/
include_once 'agent.php';
/*********************Admin Panel Start ***********************/
Route::prefix('admin')->group(function() {
     //Login and Logout
		Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
		Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
		Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');
		Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');

	//General
        Route::get('/dashboard', 'Admin\AdminController@dashboard')->name('admin.dashboard');
		Route::get('/get_customer_detail', 'Admin\AdminController@CustomerDetail')->name('admin.get_customer_detail');
		Route::get('/my_profile', 'Admin\AdminController@myProfile')->name('admin.my_profile');
		Route::post('/my_profile', 'Admin\AdminController@myProfile')->name('admin.my_profile');
		Route::get('/change_password', 'Admin\AdminController@change_password')->name('admin.change_password');
		Route::post('/change_password', 'Admin\AdminController@change_password')->name('admin.change_password');
		Route::get('/sessions', 'Admin\AdminController@sessions')->name('admin.sessions');
		Route::post('/sessions', 'Admin\AdminController@sessions')->name('admin.sessions');
        Route::post('/delete_action', 'Admin\AdminController@deleteAction');


        //Blog
		Route::get('/blog', 'Admin\BlogController@index')->name('admin.blog.index');
		Route::get('/blog/create', 'Admin\BlogController@create')->name('admin.blog.create');
		Route::post('/blog/store', 'Admin\BlogController@store')->name('admin.blog.store');
		Route::get('/blog/edit/{id}', 'Admin\BlogController@edit')->name('admin.blog.edit');
		Route::post('/blog/edit', 'Admin\BlogController@edit')->name('admin.blog.edit');

	    //Blog Category
		Route::get('/blogcategories', 'Admin\BlogCategoryController@index')->name('admin.blogcategory.index');
		Route::get('/blogcategories/create', 'Admin\BlogCategoryController@create')->name('admin.blogcategory.create');
		Route::post('/blogcategories/store', 'Admin\BlogCategoryController@store')->name('admin.blogcategory.store');
		Route::get('/blogcategories/edit/{id}', 'Admin\BlogCategoryController@edit')->name('admin.blogcategory.edit');
		Route::post('/blogcategories/edit', 'Admin\BlogCategoryController@edit')->name('admin.blogcategory.edit');

		//CMS Pages
		Route::get('/cms_pages', 'Admin\CmsPageController@index')->name('admin.cms_pages.index');
		Route::get('/cms_pages/create', 'Admin\CmsPageController@create')->name('admin.cms_pages.create');
		Route::post('/cms_pages/store', 'Admin\CmsPageController@store')->name('admin.cms_pages.store');
		Route::get('/cms_pages/edit/{id}', 'Admin\CmsPageController@editCmsPage')->name('admin.edit_cms_page');
		Route::post('/cms_pages/edit', 'Admin\CmsPageController@editCmsPage')->name('admin.edit_cms_page');
  
  
  
        // Appointment modulle
		Route::get('/appointments-others', 'Admin\AdminController@appointmentsOthers')->name('appointments-others');

		Route::resource('appointments', Admin\AppointmentsController::class);
		Route::get('/get-assigne-detail', 'Admin\AppointmentsController@assignedetail');
		Route::post('/update_appointment_status', 'Admin\AppointmentsController@update_appointment_status');
		Route::post('/update_appointment_priority', 'Admin\AppointmentsController@update_appointment_priority');
		Route::get('/change_assignee', 'Admin\AppointmentsController@change_assignee');
		Route::post('/update_apppointment_comment', 'Admin\AppointmentsController@update_apppointment_comment');
		Route::post('/update_apppointment_description', 'Admin\AppointmentsController@update_apppointment_description');

        //Appointment Dates Not Available
		Route::get('/appointment-dates-disable', 'Admin\AppointmentDisableDateController@index')->name('admin.feature.appointmentdisabledate.index');
		Route::get('/appointment-dates-disable/create', 'Admin\AppointmentDisableDateController@create')->name('admin.feature.appointmentdisabledate.create');
		Route::post('/appointment-dates-disable/store', 'Admin\AppointmentDisableDateController@store')->name('admin.feature.appointmentdisabledate.store');
		Route::get('/appointment-dates-disable/edit/{id}', 'Admin\AppointmentDisableDateController@edit')->name('admin.feature.appointmentdisabledate.edit');
		Route::post('/appointment-dates-disable/edit', 'Admin\AppointmentDisableDateController@edit')->name('admin.feature.appointmentdisabledate.edit');
  
  
        Route::post('/update_action', 'Admin\AdminController@updateAction');
  
  
       //Recent case
		Route::get('/recent_case', 'Admin\RecentCaseController@index')->name('admin.recent_case.index');
		Route::get('/recent_case/create', 'Admin\RecentCaseController@create')->name('admin.recent_case.create');
		Route::post('/recent_case/store', 'Admin\RecentCaseController@store')->name('admin.recent_case.store');
		Route::get('/recent_case/edit/{id}', 'Admin\RecentCaseController@edit')->name('admin.recent_case.edit');
		Route::post('/recent_case/edit', 'Admin\RecentCaseController@edit')->name('admin.recent_case.edit');
  
        Route::post('/delete_slot_action', 'Admin\AdminController@deleteSlotAction');

});


Route::get('/practice-areas', 'HomeController@practiceareas')->name('practice-areas');
Route::get('/case', 'HomeController@case')->name('case');

//Practice area main Page
Route::get('/family-law', 'HomeController@familylaw')->name('family-law');
Route::get('/migration-law', 'HomeController@migrationlaw')->name('migration-law');
Route::get('/criminal-law', 'HomeController@criminallaw')->name('criminal-law');
Route::get('/commercial-law', 'HomeController@commerciallaw')->name('commercial-law');
Route::get('/property-law', 'HomeController@propertylaw')->name('property-law');


//Practice area inner Page
Route::get('/divorce', 'HomeController@divorce')->name('divorce');
Route::get('/child-custody', 'HomeController@childcustody')->name('child-custody');
Route::get('/family-violence', 'HomeController@familyviolence')->name('family-violence');
Route::get('/property-settlement', 'HomeController@propertysettlement')->name('property-settlement');
Route::get('/family-violence-orders', 'HomeController@familyviolenceorders')->name('family-violence-orders');


//Migration Law
Route::get('/juridicational-error-federal-circuit-court-application', 'HomeController@juridicationalerrorfederalcircuitcourtapplication')->name('juridicational-error-federal-circuit-court-application');
Route::get('/art-application', 'HomeController@artapplication')->name('art-application');
Route::get('/visa-refusals-visa-cancellation', 'HomeController@visarefusalsvisacancellation')->name('visa-refusals-visa-cancellation');
Route::get('/federal-court-application', 'HomeController@federalcourtapplication')->name('federal-court-application');


//Criminal Law
Route::get('/intervenition-orders', 'HomeController@intervenitionorders')->name('intervenition-orders');
Route::get('/trafic-offences', 'HomeController@traficoffences')->name('trafic-offences');
Route::get('/drink-driving-offences', 'HomeController@drinkdrivingoffences')->name('drink-driving-offences');
Route::get('/assualt-charges', 'HomeController@assualtcharges')->name('assualt-charges');


//Commercial Law
Route::get('/business-law', 'HomeController@businesslaw')->name('business-law');
Route::get('/leasing-or-selling-a-business', 'HomeController@leasingorsellingabusiness')->name('leasing-or-selling-a-business');
Route::get('/contracts-or-business-agreements', 'HomeController@contractsorbusinessagreements')->name('contracts-or-business-agreements');
Route::get('/loan-agreement', 'HomeController@loanagreement')->name('loan-agreement');


//Property Law
Route::get('/conveyancing', 'HomeController@conveyancing')->name('conveyancing');
Route::get('/building-and-construction-disputes', 'HomeController@buildingandconstructiondisputes')->name('building-and-construction-disputes');
Route::get('/caveats-disputs-and-removal', 'HomeController@caveatsdisputsandremoval')->name('caveats-disputs-and-removal');




Route::get('/{slug}', 'HomeController@Page')->name('page.slug');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
