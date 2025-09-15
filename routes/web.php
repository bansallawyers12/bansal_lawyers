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
Route::middleware(['auth', 'verified', 'throttle:6,1'])->group(function () {
	Route::post('/clear-cache', function() {

		Artisan::call('config:clear');
		Artisan::call('view:clear');
		Artisan::call('route:clear');
		/* $exitCode = \Artisan::call('BirthDate:birthdate');
			$output = \Artisan::output();
			return $output;  */
		return response()->noContent();
	});
});


/*********************Frontend Routes ***********************/
//Home Page
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/index', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/testimonials', [App\Http\Controllers\HomeController::class, 'testimonial'])->name('testimonial');
Route::get('/ourservices', [App\Http\Controllers\HomeController::class, 'ourservices'])->name('ourservices');
Route::get('/ourservices/{slug}', [App\Http\Controllers\HomeController::class, 'servicesdetail'])->name('servicesdetail');
// Make experimental blog the primary
Route::get('/blog', [App\Http\Controllers\HomeController::class, 'blogExperimental'])->name('blog.index');
Route::get('/blog/category/{categorySlug}', [App\Http\Controllers\HomeController::class, 'blogCategoryExperimental'])->name('blog.category');
Route::get('/blog/{slug}', [App\Http\Controllers\HomeController::class, 'blogDetailExperimental'])->name('blog.detail');

// Experimental Blog Routes
Route::get('/blog-experimental', [App\Http\Controllers\HomeController::class, 'blogExperimental'])->name('blog.experimental');
Route::get('/blog-experimental/category/{categorySlug}', [App\Http\Controllers\HomeController::class, 'blogCategoryExperimental'])->name('blog.experimental.category');
Route::get('/blog-experimental/{slug}', [App\Http\Controllers\HomeController::class, 'blogDetailExperimental'])->name('blog.experimental.detail');

// Backup routes for original blog
Route::get('/blog-original', [App\Http\Controllers\HomeController::class, 'blog'])->name('blog.original');
Route::get('/blog-original/category/{categorySlug}', [App\Http\Controllers\HomeController::class, 'blogCategory'])->name('blog.original.category');
Route::get('/search_result', [App\Http\Controllers\HomeController::class, 'search_result'])->name('search_result');

Route::get('/contact', [App\Http\Controllers\HomeController::class, 'contactus']);
Route::post('/contact_lawyer', [App\Http\Controllers\HomeController::class, 'contact']);

Route::get('/about', [App\Http\Controllers\HomeController::class, 'about'])->name('about');

Route::get('stripe/{appointmentId}', [App\Http\Controllers\HomeController::class, 'stripe']);
Route::post('stripe', [App\Http\Controllers\HomeController::class, 'stripePost'])->name('stripe.post1');

Route::get('/book-an-appointment', [App\Http\Controllers\HomeController::class, 'bookappointment'])->name('bookappointment');
Route::get('/book-an-appointment1', [App\Http\Controllers\HomeController::class, 'bookappointment1'])->name('bookappointment1');
Route::post('/book-an-appointment/store', [App\Http\Controllers\AppointmentBookController::class, 'store']);
Route::post('/book-an-appointment/storepaid', [App\Http\Controllers\AppointmentBookController::class, 'storepaid'])->name('stripe.post');
// Promo code validation for booking
Route::post('/promo-code/check', [App\Http\Controllers\AppointmentBookController::class, 'checkpromocode']);
Route::post('/getdatetime', [App\Http\Controllers\HomeController::class, 'getdatetime']);
Route::post('/getdisableddatetime', [App\Http\Controllers\HomeController::class, 'getdisableddatetime']);
Route::get('/refresh-captcha', [App\Http\Controllers\HomeController::class, 'refresh_captcha']);
Route::get('page/{slug}', [App\Http\Controllers\HomeController::class, 'Page'])->name('page.slug');
Route::get('sicaptcha', [App\Http\Controllers\HomeController::class, 'sicaptcha'])->name('sicaptcha');
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'myprofile'])->name('profile');

