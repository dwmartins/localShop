@extends('layouts.base')

@section('styles')
    @vite('resources/css/public/styles.css')
@endsection

@section('content')
    @include('components.public.header')

    <main class="container mt-4">
        @yield('main-content')
    </main>

    footer
@endsection
