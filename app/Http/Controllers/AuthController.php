<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    /**
     * return admin login view /pages/auth/admin_login.blade.php
     * @return View
     */
    public function showLoginAdminView()
    {
        return view('pages.auth.admin_login');
    }

    /**
     * return login view /pages/auth/login.blade.php
     * @return View
     */
    public function showLoginView()
    {
        if(Auth::check()) {
            return redirect()->route('home');
        }
        
        return view('pages.auth.login');
    }

    public function login(Request $request) 
    {
        if($this->validateLogin($request)) {
            $remember_me = $request->has('remember_me');
            $credentials = $request->only('email', 'password');
            $user = User::where('email', $credentials['email'])->first();

            if($user && $user->account_status && Auth::attempt($credentials, $remember_me)) {
                $request->session()->regenerate();

                $user->updateLastLogin();
                return redirect()->route('home')->withCookie(cookie('remembered_email', $user->email, 43200)); // 30 days
            }

            return redirectWithMessage('error', '', 'As credenciais fornecidas estão incorretas.');
        }
    }

    private function validateLogin($request)
    {
        $errors = validateFields($request->all());

        if ($errors) {
            return redirectWithMessage('error', "Campos inválidos", $errors);
        }

        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            $errors = $validator->errors();
            return redirectWithMessage('error', "Campos inválidos", $errors);
        }

        return true;
    }
}
