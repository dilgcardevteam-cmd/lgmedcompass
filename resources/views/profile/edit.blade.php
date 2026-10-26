<x-app-layout>
    <style>
        /* Gold/Yellow theme – consistent with Account Management */
        :root {
            --primary: #f59e0b;
            --primary-soft: #fffbeb;
            --gold-hover: #d97706;
            --bg: #fefce8;
            --card-bg: #ffffff;
            --text-main: #78350f;
            --text-muted: #7c5e3a;
            --border: #fcd34d;
            --radius: 12px;
            --danger: #ef4444;
            --danger-soft: #fee2e2;
        }

        .profile-card {
            background: var(--card-bg);
            border-radius: 20px;
            border: 1px solid var(--border);
            padding: 1.5rem;
            box-shadow: 0 10px 25px -5px rgba(0,0,0,0.04), 0 8px 10px -6px rgba(0,0,0,0.04);
        }

        @media (min-width: 768px) {
            .profile-card {
                padding: 2rem;
            }
        }

        .profile-title {
            font-size: 1.75rem;
            font-weight: 700;
            color: var(--text-main);
            margin-bottom: 2rem;
        }

        /* Two-column grid layout */
        .profile-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 1.5rem;
        }

        @media (min-width: 768px) {
            .profile-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        .profile-section {
            background: white;
            border-radius: 16px;
            border: 1px solid var(--border);
            padding: 1.25rem;
            transition: all 0.2s;
        }

        .profile-section.danger {
            border-left: 4px solid var(--danger);
        }

        .profile-section h2 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-main);
            margin-bottom: 0.25rem;
        }

        .profile-section .section-desc {
            font-size: 0.875rem;
            color: var(--text-muted);
            margin-bottom: 1rem;
        }

        /* Form elements */
        .profile-input {
            width: 100%;
            padding: 0.6rem 0.75rem;
            border: 1px solid var(--border);
            border-radius: 10px;
            font-size: 0.9rem;
            transition: all 0.2s;
        }
        .profile-input:focus {
            outline: none;
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(245,158,11,0.1);
        }

        .profile-label {
            display: block;
            font-size: 0.75rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: var(--text-muted);
            margin-bottom: 0.25rem;
        }

        .profile-value {
            font-size: 1rem;
            font-weight: 500;
            color: var(--text-main);
            background: var(--primary-soft);
            padding: 0.6rem 0.75rem;
            border-radius: 10px;
        }

        /* Buttons */
        .btn-edit {
            background: linear-gradient(135deg, #fcd34d, #e7c85c);
            color: #1f1f1f;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-edit:hover {
            background: linear-gradient(135deg, #ffd727, #ffe941);
            transform: translateY(-1px);
            box-shadow: 0 4px 12px rgba(245,158,11,0.3);
        }

        .btn-save {
            background: linear-gradient(135deg, #fcd34d, #e7c85c);
            color: #1f1f1f;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-save:hover {
            background: linear-gradient(135deg, #ffd727, #ffe941);
            transform: translateY(-1px);
        }

        .btn-cancel {
            background: #e5e7eb;
            color: #374151;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }
        .btn-cancel:hover {
            background: #d1d5db;
        }

        .btn-danger {
            background: #fee2e2;
            color: #ef4444;
            border: none;
            padding: 0.5rem 1rem;
            border-radius: 10px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }
        .btn-danger:hover {
            background: #ef4444;
            color: white;
            transform: translateY(-1px);
        }

        /* Toast styling */
        .custom-toast {
            position: fixed;
            top: 1rem;
            right: 1rem;
            z-index: 9999;
            width: 24rem;
            max-width: calc(100% - 2rem);
            padding: 1rem;
            border-radius: 12px;
            box-shadow: 0 10px 15px -3px rgba(0,0,0,0.1);
            display: flex;
            align-items: center;
            gap: 0.75rem;
            backdrop-filter: blur(8px);
            transition: opacity 0.3s;
        }
        .custom-toast.success {
            background: linear-gradient(135deg, #fffbeb, #fef3c7);
            border-left: 4px solid var(--primary);
            color: var(--text-main);
        }
        .custom-toast.error {
            background: linear-gradient(135deg, #fef2f2, #fee2e2);
            border-left: 4px solid var(--danger);
            color: #991b1b;
        }
        .toast-icon {
            font-size: 1.5rem;
            flex-shrink: 0;
        }
        .toast-content {
            flex: 1;
            font-size: 0.875rem;
            font-weight: 500;
        }
        .toast-close {
            background: none;
            border: none;
            font-size: 1.25rem;
            cursor: pointer;
            color: currentColor;
            opacity: 0.6;
        }
        .toast-close:hover {
            opacity: 1;
        }
        .hidden {
            display: none !important;
        }

        /* Delete modal */
        .section-modal {
            position: fixed;
            inset: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            z-index: 1000;
            visibility: hidden;
            opacity: 0;
            transition: all 0.2s;
        }
        .section-modal.show {
            visibility: visible;
            opacity: 1;
        }
        .section-modal-overlay {
            position: absolute;
            inset: 0;
            background: rgba(0,0,0,0.5);
            backdrop-filter: blur(4px);
        }
        .section-modal-card {
            position: relative;
            background: white;
            width: 90%;
            max-width: 460px;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 20px 35px -10px rgba(0,0,0,0.2);
            border: 1px solid var(--border);
        }
        .section-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1rem;
        }
        .section-modal-title {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-main);
        }
        .modal-buttons {
            display: flex;
            justify-content: flex-end;
            gap: 0.75rem;
            margin-top: 1.5rem;
        }

        [x-cloak] { display: none !important; }
    </style>

    <!-- Toast container -->
    <div id="successToast" class="custom-toast success hidden">
        <i class="bi bi-check-circle-fill toast-icon" style="color: #f59e0b;"></i>
        <div class="toast-content"></div>
        <button class="toast-close" onclick="closeSuccessToast()">×</button>
    </div>
    <div id="errorToast" class="custom-toast error hidden">
        <i class="bi bi-exclamation-triangle-fill toast-icon" style="color: #ef4444;"></i>
        <div class="toast-content"></div>
        <button class="toast-close" onclick="closeErrorToast()">×</button>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-8">
        <div class="profile-card">
            <h1 class="profile-title">Profile</h1>

            <div class="profile-grid">
                <!-- ========== PERSONAL INFO ========== -->
                <div class="profile-section" x-data="{ editing: false }">
                    <div class="flex items-start justify-between gap-4 mb-4">
                        <div>
                            <h2>Personal Info</h2>
                            <p class="section-desc">Manage your personal information.</p>
                        </div>
                        @if(auth()->id() === $user->id)
                        <button type="button" x-show="!editing" x-on:click="editing = true" class="btn-edit">
                            <i class="bi bi-pencil-square"></i> Edit
                        </button>
                        @endif
                    </div>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                        @csrf
                        @method('patch')

                        <!-- First Name -->
                        <div>
                            <label class="profile-label">First Name</label>
                            <template x-if="editing">
                                <input type="text" name="first_name" value="{{ old('first_name', $user->first_name) }}" class="profile-input" required>
                            </template>
                            <p x-show="!editing" class="profile-value">{{ $user->first_name ?: 'Not specified' }}</p>
                            @error('first_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Last Name -->
                        <div>
                            <label class="profile-label">Last Name</label>
                            <template x-if="editing">
                                <input type="text" name="last_name" value="{{ old('last_name', $user->last_name) }}" class="profile-input" required>
                            </template>
                            <p x-show="!editing" class="profile-value">{{ $user->last_name ?: 'Not specified' }}</p>
                            @error('last_name') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Username (editable) -->
                        <div>
                            <label class="profile-label">Username</label>
                            <template x-if="editing">
                                <input type="text" name="username" value="{{ old('username', $user->username) }}" class="profile-input" required>
                            </template>
                            <p x-show="!editing" class="profile-value">{{ $user->username }}</p>
                            @error('username') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Birthdate -->
                        <div>
                            <label class="profile-label">Birthdate</label>
                            <template x-if="editing">
                                <input type="date" name="birthdate" value="{{ old('birthdate', optional($user->birthdate)->format('Y-m-d')) }}" class="profile-input">
                            </template>
                            <p x-show="!editing" class="profile-value">{{ $user->birthdate ? \Carbon\Carbon::parse($user->birthdate)->format('F j, Y') : 'Not specified' }}</p>
                            @error('birthdate') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Section (read-only) -->
                        <div>
                            <label class="profile-label">Section</label>
                            <p class="profile-value">{{ optional($user->section)->name ?? 'Not specified' }}</p>
                        </div>

                        <!-- Position -->
                        <div>
                            <label class="profile-label">Position</label>
                            <template x-if="editing">
                                <input type="text" name="position" value="{{ old('position', $user->position) }}" class="profile-input">
                            </template>
                            <p x-show="!editing" class="profile-value">{{ $user->position ?: 'Not specified' }}</p>
                            @error('position') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>

                        <!-- Role (read-only) -->
                        <div>
                            <label class="profile-label">Role</label>
                            <p class="profile-value">{{ $user->role ?: 'Not specified' }}</p>
                        </div>

                        <div x-show="editing" x-cloak class="flex items-center gap-3 pt-2">
                            <button type="submit" class="btn-save"><i class="bi bi-check-lg"></i> Save</button>
                            <button type="button" x-on:click="editing = false; $el.closest('form').querySelectorAll('input, select, textarea').forEach(el => el.value = el.defaultValue);" class="btn-cancel"><i class="bi bi-x-lg"></i> Cancel</button>
                        </div>
                    </form>
                </div>

                <!-- ========== UPDATE PASSWORD ========== -->
                <div class="profile-section">
                    <h2>Update Password</h2>
                    <p class="section-desc">Ensure your account is using a long, random password to stay secure.</p>

                    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
                        @csrf
                        @method('put')

                        <div>
                            <label class="profile-label">Current Password</label>
                            <input type="password" name="current_password" class="profile-input" autocomplete="current-password">
                            @error('current_password', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="profile-label">New Password</label>
                            <input type="password" name="password" class="profile-input" autocomplete="new-password">
                            @error('password', 'updatePassword') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div>
                            <label class="profile-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" class="profile-input" autocomplete="new-password">
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit" class="btn-save"><i class="bi bi-check-lg"></i> Save</button>
                        </div>
                    </form>
                </div>

                <!-- ========== CHANGE EMAIL ========== -->
                <div class="profile-section">
                    <h2>Change Email</h2>
                    <p class="section-desc">Update your account's profile email address.</p>

                    <form id="send-verification" method="post" action="{{ route('verification.send') }}">@csrf</form>

                    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
                        @csrf
                        @method('patch')

                        <div>
                            <label class="profile-label">Email</label>
                            <input type="email" name="email" value="{{ old('email', $user->email) }}" class="profile-input" required autocomplete="username">
                            @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror

                            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                                <div class="mt-2 text-sm">
                                    <span class="text-gray-600">Your email address is unverified.</span>
                                    <button form="send-verification" class="underline text-primary hover:text-gold-hover">Click here to re-send verification email.</button>
                                </div>
                                @if (session('status') === 'verification-link-sent')
                                    <p class="mt-1 text-green-600 text-xs">A new verification link has been sent.</p>
                                @endif
                            @endif
                        </div>

                        <div class="flex items-center gap-3">
                            <button type="submit" class="btn-save"><i class="bi bi-check-lg"></i> Save</button>
                        </div>
                    </form>
                </div>

                <!-- ========== DELETE ACCOUNT ==========
                <div class="profile-section danger">
                    <h2>Delete Account</h2>
                    <p class="section-desc">Once your account is deleted, all of its resources and data will be softly deleted. Before deleting, please download any data you wish to retain.</p>

                </div> -->
            </div>
        </div>
    </div>

    <!-- DELETE ACCOUNT MODAL (gold theme)
    <div id="deleteAccountModal" class="section-modal">
        <div class="section-modal-overlay" onclick="closeDeleteModal()"></div>
        <div class="section-modal-card">
            <div class="section-modal-header">
                <h2 class="section-modal-title">Confirm Account Deletion</h2>
                <button class="section-modal-close-btn" onclick="closeDeleteModal()">✕</button>
            </div>
            <div class="section-modal-body">
                <p class="text-sm text-gray-600 mb-4">Are you sure you want to delete your account? All your data will be permanently removed.</p>
                <form method="post" action="{{ route('profile.destroy') }}" id="deleteAccountForm">
                    @csrf
                    @method('delete')
                    <div class="mb-4">
                        <label class="profile-label">Password</label>
                        <input type="password" name="password" class="profile-input" placeholder="Enter your password to confirm" required>
                        @error('password', 'userDeletion') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                    </div>
                    <div class="modal-buttons">
                        <button type="button" class="btn-cancel" onclick="closeDeleteModal()">Cancel</button>
                        <button type="submit" class="btn-danger">Delete Account</button>
                    </div>
                </form>
            </div>
        </div>
    </div> -->

    <script>
        // Toast helpers
        function showSuccessToast(message) {
            const toast = document.getElementById('successToast');
            if (!toast) return;
            toast.querySelector('.toast-content').innerText = message;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 4000);
        }
        function showErrorToast(message) {
            const toast = document.getElementById('errorToast');
            if (!toast) return;
            toast.querySelector('.toast-content').innerHTML = message;
            toast.classList.remove('hidden');
            setTimeout(() => toast.classList.add('hidden'), 4000);
        }
        function closeSuccessToast() {
            document.getElementById('successToast')?.classList.add('hidden');
        }
        function closeErrorToast() {
            document.getElementById('errorToast')?.classList.add('hidden');
        }

        // Delete modal
        function openDeleteModal() {
            document.getElementById('deleteAccountModal').classList.add('show');
        }
        function closeDeleteModal() {
            document.getElementById('deleteAccountModal').classList.remove('show');
        }

        // Auto-show flash messages
        @if (session('status') === 'profile-updated')
            showSuccessToast('Profile updated successfully.');
        @elseif (session('status') === 'password-updated')
            showSuccessToast('Password updated successfully.');
        @elseif (session('status') === 'verification-link-sent')
            showSuccessToast('Verification link sent to your email.');
        @endif
        @if ($errors->any())
            let errorHtml = '<ul class="list-disc list-inside">';
            @foreach ($errors->all() as $error)
                errorHtml += '<li>{{ $error }}</li>';
            @endforeach
            errorHtml += '</ul>';
            showErrorToast(errorHtml);
        @endif
        @if (session('error'))
            showErrorToast("{{ session('error') }}");
        @endif
    </script>
</x-app-layout>