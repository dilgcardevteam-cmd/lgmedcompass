<script>
function closeSuccessToast(){
    const toast = document.getElementById("successToast");
    if(toast) toast.remove();
}
function closeErrorToast(){
    const toast = document.getElementById("errorToast");
    if(toast) toast.remove();
}
setTimeout(() => {
    closeSuccessToast();
    closeErrorToast();
}, 4000);
</script>
<script>
        window.currentUserId = {{ auth()->id() }};
        window.currentUserRole = '{{ auth()->user()->role }}';
        window.adminCount = {{ \App\Models\User::where('role', 'Admin')->count() }};
        window.dashboardUrl = '{{ route('dashboard') }}'; // or your dashboard route name
        window.updateSectionUrl = function(userId) {
            return '{{ url("account-management") }}/' + userId + '/update-section';
        };
        window.updateNicknameUrl = function(userId) {
            return '{{ url("account-management") }}/' + userId + '/nickname';
        };
        window.updateRoleUrl = function(userId) {
            return '{{ url("account-management") }}/' + userId + '/role';
        };
        window.sectionsData = {!! json_encode($sections->map(fn($s) => ['id' => $s->id, 'name' => $s->name])->values()) !!};
        window.rolesData = {!! json_encode(['Pending', 'Employee', 'Technical Inspector', 'Admin']) !!};
    </script>
