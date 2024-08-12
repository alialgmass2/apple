<?php
use App\Enums\OrderStatus;
use App\Models\checkouts\catrs\Cart;
use App\Models\User;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

// LAYOUTS
define('ADMIN_LAYOUT', 'components.layouts.app-admin');
define('USER_LAYOUT', 'components.layouts.app-user');
define('INVOICE_LAYOUT', 'components.layouts.invoice-app');
define('ORGANIZATION_LAYOUT', 'components.layouts.app-organization');
define('HOME_LAYOUT', 'components.layouts.app-home');
define('CURRENT_STEP', 'CURRENT_STEP_');
// GUARDS
define('REGISTER_STEP', 'register_step');

// AUTH ADMIN CHECK
if (!function_exists('adminCheck')) {
    function adminCheck()
    {
        return Auth::guard('admin')->check();
    }
}

// AUTH USER (WEB) CHECK
if (!function_exists('authCheck')) {
    function authCheck()
    {
        return Auth::guard('web')->check();
    }
}

// active guard
if (!function_exists('activeGuard')) {
    function activeGuard() {
        $guards = array_keys(config('auth.guards')) ;
        foreach($guards as $guard){
            if(auth()->guard($guard)->check()){
                return $guard;
            }
            return null;
        }
    }
}

// AUTH USER (register_step) CHECK
if (!function_exists('RegisterStepCheck')) {
    function RegisterStepCheck()
    {
        return Auth::guard(REGISTER_STEP)->check();
    }
}

// AUTH ADMIN USER
if (!function_exists('authAdmin')) {
    function authAdmin()
    {
        return Auth::guard('admin')->user();
    }
}
// AUTH USER (WEB)
if (!function_exists('authUser')) {
    function authUser()
    {
        return Auth::guard('web')->user();
    }
}
// AUTH USER (register_step)
if (!function_exists('authRegisterStep')) {
    function authRegisterStep()
    {
        return Auth::guard(REGISTER_STEP)->user();
    }
}

// SET CURRENT REGISTER STEP WITH IP ADDRESS
if (!function_exists('setCurrentRegisterStep')) {
    function setCurrentRegisterStep()
    {
        if (Session::has(CURRENT_STEP . request()->ip())) {
            // Session::forget(CURRENT_STEP . request()->ip());

            // DDO NOTHING
            return 'true';
        } else {
            return Session::put(CURRENT_STEP . request()->ip(), 11);
        }
    }
}
// GET CURRENT REGISTER STEP WITH IP ADDRESS
if (!function_exists('getCurrentRegisterStep')) {
    function getCurrentRegisterStep()
    {
        return Session::get(CURRENT_STEP . request()->ip());
    }
}
// CHECK IF HAS CURRENT REGISTER STEP WITH IP ADDRESS OR NOT
if (!function_exists('updateCurrentRegisterStep')) {
    function updateCurrentRegisterStep($step)
    {
        // Session::forget(CURRENT_STEP . request()->ip());
        return Session::put(CURRENT_STEP . request()->ip(), $step);
    }
}

// // CHECK KEY EXISTS IN STATE BEFORE UPLOAD IMAGE
if (!function_exists('toExists')) {
    function toExists($key, $stateArray)
    {
        if (array_key_exists($key, $stateArray)) {
            return true;
        }
        return false;
    }
}

// HANDLE PRVIEWS OF FILES IN DETAILS PAGE
if (!function_exists('handlePreviewFile')) {
    function handlePreviewFile($file)
    {
        if (in_array(File::extension($file), ['jpeg', 'png', 'jpg', 'svg'])) {
            return '<a href="' . $file . '" target="_blank">
                <img src="' . $file . '" class="image-preview" alt="" />
            </a>';
        } else {
            return '<a href="' . $file . '" class="file-preview" target="_blank">' . File::extension($file) . '</a>';
        }
    }

}

// HANDLE STATE OF FORM FILE PRVIEWS
if (!function_exists('handleStateFile')) {
    function handleStateFile($file)
    {
        if (in_array($file->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'svg'])) {
            return '<img src="' . $file->temporaryUrl() . '" class="image-preview" alt="" />';
        } else {
            return '<span class="file-preview">' . $file->getClientOriginalExtension() . '</span>';
        }
    }
}

// VALUE OR DB NAME TO TO LOCALE
if (!function_exists('toLocale')) {
    function toLocale($value)
    {
        if ($value !== null) {
            return $value . '_' . app()->getLocale() ?? '';
        }
        return '';
    }
}

// AUTH FACTORY CHECK
if (!function_exists('authCheck')) {
    function authCheck()
    {
        return Auth::guard('web')->check();
    }
}

