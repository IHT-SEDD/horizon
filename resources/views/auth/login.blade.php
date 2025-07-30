@extends('layouts.guest')

@section('main')
<div class="flex flex-col justify-between items-center w-full gap-7">
    <h3 class="text-2xl font-semibold text-neutral">Sign In</h3>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="w-full">
        @csrf

        <div class="flex flex-col justify-between items-center w-full px-3 gap-4">
            <!-- Email Address -->
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Email</span>
                </div>
                <input type="email" id="email" name="email" :value="old('email')" required autofocus
                    autocomplete="username" placeholder="example@mail.com" class="input input-bordered w-full" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </label>

            <!-- Password -->
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Password</span>
                </div>
                <input type="password" id="password" type="password" name="password" required
                    autocomplete="current-password" placeholder="*******" class="input input-bordered w-full" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </label>

            <!-- Remember Me -->
            <div class="form-control w-full">
                <label class="label cursor-pointer">
                    <span class="label-text">Remember me</span>
                    <input type="checkbox" class="checkbox" id="remember_me" name="remember" />
                </label>
            </div>


            <div
                class="flex items-center justify-between mt-4 gap-2 w-full pb-8 border-b border-dashed border-base-200">
                @if (Route::has('password.request'))
                <a class="link link-hover text-xs" href="{{ route('password.request') }}">Forgot your password?</a>
                @endif
                <button class="btn btn-secondary" type="submit">Log In</button>
            </div>

            <div class="flex items-center mt-3 w-full">
                <a class="link link-hover text-xs" href="{{ route('register') }}">Didn't have an account?</a>
            </div>
        </div>

    </form>
</div>
@endsection