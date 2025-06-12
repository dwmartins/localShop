@extends('layouts.base')

@section('styles')
    @vite('resources/css/public/styles.css')
@endsection

@section('content')
    <section class="admin_login_view container-fluid px-0 vh-100">
        <div class="container item_center vh-100">
            <form action="/app/login" method="post" id="form_admin_login" class="w-100 bg-white rounded-3 py-4 px-3 px-md-4">
                @csrf

                <div class="mb-1 logo_image">
                    <img src="{{ config('website_info')->getImage("logo_image") }}?v={{ formatDateForUrl(config('website_info')->updated_at) }}" alt="{{ config('website_info')->getWebsiteName() }}">
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label fs-7 fw-semibold">E-mail</label>
                    <input type="email" name="email" id="email" class="form-control form-control-lg custom_focus_primary text-secondary fs-6" autocomplete="email" value="{{ old('email') ?? request()->cookie('remembered_email') }}">
                </div>

                <div class="mb-4">
                    <label for="password" class="form-label fs-7 fw-semibold">Senha</label>
                    <div class="position-relative">
                        <input type="password" name="password" id="password" class="form-control form-control-lg custom_focus_primary text-secondary fs-6">
                        <i class="fa-regular icon_show_password fa-eye text-secondary"></i>
                    </div>
                </div>

                <div class="d-flex justify-content-between align-items-center gap-1 mb-4 px-1">
                    <x-checkboxes.checkbox
                        id="remember_me"
                        description="Lembrar de mim"
                        class="text-secondary"
                    />

                    <a href="" class="custom-link outline_none fs-7 fw-medium">Esqueci minha senha</a>
                </div>

                <x-buttons.btn-primary 
                    text="Entrar"
                    class="w-100"
                    type="submit"
                    onclick="toggleLoading(this, true)"
                />
            </form>
        </div>
    </section>
@endsection