// AUTH DASHBOARD USER (ALL TYPES FACTORY - DISTRBUTOR - RETAILER - CLIENT)
if (!function_exists('authUser')) {
    function authUser()
    {
        return Auth::guard('web')->user();
    }
}

// CALCULATE DISCOUNT FOR ORDER
if (!function_exists('calculateDiscountForOrder')) {
    function calculateDiscountForOrder($price, $discount)
    {
        $step = $price * $discount;
        $discountPrice = $step / 100;
        $priceAfterDiscount = $price - $discountPrice;
        return $priceAfterDiscount;
    }
}
// HANDLE COLORS FOR ORDER STATUS
if (!function_exists('handleColorsForOrderStatauses')) {
    function handleColorsForOrderStatauses($status)
    {
        if ($status == 'IN_PROGRESS') {
            return ' Green';
        } elseif ($status == 'SHIPPED') {
            return '#fcbf04';
        } elseif ($status == 'OUT_FOR_DELIVERY') {
            return '#fa5033';
        } elseif ($status == 'DELIVERED') {
            return '#29B27f';
        }  elseif ($status == 'ORDER_PLACED') {
            return '#188AF9';
        }elseif ($status == 'CANCELLED') {
            return '#f70207';
        } else {
            return '#fcbf04';
        }
    }
}
// HANDLE BG COLORS FOR ORDER STATUS
if (!function_exists('handleColorsForOrderStatauses')) {
    function handleColorsForOrderStatauses($status)
    {
        // if ($status == 'IN_PROGRESS') {
        //     return '#f2c343';
        // } elseif ($status == 'SHIPPED') {
        //     return '#f2c343';
        // } elseif ($status == 'OUT_FOR_DELIVERY') {
        //     return '#f2c343';
        // } elseif ($status == 'DELIVERED') {
        //     return 'green';
        // } else {
        //     return '#f2c343';
        // }
    }
}
// HANDLE TEXT COLORS FOR ORDER STATUS
if (!function_exists('handleTextColorsForOrderStatauses')) {
    function handleTextColorsForOrderStatauses($status)
    {
        return '#fff';
        // if ($status == 'IN_PROGRESS') {
        //     return 'black';
        // } elseif ($status == 'SHIPPED') {
        //     return 'black';
        // } elseif ($status == 'OUT_FOR_DELIVERY') {
        //     return 'black';
        // } elseif ($status == 'DELIVERED') {
        //     return '#fff';
        // } else {
        //     return 'black';
        // }
    }
}

if (!function_exists('previous_route')) {
    /**
     * Generate a route name for the previous request.
     *
     * @return string|null
     */
    function previousRoute()
    {
        $previousRequest = app('request')->create(app('url')->previous());
        try {
            $routeName = app('router')->getRoutes()->match($previousRequest)->getName();
        } catch (NotFoundHttpException $exception) {
            return null;
        }

        return $routeName;
    }
}
function chunkString(string $string)
{
    return \Illuminate\Support\Str::limit($string, 50, ' ...');
}

function productInfo($data,$link):string
{
    $html = '';
    if ($data != null) {
        if (str_contains($data,"\n")){
            foreach (explode("\n",$data) as $item){
                $html .= '<li>'.$item.'</li>';
            }
        }else{
            $html .= '<li>'.$data.'</li>';
        }
        if (isset($link) && $link != null) {
            $html .= '<a href="'.$link.'" target="_blank">
                        <x-admin.button class="btn btn-warning">More Info</x-admin.button>
                      </a>';
        }
    }else{
        $html .= '<li>Not Found Data</li>';
    }

    return $html;
}

