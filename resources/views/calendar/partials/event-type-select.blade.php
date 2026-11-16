<div class="calendar-modal-row icon-field" data-create-type-select-wrapper>
    <i class="bi bi-list-check input-icon" aria-hidden="true"></i>
    <select class="calendar-modal-input with-icon"
            data-create-event-type
            aria-label="Calendar entry type">
        <option value="event" @selected($selectedType === 'event')>Activity</option>
        <option value="official_business" @selected($selectedType === 'official_business')>Official Business</option>
        <option value="leave" @selected($selectedType === 'leave')>Leave</option>
        <option value="holiday" @selected($selectedType === 'holiday')>Holiday</option>
    </select>
</div>
