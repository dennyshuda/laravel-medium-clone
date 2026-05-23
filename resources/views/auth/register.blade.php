@section('auth-title', 'Join Medium Clone')
@section('auth-subtitle', 'Create an account to start writing and reading stories')

<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Username -->
        <div>
            <label for="username" class="block text-sm font-medium text-gray-700 mb-1">
                Username
            </label>
            <input id="username" type="text" name="username" value="{{ old('username') }}" required autofocus
                autocomplete="name"
                class="block w-full border-gray-300 rounded-lg focus:border-green-700 focus:ring-1 focus:ring-green-700 shadow-sm"
                placeholder="johndoe" />
            <x-input-error :messages="$errors->get('username')" class="mt-2" />
        </div>

        <!-- Name -->
        <div class="mt-5">
            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">
                Full name
            </label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" required
                class="block w-full border-gray-300 rounded-lg focus:border-green-700 focus:ring-1 focus:ring-green-700 shadow-sm"
                placeholder="John Doe" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email Address -->
        <div class="mt-5">
            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                Email
            </label>
            <input id="email" type="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                class="block w-full border-gray-300 rounded-lg focus:border-green-700 focus:ring-1 focus:ring-green-700 shadow-sm"
                placeholder="john@example.com" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-5">
            <label for="password" class="block text-sm font-medium text-gray-700 mb-1">
                Password
            </label>
            <input id="password" type="password" name="password" required autocomplete="new-password"
                class="block w-full border-gray-300 rounded-lg focus:border-green-700 focus:ring-1 focus:ring-green-700 shadow-sm"
                placeholder="At least 8 characters" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-5">
            <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">
                Confirm password
            </label>
            <input id="password_confirmation" type="password" name="password_confirmation" required
                autocomplete="new-password"
                class="block w-full border-gray-300 rounded-lg focus:border-green-700 focus:ring-1 focus:ring-green-700 shadow-sm"
                placeholder="Repeat your password" />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="mt-6">
            <button type="submit"
                class="w-full bg-green-700 text-white rounded-full py-2.5 font-medium hover:bg-green-800 transition focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2">
                Create account
            </button>
        </div>

        <p class="text-center text-sm text-gray-500 mt-6">
            Already have an account?
            <a href="{{ route('login') }}" class="text-green-700 hover:text-green-800 font-medium">Sign in</a>
        </p>
    </form>
</x-guest-layout>