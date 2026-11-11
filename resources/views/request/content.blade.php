<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

@guest
    <section class="min-h-[calc(100vh-5rem)] bg-yellow-50 px-4 py-12 sm:px-6 sm:py-16">
        <div class="mx-auto flex min-h-[calc(100vh-11rem)] max-w-7xl items-center justify-center">
            <div class="w-full max-w-4xl overflow-hidden rounded-[2rem] border border-amber-200 bg-white shadow-xl shadow-amber-900/5">
                <div class="h-2 bg-[#1E3A8A]" aria-hidden="true"></div>
                <div class="px-6 py-10 text-center sm:px-12 sm:py-14">
                    <div class="mx-auto flex h-16 w-16 items-center justify-center rounded-2xl bg-amber-100 text-3xl text-[#1E3A8A]">
                        <i class="bi bi-file-earmark-text" aria-hidden="true"></i>
                    </div>
                    <p class="mt-7 text-xs font-bold uppercase tracking-[0.2em] text-amber-700">LGMED Compass</p>
                    <h1 class="mt-3 text-4xl font-extrabold tracking-tight text-[#1E3A8A] sm:text-5xl">Request</h1>
                    <p class="mx-auto mt-5 max-w-2xl text-base leading-7 text-slate-600 sm:text-lg sm:leading-8">
                        Submit a request to LGMED. You can use this form without signing in.
                    </p>
                    <button
                        type="button"
                        onclick="document.getElementById('requestForm').showModal()"
                        class="mt-8 inline-flex min-h-12 w-full items-center justify-center gap-2 rounded-xl bg-[#1E3A8A] px-7 py-3 text-sm font-bold text-white shadow-md transition hover:bg-blue-900 focus:outline-none focus:ring-4 focus:ring-blue-200 sm:w-auto"
                    >
                        <span>Open Request Form</span>
                        <i class="bi bi-arrow-right text-[#f6c76f]" aria-hidden="true"></i>
                    </button>
                    <p class="mt-3 text-sm text-slate-500">No account is required.</p>
                </div>
            </div>
        </div>
    </section>
@else
    @include('request.authenticated')
@endguest

@if(session('success') && !auth()->check())
    <div data-auto-dismiss="5000" class="fixed bottom-5 left-1/2 z-20 w-[calc(100%-2rem)] max-w-lg -translate-x-1/2 rounded-2xl border border-green-200 bg-green-50 p-5 text-green-900 opacity-100 shadow-xl transition-opacity duration-500" role="status">
        <p class="font-bold">{{ session('success') }}</p>
        @if(session('request_reference'))
            <p class="mt-1 text-sm">Reference number: <strong>{{ session('request_reference') }}</strong></p>
        @endif
    </div>
@endif

<style>
    #requestForm label.request-analysis-option {
        display: flex;
        margin-bottom: 0;
    }

    #requestForm input.request-analysis-checkbox {
        width: 1.25rem;
        min-width: 1.25rem;
        height: 1.25rem;
        margin: 0.125rem 0 0;
        padding: 0;
        flex: none;
    }

    #requestForm {
        display: none;
    }

    #requestForm[open] {
        display: flex;
    }
</style>

<dialog
    id="requestForm"
    class="m-auto h-[min(92dvh,56rem)] max-h-[92dvh] w-[calc(100%-1rem)] max-w-3xl flex-col overflow-hidden rounded-3xl border border-gray-200 bg-white p-0 shadow-2xl backdrop:bg-gray-900/60"
    aria-labelledby="requestFormTitle"
