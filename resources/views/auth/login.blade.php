@section('auth-title', 'Welcome back')
@section('auth-subtitle', 'Sign in to continue reading and writing stories')

<x-guest-layout>
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Email
            </label>
            <input id="email" type="email" name="email" :value="old('email')" required autofocus autocomplete="username"
                class="block w-full border-gray-300 rounded-lg focus:border-green-700 focus:ring-1 focus:ring-green-700 shadow-sm"
                placeholder="your@email.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                Password
            </label>
            <input id="password" type="password" name="password" required autocomplete="current-password"
                class="block w-full border-gray-300 rounded-lg focus:border-green-700 focus:ring-1 focus:ring-green-700 shadow-sm"
                placeholder="Enter your password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me & Forgot -->
        <div class="flex items-center justify-between mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox"
                    class="rounded border-gray-300 text-green-700 focus:ring-green-700" name="remember">
                <span class="ml-2 text-sm text-gray-600">Remember me</span>
            </label>

            @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-sm text-green-700 hover:text-green-800 font-medium">
                Forgot password?
            </a>
            @endif
        </div>

        <div class="mt-6">
            <button type="submit"
                class="w-full bg-green-700 text-white rounded-full py-2.5 font-medium hover:bg-green-800 transition focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Sign in
            </button>
        </div>

        <p class="text-center text-sm text-gray-500 mt-6">
            No account?
            <a href="{{ route('register') }}" class="text-green-700 hover:text-green-800 font-medium">
                Create one
            </a>
        </p>
    </form>
</x-guest-layout>