<x-app-layout>
    @vite(['resources/css/account-management.css'])
    <script src="{{ asset('js/account-management.js') }}"></script>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <!-- SECTION MODAL -->
    <div id="sectionModal" class="section-modal hidden">
        <div class="section-modal-overlay" onclick="closeSectionModal()"></div>
        <div class="section-modal-card">
            <div class="section-modal-header">
                <h2 id="sectionModalTitle" class="section-modal-title">Add Section</h2>
                <button type="button" class="section-modal-close-btn" onclick="closeSectionModal()">✕</button>
            </div>
            <div class="section-modal-body">
                <input type="hidden" id="sectionId">
                <div class="section-modal-row">
                    <label>Section Name</label>
                    <input type="text" id="sectionName" class="section-modal-input" placeholder="Enter section name">
                </div>
                <div class="section-modal-row">
                    <label>Section Color</label>
                    <div class="color-picker-wrapper">
                        <input type="color" id="sectionColor" value="#000000" class="section-color-input">
                        <input type="text" id="sectionColorHex" value="#000000" maxlength="7" placeholder="#000000" class="section-hex-input">
                    </div>
                </div>
                <div style="margin-top:20px; text-align:center;">
                    <button type="button" onclick="saveSection()" class="section-modal-submit-btn">Save Section</button>
                </div>
            </div>
        </div>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-8">
        <div class="account-card">
            <div class="mb-6 flex flex-wrap items-center justify-between gap-4">
                <h1 class="text-3xl font-bold text-black">Account Management</h1>
            </div>

            <!-- Filter Bar -->
            <form method="GET" action="{{ route('account-management.index') }}" class="account-filter-bar" id="filterForm">
                <div class="filter-field search-field">
                    <p class="filter-title">Search Name</p>
                    <div class="search-wrapper">
                        <span class="filter-icon" aria-hidden="true">
                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11 4C7.13401 4 4 7.13401 4 11C4 14.866 7.13401 18 11 18C12.925 18 14.6687 17.2233 15.9367 15.9667L19.485 19.515C19.778 19.808 20.253 19.808 20.546 19.515C20.839 19.222 20.839 18.747 20.546 18.454L16.9978 14.9057C18.2538 13.6378 19.03 11.8947 19.03 9.97C19.03 6.10401 15.896 2.97 12.03 2.97H11V4ZM11 5.5C14.0376 5.5 16.5 7.96243 16.5 11C16.5 14.0376 14.0376 16.5 11 16.5C7.96243 16.5 5.5 14.0376 5.5 11C5.5 7.96243 7.96243 5.5 11 5.5Z" fill="currentColor"/>
                            </svg>
                        </span>
                        <input type="text" name="name" value="{{ $nameFilter }}" placeholder="Search by name" class="account-management-search">
                        @if($nameFilter)
                            <button type="button" onclick="clearSearch()" class="clear-btn">✕</button>
                        @endif
                    </div>
                </div>

                <div class="filter-field dropdown-field">
                    <div style="display:flex; align-items:center; justify-content:space-between;">
                        <p class="filter-title">Sections</p>
                        @if(auth()->user()->role === 'Admin')
                            <button type="button" onclick="openSectionModal()" class="account-management-delete-btn" style="padding:4px 10px; font-size:12px; border: 1px solid #f59e0b; border-radius:9999px;">+ Add</button>
                        @endif
                    </div>
                    <div class="dropdown" data-dropdown>
                        <button type="button" class="dropdown-toggle" onclick="toggleDropdown('sectionDropdown')">
                            <span class="dropdown-label">
                                @if(!empty($selectedSectionNames))
                                    @php $first = $selectedSectionNames[0]; $count = count($selectedSectionNames); @endphp
                                    {{ $first }}
                                    @if($count > 1) <span class="text-gray-500">(+{{ $count - 1 }} more)</span> @endif
                                @else All Sections @endif
                            </span>
                        </button>
                        <div class="dropdown-menu" id="sectionDropdown">
                            @foreach ($sections as $section)
                                <label class="dropdown-item" style="display:flex; justify-content:space-between; align-items:center;">
                                    <div style="display: flex; align-items: center; gap: 8px; flex:1; min-width:0;">
                                        <input type="checkbox" name="section[]" value="{{ $section->id }}" onchange="document.getElementById('filterForm').submit()" @if(in_array($section->id, $sectionFilter)) checked @endif>
                                        <span class="section-name-truncate" style="color: {{ $section->color }};" title="{{ $section->name }}">
                                            {{ $section->name }}
                                        </span>
                                    </div>
                                    @if(auth()->user()->role === 'Admin')
                                        <div class="flex items-center gap-2">
                                            <button type="button" onclick="editSection({{ $section->id }}, {{ json_encode($section->name) }}, {{ json_encode($section->color) }})" class="text-yellow-500 hover:text-yellow-600" title="Edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M16.862 3.487a2.25 2.25 0 113.182 3.182L7.5 19.213l-4.5 1.125 1.125-4.5L16.862 3.487z" /></svg>
                                            </button>
                                            @if(!$section->is_protected)
                                                <button type="button" onclick="deleteSection({{ $section->id }}, '{{ addslashes($section->name) }}')" class="text-gray-500 hover:text-red-600" title="Delete">
                                                    <svg xmlns="http://www.w3.org/2000/svg" fill="black" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5"><path stroke-linecap="round" stroke-linejoin="round" d="M14.74 9l-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166M4.772 5.79c.34-.059.68-.114 1.022-.166m0 0L6.75 4.5A2.25 2.25 0 019 3h6a2.25 2.25 0 012.25 1.5l.956 1.124m-12.412 0h12.412" /></svg>
                                                </button>
                                            @endif
                                        </div>
                                    @endif
                                </label>
                            @endforeach
                            @if(!empty($sectionFilter))
                                <div class="dropdown-clear"><a href="{{ route('account-management.index', request()->except('section')) }}">✕ Clear Filter</a></div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="filter-field dropdown-field">
                    <p class="filter-title">Roles</p>
                    <div class="dropdown" data-dropdown>
                        <button type="button" class="dropdown-toggle" onclick="toggleDropdown('roleDropdown')">
                            <span class="dropdown-label">{{ !empty($roleFilter) ? implode(', ', $roleFilter) : 'All Roles' }}</span>
                        </button>
                        <div class="dropdown-menu" id="roleDropdown">
                            @foreach ($roles as $role)
                                <label class="dropdown-item">
                                    <input type="checkbox" name="role[]" value="{{ $role }}" onchange="document.getElementById('filterForm').submit()" @if(is_array($roleFilter) && in_array($role, $roleFilter)) checked @endif>
                                    {{ $role }}
                                </label>
                            @endforeach
                            @if(!empty($roleFilter))
                                <div class="dropdown-clear"><a href="{{ route('account-management.index', request()->except('role')) }}">✕ Clear Filter</a></div>
                            @endif
                        </div>
                    </div>
                </div>

                @if(auth()->user()->role === 'Admin')
                    <div class="account-archive-action">
                        <a href="{{ route('account-management.archive') }}" class="inline-flex items-center gap-2 rounded-xl border border-amber-200 bg-amber-50 px-4 py-2 font-semibold text-amber-800 no-underline transition hover:bg-amber-100">
                            <i class="bi bi-archive"></i>
                            User Archive
                        </a>
                    </div>
                @endif
            </form>

            <!-- Toast messages -->
            @if ($errors->any())
                <div id="errorToast" class="fixed top-6 right-6 z-[9999] w-96 max-w-full p-4 rounded-lg border-l-4 border-red-600 bg-white shadow-xl flex items-start gap-3">
                    <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/></svg>
                    <div class="text-red-800 text-sm"><ul class="list-disc list-inside">@foreach ($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul></div>
                    <button onclick="closeErrorToast()" class="ml-auto text-red-600 font-bold">×</button>
                </div>
            @endif
            @if (session('status'))
                <div id="successToast" class="fixed top-6 right-6 z-[9999] w-96 max-w-full p-4 rounded-lg border-l-4 border-green-600 bg-white shadow-xl flex items-center gap-3">
                    <svg class="w-6 h-6 text-green-600 flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>
                    <span class="text-green-800 text-sm font-medium">{{ session('status') }}</span>
                    <button onclick="closeSuccessToast()" class="ml-auto text-green-600 font-bold">×</button>
                </div>
            @endif
            
            <!-- Pending Users -->
            @if(auth()->user()->role === 'Admin' && $pendingUsers->count())
                <div class="bg-white rounded-xl shadow p-6 mb-8">
                    <h2 class="text-xl font-bold mb-4">Pending Account Requests</h2>
                    @foreach($pendingUsers as $user)
                        <div class="flex flex-col md:flex-row md:items-center md:justify-between border-b py-4 gap-4">
                            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-3 flex-1">
                                <div><p class="text-xs text-gray-500 uppercase tracking-wide">Full Name</p><p class="font-semibold text-gray-800">{{ $user->first_name }} {{ $user->last_name }}</p></div>
                                <div><p class="text-xs text-gray-500 uppercase tracking-wide">Email</p><p class="text-sm text-gray-700 break-all">{{ $user->email }}</p></div>
                                <div><p class="text-xs text-gray-500 uppercase tracking-wide">Position</p><p class="text-sm text-gray-700">{{ $user->position ?: 'No position set' }}</p></div>
                                <div><p class="text-xs text-gray-500 uppercase tracking-wide">Section</p><p class="text-sm text-gray-700">{{ $user->section ? $user->section->name : 'No section' }}</p></div>
                            </div>
                            <div class="flex gap-3 self-start md:self-center">
                                <form method="POST" action="{{ route('users.approve', $user) }}">@csrf @method('PATCH')<button class="px-4 py-1 rounded bg-green-500 text-white hover:bg-green-600 transition text-sm">Approve</button></form>
                                <form method="POST" action="{{ route('users.decline', $user) }}" class="decline-user-form" data-user-name="{{ $user->first_name }} {{ $user->last_name }}">
                                    @csrf @method('PATCH')
                                    <button type="button" class="decline-btn px-4 py-1 rounded bg-red-500 text-white hover:bg-red-600 transition text-sm">Decline</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Users Table -->
            <div class="account-table">
                <div class="account-table-header">
                    <span>User</span>
                    <span>Credentials</span>
                    <span>Section</span>
                    <span>Role</span>
                    <span>Actions</span>
                </div>

                @forelse ($users as $managedUser)
                    <div class="account-row" data-user-id="{{ $managedUser->id }}" data-section-id="{{ $managedUser->section_id ?? '' }}" data-role="{{ $managedUser->role }}" data-nickname="{{ $managedUser->nickname ?? '' }}">
                        <div class="account-cell user-cell" data-label="User">
                            <p class="account-name">{{ $managedUser->first_name }} {{ $managedUser->last_name }}</p>
                            <p class="account-position nickname-display">Nickname: {{ $managedUser->nickname ?: '—' }}</p>
                            <p class="account-position">{{ $managedUser->position ?: 'No position set' }}</p>
                        </div>
                        <div class="account-cell" data-label="Credentials">
                            <p class="account-email">{{ $managedUser->email }}</p>
                            <p class="account-username">{{ $managedUser->username }}</p>
                        </div>
                        <div class="account-cell section-cell" data-label="Section">
                            <span class="section-display">{{ $managedUser->section ? $managedUser->section->name : 'No Section' }}</span>
                        </div>
                        <div class="account-cell role-cell" data-label="Role">
                            <span class="role-display">{{ $managedUser->role }}</span>
                        </div>
                        <div class="account-cell actions-cell" data-label="Actions">
                            @if(auth()->user()->role === 'Admin')
                                <div class="action-buttons-wrapper">
                                    <button type="button" class="edit-row-btn" title="Edit Section/Role"><i class="bi bi-pencil-square"></i> Edit</button>
                                    @if(auth()->id() !== $managedUser->id)
                                        <form method="POST" action="{{ route('account-management.destroy', $managedUser) }}" class="delete-user-form" data-user-name="{{ $managedUser->first_name }} {{ $managedUser->last_name }}">
                                            @csrf @method('DELETE')
                                            <button type="button" class="delete-row-btn" title="Archive User"><i class="bi bi-archive"></i> Archive</button>
                                        </form>
                                    @endif
                                </div>
                            @else
                                <span class="text-gray-400 text-sm">—</span>
                            @endif
                        </div>
                    </div>
                @empty
                    <div class="account-row text-center py-4"><p class="text-gray-500">No users match your filters.</p></div>
                @endforelse
            </div>

            <div class="mt-6">{{ $users->links() }}</div>
        </div>
    </div>

    

<!-- Reusable Confirmation Modal -->
<div class="modal" id="confirmModal">
    <div class="modal-content">
        <div class="modal-header">
            <span id="confirmModalTitle">Confirm Archive</span>
            <i class="bi bi-x-lg" onclick="closeConfirmModal()"></i>
        </div>
        <div class="modal-body">
            <p id="confirmModalMessage">Are you sure you want to archive this item?</p>
            <p id="confirmModalWarning" style="color: #92400e; font-size: 0.85rem;">The account will be deactivated and can be activated again from the user archive.</p>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn-gold" onclick="closeConfirmModal()">Cancel</button>
            <button type="button" class="btn-primary" id="confirmModalBtn">Archive</button>
        </div>
    </div>
</div>

<style>
    /* Ensure modal styles are present (if not already in your CSS) */
    .modal {
        display: none;
        position: fixed;
        z-index: 9999;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0,0,0,0.5);
        align-items: center;
        justify-content: center;
    }
    .modal.show {
        display: flex;
    }
    .modal-content {
        background: white;
        border-radius: 16px;
        width: 90%;
        max-width: 450px;
        box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1);
    }
    .modal-header {
        padding: 16px 20px;
        border-bottom: 1px solid #e5e7eb;
        font-weight: 700;
        display: flex;
        justify-content: space-between;
        align-items: center;
    }
    .modal-header i {
        cursor: pointer;
        font-size: 1.2rem;
    }
    .modal-body {
        padding: 20px;
    }
    .modal-footer {
        padding: 16px 20px;
        border-top: 1px solid #e5e7eb;
        display: flex;
        justify-content: flex-end;
        gap: 12px;
    }
    .btn-gold {
        background: #f3f4f6;
        border: 1px solid #d1d5db;
        color: #374151;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
    }
    .btn-primary {
        background: #ef4444;
        border: none;
        color: white;
        padding: 8px 16px;
        border-radius: 8px;
        font-weight: 500;
        cursor: pointer;
    }
    .btn-primary:hover {
        background: #dc2626;
    }
</style>
</x-app-layout>