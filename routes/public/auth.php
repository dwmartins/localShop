<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get("/app/login", [AuthController::class, "showLoginAdminView"])->name("admin_login");