>
    <div class="flex flex-none items-start justify-between gap-6 border-b border-gray-100 px-5 py-5 sm:px-8">
        <div>
            <p class="text-xs font-bold uppercase tracking-widest text-[#1E3A8A]">LGMED Compass</p>
            <h2 id="requestFormTitle" class="mt-2 text-2xl font-extrabold text-gray-900">Request Form</h2>
            <p class="mt-1 text-sm text-gray-500">Fields marked <span class="text-red-600">*</span> are required.</p>
        </div>
        <button
            type="button"
            onclick="document.getElementById('requestForm').close()"
            class="flex h-9 w-9 flex-shrink-0 items-center justify-center rounded-full text-gray-500 transition hover:bg-gray-100 hover:text-gray-900"
            aria-label="Close form"
        >
            <i class="bi bi-x-lg" aria-hidden="true"></i>
        </button>
    </div>

    <form method="POST" action="{{ route('request.store') }}" enctype="multipart/form-data" class="flex min-h-0 flex-1 flex-col">
        @csrf
        <div class="min-h-0 flex-1 overflow-y-auto overscroll-contain">
            <div class="space-y-8 px-5 py-6 sm:px-8">
            @if($errors->any())
                <div class="rounded-xl border border-red-200 bg-red-50 p-4 text-sm text-red-800" role="alert">
                    <p class="font-bold">Please review the highlighted fields.</p>
                </div>
            @endif

            <section>
                <div class="mb-4 border-b border-gray-100 pb-3">
                    <h3 class="font-bold text-gray-900">Requester Information</h3>
                    <p class="mt-1 text-sm text-gray-500">Your contact information will be used if we need to follow up.</p>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div>
                        <label for="requester_name" class="mb-1.5 block text-sm font-semibold text-gray-700">Requester Name <span class="text-red-600">*</span></label>
                        <input id="requester_name" name="requester_name" type="text" required maxlength="255" value="{{ old('requester_name', auth()->user()?->name) }}" @auth readonly @endauth class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#1E3A8A] focus:ring-2 focus:ring-blue-100 @auth bg-gray-50 @endauth">
                        @error('requester_name')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="office_address" class="mb-1.5 block text-sm font-semibold text-gray-700">Office / Address <span class="text-red-600">*</span></label>
                        <input id="office_address" name="office_address" type="text" required maxlength="255" value="{{ old('office_address', auth()->user()?->section?->name) }}" class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#1E3A8A] focus:ring-2 focus:ring-blue-100">
                        @error('office_address')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="contact_number" class="mb-1.5 block text-sm font-semibold text-gray-700">Contact Number <span class="text-red-600">*</span></label>
                        <input id="contact_number" name="contact_number" type="tel" required maxlength="40" autocomplete="tel" value="{{ old('contact_number') }}" class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#1E3A8A] focus:ring-2 focus:ring-blue-100">
                        @error('contact_number')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="requester_email" class="mb-1.5 block text-sm font-semibold text-gray-700">Email Address <span class="text-red-600">*</span></label>
                        <input id="requester_email" name="email" type="email" required maxlength="255" autocomplete="email" value="{{ old('email', auth()->user()?->email) }}" @auth readonly @endauth class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#1E3A8A] focus:ring-2 focus:ring-blue-100 @auth bg-gray-50 @endauth">
                        @error('email')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>

            <section>
                <div class="mb-4 border-b border-gray-100 pb-3">
                    <h3 class="font-bold text-gray-900">Request Details</h3>
                    <p class="mt-1 text-sm text-gray-500">Tell us what you need and when you need it.</p>
                </div>
                <div class="grid grid-cols-1 gap-4 sm:grid-cols-2">
                    <div class="sm:col-span-2">
                        <label for="service_type" class="mb-1.5 block text-sm font-semibold text-gray-700">Type of Service <span class="text-red-600">*</span></label>
                        <select id="service_type" name="service_type" required class="w-full rounded-xl border border-gray-300 bg-white px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#1E3A8A] focus:ring-2 focus:ring-blue-100">
                            <option value="" disabled @selected(old('service_type') === null)>Select a request type</option>
                            <option value="Data Analysis" @selected(old('service_type') === 'Data Analysis')>Data Analysis</option>
                            <option value="Others" @selected(old('service_type') === 'Others')>Others, Specify</option>
                        </select>
                        @error('service_type')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <fieldset id="analysisTypesGroup" class="hidden sm:col-span-2">
                        <legend class="mb-1.5 block text-sm font-semibold text-gray-700">Analysis Type(s) <span class="text-red-600">*</span></legend>
                        <p class="mb-3 text-xs text-gray-500">Select one or more analyses. Data Analysis requests are sent to the Database and Statistical Unit.</p>
                        <div class="grid grid-cols-1 gap-2 sm:grid-cols-2">
                            @foreach(\App\Models\ServiceRequest::ANALYSIS_TYPES as $analysisType)
                                <label class="request-analysis-option cursor-pointer items-start gap-3 rounded-xl border border-gray-200 px-4 py-3 text-sm text-gray-700 transition hover:border-blue-300 hover:bg-blue-50">
                                    <input type="checkbox" name="analysis_types[]" value="{{ $analysisType }}" @checked(in_array($analysisType, old('analysis_types', []), true)) class="request-analysis-checkbox rounded border-gray-300 text-[#1E3A8A] focus:ring-blue-200">
                                    <span>{{ $analysisType }}</span>
                                </label>
                            @endforeach
                        </div>
                        @error('analysis_types')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                        @error('analysis_types.*')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </fieldset>
                    <div id="otherServiceTypeGroup" class="hidden sm:col-span-2">
                        <label for="other_service_type" class="mb-1.5 block text-sm font-semibold text-gray-700">Please Specify <span class="text-red-600">*</span></label>
                        <input id="other_service_type" name="other_service_type" type="text" maxlength="255" value="{{ old('other_service_type') }}" class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#1E3A8A] focus:ring-2 focus:ring-blue-100">
                        @error('other_service_type')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="subject" class="mb-1.5 block text-sm font-semibold text-gray-700">Subject <span class="text-red-600">*</span></label>
                        <input id="subject" name="subject" type="text" required maxlength="255" value="{{ old('subject') }}" class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#1E3A8A] focus:ring-2 focus:ring-blue-100">
                        @error('subject')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="sm:col-span-2">
                        <label for="description" class="mb-1.5 block text-sm font-semibold text-gray-700">Request Description <span class="text-red-600">*</span></label>
                        <textarea id="description" name="description" rows="5" required maxlength="10000" class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#1E3A8A] focus:ring-2 focus:ring-blue-100">{{ old('description') }}</textarea>
                        @error('description')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div>
                        <label for="requested_at_display" class="mb-1.5 block text-sm font-semibold text-gray-700">Date &amp; Time Requested</label>
                        <input id="requested_at_display" type="text" readonly value="{{ now()->format('M j, Y g:i A') }}" class="w-full rounded-xl border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-600">
                        <p class="mt-1 text-xs text-gray-500">Recorded automatically when submitted.</p>
                    </div>
                    <div>
                        <label for="date_needed" class="mb-1.5 block text-sm font-semibold text-gray-700">Date Needed <span class="text-red-600">*</span></label>
                        <input id="date_needed" name="date_needed" type="date" required min="{{ now()->toDateString() }}" value="{{ old('date_needed') }}" class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition focus:border-[#1E3A8A] focus:ring-2 focus:ring-blue-100">
                        @error('date_needed')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>

            <section>
                <div class="mb-4 border-b border-gray-100 pb-3">
                    <h3 class="font-bold text-gray-900">Supporting Documents</h3>
                    <p class="mt-1 text-sm text-gray-500">Add a reference link or attach one supporting document.</p>
                </div>
                <div class="space-y-4">
                    <div>
                        <label for="document_link" class="mb-1.5 block text-sm font-semibold text-gray-700">Document Link</label>
                        <input id="document_link" name="document_link" type="url" maxlength="2048" placeholder="https://" value="{{ old('document_link') }}" class="w-full rounded-xl border border-gray-300 px-4 py-3 text-sm text-gray-900 outline-none transition placeholder:text-gray-400 focus:border-[#1E3A8A] focus:ring-2 focus:ring-blue-100">
                        @error('document_link')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                    <div class="relative">
                        <label for="attachment" class="mb-1.5 block text-sm font-semibold text-gray-700">Attach File</label>
                        <div class="relative">
                            <input id="attachment" name="attachment" type="file" accept=".pdf,.doc,.docx,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document" aria-describedby="requestAttachmentName" class="peer absolute inset-0 z-10 h-full w-full cursor-pointer opacity-0">
                            <label for="attachment" id="requestDropZone" class="flex cursor-pointer flex-col items-center justify-center rounded-2xl border-2 border-dashed border-gray-300 bg-gray-50 px-5 py-8 text-center transition hover:border-[#1E3A8A] hover:bg-blue-50 peer-focus-visible:ring-4 peer-focus-visible:ring-blue-200">
                            <i class="bi bi-cloud-arrow-up text-3xl text-[#1E3A8A]" aria-hidden="true"></i>
                            <span class="mt-2 text-sm font-semibold text-gray-700">Drag and drop your file here, or <span class="text-[#1E3A8A] underline">browse</span></span>
                                <span id="requestAttachmentName" class="mt-1 text-xs text-gray-500">PDF, DOC, or DOCX · up to 5 MB</span>
                            </label>
                        </div>
                        @error('attachment')<p class="mt-1 text-sm text-red-600">{{ $message }}</p>@enderror
                    </div>
                </div>
            </section>
            </div>
        </div>

        <div class="flex flex-none flex-col-reverse gap-3 border-t border-gray-100 bg-white px-5 py-4 sm:flex-row sm:justify-end sm:px-8">
            <button type="button" onclick="document.getElementById('requestForm').close()" class="rounded-xl border border-gray-300 bg-white px-6 py-3 text-sm font-bold text-gray-700 transition hover:bg-gray-50">
                Cancel
            </button>
            <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-xl bg-[#1E3A8A] px-7 py-3 text-sm font-bold text-white shadow-md transition hover:bg-blue-900 focus:outline-none focus:ring-4 focus:ring-blue-200">
                <i class="bi bi-send" aria-hidden="true"></i>
                Submit Request
            </button>
        </div>
    </form>
</dialog>

@include('request.partials.auto-dismiss')

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const dialog = document.getElementById('requestForm');
        const input = document.getElementById('attachment');
        const dropZone = document.getElementById('requestDropZone');
        const dropArea = dropZone?.parentElement;
        const fileName = document.getElementById('requestAttachmentName');
        const serviceType = document.getElementById('service_type');
        const analysisTypesGroup = document.getElementById('analysisTypesGroup');
        const otherServiceTypeGroup = document.getElementById('otherServiceTypeGroup');
        const otherServiceType = document.getElementById('other_service_type');

        if (!dialog || !input || !dropZone || !dropArea || !fileName || !serviceType || !analysisTypesGroup || !otherServiceTypeGroup || !otherServiceType) {
            return;
        }

        const updateServiceFields = () => {
            const isDataAnalysis = serviceType.value === 'Data Analysis';
            const isOther = serviceType.value === 'Others';

            analysisTypesGroup.classList.toggle('hidden', !isDataAnalysis);
            otherServiceTypeGroup.classList.toggle('hidden', !isOther);
            otherServiceType.required = isOther;
        };

        const showSelectedFile = (file) => {
            fileName.textContent = file ? file.name : 'PDF, DOC, or DOCX · up to 5 MB';
        };

        serviceType.addEventListener('change', updateServiceFields);
        updateServiceFields();
        input.addEventListener('change', () => showSelectedFile(input.files[0]));
        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropZone.classList.add('border-blue-700', 'bg-blue-50');
        });
        dropArea.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-blue-700', 'bg-blue-50');
        });
        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropZone.classList.remove('border-blue-700', 'bg-blue-50');

            if (event.dataTransfer.files.length > 0) {
                input.files = event.dataTransfer.files;
                showSelectedFile(input.files[0]);
            }
        });

        @if($errors->any())
            dialog.showModal();
        @endif
    });
</script>
