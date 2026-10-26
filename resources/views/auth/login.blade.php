    @vite('resources/css/login.css')
    <x-guest-layout>


    <main class="login-wrapper">
        <div class="login-card">
            <div class="login-image">
            <div class="logo-overlay">

            
            <!-- Big Center Logo -->
             <img class="main-logo" src="https://image2url.com/r2/default/images/1773720216878-cd59f20e-a62d-4972-987a-05f2324f76f9.png" 
                alt="LGMED Compass Logo" 
                class="main-logo">

        </div>
            </div>


        <div class="login-form px-60">
            <h1>Sign in</h1>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}" autocomplete="on" novalidate>
                @csrf

                <!-- Email -->
                <div class="form-group @error('login') input-error @enderror">
                    <label for="login">Email or Username</label>

                    <div class="email-wrapper">
                        <input 
                            type="text"
                            id="login"
                            name="login"
                            placeholder="Email or username"
                            value="{{ old('login') }}"
                            required
                            autocomplete="username"
                        >
                    </div>

                    @error('login')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="form-group @error('password') input-error @enderror">
                    <label for="password">Password</label>
                        <div class="password-wrapper">
                            
                        <input
                            id="password"
                            type="password"
                            name="password" 
                            placeholder="Enter password"
                            autocomplete="current-password"
                            >
                        <button type="button"
                                    class="toggle-password"
                                    onclick="togglePassword('password')">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>  
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <div class="remember-wrapper">
                    <label class="remember-label">
                        <input 
                            type="checkbox"
                            id="remember_me"
                            name="remember"
                            {{ old('remember') ? 'checked' : '' }}
                        >
                        <span>Remember me</span>
                    </label>
                </div>
                <!-- Forgot -->
                @if (Route::has('password.request'))
                    <div class="forgot">
                        <a href="{{ route('password.request') }}">
                            Forgot Password
                        </a>
                    </div>
                @endif

                <button type="submit" class="btn-login">
                    Sign in
                </button>

                <p class="register-text">
                    New here?
                    <a href="{{ route('register') }}">Create an account</a>
                </p>
            </form>
        </div>
        </div>
    <script src="{{ asset('js/login.js') }}"></script>
    </main>

    </x-guest-layout>
