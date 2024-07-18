<x-layouts.base>
    <x-slot:title>{{ $title ?? config('app.name') }}</x-slot:title>
    <div class="navbar bg-base-100">
        <div class="navbar-start">
            <a class="btn btn-ghost text-xl" href="{{ route('home') }}">{{ config('app.name') }}</a>
        </div>
        <div class="navbar-center hidden lg:flex">
            <ul class="menu menu-horizontal px-1">
                <li>
                    <a href="{{ route('projects.index') }}">
                        {{ __('Projects') }}
                    </a>
                </li>
            </ul>
        </div>
        <div class="navbar-end">
            <div class="flex-none gap-2">
                <div class="dropdown dropdown-end">
                    <div tabindex="0" role="button" class="btn btn-ghost btn-circle avatar">
                        <div class="w-10 rounded-full">
                            <img alt="User avatar"
                                 src="https://ui-avatars.com/api/?name={{ auth()->user()?->name }}"/>
                        </div>
                    </div>
                    <ul tabindex="0"
                        class="mt-3 z-[1] p-2 shadow menu menu-sm dropdown-content bg-base-100 rounded-box w-52">
                        <li>
                            <form method="post" action="{{ route('logout') }}">
                                @csrf
                                <button>{{ __('Logout') }}</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <main class="max-w-7xl mx-auto">
        {{ $slot }}
    </main>
</x-layouts.base>
