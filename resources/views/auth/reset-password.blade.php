<x-layouts.base>
    <x-slot:title>{{ __('Reset Password') }}</x-slot:title>

    <div class="w-screen h-screen flex items-center justify-center">
        <form class="flex flex-col space-y-4" method="post" action="{{ route('password.update') }}">
            @csrf

            <input type="hidden" name="token" value="{{ $request->route('token') }}">

            <h1 class="font-bold text-xl text-center">{{ config('app.name') }}</h1>

            <!-- Email address -->
            <x-input name="email" type="email" label="{{ __('Email') }}" icon="o-at-symbol" error-field="email" class="w-80" value="{{ $request->email }}" />

            <!-- Password -->
            <x-input name="password" type="password" label="{{ __('Password') }}" icon="o-key" error-field="password" class="w-80" />

            <!-- Password confirmation -->
            <x-input name="password_confirmation" type="password" label="{{ __('Password Confirmation') }}" icon="o-key" error-field="password_confirmation" class="w-80" />

            @if(session()->has('status'))
                <x-alert class="alert-success" title="{{ __('Success') }}" description="{{ session('status') }}" />
            @endif
            <x-button type="submit" class="btn btn-primary" label="{{ __('Reset Password') }}" />
        </form>
    </div>
</x-layouts.base>
