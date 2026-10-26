@vite('resources/css/calendar.css')
@vite('resources/css/calendar-modal.css')
<div id="leaveModal" class="calendar-modal hidden">
    <div class="calendar-modal-overlay"></div>

    <div class="calendar-modal-card">
        <div class="calendar-modal-header">
            <h2 id="leaveModalTitle" class="calendar-modal-title">Add Leave</h2>
            <button type="button" class="calendar-modal-close-btn" onclick="closeModal('leaveModal')">✕</button>
        </div>

        <form method="POST"
              action="{{ route('calendar.events.store') }}"
              data-store-url="{{ route('calendar.events.store') }}"
              class="calendar-modal-form calendar-ajax-form"
              data-type="leave">
            @csrf

            @include('calendar.partials.event-type-select', ['selectedType' => 'leave'])

            <input type="hidden" name="type" value="leave">
            <input type="hidden" name="visibility_type" value="global">

            <!-- Subject -->
            <div class="calendar-modal-row icon-field">
                <x-heroicon-o-document-text class="input-icon" />
                <input type="text"
                    name="title"
                    placeholder="Subject"
                    maxlength="100"
                    class="calendar-modal-input with-icon title-input"
                    oninput="handleTitleInput(this)">
            </div>
            <div class="title-limit-row">
                <span class="title-warning hidden text-red-500 text-xs font-medium">Maximum 100 characters reached</span>
                <span class="text-gray-400 text-xs ml-auto">
                    <span class="title-counter">0</span>/100 characters
                </span>
            </div>

            <!-- Focal Person -->
            <div class="calendar-modal-row icon-field">
                <x-heroicon-o-user class="input-icon" />
                <select name="focal_person_id"
                        class="calendar-modal-input with-icon"
                        required>
                    <option value="">Select Focal Person</option>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">
                            {{ $user->name }} ({{ optional($user->section)->name }})
                        </option>
                    @endforeach
                </select>
            </div>

            @include('calendar.partials.modal-date-fields')

            <!-- Notes -->
            <div class="calendar-modal-row icon-field">
                <x-heroicon-o-pencil-square class="input-icon textarea-icon" />
                <textarea name="notes"
                        placeholder="Notes"
                        maxlength="1000"
                        class="calendar-modal-textarea with-icon"
                        id="notesTextarea"></textarea>
            </div>
            <div class="text-right text-xs mt-1 flex justify-between items-center">
                <span class="text-gray-400">Maximum 1000 characters</span>
                <span class="text-gray-500">
                    <span id="notesCounter">0</span>/1000 characters
                </span>
            </div>

            <button type="submit" class="calendar-modal-submit-btn">Save Leave</button>
        </form>
    </div>
</div>