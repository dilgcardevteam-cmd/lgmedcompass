@vite('resources/css/calendar.css')
@vite('resources/css/calendar-modal.css')
<div id="eventModal" class="calendar-modal hidden">
    <div class="calendar-modal-overlay"></div>

    <div class="calendar-modal-card">
        <div class="calendar-modal-header">
            <h2 id="eventModalTitle" class="calendar-modal-title">Create Activity</h2>
            <button type="button"
                    class="calendar-modal-close-btn"
                    onclick="closeModal('eventModal')">✕</button>
        </div>

        <form method="POST"
              action="{{ route('calendar.events.store') }}"
              data-store-url="{{ route('calendar.events.store') }}"
              class="calendar-modal-form calendar-ajax-form"
              data-type="event">
            @csrf

            <input type="hidden" name="type" value="event">
            @include('calendar.partials.event-type-select', ['selectedType' => 'event'])

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

            <!-- ✅ VISIBILITY TYPE -->
            <div class="calendar-modal-row icon-field">
                <x-heroicon-o-eye class="input-icon" />

                <select name="visibility_type"
                        class="calendar-modal-input with-icon">

                    <option value="private">Private (Only Me)</option>
                    <option value="section">Section</option>
                    <option value="global">Global (For Everyone)</option>

                </select>
            </div>

            <!-- SECTION DROPDOWN -->
            <div class="calendar-modal-row icon-field section-field hidden">

                <x-heroicon-o-user-group class="input-icon" />

                <select name="section_id"
                        class="calendar-modal-input with-icon">

                    <option value="" selected disabled hidden>
                        Select Section
                    </option>

                    @foreach($sections as $section)

                        <option value="{{ $section->id }}"
                            {{ auth()->user()->section_id == $section->id ? 'selected' : '' }}>

                            {{ $section->name }}

                        </option>

                    @endforeach

                </select>

            </div>

            @include('calendar.partials.modal-date-fields')

            <div class="calendar-modal-row icon-field">
                <x-heroicon-o-link class="input-icon" />
                <input type="url"
                       name="link"
                       placeholder="Link"
                       class="calendar-modal-input with-icon">
            </div>

            <div class="calendar-modal-row icon-field">
                <x-heroicon-o-map-pin class="input-icon" />
                <input type="text"
                       name="location"
                       placeholder="Location"
                       class="calendar-modal-input with-icon">
            </div>

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

            <button type="submit" class="calendar-modal-submit-btn">
                Save Activity
            </button>
        </form>
    </div>
</div>