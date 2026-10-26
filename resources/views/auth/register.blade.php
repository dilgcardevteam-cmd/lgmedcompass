<x-guest-layout>

@vite('resources/css/register.css')
@vite('resources/css/app.css')
<style>
/* Keep all your original styles, just add these small extras for validation feedback */
.password-hint, .username-hint {
    display: block;
    font-size: 0.75rem;
    color: #6c757d;
    margin-top: 0.25rem;
}
/* Make constraint list items inherit the hint style */
.constraint-list {
    list-style: none;
    padding-left: 0;
    margin-top: 0.25rem;
    font-size: 0.75rem;
}
.constraint-list li {
    margin-bottom: 0.15rem;
    color: #e74c3c; /* red for missing */
    transition: all 0.2s;
}
.constraint-list li.valid {
    display: none; /* disappear when satisfied */
}
.constraint-list li i {
    width: 14px;
    margin-right: 4px;
}
.valid-field input, .valid-field select {
    border-color: #28a745 !important;
}
</style>

<main class="login-wrapper">
    <div class="login-card">

        <!-- LEFT IMAGE -->
        <div class="login-image">
         <div class="logo-overlay">
        <img class="main-logo" src="https://image2url.com/r2/default/images/1773720216878-cd59f20e-a62d-4972-987a-05f2324f76f9.png" 
             alt="LGMED Compass Logo">
        </div>
    </div>

        <!-- RIGHT FORM -->
        <div class="login-form">
            <h1>Sign up</h1>

            <form method="POST" action="{{ route('register') }}" id="registerForm">
                @csrf

                <!-- First Name -->
                <div class="form-group @error('first_name') input-error @enderror" id="firstNameGroup">
                    <label for="first_name">First Name</label>
                    <input id="first_name" type="text" name="first_name" value="{{ old('first_name') }}" placeholder="Enter First Name" required>

                    <div class="username-hint">
                        <ul class="constraint-list" id="firstNameConstraints">
                            <li id="firstNameLength"><i class="fas fa-times-circle"></i> At least 2 characters</li>
                            <li id="firstNameChars"><i class="fas fa-times-circle"></i> Letters only</li>
                        </ul>
                    </div>

                    @error('first_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Last Name -->
                <div class="form-group @error('last_name') input-error @enderror" id="lastNameGroup">
                    <label for="last_name">Last Name</label>
                    <input id="last_name" type="text" name="last_name" value="{{ old('last_name') }}" placeholder="Enter Last Name" required>

                    <div class="username-hint">
                        <ul class="constraint-list" id="lastNameConstraints">
                            <li id="lastNameLength"><i class="fas fa-times-circle"></i> At least 2 characters</li>
                            <li id="lastNameChars"><i class="fas fa-times-circle"></i> Letters only</li>
                        </ul>
                    </div>

                    @error('last_name')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Username -->
                <div class="form-group @error('username') input-error @enderror" id="usernameGroup">
                    <label for="username">Username</label>
                    <input id="username" type="text" name="username" value="{{ old('username') }}" placeholder="Enter Username" required autofocus>
                    <div class="username-hint">
                        <ul class="constraint-list" id="usernameConstraints">
                            <li id="usernameLength"><i class="fas fa-times-circle"></i> At least 8 characters</li>
                            <li id="usernameChars"><i class="fas fa-times-circle"></i> Only letters, numbers, underscores, dashes</li>
                        </ul>
                    </div>
                    @error('username')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Email -->
                <div class="form-group @error('email') input-error @enderror" id="emailGroup">
                    <label for="email">Email</label>
                    <input id="email" type="email" name="email" value="{{ old('email') }}" placeholder="Enter email" required>
                    <div class="password-hint">
                        <ul class="constraint-list" id="emailConstraints">
                            <li id="emailValid"><i class="fas fa-times-circle"></i> Valid email address required</li>
                        </ul>
                    </div>
                    @error('email')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Section -->
                <div class="form-group @error('section') input-error @enderror" id="sectionGroup">
                    <label for="section_id" class="block text-sm font-bold mb-1">Section</label>
                    <select name="section_id" class="w-full border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-emerald-500 focus:outline-none text-sm" required>
                        <option value="" selected disabled hidden>Select a section</option>
                        @foreach($sections as $section)
                            <option value="{{ $section->id }}" {{ old('section_id') == $section->id ? 'selected' : '' }}>
                                {{ $section->name }}
                            </option>
                        @endforeach
                    </select>
                    <div class="password-hint">
                        <ul class="constraint-list" id="sectionConstraints">
                            <li id="sectionRequired"><i class="fas fa-times-circle"></i> Please select a section</li>
                        </ul>
                    </div>
                    @error('section')
                        <div class="text-red-500 text-xs mt-1">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Position -->
                <div class="form-group @error('position') input-error @enderror" id="positionGroup">
                    <label for="position">Position</label>
                    <input id="position" type="text" name="position" value="{{ old('position') }}" placeholder="Enter Position" required>

                    <div class="username-hint">
                        <ul class="constraint-list" id="positionConstraints">
                            <li id="positionLength"><i class="fas fa-times-circle"></i> At least 2 characters</li>
                            <li id="positionChars"><i class="fas fa-times-circle"></i> Letters, numbers, Roman numerals, and special characters allowed</li>                        </ul>
                    </div>

                    @error('position')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- Password -->
                <div class="form-group @error('password') input-error @enderror" id="passwordGroup">
                    <label for="password">Password</label>
                    <div class="password-wrapper">
                        <input id="password" type="password" name="password" placeholder="Enter password">
                        <button type="button" class="toggle-password" onclick="togglePassword('password')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-hint">
                        <ul class="constraint-list" id="passwordConstraints">
                            <li id="passwordLength"><i class="fas fa-times-circle"></i> At least 8 characters</li>
                            <li id="passwordUpper"><i class="fas fa-times-circle"></i> At least one uppercase letter</li>
                            <li id="passwordLower"><i class="fas fa-times-circle"></i> At least one lowercase letter</li>
                            <li id="passwordNumber"><i class="fas fa-times-circle"></i> At least one number</li>
                            <li id="passwordSpecial"><i class="fas fa-times-circle"></i> At least one special character (!@#$%^&*)</li>
                        </ul>
                    </div>
                    @error('password')
                        <div class="error-message">{{ $message }}</div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="form-group" id="confirmGroup">
                    <label for="password_confirmation">Confirm Password</label>
                    <div class="password-wrapper">
                        <input id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm password">
                        <button type="button" class="toggle-password" onclick="togglePassword('password_confirmation')">
                            <i class="fas fa-eye"></i>
                        </button>
                    </div>
                    <div class="password-hint">
                        <ul class="constraint-list" id="confirmConstraints">
                            <li id="passwordMatch"><i class="fas fa-times-circle"></i> Passwords must match</li>
                        </ul>
                    </div>
                </div>

                <button type="submit" class="btn-login" id="submitBtn">
                    Register
                </button>

                <p class="register-text">
                    Already registered?
                    <a href="{{ route('login') }}">Sign in</a>
                </p>
            </form>
        </div>

    </div>
</main>

<script>
// Toggle password visibility (keep your original function)
function togglePassword(fieldId) {
    const field = document.getElementById(fieldId);
    const icon = field.parentElement.querySelector('.toggle-password i');
    if (field.type === 'password') {
        field.type = 'text';
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
    } else {
        field.type = 'password';
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
    }
}

// Real-time validation logic
const usernameInput = document.getElementById('username');
const emailInput = document.getElementById('email');
const sectionSelect = document.querySelector('select[name="section_id"]');
const passwordInput = document.getElementById('password');
const confirmInput = document.getElementById('password_confirmation');

const firstNameInput = document.getElementById('first_name');
const lastNameInput = document.getElementById('last_name');

const firstNameLength = document.getElementById('firstNameLength');
const firstNameChars = document.getElementById('firstNameChars');

const lastNameLength = document.getElementById('lastNameLength');
const lastNameChars = document.getElementById('lastNameChars');

const positionInput = document.getElementById('position');

const positionLength = document.getElementById('positionLength');
const positionChars = document.getElementById('positionChars');

const usernameLength = document.getElementById('usernameLength');
const usernameChars = document.getElementById('usernameChars');
const emailValid = document.getElementById('emailValid');
const sectionRequired = document.getElementById('sectionRequired');
const passwordLength = document.getElementById('passwordLength');
const passwordUpper = document.getElementById('passwordUpper');
const passwordLower = document.getElementById('passwordLower');
const passwordNumber = document.getElementById('passwordNumber');
const passwordSpecial = document.getElementById('passwordSpecial');
const passwordMatch = document.getElementById('passwordMatch');

function setValid(element, isValid) {
    if (isValid) {
        element.classList.add('valid');
    } else {
        element.classList.remove('valid');
    }
}
function validateFirstName() {
    const val = firstNameInput.value.trim().replace(/\s+/g, ' ');

    const lenOk = val.length >= 2;
    const charsOk = /^[A-Za-z]+(?:\s+[A-Za-z]+)*$/.test(val);

    setValid(firstNameLength, lenOk);
    setValid(firstNameChars, charsOk);

    return lenOk && charsOk;
}

function validateLastName() {
    const val = lastNameInput.value.trim();
    const lenOk = val.length >= 2;
    const charsOk = /^[A-Za-z]+$/.test(val);

    setValid(lastNameLength, lenOk);
    setValid(lastNameChars, charsOk);

    return lenOk && charsOk;
}

function validateUsername() {
    const val = usernameInput.value;
    const lenOk = val.length >= 8;
    const charsOk = /^[a-zA-Z0-9_-]+$/.test(val);
    setValid(usernameLength, lenOk);
    setValid(usernameChars, charsOk);
    return lenOk && charsOk;
}

function validateEmail() {
    const email = emailInput.value;
    const regex = /^[^\s@]+@([^\s@.,]+\.)+[^\s@.,]{2,}$/;
    const ok = regex.test(email);
    setValid(emailValid, ok);
    return ok;
}

function validateSection() {
    const ok = sectionSelect.value !== '';
    setValid(sectionRequired, ok);
    return ok;
}

function validatePosition() {
    const val = positionInput.value.trim();

    const charsOk = /^[A-Za-z0-9\s().#-]+$/.test(val);
    const lenOk = val.length >= 2;

    setValid(positionLength, lenOk);
    setValid(positionChars, charsOk);

    return lenOk && charsOk;
}

function validatePassword() {
    const pwd = passwordInput.value;
    const lenOk = pwd.length >= 8;
    const upperOk = /[A-Z]/.test(pwd);
    const lowerOk = /[a-z]/.test(pwd);
    const numOk = /[0-9]/.test(pwd);
    const specialOk = /[!@#$%^&*(),.?":{}|<>]/.test(pwd);
    setValid(passwordLength, lenOk);
    setValid(passwordUpper, upperOk);
    setValid(passwordLower, lowerOk);
    setValid(passwordNumber, numOk);
    setValid(passwordSpecial, specialOk);
    return lenOk && upperOk && lowerOk && numOk && specialOk;
}

function validateConfirm() {
    const ok = passwordInput.value !== '' && passwordInput.value === confirmInput.value;
    setValid(passwordMatch, ok);
    return ok;
}

function markFieldGroup(groupId, isValid) {
    const group = document.getElementById(groupId);
    if (group) {
        if (isValid) {
            group.classList.add('valid-field');
        } else {
            group.classList.remove('valid-field');
        }
    }
}

function runAllValidations() {
    const firstNameOk = validateFirstName();
    const lastNameOk = validateLastName();
    const usernameOk = validateUsername();
    const emailOk = validateEmail();
    const sectionOk = validateSection();
    const passwordOk = validatePassword();
    const positionOk = validatePosition();
    const confirmOk = validateConfirm();

    markFieldGroup('firstNameGroup', firstNameOk);
    markFieldGroup('lastNameGroup', lastNameOk);
    markFieldGroup('usernameGroup', usernameOk);
    markFieldGroup('emailGroup', emailOk);
    markFieldGroup('sectionGroup', sectionOk);
    markFieldGroup('passwordGroup', passwordOk);
    markFieldGroup('confirmGroup', confirmOk);
    markFieldGroup('positionGroup', positionOk);

    return firstNameOk && lastNameOk && usernameOk && emailOk && sectionOk && positionOk && passwordOk && confirmOk;
}

// Attach event listeners
firstNameInput.addEventListener('input', runAllValidations);
lastNameInput.addEventListener('input', runAllValidations);
usernameInput.addEventListener('input', runAllValidations);
emailInput.addEventListener('input', runAllValidations);
sectionSelect.addEventListener('change', runAllValidations);
positionInput.addEventListener('input', runAllValidations);
passwordInput.addEventListener('input', () => {
    runAllValidations();
    if (confirmInput.value !== '') validateConfirm();
});
confirmInput.addEventListener('input', runAllValidations);

// Prevent submit if not fully valid
const form = document.getElementById('registerForm');
form.addEventListener('submit', function(e) {
    if (!runAllValidations()) {
        e.preventDefault();
        alert('Please complete all requirements correctly before registering.');
        // Scroll to first invalid field
        const firstInvalid = document.querySelector('.form-group:not(.valid-field)');
        if (firstInvalid) firstInvalid.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
});

// Run initial validation
runAllValidations();
</script>
</x-guest-layout>