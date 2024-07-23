<x-layouts.base>
    <x-slot:title>{{ __('Login') }}</x-slot:title>

    <div class="w-screen h-screen flex items-center justify-center">
        <form class="flex flex-col space-y-4" method="post">
            @csrf

            <h1 class="font-bold text-xl text-center">{{ config('app.name') }}</h1>

            <!-- Email address -->
            <x-input name="email" type="email" label="{{ __('Email') }}" icon="o-at-symbol" error-field="email" class="min-w-96" value="{{ old('email') }}" />

            <!-- Password -->
            <x-input name="password" type="password" label="{{ __('Password') }}" icon="o-key" error-field="password" class="min-w-96" />

            <!-- Remember me -->
            <x-checkbox name="remember" label="{{ __('Remember me') }}" class="text-sm" />

            <!-- Forgot password -->
            <a href="{{ route('password.request') }}" class="text-sm text-primary text-right hover:underline">
                {{ __('Forgot your password?') }}
            </a>

            <div class="flex flex-col sm:flex-row w-full space-x-4">
                <a href="{{ route('register') }}" class="btn btn-default flex-grow">{{ __('Register') }}</a>
                <x-button type="submit" class="btn btn-primary flex-grow" label="{{ __('Sign In') }}"/>
            </div>
        </form>
    </div>
</x-layouts.base>