function getPrice($product_id):string
{

    $organization = authUser()->organization->id;
//    $organizationData = authUser()->organization->offers()->get();
//    if ($organizationData != null){
//        $prec = '';
//        foreach ($organizationData as $item){
//            $prec =  $item->ProductOffer()->where('product_id',$product_id)->with('offer');
//            if ($prec->exists() && checkOfferExpiration($prec->first()?->offer->start_date,$prec->first()?->offer->end_date,$prec->first()?->offer->status)){
//                return $prec->first()->offer->percent;
//            }
//        }
//    }
    $discount = \App\Models\OrganizationDiscount::where([['organization_id', $organization],['product_id',$product_id]])->first();
    if ($discount != null && $discount->discount != 0){
        return $discount->discount;
    }else{
        return authUser()->organization->discount;
    }

}
function checkOffer($product_id):string
{

    $organization = authUser()->organization->id;
    $discount = \App\Models\OrganizationDiscount::where([['organization_id', $organization],['product_id',$product_id]])->first();
    if ($discount != null && $discount->discount != 0){
        $discount = $discount->discount;
    }else{
        $discount = authUser()->organization->discount;
    }

    $organization = authUser()->organization->offers()->get();
    if ($organization != null){
        $prec = '';
        foreach ($organization as $item){
            $prec =  $item->ProductOffer()->where('product_id',$product_id)->with('offer');
            if ($prec->exists() && checkOfferExpiration($prec->first()?->offer->start_date,$prec->first()?->offer->end_date,$prec->first()?->offer->status)){
                return $discount;
            }
        }
    }
    return '';
//    $organization = authUser()->organization->id;
//    $discount = \App\Models\OrganizationDiscount::where([['organization_id', $organization],['product_id',$product_id]])->first();
//    if ($discount != null && $discount->discount != 0){
//        return $discount->discount;
//    }else{
//        return authUser()->organization->discount;
//    }

}
function addCart($product_id , $color):string
{
    $max_product_in_cart=auth()->user()->organization->max_order_number;
    $current =auth()->user()->cart()->sum('quantity');
    if($current<$max_product_in_cart){
        $data = [];
        $data['product_id'] = $product_id;
        $data['user_id'] = auth()->user()->id;
        $data['color_code'] = $color??null;
        $checkCart = Cart::where('product_id', $data['product_id'])->where('user_id', $data['user_id']);
        if ($checkCart->exists()) {
            $cart = $checkCart->increment('quantity');
        }else{
            $cart = Cart::create($data);
        }
        return  'addSuccess';
    }

    return 'maxNum';
}
function getTerms():string
{
    $title     = 'title_'.config('app.locale');
    $sub_title = 'sub_title_'.config('app.locale');
    $content   = 'content_'.config('app.locale');
    $html = '';
    foreach(\App\Models\Term::orderBy('created_at')->get() as $pKey => $terms){
        $pKey = ++$pKey;
        $html .= '<div class="body_title">';
        $html .= '<h1>'.$pKey . ' . ' . $terms->$title.'</h1>';
        $html .= '<div class="body_subtitle">';
        $html .= '<p class="maintitle_terms">'.$terms->$sub_title.'<p>';
        foreach(explode("\n",$terms->$content) as $sKey => $sonTerms){
            $html .= '<p  class="list_subtitle">'.$pKey . '.'.++$sKey . ' . ' . $sonTerms.'</p>';
        }
        $html .= '</div>';
        $html .= '</div>';
    }
    return $html;
}
function sendNotification($data){
    if ($data['type'] == 'create'){
        $sender = \App\Models\Admin::first();
        $data['title_en'] = 'New Order Created';
        $data['title_ar'] = 'هناك طلب جديد';
    }else{
        $sender = \App\Models\User::find($data['user_id']);
    }
    \Notification::send($sender,new App\Notifications\OrderNotify($data));
}
function downloadPdf($view,$data){
    $pdf = \PDF::loadHtml($view);

// Make sure your HTML/CSS references the font correctly

// Download the PDF
    $pdfData = $pdf->download('invoice.pdf');

// Display PDF data
    return $pdfData;

//    $pdf = \Barryvdh\DomPDF\PDF::class;
////    $pdf->setOptions(['defaultFont'=>'SF Hello']);
//    $pdf->loadView($view, $data);
//    return $pdf->download('invoice.pdf');
}
function orderPdf($order_id)
{
    $order = App\Models\checkouts\orders\Order::find($order_id);

    abort_if($order == null,404);
    $displayQRCodeAsBase64 = Salla\ZATCA\GenerateQrCode::fromArray([
        new Salla\ZATCA\Tags\Seller('شركة ضوابط التقنية للتجارة'), // seller name
        new Salla\ZATCA\Tags\TaxNumber('300925605200003'), // seller tax number
        new Salla\ZATCA\Tags\InvoiceDate($order->created_at), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
        new Salla\ZATCA\Tags\InvoiceTaxAmount($order->total), // invoice total amount
        new Salla\ZATCA\Tags\InvoiceTotalAmount(number_format($order->total*15/100)) // invoice tax amount sell
        // TODO :: Support others tags
    ])->render();
    $qr=$displayQRCodeAsBase64;
    abort_if(authUser() && $order->user_id != authUser()->id && !authAdmin(),"404");
    $order = $order->load('items');
    $user = User::find($order?->user_id);
    $orgnization = $user->organization()->first();;
   // return downloadPdf('components.misc.order_pdf',['user'=>$user,'orgnization'=>$orgnization,'qr'=>$qr,'order'=>$order]);
    return downloadPdf(view('components.misc.order_pdf',['user'=>$user,'orgnization'=>$orgnization,'qr'=>$qr,'order'=>$order]),[]);
}

function checkOfferExpiration($start_date,$end_date,$status):bool
{
    $return = false;
    if (\Carbon\Carbon::parse($start_date)->isPast() && !\Carbon\Carbon::parse($end_date)->isPast() && $status == 1){
        $return = true;
    }
    return $return;
}
