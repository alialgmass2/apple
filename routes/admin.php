<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;

Route::prefix('admin')->name('admin.')->group(function () {

    Route::get('/login', [AdminController::class, 'login'])->name('login');

    Route::post('/login/submit', [AdminController::class, 'loginSubmit'])->name('login.submit');

    /*=============================================
    =       AUTH ADMIN Section            =
    =============================================*/
    Route::middleware('auth.admin','role:superAdmin,admin')->group(function () {
// DASHBOARD START
        Route::get('/dashboard', 'App\Livewire\Admin\Dashboard')->name('dashboard')->withoutMiddleware('role:superAdmin,admin');
// DASHBOARD END
// REGIONS START
        Route::get('/region', 'App\Livewire\Admin\Region\Index')->name('region.index');
// REGIONS END
//// How To Know START
        Route::get('/How-to-know', 'App\Livewire\Admin\HowToKnow\Index')->name('how-to-know.index');
// How To Know END
// Notification START
        Route::get('/notification', 'App\Livewire\Admin\Notification\Index')->name('notification');
// Notification END
// CITIES START
        Route::get('/city', 'App\Livewire\Admin\City\Index')->name('city.index');
// CITIES END
// EDUCATION LEVEL START
        Route::get('/educationlevel', 'App\Livewire\Admin\EducationLevel\Index')->name('educationlevel.index');
// EDUCATION LEVEL END
// ORGANIZATIONS START
        Route::get('/organization', 'App\Livewire\Admin\Organization\Index')->name('organization.index');
        Route::get('/organization/{organization}', 'App\Livewire\Admin\Organization\Show')->name('organization.show');
        Route::get('/organization/discount/{organization}', 'App\Livewire\Admin\Organization\Discount')->name('organization.discount');
// ORGANIZATIONS END
// USERS START
        Route::get('/user', 'App\Livewire\Admin\User\Index')->name('user.index');
        Route::get('/user/{user}', 'App\Livewire\Admin\User\Show')->name('user.show');
// USERS END
// CATEGORIES START
        Route::get('/category', 'App\Livewire\Admin\Category\Index')->name('category.index');
// CATEGORIES END
// SUB CATEGORIES START
        Route::get('/subcategories', 'App\Livewire\Admin\SubCategory\Index')->name('subcategory.index');
// SUB CATEGORIES END
// PRODUCTS START
        Route::get('/product', 'App\Livewire\Admin\Product\Index')->name('product.index');
        Route::get('/product/create', 'App\Livewire\Admin\Product\create')->name('product.create');
        Route::get('/product/{product}', 'App\Livewire\Admin\Product\Show')->name('product.show');
        Route::get('/product/edit/{product}', 'App\Livewire\Admin\Product\edit')->name('product.edit');
// PRODUCTS END
//// PRODUCTS START
        Route::get('/color', 'App\Livewire\Admin\Color\Index')->name('color.index');
// PRODUCTS END
//// PRODUCTS START
        Route::get('/offer', 'App\Livewire\Admin\Offer\Index')->name('offer.index');
        Route::get('/organization-offer', 'App\Livewire\Admin\OrganizationOffer\Index')->name('organization-offer.index');
        Route::get('/organization-offer/{id}', 'App\Livewire\Admin\OrganizationOffer\Show')->name('organization-offer.show');
// PRODUCTS END
// DISCOUNT START
        Route::get('/discount', 'App\Livewire\Admin\Discount\Index')->name('discount.index');
// DISCOUNT END
// HOW TO START
        Route::get('/howto', 'App\Livewire\Admin\HowTo\Index')->name('howto.index');
        Route::get('/howto/{howto}', 'App\Livewire\Admin\HowTo\Show')->name('howto.show');
// HOW TO END
// ROLES START
        Route::get('/role', 'App\Livewire\Admin\Role\Index')->name('role.index');
// ROLES END
// ORDERS START
        Route::get('/order', 'App\Livewire\Admin\Order\Index')->name('order.index');
        Route::get('/order/{order}', 'App\Livewire\Admin\Order\Show')->name('order.show');
// ORDERS END
// CONTACTS START
        Route::get('/contact', 'App\Livewire\Admin\Contact\Index')->name('contact.index');
        Route::get('/contact/{contact}', 'App\Livewire\Admin\Contact\Show')->name('contact.show');
// CONTACTS END
//
// terms START
        Route::get('/terms', 'App\Livewire\Admin\Terms\Index')->name('terms.index');
        Route::get('/terms/{terms}', 'App\Livewire\Admin\Terms\Show')->name('terms.show');
// CONTACTS END
// BOOK A CONSULTATIONS START
        Route::get('/bookaconsulation', 'App\Livewire\Admin\BookAConsultant\Index')->name('bookaconsulation.index');
        Route::get('/bookaconsulation/{bookaconsulation}', 'App\Livewire\Admin\BookAConsultant\Show')->name('bookaconsulation.show');
// BOOK A CONSULTATIONS END
// IT CONTACT US START
        Route::get('/itcontactus', 'App\Livewire\Admin\ITContactUs\Index')->name('itcontactus.index');
        Route::get('/itcontactus/{itcontactus}', 'App\Livewire\Admin\ITContactUs\Show')->name('itcontactus.show');
// IT CONTACT US END
// HOME BANNER START
        Route::get('/banner', 'App\Livewire\Admin\Banner\Index')->name('banner.index');
// HOME BANNER END
// HOME INTROS START
        Route::get('/homeintro', 'App\Livewire\Admin\HomeIntro\Index')->name('homeintro.index');
        Route::get('/homeintro/{homeintro}', 'App\Livewire\Admin\HomeIntro\Show')->name('homeintro.show');
// HOME INTROS END
// VISIONS START
        Route::get('/vision', 'App\Livewire\Admin\Vision\Index')->name('vision.index');
        Route::get('/vision/{vision}', 'App\Livewire\Admin\Vision\Show')->name('vision.show');
// VISIONS END
// MISSIONS START
        Route::get('/mission', 'App\Livewire\Admin\Mission\Index')->name('mission.index');
        Route::get('/mission/{mission}', 'App\Livewire\Admin\Mission\Show')->name('mission.show');
// MISSIONS END
// LEADERSHIP BANNER START
        Route::get('/leadershipbanner', 'App\Livewire\Admin\LeadershipBanner\Index')->name('leadershipbanner.index');
// LEADERSHIP BANNER END

// LEADERSHIP INTROS START
        Route::get('/leadershipintro', 'App\Livewire\Admin\LeadershipIntro\Index')->name('leadershipintro.index');
        Route::get('/leadershipintro/{leadershipintro}', 'App\Livewire\Admin\LeadershipIntro\Show')->name('leadershipintro.show');
// LEADERSHIP INTROS END

// LEADERSHIP OUR VALUE START
        Route::get('/leadershipourvalue', 'App\Livewire\Admin\LeadershipOurValue\Index')->name('leadershipourvalue.index');
        Route::get('/leadershipourvalue/{leadershipourvalue}', 'App\Livewire\Admin\LeadershipOurValue\Show')->name('leadershipourvalue.show');
// LEADERSHIP OUR VALUE END
// LEADERSHIP CUSTMIZED SOLUTION START
        Route::get('/customisedsolution', 'App\Livewire\Admin\CustomisedSolution\Index')->name('customisedsolution.index');
        Route::get('/customisedsolution/{customisedsolution}', 'App\Livewire\Admin\CustomisedSolution\Show')->name('customisedsolution.show');
// LEADERSHIP CUSTMIZED SOLUTION END

// LEADERSHIP BOOK A CONSULTAIONS START
        Route::get('/bookconsultation', 'App\Livewire\Admin\BookConsultation\Index')->name('bookconsultation.index');
        Route::get('/bookconsultation/{bookconsultation}', 'App\Livewire\Admin\BookConsultation\Show')->name('bookconsultation.show');
// LEADERSHIP BOOK A CONSULTAIONS END

// EDUCATOR BANNER START
        Route::get('/educatorbanner', 'App\Livewire\Admin\EducatorBanner\Index')->name('educatorbanner.index');
// EDUCATOR BANNER END

// EDUCATOR INTROS START
        Route::get('/educatorintro', 'App\Livewire\Admin\EducatorIntro\Index')->name('educatorintro.index');
        Route::get('/educatorintro/{educatorintro}', 'App\Livewire\Admin\EducatorIntro\Show')->name('educatorintro.show');
// EDUCATOR INTROS END

// EVERY ONE CODE START
        Route::get('/everyonecode', 'App\Livewire\Admin\EveryOneCode\Index')->name('everyonecode.index');
        Route::get('/everyonecode/{everyonecode}', 'App\Livewire\Admin\EveryOneCode\Show')->name('everyonecode.show');
// EVERY ONE CODE END

// EVERY ONE CREATE START
        Route::get('/everyonecreate', 'App\Livewire\Admin\EveryOneCreate\Index')->name('everyonecreate.index');
        Route::get('/everyonecreate/{everyonecreate}', 'App\Livewire\Admin\EveryOneCreate\Show')->name('everyonecreate.show');
// EVERY ONE CREATE END

// EDUCATION COMMUNITY START
        Route::get('/educationcommunity', 'App\Livewire\Admin\EducationCommunity\Index')->name('educationcommunity.index');
        Route::get('/educationcommunity/{educationcommunity}', 'App\Livewire\Admin\EducationCommunity\Show')->name('educationcommunity.show');
// EDUCATION COMMUNITY END

// EDUCATOR BANNER START
        Route::get('/studentbanner', 'App\Livewire\Admin\StudentBanner\Index')->name('studentbanner.index');
// EDUCATOR BANNER END

// STUDENT INTROS START
        Route::get('/studentintro', 'App\Livewire\Admin\StudentIntro\Index')->name('studentintro.index');
        Route::get('/studentintro/{studentintro}', 'App\Livewire\Admin\StudentIntro\Show')->name('studentintro.show');
// STUDENT INTROS END
// PARENTAL START
        Route::get('/parental', 'App\Livewire\Admin\Parental\Index')->name('parental.index');
// Route::get('/parental/{parental}', 'App\Livewire\Admin\Parental\Show')->name('parental.show');
// PARENTAL END

// EDUCATION BANNER START
        Route::get('/educationbanners', 'App\Livewire\Admin\EducationBanner\Index')->name('educationbanner.index');
// EDUCATION BANNER END
// EDUCATIONS START
        Route::get('/educationintro', 'App\Livewire\Admin\EducationIntro\Index')->name('educationintro.index');
// EDUCATIONS END
// EDUCATIONS SOLUTION START
        Route::get('/solution', 'App\Livewire\Admin\Solution\Index')->name('solution.index');
// EDUCATIONS SOLUTION END
// EDUCATIONS TECHNICAL START
        Route::get('/technical', 'App\Livewire\Admin\Technical\Index')->name('technical.index');
// EDUCATIONS TECHNICAL END

// SERVICES START
        Route::get('/service', 'App\Livewire\Admin\Service\Index')->name('service.index');
        Route::get('/service/{service}', 'App\Livewire\Admin\Service\Show')->name('service.show');
// SERVICES END
// LEARN & BUY BANNER START
        Route::get('/learnbanner', 'App\Livewire\Admin\LearnBanner\Index')->name('learnbanner.index');
// LEARN & BUY BANNER END

// LEARN INTROS START
        Route::get('/learnintro', 'App\Livewire\Admin\LearnIntro\Index')->name('learnintro.index');
        Route::get('/learnintro/{learnintro}', 'App\Livewire\Admin\LearnIntro\Show')->name('learnintro.show');
// LEARN INTROS END
// ONLINE COURSE START
        Route::get('/onlinecourse', 'App\Livewire\Admin\OnlineCourse\Index')->name('onlinecourse.index');
        Route::get('/onlinecourse/{onlinecourse}', 'App\Livewire\Admin\OnlineCourse\Show')->name('onlinecourse.show');
// ONLINE COURSE END
// TRAINING START
        Route::get('/training', 'App\Livewire\Admin\Training\Index')->name('training.index');
// TRAINING END
// MISSION BANNER START
        Route::get('/missionbanner', 'App\Livewire\Admin\MissionBanner\Index')->name('missionbanner.index');
// MISSION BANNER END
// MISSION BANNER START
        Route::get('/customisedsolutionbanner', 'App\Livewire\Admin\CustomisedSolutionBanner\Index')->name('customisedsolutionbanner.index');
// MISSION BANNER END
// TRAINING START
        Route::get('/learnshopnow', 'App\Livewire\Admin\LearnShopNow\Index')->name('learnshopnow.index');
// TRAINING END

// MISSION BANNER START
        Route::get('/parentaltitle', 'App\Livewire\Admin\ParentalTitle\Index')->name('parentaltitle.index');
// MISSION BANNER END
// ORDERS START
        Route::group([],function (){
            Route::get('/orders', 'App\Livewire\Admin\Orders\Index')->name('orders.index')->withoutMiddleware('role:superAdmin,admin')
                ->middleware('role:superAdmin|orderAdmin,admin')
            ;
            Route::get('/orders/{order}', 'App\Livewire\Admin\Orders\Show')->name('orders.show')->withoutMiddleware('role:superAdmin,admin')
                ->middleware('role:superAdmin|orderAdmin,admin')
            ;
        });


// ORDERS END
//// ORDERS START
        Route::get('/payments', 'App\Livewire\Admin\Payments\Index')->name('payments.index');
        Route::get('/payments/{index}', 'App\Livewire\Admin\Payments\Show')->name('payments.show');
// ORDERS END
// COURSES START
        Route::get('/course', 'App\Livewire\Admin\Course\Index')->name('course.index');
        Route::get('/course/{course}', 'App\Livewire\Admin\Course\Show')->name('course.show');
// COURSES END
// EDUCATION FEATURE START
        Route::get('/educationfeature', 'App\Livewire\Admin\EducationFeature\Index')->name('educationfeature.index');
        Route::get('/educationfeature/{educationfeature}', 'App\Livewire\Admin\EducationFeature\Show')->name('educationfeature.show');
// EDUCATION FEATURE END

// STUDENT FEATURE START
        Route::get('/studentfeature', 'App\Livewire\Admin\StudentFeature\Index')->name('studentfeature.index');
        Route::get('/studentfeature/{studentfeature}', 'App\Livewire\Admin\StudentFeature\Show')->name('studentfeature.show');
// STUDENT FEATURE END

// LOGOUT
        Route::any('/logout', [AdminController::class, 'logout'])->name('logout')->withoutMiddleware('role:superAdmin,admin');;
// TO GET FILES FROM STORAGE START
        Route::any('/files/{path}', [AdminController::class, 'uploads'])->name('uploads')->withoutMiddleware('role:superAdmin,admin');;
// TO GET FILES FROM STORAGE END

    });

    /* ====  End of AUTH ADMIN==== */
    Route::get('clear-cache', function (\Illuminate\Http\Request $request) {
        \Illuminate\Support\Facades\Artisan::call('optimize:clear');
        return redirect(url()->previous());
    })->name('clear-cache');
});
