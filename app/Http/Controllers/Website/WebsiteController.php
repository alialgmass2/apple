<?php

namespace App\Http\Controllers\Website;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class WebsiteController extends Controller
{
    public function uploads(Request $request, $path)
    {
        // abort_if(!Storage::disk('uploads')->exists($path), 404, 'file does not exists check the path');
        // if (!Storage::disk('uploads')->exists($path)) {
        //     # code...
        // }
        return Storage::disk('uploads')->response($path);
    }
}
