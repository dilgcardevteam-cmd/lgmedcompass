<x-app-layout>
    @vite(['resources/css/account-management.css'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <div class="mx-auto max-w-7xl px-4 py-8">
        <div class="account-card">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold text-black">User Archive</h1>
                    <p class="mt-1 text-sm text-gray-500">Archived accounts are deactivated until they are activated again.</p>
                </div>
                <a href="{{ route('account-management.index') }}" class="inline-flex items-center gap-2 rounded-xl border border-gray-300 bg-white px-4 py-2 font-semibold text-gray-700 no-underline transition hover:bg-gray-50">
                    <i class="bi bi-arrow-left"></i>
                    Back to Account Management
                </a>
            </div>

            @if ($errors->any())
                <div id="account-archive-error" class="mb-4 rounded-lg border-l-4 border-red-600 bg-white p-4 text-sm text-red-800 shadow">
                    <ul class="list-inside list-disc">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('status'))
                <div class="mb-4 rounded-lg border-l-4 border-green-600 bg-white p-4 text-sm text-green-800 shadow">
                    {{ session('status') }}
                </div>
            @endif

            <div class="account-table user-archive-table">
                <div class="account-table-header">
                    <span>User</span>
                    <span>Credentials</span>
                    <span>Section</span>
                    <span>Archived</span>
                    <span>Actions</span>
                </div>

                @forelse ($users as $archivedUser)
                    <div class="account-row">
                        <div class="account-cell">
                            <p class="account-name">{{ $archivedUser->first_name }} {{ $archivedUser->last_name }}</p>
                            <p class="account-position">{{ $archivedUser->position ?: 'No position set' }}</p>
                        </div>
                        <div class="account-cell">
                            <p class="account-email">{{ $archivedUser->email }}</p>
                            <p class="account-username">{{ $archivedUser->username }}</p>
                        </div>
                        <div class="account-cell">
                            <span>{{ $archivedUser->section?->name ?? 'No Section' }}</span>
                        </div>
                        <div class="account-cell">
                            <span>{{ $archivedUser->deleted_at->format('M d, Y') }}</span>
                        </div>
                        <div class="account-cell actions-cell" data-label="Actions">
                            <div class="action-buttons-wrapper">
                                <form method="POST" action="{{ route('account-management.restore', $archivedUser->id) }}" class="account-action-form">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="account-action-button delete-row-btn activate-row-btn" title="Activate User" data-action="activate" data-user-name="{{ $archivedUser->name }}">
                                        <i class="bi bi-person-check"></i>
                                        Activate
                                    </button>
                                </form>
                                <form method="POST" action="{{ route('account-management.force-delete', $archivedUser->id) }}" class="account-action-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="account-action-button permanently-delete-account-button delete-row-btn" title="Permanently Delete User" data-action="delete" data-user-name="{{ $archivedUser->name }}">
                                        <i class="bi bi-trash3"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="account-row">
                        <p class="col-span-full py-4 text-center text-gray-500">There are no archived user accounts.</p>
                    </div>
                @endforelse
            </div>

            <div class="mt-6">{{ $users->links() }}</div>
        </div>
    </div>

    <dialog id="account-action-dialog" aria-labelledby="account-action-title" aria-describedby="account-action-description" class="fixed left-1/2 top-1/2 m-0 w-[calc(100%-2rem)] max-w-lg -translate-x-1/2 -translate-y-1/2 rounded-2xl border-0 p-0 shadow-2xl backdrop:bg-black/50">
        <div class="p-6 sm:p-7">
            <div class="flex items-start gap-4">
                <div id="account-action-icon" class="flex h-11 w-11 shrink-0 items-center justify-center rounded-full bg-red-100 text-red-700">
                    <i id="account-action-icon-symbol" class="bi bi-exclamation-triangle-fill text-xl" aria-hidden="true"></i>
                </div>
                <div>
                    <h2 id="account-action-title" class="text-lg font-bold text-gray-900"></h2>
                    <p id="account-action-description" class="mt-2 text-sm leading-6 text-gray-600">
                    </p>
                </div>
            </div>
            <div class="mt-7 flex flex-wrap justify-end gap-3">
                <button type="button" id="cancel-account-action" class="rounded-lg border border-gray-300 bg-white px-4 py-2 text-sm font-semibold text-gray-700 transition hover:bg-gray-50">
                    Cancel
                </button>
                <button type="button" id="confirm-account-action" class="inline-flex items-center gap-2 rounded-lg px-4 py-2 text-sm font-semibold text-white transition">
                    <i id="confirm-account-action-icon" aria-hidden="true"></i>
                    <span id="confirm-account-action-label"></span>
                </button>
            </div>
        </div>
    </dialog>

    @if ($errors->any())
        <script>
            setTimeout(() => {
                document.getElementById('account-archive-error')?.remove();
            }, 4000);
        </script>
    @endif
    <script>
        const accountActionDialog = document.getElementById('account-action-dialog');
        const accountActionTitle = document.getElementById('account-action-title');
        const accountActionDescription = document.getElementById('account-action-description');
        const accountActionIcon = document.getElementById('account-action-icon');
        const accountActionIconSymbol = document.getElementById('account-action-icon-symbol');
        const confirmAccountActionButton = document.getElementById('confirm-account-action');
        const confirmAccountActionIcon = document.getElementById('confirm-account-action-icon');
        const confirmAccountActionLabel = document.getElementById('confirm-account-action-label');
        let accountActionForm = null;

        document.querySelectorAll('.account-action-button').forEach((button) => {
            button.addEventListener('click', () => {
                accountActionForm = button.closest('form');
                const userName = button.dataset.userName || 'this account';
                const isActivation = button.dataset.action === 'activate';

                accountActionTitle.textContent = isActivation ? 'Activate account?' : 'Permanently delete account?';
                accountActionDescription.textContent = isActivation
                    ? `This will activate ${userName}'s account and allow them to sign in.`
                    : `This will permanently delete ${userName}. This action cannot be undone.`;
                confirmAccountActionLabel.textContent = isActivation ? 'Activate account' : 'Permanently delete';
                confirmAccountActionIcon.className = isActivation ? 'bi bi-person-check' : 'bi bi-trash3';

                accountActionIcon.classList.toggle('bg-green-100', isActivation);
                accountActionIcon.classList.toggle('text-green-700', isActivation);
                accountActionIcon.classList.toggle('bg-red-100', !isActivation);
                accountActionIcon.classList.toggle('text-red-700', !isActivation);
                accountActionIconSymbol.className = isActivation
                    ? 'bi bi-person-check-fill text-xl'
                    : 'bi bi-exclamation-triangle-fill text-xl';

                confirmAccountActionButton.classList.toggle('bg-green-600', isActivation);
                confirmAccountActionButton.classList.toggle('hover:bg-green-700', isActivation);
                confirmAccountActionButton.classList.toggle('bg-red-600', !isActivation);
                confirmAccountActionButton.classList.toggle('hover:bg-red-700', !isActivation);

                accountActionDialog.showModal();
            });
        });

        document.getElementById('cancel-account-action').addEventListener('click', () => {
            accountActionDialog.close();
        });

        confirmAccountActionButton.addEventListener('click', () => {
            if (accountActionForm) {
                accountActionForm.requestSubmit();
            }

            accountActionDialog.close();
        });

        accountActionDialog.addEventListener('close', () => {
            accountActionForm = null;
        });
    </script>
</x-app-layout>
