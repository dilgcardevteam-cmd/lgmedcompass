<x-guest-layout>
    <section class="min-h-screen bg-yellow-50 px-4 py-10 sm:px-6 sm:py-16">
        <div class="mx-auto max-w-3xl overflow-hidden rounded-3xl border border-amber-200 bg-white shadow-xl shadow-amber-900/5">
            <div class="h-2 bg-[#1E3A8A]" aria-hidden="true"></div>
            <div class="p-6 sm:p-10">
                <p class="text-xs font-bold uppercase tracking-[0.2em] text-amber-700">LGMED Compass · Request Tracking</p>
                <h1 class="mt-3 text-3xl font-extrabold tracking-tight text-[#1E3A8A]">Your Request</h1>
                <div class="mt-6 flex flex-wrap items-center gap-3">
                    <x-request-status-badge :status="$serviceRequest->status" class="text-sm" />
                    <span class="text-sm text-slate-500">{{ $serviceRequest->service_type }}</span>
                </div>

                <dl class="mt-6 grid gap-4 border-y border-slate-100 py-6 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <dt class="text-xs font-bold uppercase tracking-wide text-slate-500">Subject</dt>
                        <dd class="mt-1 font-semibold text-slate-900">{{ $serviceRequest->subject }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wide text-slate-500">Received</dt>
                        <dd class="mt-1 text-sm text-slate-800">{{ $serviceRequest->requested_at->format('M j, Y g:i A') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-bold uppercase tracking-wide text-slate-500">Date needed</dt>
                        <dd class="mt-1 text-sm text-slate-800">{{ $serviceRequest->date_needed->format('M j, Y') }}</dd>
                    </div>
                </dl>

                @if(session('success'))
                    <div data-auto-dismiss="5000" class="mt-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm font-semibold text-green-900 opacity-100 transition-opacity duration-500" role="status">
                        {{ session('success') }}
                    </div>
                @endif

                @if($serviceRequest->last_comment)
                    <div class="mt-6 rounded-xl border border-blue-100 bg-blue-50 p-4 text-sm text-blue-900">
                        <p class="font-bold">Latest message</p>
                        <p class="mt-1 whitespace-pre-line">{{ $serviceRequest->last_comment }}</p>
                    </div>
                @endif

                @if($serviceRequest->status === \App\Models\ServiceRequest::STATUS_COMPLETED && ($serviceRequest->deliverable_link || $serviceRequest->deliverables->isNotEmpty()))
                    <section class="mt-6 rounded-xl border border-green-200 bg-green-50 p-4 text-sm text-green-950">
                        <h2 class="font-bold">Completed files and links</h2>
                        @if($serviceRequest->deliverable_link)
                            <a href="{{ $serviceRequest->deliverable_link }}" target="_blank" rel="noopener noreferrer" class="mt-3 inline-flex items-center gap-2 font-semibold text-blue-800 underline">
                                <i class="bi bi-link-45deg" aria-hidden="true"></i> Open deliverable link
                            </a>
                        @endif
                        @foreach($serviceRequest->deliverables as $deliverable)
                            <a href="{{ route('request.track-deliverable', [$token, $deliverable]) }}" class="mt-3 flex items-center gap-2 font-semibold text-blue-800 underline">
                                <i class="bi bi-download" aria-hidden="true"></i> {{ $deliverable->file_name }}
                            </a>
                        @endforeach
                    </section>
                @endif

                @if($serviceRequest->status === \App\Models\ServiceRequest::STATUS_MORE_INFORMATION_NEEDED)
                    <form method="POST" action="{{ route('request.respond', $token) }}" class="mt-8 space-y-4">
                        @csrf
                        <div>
                            <label for="response" class="block text-sm font-bold text-slate-800">Your response <span class="text-red-600">*</span></label>
                            <p class="mt-1 text-sm text-slate-500">Reply here and the staff member handling your request will be notified.</p>
                            <textarea id="response" name="response" rows="5" required maxlength="10000" class="mt-3 w-full rounded-xl border border-slate-300 px-4 py-3 text-sm text-slate-900 outline-none focus:border-[#1E3A8A] focus:ring-2 focus:ring-blue-100">{{ old('response') }}</textarea>
                            @error('response')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        </div>
                        <button type="submit" class="inline-flex min-h-11 items-center justify-center gap-2 rounded-xl bg-[#1E3A8A] px-6 py-3 text-sm font-bold text-white transition hover:bg-blue-900">
                            <i class="bi bi-send" aria-hidden="true"></i> Send response
                        </button>
                    </form>
                @else
                    <p class="mt-6 text-sm leading-6 text-slate-600">
                        @if(in_array($serviceRequest->status, \App\Models\ServiceRequest::CLOSED_STATUSES, true))
                            This request is closed. If you need further assistance, please submit a new request.
                        @else
                            We will email you if the staff handling your request needs more information.
                        @endif
                    </p>
                @endif
            </div>
        </div>
    </section>

    @include('request.partials.auto-dismiss')
</x-guest-layout>
