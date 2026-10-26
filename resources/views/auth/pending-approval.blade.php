<x-guest-layout>

<div class="min-h-screen flex items-center justify-center bg-gray-50">

    <div class="max-w-md w-full bg-white shadow-xl rounded-2xl p-8 text-center">

        <!-- Status Icon -->
        <div class="flex justify-center mb-5">
            <div class="w-16 h-16 flex items-center justify-center rounded-full bg-yellow-100">
                <svg class="w-8 h-8 text-yellow-500" fill="none" stroke="currentColor" stroke-width="2"
                     viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
        </div>

        <!-- Title -->
        <h2 class="text-2xl font-semibold text-gray-800 mb-2">
            Account Pending Approval
        </h2>

        <!-- Description -->
        <p class="text-gray-600 mb-6">
            Your account has been successfully registered and your email has been verified.
            Please wait for the administrator to approve your account.
        </p>

        <!-- Info box -->
        <div class="bg-gray-50 border rounded-lg p-4 text-sm text-gray-500">
            📧 You will receive an email notification once your account has been approved.
        </div>

        <!-- Divider -->
        <div class="mt-6 text-xs text-gray-400">
            If you believe this is taking too long, please contact the system administrator.
        </div>

        <!-- Logout Button (styled) -->
        <div class="mt-6">
            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="inline">
                @csrf
                <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500 active:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-offset-2 transition ease-in-out duration-150">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                    </svg>
                    Logout
                </button>
            </form>
        </div>
    </div>

</div>

<script>
    // Check every 5 seconds if user is approved
    setInterval(function() {
        fetch('{{ route("check.approval.status") }}')
            .then(response => response.json())
            .then(data => {
                if (data.approved) {
                    window.location.href = '{{ route("dashboard") }}';
                }
            });
    }, 5000);
</script>
</x-guest-layout>