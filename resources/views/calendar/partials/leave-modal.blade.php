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

            <div class="calendar-modal-row icon-field">
                <x-heroicon-o-document-text class="input-icon" />
                <select name="leave_type"
                        class="calendar-modal-input with-icon"
                        data-leave-type
                        required>
                    <option value="">Select Type of Leave</option>
                    @foreach(\App\Models\Event::LEAVE_TYPES as $leaveType)
                        <option value="{{ $leaveType }}">{{ $leaveType }}</option>
                    @endforeach
                </select>
            </div>

            <div class="hidden" data-leave-type-other-wrapper>
                <div class="calendar-modal-row icon-field">
                    <x-heroicon-o-pencil-square class="input-icon" />
                    <input type="text"
                           name="leave_type_other"
                           placeholder="Specify type of leave"
                           maxlength="255"
                           class="calendar-modal-input with-icon"
                           data-leave-type-other>
                </div>
            </div>

            <div data-single-focal-person>
                <div class="calendar-modal-row icon-field">
                    <x-heroicon-o-user class="input-icon" />
                    <select name="focal_person_id"
                            class="calendar-modal-input with-icon"
                            required>
                        <option value="">Select Personnel</option>
                        @foreach($users as $user)
                            <option value="{{ $user->id }}">
                                {{ $user->name }} ({{ optional($user->section)->name }})
                            </option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="hidden" data-multiple-focal-person>
                <div class="calendar-focal-person-heading">
                    <x-heroicon-o-user-group class="input-icon" />
                    <div>
                        <p class="calendar-focal-person-title">Personnel</p>
                        <p class="calendar-focal-person-hint">Select one or more people for this leave.</p>
                    </div>
                </div>
                <div class="calendar-focal-person-search-group">
                    <div class="calendar-modal-row icon-field calendar-focal-person-search">
                        <x-heroicon-o-magnifying-glass class="input-icon" />
                        <input type="search"
                               class="calendar-modal-input with-icon"
                               placeholder="Search name, position, or section"
                               aria-label="Search personnel"
                               data-focal-person-search>
                    </div>
                    <p class="calendar-focal-person-search-results"
                       data-focal-person-search-results
                       aria-live="polite"></p>
                </div>
                <fieldset class="calendar-focal-person-options" data-focal-person-options>
                    <legend class="sr-only">Personnel</legend>
                    @foreach($users as $user)
                        <label class="calendar-focal-person-option"
                               data-search-text="{{ $user->name }} {{ $user->position }} {{ optional($user->section)->name }}">
                            <input type="checkbox"
                                   name="focal_person_ids[]"
                                   value="{{ $user->id }}"
                                   class="calendar-focal-person-checkbox">
                            <span class="calendar-focal-person-name">{{ $user->name }}</span>
                        </label>
                    @endforeach
                </fieldset>
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