<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get("/app/entrar", [AuthController::class, "showLoginAdminView"])->name("admin_login");
Route::get("/entrar", [AuthController::class, "showLoginView"])->name("login");
Route::get("/registrar", [AuthController::class, "showRegisterView"])->name("register");

Route::post("/login", [AuthController::class, "login"]);