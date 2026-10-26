<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gray-50 px-4">
        <div class="w-full max-w-md bg-white p-8 md:p-10 rounded-2xl shadow-lg border border-gray-200">

            <h2 class="text-3xl font-extrabold text-center mb-4 text-gray-800">
                Reset Password
            </h2>

            <p class="text-center text-gray-600 mb-8 text-sm">
                Enter your email and new password below to reset your account password.
            </p>

            <form method="POST" action="{{ route('password.store') }}" class="w-full">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <!-- Email -->
                <div class="mb-5">
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700 font-semibold" />
                    <x-text-input 
                        id="email"
                        class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-200"
                        type="email"
                        name="email"
                        :value="old('email', $request->email)"
                        required
                        autofocus
                        autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Password -->
                <div class="mb-5">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700 font-semibold" />
                    <x-text-input 
                        id="password"
                        class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-200"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Confirm Password -->
                <div class="mb-8">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" class="text-gray-700 font-semibold" />
                    <x-text-input 
                        id="password_confirmation"
                        class="block mt-1 w-full rounded-lg border-gray-300 shadow-sm focus:border-gray-900 focus:ring focus:ring-gray-200"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password" />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-sm text-red-600" />
                </div>

                <!-- Submit -->
                <x-primary-button class="w-full py-3 rounded-lg text-white font-semibold bg-gray-800 hover:bg-gray-900 transition ease-in-out duration-150 flex justify-center items-center">
                    {{ __('Reset Password') }}
                </x-primary-button>
            </form>
        </div>
    </div>
</x-guest-layout>