<x-guest-layout>
<style>
    body {
        background: #f9fafb; /* Matches bg-gray-50 */
        font-family: "Segoe UI", sans-serif;
    }

    .forgot-wrapper {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 0 16px;
    }

    .forgot-card {
        width: 100%;
        max-width: 448px; /* max-w-md */
        background: #ffffff;
        padding: 40px; /* md:p-10 */
        border-radius: 16px; /* rounded-2xl */
        box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); /* shadow-lg */
        border: 1px solid #e5e7eb; /* border-gray-200 */
    }

    .forgot-card h2 {
        text-align: center;
        font-size: 30px; /* text-3xl */
        font-weight: 800; /* font-extrabold */
        margin-bottom: 16px;
        color: #1f2937; /* text-gray-800 */
    }

    .forgot-card p {
        font-size: 14px;
        color: #4b5563; /* text-gray-600 */
        margin-bottom: 32px;
        text-align: center;
        line-height: 1.6;
    }

    label {
        font-size: 14px;
        font-weight: 600; /* font-semibold */
        display: block;
        margin-bottom: 6px;
        color: #374151; /* text-gray-700 */
    }

    /* FORCED LIGHT MODE INPUTS */
    input {
        width: 100%;
        padding: 12px;
        border-radius: 8px;
        display: block;
        margin-top: 4px;
        background-color: #ffffff !important; 
        color: #000000 !important;
        border: 1px solid #d1d5db !important; /* border-gray-300 */
        box-shadow: 0 1px 2px 0 rgba(0, 0, 0, 0.05); /* shadow-sm */
    }

    input:focus {
        border-color: #111827 !important; /* focus:border-gray-900 */
        outline: none;
        ring: 2px;
        box-shadow: 0 0 0 3px rgba(229, 231, 235, 0.5) !important; /* focus:ring-gray-200 */
    }

    .error-message {
        margin-top: 8px;
        color: #dc2626; /* text-red-600 */
        font-size: 14px;
    }

    /* BUTTON STYLING */
    .btn-reset {
        width: 100%;
        margin-top: 24px;
        padding: 12px;
        border-radius: 8px;
        background: #1f2937; /* bg-gray-800 */
        color: #ffffff;
        font-weight: 600;
        border: none;
        cursor: pointer;
        display: flex;
        justify-content: center;
        align-items: center;
        transition: all 0.15s ease-in-out;
    }

    .btn-reset:hover {
        background: #111827; /* hover:bg-gray-900 */
    }

    .back-login {
        text-align: center;
        margin-top: 18px;
        font-size: 14px;
    }

    .back-login a {
        font-weight: 600;
        text-decoration: none;
        color: #374151;
    }

    .back-login a:hover {
        text-decoration: underline;
    }
</style>

@extends('layouts.forgot')

@section('content')

<div class="forgot-wrapper">
    <div class="forgot-card">

        <h2>Forgot Password</h2>

        <p>
            Forgot your password? No problem. Enter your email address and
            we’ll send you a password reset link.
        </p>

        <x-auth-session-status class="mb-4" :status="session('status')" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="mb-5">
                <label for="email">Email</label>
                <input
                    id="email"
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    required
                    autofocus
                    placeholder="Enter your email"
                >

                <x-input-error :messages="$errors->get('email')" class="error-message" />
            </div>

            <button type="submit" class="btn-reset">
                Email Password Reset Link
            </button>

            <div class="back-login">
                <a href="{{ route('login') }}">Back to Sign in</a>
            </div>
        </form>

    </div>
</div>

@endsection
</x-guest-layout>