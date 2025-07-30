@extends('layouts.guest')

@section('main')
<div class="flex flex-col justify-between items-center w-full gap-7">
    <h3 class="text-2xl font-semibold text-neutral">Sign Up</h3>

    <form method="POST" action="{{ route('register') }}" class="w-full">
        @csrf
        <div class="flex flex-col justify-between items-center w-full px-3 gap-4">
            <!-- Name -->
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Name</span>
                </div>
                <input type="text" id="name" name="name" :value="old('name')" required autofocus autocomplete="name"
                    placeholder="your name" class="input input-bordered w-full" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </label>

            <!-- Email Address -->
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Email</span>
                </div>
                <input type="email" id="email" name="email" :value="old('email')" required autocomplete="username"
                    placeholder="example@mail.com" class="input input-bordered w-full" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </label>

            <!-- Password -->
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Password</span>
                </div>
                <input type="password" id="password" type="password" name="password" required
                    autocomplete="new-password" placeholder="*******" class="input input-bordered w-full" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </label>

            <!-- Confirm Password -->
            <label class="form-control w-full">
                <div class="label">
                    <span class="label-text">Confirm Password</span>
                </div>
                <input type="password" id="password_confirmation" type="password" name="password_confirmation" required
                    autocomplete="new-password" placeholder="*******" class="input input-bordered w-full" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </label>

            <div class="flex items-center justify-between mt-4 gap-2 w-full">
                <a class="link link-hover text-sm" href="{{ route('login') }}">Already registered?</a>
                <button class="btn btn-secondary" type="submit">Register</button>
            </div>
        </div>
    </form>
</div>
@endsection