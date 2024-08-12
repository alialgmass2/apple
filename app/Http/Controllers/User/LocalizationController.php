<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class LocalizationController extends Controller
{
    public function localize($lang)
    {
        abort_if(!in_array($lang,['en','ar']),501,'un supported url paramter');
        Session::put('locale', $lang);
        return redirect()->back();
    }
}
