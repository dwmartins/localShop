<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * return admin login view /pages/auth/admin_login.blade.php
     * @return View
     */
    public function showLoginAdminView() {
        return view('pages.auth.admin_login');
    }
}
