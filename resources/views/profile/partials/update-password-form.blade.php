<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Update Password') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __('Ensure your account is using a long, random password to stay secure.') }}
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
        @csrf
        @method('put')

        <div>
            <x-input-label for="update_password_current_password" :value="__('Current Password')" />
            <x-texts-input id="update_password_current_password" name="current_password" type="password" class="mt-1 block w-full" autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
        </div>

        <div class="form-group @error('password', 'updatePassword') input-error @enderror" id="passwordGroup">
    <label for="update_password_password">New Password</label>

    <div class="password-wrapper">
        <input 
            id="update_password_password"
            type="password" 
            name="password" 
            placeholder="Enter new password"
            autocomplete="new-password"
        >
        <button type="button" class="toggle-password" onclick="togglePassword('update_password_password')">
            <i class="fas fa-eye"></i>
        </button>
    </div>

    <div class="password-hint">
        <ul class="constraint-list" id="passwordConstraints">
            <li id="passwordLength"><i class="fas fa-times-circle"></i> 8–12 characters</li>
            <li id="passwordUpper"><i class="fas fa-times-circle"></i> At least one uppercase letter</li>
            <li id="passwordLower"><i class="fas fa-times-circle"></i> At least one lowercase letter</li>
            <li id="passwordNumber"><i class="fas fa-times-circle"></i> At least one number</li>
            <li id="passwordSpecial"><i class="fas fa-times-circle"></i> At least one special character (!@#$%^&*)</li>
        </ul>
    </div>

    <form method="post" action="{{ route('password.update') }}" 
      class="mt-6 space-y-6"
      onsubmit="return validatePasswordForm()"></form>

    @error('password', 'updatePassword')
        <div class="error-message">{{ $message }}</div>
    @enderror
</div>

        <div>
            <x-input-label for="update_password_password_confirmation" :value="__('Confirm Password')" />
            <x-texts-input id="update_password_password_confirmation" name="password_confirmation" type="password" class="mt-1 block w-full" autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button
                class="btn-save flex items-center gap-2">

                <i class="uil uil-save"></i>
                {{ __('Save') }}
            </x-primary-button>

            @if (session('status') === 'password-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
    <style>
                /* EDIT BUTTON */
        .btn-edit {
            background-color: #0C8EF4;
            color: #fff;
        }

        .btn-edit:hover {
            background-color: #0A7CD6;
        }

        /* SAVE BUTTON */
        .btn-save {
            background-color: #05C274;
            color: #fff;
        }

        .btn-save:hover {
            background-color: #04A764;
        }

        /* CANCEL BUTTON (optional styling) */
        .btn-cancel {
            background-color: #e5e7eb;
            color: #374151;
        }

        .btn-cancel:hover {
            background-color: #d1d5db;
        }
    </style>
    <script>
        function validatePasswordForm() {
    const val = document.getElementById('update_password_password').value;

    const lengthOk = val.length >= 8 && val.length <= 12;
    const upperOk = /[A-Z]/.test(val);
    const lowerOk = /[a-z]/.test(val);
    const numberOk = /[0-9]/.test(val);
    const specialOk = /[!@#$%^&*]/.test(val);

    if (!(lengthOk && upperOk && lowerOk && numberOk && specialOk)) {
        alert("Password does not meet the required constraints.");
        return false; // ❌ STOP submission
    }

    return true; // ✅ allow submit
}
    </script>
</section>