/*********************Admin Panel Routes ***********************/
Route::prefix('admin')->group(function() {
     //Login and Logout
		Route::middleware('guest:admin')->group(function () {
			Route::get('/', [App\Http\Controllers\Auth\AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');
			Route::get('/login', [App\Http\Controllers\Auth\AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');
			Route::post('/login', [App\Http\Controllers\Auth\AdminAuthenticatedSessionController::class, 'store']);
		});

	//General (admin only)
		Route::middleware('auth:admin')->group(function () {
			Route::post('/logout', [App\Http\Controllers\Auth\AdminAuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
			Route::get('/dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard'])->name('admin.dashboard');
			Route::get('/get_customer_detail', [App\Http\Controllers\Admin\AdminController::class, 'CustomerDetail'])->name('admin.get_customer_detail');
			Route::get('/my_profile', [App\Http\Controllers\Admin\AdminController::class, 'myProfile'])->name('admin.my_profile');
			Route::post('/my_profile', [App\Http\Controllers\Admin\AdminController::class, 'myProfile'])->name('admin.my_profile');
			Route::get('/change_password', [App\Http\Controllers\Admin\AdminController::class, 'change_password'])->name('admin.change_password');
			Route::post('/change_password', [App\Http\Controllers\Admin\AdminController::class, 'change_password'])->name('admin.change_password');
			Route::get('/sessions', [App\Http\Controllers\Admin\AdminController::class, 'sessions'])->name('admin.sessions');
			Route::post('/sessions', [App\Http\Controllers\Admin\AdminController::class, 'sessions'])->name('admin.sessions');
        Route::post('/delete_action', [App\Http\Controllers\Admin\AdminController::class, 'deleteAction']);
        Route::post('/declined_action', [App\Http\Controllers\Admin\AdminController::class, 'declinedAction']);
        Route::post('/approved_action', [App\Http\Controllers\Admin\AdminController::class, 'approvedAction']);
        Route::post('/process_action', [App\Http\Controllers\Admin\AdminController::class, 'processAction']);
        Route::post('/archive_action', [App\Http\Controllers\Admin\AdminController::class, 'archiveAction']);
        Route::post('/move_action', [App\Http\Controllers\Admin\AdminController::class, 'moveAction']);

        //Blog
			Route::get('/blog', [App\Http\Controllers\Admin\BlogController::class, 'index'])->name('admin.blog.index');
			Route::get('/blog/create', [App\Http\Controllers\Admin\BlogController::class, 'create'])->name('admin.blog.create');
			Route::post('/blog/store', [App\Http\Controllers\Admin\BlogController::class, 'store'])->name('admin.blog.store');
			Route::get('/blog/edit/{id}', [App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('admin.blog.edit');
			Route::post('/blog/edit', [App\Http\Controllers\Admin\BlogController::class, 'edit'])->name('admin.blog.edit');

		    //Blog Category
			Route::get('/blogcategories', [App\Http\Controllers\Admin\BlogCategoryController::class, 'index'])->name('admin.blogcategory.index');
			Route::get('/blogcategories/create', [App\Http\Controllers\Admin\BlogCategoryController::class, 'create'])->name('admin.blogcategory.create');
			Route::post('/blogcategories/store', [App\Http\Controllers\Admin\BlogCategoryController::class, 'store'])->name('admin.blogcategory.store');
			Route::get('/blogcategories/edit/{id}', [App\Http\Controllers\Admin\BlogCategoryController::class, 'edit'])->name('admin.blogcategory.edit');
			Route::post('/blogcategories/edit', [App\Http\Controllers\Admin\BlogCategoryController::class, 'edit'])->name('admin.blogcategory.edit');

			//CMS Pages
			Route::get('/cms_pages', [App\Http\Controllers\Admin\CmsPageController::class, 'index'])->name('admin.cms_pages.index');
			Route::get('/cms_pages/create', [App\Http\Controllers\Admin\CmsPageController::class, 'create'])->name('admin.cms_pages.create');
			Route::post('/cms_pages/store', [App\Http\Controllers\Admin\CmsPageController::class, 'store'])->name('admin.cms_pages.store');
			Route::get('/cms_pages/edit/{id}', [App\Http\Controllers\Admin\CmsPageController::class, 'editCmsPage'])->name('admin.edit_cms_page');
        Route::post('/cms_pages/edit', [App\Http\Controllers\Admin\CmsPageController::class, 'editCmsPage'])->name('admin.edit_cms_page');

        // Appointment Module
			Route::get('/appointments-others', [App\Http\Controllers\Admin\AdminController::class, 'appointmentsOthers'])->name('appointments-others');

			Route::resource('appointments', App\Http\Controllers\Admin\AppointmentsController::class);
			Route::get('/get-assigne-detail', [App\Http\Controllers\Admin\AppointmentsController::class, 'assignedetail']);
			Route::post('/update_appointment_status', [App\Http\Controllers\Admin\AppointmentsController::class, 'update_appointment_status']);
			Route::post('/update_appointment_priority', [App\Http\Controllers\Admin\AppointmentsController::class, 'update_appointment_priority']);
			Route::get('/change_assignee', [App\Http\Controllers\Admin\AppointmentsController::class, 'change_assignee']);
			Route::post('/update_apppointment_comment', [App\Http\Controllers\Admin\AppointmentsController::class, 'update_apppointment_comment']);
			Route::post('/update_apppointment_description', [App\Http\Controllers\Admin\AppointmentsController::class, 'update_apppointment_description']);

			//Appointment Dates Not Available
			Route::get('/appointment-dates-disable', [App\Http\Controllers\Admin\AppointmentDisableDateController::class, 'index'])->name('admin.feature.appointmentdisabledate.index');
			Route::get('/appointment-dates-disable/create', [App\Http\Controllers\Admin\AppointmentDisableDateController::class, 'create'])->name('admin.feature.appointmentdisabledate.create');
			Route::post('/appointment-dates-disable/store', [App\Http\Controllers\Admin\AppointmentDisableDateController::class, 'store'])->name('admin.feature.appointmentdisabledate.store');
			Route::get('/appointment-dates-disable/edit/{id}', [App\Http\Controllers\Admin\AppointmentDisableDateController::class, 'edit'])->name('admin.feature.appointmentdisabledate.edit');
        Route::post('/appointment-dates-disable/edit', [App\Http\Controllers\Admin\AppointmentDisableDateController::class, 'edit'])->name('admin.feature.appointmentdisabledate.edit');

        Route::post('/update_action', [\App\Http\Controllers\Admin\AdminController::class, 'updateAction']);

        // Recent Case
			Route::get('/recent_case', [App\Http\Controllers\Admin\RecentCaseController::class, 'index'])->name('admin.recent_case.index');
			Route::get('/recent_case/create', [App\Http\Controllers\Admin\RecentCaseController::class, 'create'])->name('admin.recent_case.create');
			Route::post('/recent_case/store', [App\Http\Controllers\Admin\RecentCaseController::class, 'store'])->name('admin.recent_case.store');
			Route::get('/recent_case/edit/{id}', [App\Http\Controllers\Admin\RecentCaseController::class, 'edit'])->name('admin.recent_case.edit');
			Route::post('/recent_case/edit', [App\Http\Controllers\Admin\RecentCaseController::class, 'edit'])->name('admin.recent_case.edit');

        Route::post('/delete_slot_action', [App\Http\Controllers\Admin\AdminController::class, 'deleteSlotAction']);

		});

});


Route::get('/practice-areas', [\App\Http\Controllers\HomeController::class, 'practiceareas'])->name('practice-areas');
Route::get('/practice-areas-backup', [\App\Http\Controllers\HomeController::class, 'practiceareasBackup'])->name('practice-areas-backup');
Route::get('/case', [\App\Http\Controllers\HomeController::class, 'case'])->name('case');
Route::get('/case-experiment', [\App\Http\Controllers\HomeController::class, 'caseExperiment'])->name('case-experiment');
Route::get('/case-new', [\App\Http\Controllers\HomeController::class, 'caseNew'])->name('case-new');
// Experimental case detail (noindex)
Route::get('/case-experiment/{slug}', [\App\Http\Controllers\HomeController::class, 'casedetailExperiment'])->name('case-detail-experiment');

//Practice area main Page
// Swap: make experimental the primary and keep original as backup
Route::get('/family-law', [\App\Http\Controllers\HomeController::class, 'familylawExperiment'])->name('family-law');
Route::get('/family-law-backup', [\App\Http\Controllers\HomeController::class, 'familylaw'])->name('family-law-backup');
// Swap: make experimental the primary and keep original as backup
Route::get('/migration-law', [\App\Http\Controllers\HomeController::class, 'migrationlawExperiment'])->name('migration-law');
Route::get('/migration-law-backup', [\App\Http\Controllers\HomeController::class, 'migrationlaw'])->name('migration-law-backup');
// Swap: make experimental the primary and keep original as backup
Route::get('/criminal-law', [\App\Http\Controllers\HomeController::class, 'criminallawExperiment'])->name('criminal-law');
Route::get('/criminal-law-backup', [\App\Http\Controllers\HomeController::class, 'criminallaw'])->name('criminal-law-backup');
// Swap: make experimental the primary and keep original as backup
Route::get('/commercial-law', [\App\Http\Controllers\HomeController::class, 'commerciallawExperiment'])->name('commercial-law');
Route::get('/commercial-law-backup', [\App\Http\Controllers\HomeController::class, 'commerciallaw'])->name('commercial-law-backup');
// Swap: make experimental the primary and keep original as backup
Route::get('/property-law', [\App\Http\Controllers\HomeController::class, 'propertylawExperiment'])->name('property-law');
Route::get('/property-law-backup', [\App\Http\Controllers\HomeController::class, 'propertylaw'])->name('property-law-backup');
// Experimental route for Migration Law page
Route::get('/migration-law-experiment', [\App\Http\Controllers\HomeController::class, 'migrationlawExperiment'])->name('migration-law-experiment');
// Experimental routes for other practice areas
Route::get('/family-law-experiment', [\App\Http\Controllers\HomeController::class, 'familylawExperiment'])->name('family-law-experiment');
Route::get('/criminal-law-experiment', [\App\Http\Controllers\HomeController::class, 'criminallawExperiment'])->name('criminal-law-experiment');
Route::get('/commercial-law-experiment', [\App\Http\Controllers\HomeController::class, 'commerciallawExperiment'])->name('commercial-law-experiment');
Route::get('/property-law-experiment', [\App\Http\Controllers\HomeController::class, 'propertylawExperiment'])->name('property-law-experiment');


/*********************Practice Area Inner Pages ***********************/
Route::get('/divorce', [\App\Http\Controllers\HomeController::class, 'divorce'])->name('divorce');
Route::get('/child-custody', [\App\Http\Controllers\HomeController::class, 'childcustody'])->name('child-custody');
Route::get('/family-violence', [\App\Http\Controllers\HomeController::class, 'familyviolence'])->name('family-violence');
Route::get('/property-settlement', [\App\Http\Controllers\HomeController::class, 'propertysettlement'])->name('property-settlement');
Route::get('/family-violence-orders', [\App\Http\Controllers\HomeController::class, 'familyviolenceorders'])->name('family-violence-orders');

/*********************Migration Law ***********************/
Route::get('/juridicational-error-federal-circuit-court-application', [\App\Http\Controllers\HomeController::class, 'juridicationalerrorfederalcircuitcourtapplication'])->name('juridicational-error-federal-circuit-court-application');
Route::get('/art-application', [\App\Http\Controllers\HomeController::class, 'artapplication'])->name('art-application');
Route::get('/visa-refusals-visa-cancellation', [\App\Http\Controllers\HomeController::class, 'visarefusalsvisacancellation'])->name('visa-refusals-visa-cancellation');
Route::get('/federal-court-application', [\App\Http\Controllers\HomeController::class, 'federalcourtapplication'])->name('federal-court-application');

/*********************Criminal Law ***********************/
Route::get('/intervenition-orders', [\App\Http\Controllers\HomeController::class, 'intervenitionorders'])->name('intervenition-orders');
Route::get('/trafic-offences', [\App\Http\Controllers\HomeController::class, 'traficoffences'])->name('trafic-offences');
Route::get('/drink-driving-offences', [\App\Http\Controllers\HomeController::class, 'drinkdrivingoffences'])->name('drink-driving-offences');
Route::get('/assualt-charges', [\App\Http\Controllers\HomeController::class, 'assualtcharges'])->name('assualt-charges');

/*********************Commercial Law ***********************/
Route::get('/business-law', [\App\Http\Controllers\HomeController::class, 'businesslaw'])->name('business-law');
Route::get('/leasing-or-selling-a-business', [\App\Http\Controllers\HomeController::class, 'leasingorsellingabusiness'])->name('leasing-or-selling-a-business');
Route::get('/contracts-or-business-agreements', [\App\Http\Controllers\HomeController::class, 'contractsorbusinessagreements'])->name('contracts-or-business-agreements');
Route::get('/loan-agreement', [\App\Http\Controllers\HomeController::class, 'loanagreement'])->name('loan-agreement');

/*********************Property Law ***********************/
Route::get('/conveyancing', [\App\Http\Controllers\HomeController::class, 'conveyancing'])->name('conveyancing');
Route::get('/building-and-construction-disputes', [\App\Http\Controllers\HomeController::class, 'buildingandconstructiondisputes'])->name('building-and-construction-disputes');
Route::get('/caveats-disputs-and-removal', [\App\Http\Controllers\HomeController::class, 'caveatsdisputsandremoval'])->name('caveats-disputs-and-removal');

/*********************Catch-all Route ***********************/
Route::get('/{slug}', [\App\Http\Controllers\HomeController::class, 'Page'])
	->where('slug', '^(?!admin|api|login|register|home|invoice|profile|clear-cache|js|css|images|img|assets|fonts|storage).*$')
	->name('page.slug');

// require __DIR__.'/auth.php'; // File doesn't exist
