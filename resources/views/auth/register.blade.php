<x-layouts.base>
    <x-slot:title>{{ __('Register') }}</x-slot:title>

    <div class="w-screen h-screen flex items-center justify-center">
        <form class="flex flex-col space-y-4" method="post">
            @csrf

            <h1 class="font-bold text-xl text-center">{{ config('app.name') }}</h1>

            <!-- Email address -->
            <x-input name="name" type="text" label="{{ __('Name') }}" icon="o-user" error-field="email" class="min-w-96" value="{{ old('name') }}" />

            <!-- Email address -->
            <x-input name="email" type="email" label="{{ __('Email') }}" icon="o-at-symbol" error-field="email" class="min-w-96" value="{{ old('email') }}" />

            <!-- Password -->
            <x-input name="password" type="password" label="{{ __('Password') }}" icon="o-key" error-field="password" class="min-w-96" />

            <!-- Password confirmation -->
            <x-input name="password_confirmation" type="password" label="{{ __('Confirm Password') }}" icon="o-key" error-field="password_confirmation" class="min-w-96" />

            <!-- Forgot password -->
            <a href="{{ route('password.request') }}" class="text-sm text-primary text-right hover:underline">
                {{ __('Forgot your password?') }}
            </a>

            <x-button type="submit" class="btn btn-primary" label="{{ __('Register') }}" />
        </form>
    </div>
</x-layouts.base>
