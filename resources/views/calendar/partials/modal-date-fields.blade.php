<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
@vite('resources/css/calendar.css')
@vite('resources/css/calendar-modal.css')
<div class="calendar-modal-row icon-field">
    <x-heroicon-o-calendar class="input-icon" />

    <div class="date-range-wrapper all-day-mode with-icon">
        <input type="text" name="start_date"
               class="calendar-date calendar-modal-input"
               placeholder="Start Date">

        <input type="text" name="end_date"
               class="calendar-date calendar-modal-input"
               placeholder="End Date">
    </div>

    <div class="date-time-wrapper time-mode hidden with-icon">
        <input type="date" name="single_date"
               class="calendar-date calendar-modal-input"
               placeholder="Date">

        <input type="time" name="start_time"
               class="calendar-time calendar-modal-input"
               placeholder="Start Time">

        <input type="time" name="end_time"
               class="calendar-time calendar-modal-input"
               placeholder="End Time">
    </div>
</div>

<div class="calendar-modal-row">
    <label class="calendar-checkbox flex items-center gap-2">
        <input type="checkbox" name="all_day" value="1" checked>
        <span>All Day</span>
    </label>
</div>

<style>
.flatpickr-day.flatpickr-disabled,
.flatpickr-day.prevMonthDay.flatpickr-disabled {
    background: #e0e0e0 !important;
    color: #9e9e9e !important;
    cursor: not-allowed !important;
    opacity: 0.6;
}

.flatpickr-day.flatpickr-disabled:hover {
    background: #e0e0e0 !important;
}
.calendar-checkbox input[type="checkbox"]{
    width: 14px;
    height: 14px;
    transform: scale(0.9); /* optional extra shrink */
    cursor: pointer;
    border: 1px solid #5d5d5dff;
}
</style>

<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    function initFlatpickr() {

        /* ===========================
           DESTROY OLD INSTANCES (IMPORTANT FOR MODAL)
        ============================ */
        document.querySelectorAll(".flatpickr-input").forEach(input => {
            if (input._flatpickr) {
                input._flatpickr.destroy();
            }
        });

        /* ===========================
           DATE PICKERS - Initialize per modal
        ============================ */

        document.querySelectorAll(".calendar-modal").forEach(modal => {
            const startDateInput = modal.querySelector('input[name="start_date"]');
            const endDateInput = modal.querySelector('input[name="end_date"]');
            const singleDateInput = modal.querySelector('input[name="single_date"]');
            const startTimeInput = modal.querySelector('input[name="start_time"]');
            const endTimeInput = modal.querySelector('input[name="end_time"]');

            let endDatePicker = null;
            let endTimePicker = null;

            // Initialize end_date picker first (so we can reference it in start_date onChange)
            if (endDateInput) {
                endDatePicker = flatpickr(endDateInput, {
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    disableMobile: true,
                    allowInput: false
                });
            }

            // Initialize start_date picker
            if (startDateInput) {
                flatpickr(startDateInput, {
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    disableMobile: true,
                    allowInput: false,
                    onChange: function(selectedDates) {
                        if (selectedDates.length > 0 && endDatePicker) {
                            // Set minDate on end picker to prevent selecting earlier dates
                            endDatePicker.set("minDate", selectedDates[0]);
                            
                            // If current end date is before new start date, update it
                            if (endDatePicker.selectedDates.length > 0 && 
                                endDatePicker.selectedDates[0] < selectedDates[0]) {
                                endDatePicker.setDate(selectedDates[0]);
                            }
                        }
                    }
                });
            }

            // Initialize single_date picker
            if (singleDateInput) {
                flatpickr(singleDateInput, {
                    dateFormat: "Y-m-d",
                    minDate: "today",
                    disableMobile: true,
                    allowInput: false
                });
            }

            /* ===========================
               TIME PICKERS
            ============================ */

            // Initialize end_time picker first (with default 17:00)
            if (endTimeInput) {
                endTimePicker = flatpickr(endTimeInput, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    altInput: true,
                    altFormat: "h:i K",
                    time_24hr: false,
                    defaultDate: "17:00",
                    allowInput: false
                });
                // Ensure input value is set
                if (!endTimeInput.value) endTimeInput.value = "17:00";
            }

            // Initialize start_time picker (with default 08:00)
            if (startTimeInput) {
                flatpickr(startTimeInput, {
                    enableTime: true,
                    noCalendar: true,
                    dateFormat: "H:i",
                    altInput: true,
                    altFormat: "h:i K",
                    time_24hr: false,
                    defaultDate: "08:00",
                    allowInput: false,
                    onChange: function(selectedDates) {
                        if (selectedDates.length > 0 && endTimePicker) {
                            endTimePicker.set("minTime", selectedDates[0]);
                            if (endTimePicker.selectedDates.length > 0 &&
                                endTimePicker.selectedDates[0] < selectedDates[0]) {
                                endTimePicker.setDate(selectedDates[0]);
                            }
                        }
                    }
                });
                if (!startTimeInput.value) startTimeInput.value = "08:00";
            }
        });
    }

    /* ===========================
       INITIAL LOAD
    ============================ */
    initFlatpickr();

    /* ===========================
       RE-INIT WHEN MODAL OPENS
       (VERY IMPORTANT)
    ============================ */

    document.addEventListener("click", function(e) {
        if (e.target.closest("[data-open-modal]")) {
            setTimeout(initFlatpickr, 150);
        }
    });

});
</script>