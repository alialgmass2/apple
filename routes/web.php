<?php

use App\Http\Controllers\User\LocalizationController;
use App\Mail\OTPMail;
use App\Mail\TestMail;
use App\Services\OTPService;
use App\Mail\OTPMail as MailOTPMail;
use App\Services\ShippingService;
use App\Services\Transactions\TransactionService;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Website\WebsiteController;

Route::middleware(['handle.register.otp','website.localize'])->group(function(){
Route::any('/locale/{lang}', [LocalizationController::class, 'localize'])->name('website.localize')
->withoutMiddleware('handle.register.otp');
Route::redirect('/','/apple');
Route::prefix('apple')->group(function(){
// Route::get('/', 'App\Livewire\Website\Welcome')->name('website.welcome');
Route::get('/', 'App\Livewire\Website\Home')->name('website.welcome');
Route::get('/leadership', 'App\Livewire\Website\Leadership')->name('website.leadership');
Route::get('/educators', 'App\Livewire\Website\Educators')->name('website.educators');
Route::get('/students-and-parents', 'App\Livewire\Website\StudentsAndParents')->name('website.studentsandparents');
Route::get('/education-deployment', 'App\Livewire\Website\EducationDeployment')->name('website.educationdeployment');
Route::get('Learn-and-buy', 'App\Livewire\Website\LearnAndBuy')->name('website.learnandbuy');
Route::get('/terms', 'App\Livewire\Website\Terms')->name('website.terms');
Route::get('/register-student', 'App\Livewire\Website\Auth\Register')
    ->name('website.register.student');
Route::get('/register-educator', 'App\Livewire\Website\Auth\RegisterEducator')->name('website.register.educator');

Route::get('/forgot-password', 'App\Livewire\Website\Auth\ForgotPassword')->name('user.forgotpassword');
Route::get('/checkUser', function (){
    dd(authUser()->howToKnow()->get());
});
Route::post('/accept-terms', function (\Illuminate\Http\Request $request){
    if ($request->accept){
        if(!authUser()->howToKnow()->exists()){
            if (!$request->answer){
                return response()->json([
                    'status'=>0,
                    'errorKey'=>'answer',
                    'error'=>'Answer is required'
                ]);
            }
            authUser()->howToKnow()->create([
                'answer'=>$request->answer
            ]);
            return response()->json([
                'status'=>'success',
                'url'=>route('checouts.create')
            ]);
        }else{
            return response()->json([
                'status'=>'success',
                'role'=>1,  // meaning that user already answered before
                'url'=>route('checouts.create')
            ]);
        }
    }else{
        return response()->json([
           'status'=>0,
           'errorKey'=>'accept',
           'error'=>'Accept is required'
        ]);
    }
})->name('user.accept.terms');

});
// END OF PREFIX
});
// END handle.register.otp

// Route::get('/finish', 'App\Livewire\Website\Auth\Finish')->name('register.finish');
Route::any('/files/{path}', [WebsiteController::class, 'uploads'])->name('website.uploads');
Route::get('products/{category}', 'App\Livewire\User\Organization\Product\ProductMenu')->name('products')->middleware('auth');
//Route::get('order-pdf/{order}','App\Livewire\Website\Components\Invoice')->name('order_pdf')->middleware('auth');
Route::get('order-pdf/{order}', function ($order){ return orderPdf($order); })->name('order_pdf');

//Route::view('products','products/all',[
//    'products'=>\App\Models\Product::where(function ($q){
//        if (request('cat_id')  ){
//            $q->where('category_id',request('cat_id'));
//        }
//        if (request('scat_id') ){
//            $q->where('sub_category_id',request('scat_id'));
//        }
//    })->limit(request('limit') ?? 5)->get(),
//    'categories'=>\App\Models\Category::all()
//    ])->name('products')->middleware('auth');
Route::get('/testmail', function () {
    $res = OTPService::send('test@mail.com', 1234);
    dd($res->body());

    return new OtpMail();
});
Route::get('/testmail2', function () {
    $otp = OTPService::generateOtp();
    // Mail::to('ali.ehab@alexondev.net')->send(new MailOTPMail($otp));
    // Mail::to('meshrf-emam@hotmail.com')->send(new MailOTPMail($otp));
    // return new MailOTPMail($otp);
    // Mail::to('tagmdev@gmail.com')->send(new MailOTPMail($otp));
    dd('#DONE ###################',$otp);
});
Route::get('/foo', function () {
//    (new TransactionService())->create();
    (new TransactionService())->tabby();
});
Route::get('/clear', function () {
    Artisan::call('optimize:clear');
});
