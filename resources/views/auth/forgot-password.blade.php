<x-layouts.base>
    <x-slot:title>{{ __('Forgot Password') }}</x-slot:title>

    <div class="w-screen h-screen flex items-center justify-center">
        <form class="flex flex-col space-y-4" method="post" action="{{ route('password.email') }}">
            @csrf

            <h1 class="font-bold text-xl text-center">{{ config('app.name') }}</h1>

            <!-- Email address -->
            <x-input name="email" type="email" label="{{ __('Email') }}" icon="o-at-symbol" error-field="email" class="w-80" />

            @if(session()->has('status'))
                <x-alert class="alert-success" title="{{ __('Success') }}" description="{{ session('status') }}" />
            @endif
            <x-button type="submit" class="btn btn-primary" label="{{ __('Reset Password') }}" />
        </form>
    </div>
</x-layouts.base>
