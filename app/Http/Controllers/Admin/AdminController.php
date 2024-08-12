<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class AdminController extends Controller
{
    public function login()
    {
        return view('admin.auth.login');
    }
    public function loginSubmit(Request $request)
    {
        $request->validate([
            'email' => 'required|string|min:5|max:50',
            'password' => 'required|string|min:5|max:50',
        ]);
        $email = $request->email;
        $password = $request->password;
        if (Auth::guard('admin')->attempt(['email' => $email, 'password' => $password], true)) {
            return redirect()->route('admin.dashboard');
        } else {
            throw ValidationException::withMessages([
                'email' => 'Username or password invalid',
            ]);
        }
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login');
    }

    public function uploads(Request $request, $path)
    {
        // abort_if(!Storage::disk('uploads')->exists($path), 404, 'file does not exists check the path');
        return Storage::disk('uploads')->response($path);
    }
}
