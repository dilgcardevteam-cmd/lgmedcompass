
<x-guest-layout>
<div style="position: fixed; top: 0; left: 0; width: 100vw; height: 100vh; z-index: 9999; background: rgba(0,0,0,0.5); display: flex; align-items: center; justify-content: center;">        <div class="bg-white rounded-2xl shadow-xl max-w-md w-full p-6 text-center">
                <!-- Heading -->
                <h2 class="text-2xl font-semibold text-gray-800 mb-4">
                    Verify Your Email
                </h2>

                <!-- Message -->
                <p class="text-gray-600  mb-4">
                    {{ __('Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                </p>

                <!-- Success Message -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 text-green-600 font-medium">
                        {{ __('A new verification link has been sent to the email address you provided during registration.') }}
                    </div>
                @endif

                <!-- Buttons -->
                <div class="flex flex-col sm:flex-row gap-3 justify-center mt-6">
                    <!-- Resend Verification Email -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <x-primary-button class="w-40 sm:w-auto px-6 py-2">
                            {{ __('Resend Verification Email') }}
                        </x-primary-button>
                    </form>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="w-40 sm:w-auto px-6 py-2 underline text-gray-600  hover:text-gray-900  rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 ">
                            {{ __('Log Out') }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-guest-layout>