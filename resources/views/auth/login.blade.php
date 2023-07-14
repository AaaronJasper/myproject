<x-guest-layout>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>
        <x-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        {{-- Login with Google account --}}
        <div class="flex items-center justify-end mt-4">
            <a class="google-btn" href="{{ url('auth/google') }}">
                <div class="google-icon-wrapper">
                    <img class="google-icon" src="https://upload.wikimedia.org/wikipedia/commons/5/53/Google_%22G%22_Logo.svg" />
                </div>
                <p class="btn-text"><b>Google 帳戶登入</b></p>
            </a>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <x-button class="ml-4">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-authentication-card>
    ß


</x-guest-layout>
<style>
    $white: #fff;
    $google-blue: #4285f4;
    $button-active-blue: #1669F2;

    .google-btn {
        width: 184px;
        height: 42px;
        background-color: $google-blue;
        border-radius: 2px;
        box-shadow: 0 3px 4px 0 rgba(0, 0, 0, .25);
        display: flex;
        align-items: center;
        justify-content: center;
        text-decoration: none;
        color: $white;
        font-weight: bold;
        transition: box-shadow 0.3s ease;
    }

    .google-icon-wrapper {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 40px;
        height: 40px;
        border-radius: 2px;
        background-color: $white;
        margin-right: 10px;
    }

    .google-icon {
        width: 18px;
        height: 18px;
    }

    .btn-text {
        font-size: 14px;
        letter-spacing: 0.2px;
        font-family: 'Open Sans', sans-serif;
    }

    .google-btn:hover {
        box-shadow: 0 0 6px $google-blue;
    }

    .google-btn:active {
        background: $button-active-blue;
    }
</style>
<link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans">