<!DOCTYPE html>
<html lang="en">

<!-- login17.html /3.x [XR&CO'2014], Sun, 03 Jan 2021 18:44:26 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/fontawesome-all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/iofrm-style.css">
    <link rel="stylesheet" type="text/css" href="{{asset('/')}}css/iofrm-theme17.css">
</head>
<body>
<div class="form-body without-side">
    <div class="website-logo">
        <a href="#">
            <div class="logo">
                <img class="logo-size" src="{{asset('/')}}img/logo-light.svg" alt="">
            </div>
        </a>
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3 class="mb-3">ログイン</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <select class="form-select mb-2" id="year" name="email" required>
                            <option></option>
                            @foreach($users as $item)
                                <option value="{{$item->email}}">{{$item->name}}</option>
                            @endforeach
                        </select>
{{--                        <input class="form-control" type="email" name="email" placeholder="メールアドレス" required autofocus>--}}
                        <input class="form-control" type="password" name="password" placeholder="パスワード" required>
{{--                        <input id="remember_me" type="checkbox" class="rounded" name="remember">--}}
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">ログイン</button>
{{--                            <a href="forget17.html">Forget password?</a>--}}
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('/')}}js/jquery.min.js"></script>
<script src="{{asset('/')}}js/popper.min.js"></script>
<script src="{{asset('/')}}js/bootstrap.min.js"></script>
<script src="{{asset('/')}}js/main.js"></script>
</body>

<!-- login17.html /3.x [XR&CO'2014], Sun, 03 Jan 2021 18:44:29 GMT -->
</html>

{{--<x-guest-layout>--}}
{{--    <x-auth-card>--}}
{{--        <x-slot name="logo">--}}
{{--            <a href="/">--}}
{{--                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />--}}
{{--            </a>--}}
{{--        </x-slot>--}}

{{--        <!-- Session Status -->--}}
{{--        <x-auth-session-status class="mb-4" :status="session('status')" />--}}

{{--        <!-- Validation Errors -->--}}
{{--        <x-auth-validation-errors class="mb-4" :errors="$errors" />--}}

{{--        <form method="POST" action="{{ route('login') }}">--}}
{{--        @csrf--}}

{{--        <!-- Email Address -->--}}
{{--            <div>--}}
{{--                <x-label for="email" :value="__('Email')" />--}}

{{--                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />--}}
{{--            </div>--}}

{{--            <!-- Password -->--}}
{{--            <div class="mt-4">--}}
{{--                <x-label for="password" :value="__('Password')" />--}}

{{--                <x-input id="password" class="block mt-1 w-full"--}}
{{--                         type="password"--}}
{{--                         name="password"--}}
{{--                         required autocomplete="current-password" />--}}
{{--            </div>--}}

{{--            <!-- Remember Me -->--}}
{{--            <div class="block mt-4">--}}
{{--                <label for="remember_me" class="inline-flex items-center">--}}
{{--                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">--}}
{{--                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--                </label>--}}
{{--            </div>--}}

{{--            <div class="flex items-center justify-end mt-4">--}}
{{--                @if (Route::has('password.request'))--}}
{{--                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">--}}
{{--                        {{ __('Forgot your password?') }}--}}
{{--                    </a>--}}
{{--                @endif--}}

{{--                <x-button class="ml-3">--}}
{{--                    {{ __('Log in') }}--}}
{{--                </x-button>--}}
{{--            </div>--}}
{{--        </form>--}}
{{--    </x-auth-card>--}}
{{--</x-guest-layout>--}}
