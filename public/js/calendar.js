    (function() {
    // Prevent double initialization
    if (window.calendarInitialized) return;
    window.calendarInitialized = true;

    console.log("Calendar JS Loaded");

    /* =========================================================
       GLOBAL FUNCTIONS (must be available before any modal uses them)
    ========================================================= */
    
    // Open any modal by ID
    window.openModal = function (modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;

        modal.classList.remove("hidden");
        modal.classList.add("flex");
        document.body.style.overflow = "hidden";

        // Attach notes counter to the correct textarea inside THIS modal
        initNotesCounter(modal);
    };

    // Attach live character counter to the notes textarea in a specific modal
    function initNotesCounter(modal) {
        // Use querySelector on the modal element to get the correct textarea/counter
        const textarea = modal.querySelector("#notesTextarea");
        const counter = modal.querySelector("#notesCounter");

        if (!textarea || !counter) return;

        // Prevent binding the listener multiple times on the same textarea
        if (textarea.dataset.counterBound === "true") return;
        textarea.dataset.counterBound = "true";

        const update = () => {
            counter.textContent = textarea.value.length;
        };

        textarea.addEventListener("input", update);
        update(); // set initial count
    }

    // Close any modal by ID
    window.closeModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;
        modal.classList.add("hidden");
        modal.classList.remove("flex");
        modal.classList.remove('dashboard-mode'); 
        document.body.style.overflow = "auto";
        // Clear pending date when modal closes
        window.pendingClickDate = null;
    };

    // Show validation errors inside a form
    window.showErrors = function(errors, form) {
        clearErrors(form);
        for (const [field, messages] of Object.entries(errors)) {
            const input = form.querySelector(`[name="${field}"]`);
            if (!input) continue;
            input.classList.add("input-error");
            const errorMsg = document.createElement("p");
            errorMsg.className = "error-text text-red-500 text-xs mt-1";
            errorMsg.innerText = messages[0];
            // Insert after the input's container (depends on structure)
            const row = input.closest(".calendar-modal-row");
            if (row) row.appendChild(errorMsg);
            else input.parentNode.appendChild(errorMsg);
        }
    };

    window.clearErrors = function(form) {
        form.querySelectorAll(".input-error").forEach(el => el.classList.remove("input-error"));
        form.querySelectorAll(".error-text").forEach(el => el.remove());
    };

    // View event functions (must be defined)
    // Modified openViewModal to accept optional fromDashboard flag
    window.openViewModal = function(eventObj, fromDashboard = false) {
        fetch(`/calendar/events/${eventObj.id}`)
            .then(res => res.json())
            .then(event => {
                const modal = document.getElementById("viewModal");
                if (!modal) {
                    console.warn("viewModal not found in DOM");
                    return;
                }

                // Use the original stored end date (end_display) if present
                const displayEnd = event.end_display || event.end;

                // Populate modal fields
                modal.querySelector("#viewTitle").textContent = event.title || "";
                const typeLabels = {
                    event: "Activity",
                    offsite: "Off Site",
                    official_business: "Official Business",
                    leave: "Leave",
                    holiday: "Holiday"
                };
                modal.querySelector("#viewType").textContent = typeLabels[event.type] || event.type || "";
                modal.querySelector("#viewDate").textContent = formatEventDate(event.start_date, event.end_date);
                modal.querySelector("#viewLocation").textContent = event.location || "No Location Provided";
                modal.querySelector("#viewLink").innerHTML = event.link ? `<a href="${event.link}" target="_blank">${event.link}</a>` : "No Link Attached";
                modal.querySelector("#viewNotes").textContent = event.notes || "No Notes Provided";
                modal.querySelector("#viewFocalPerson").textContent = event.focal_person || "No Focal Person Provided";
                modal.querySelector("#viewCreatedBy").textContent = event.created_by || "No Creator Information";

                // Extended props (for layout / delete/edit buttons)
                applyViewModalLayout(event.type);
                setField("viewVisibility", (event.visibility_type || "global").toUpperCase());

                const editBtn = document.getElementById("editEventBtn");
                const deleteBtn = document.getElementById("deleteEventBtn");
                if (editBtn) editBtn.setAttribute("data-id", event.id);
                if (deleteBtn) deleteBtn.setAttribute("data-id", event.id);

                const modalEl = document.getElementById("viewModal");
            if (fromDashboard) {
                modalEl.classList.add('dashboard-mode');
            } else {
                modalEl.classList.remove('dashboard-mode');
            }

            window.openModal("viewModal");
        })
        .catch(err => console.error("Failed to fetch event details:", err));
    };

    window.openViewModalById = function(id, fromDashboard = false) {
        fetch(`/calendar/events/${id}`)
            .then(res => res.json())
            .then(event => openViewModal(event, fromDashboard))
            .catch(err => console.error("Failed to fetch event by ID:", err));
    };

    /* =========================================================
       HELPER: refresh upcoming events (used after filters/submit)
    ========================================================= */
    function loadUpcomingEvents() {
        const todayContainer = document.getElementById('todayEventsContainer');
        const tomorrowContainer = document.getElementById('tomorrowEventsContainer');
        if (!todayContainer || !tomorrowContainer) return;
        fetch('/calendar/upcoming')
            .then(res => res.json())
            .then(data => {
                todayContainer.innerHTML = '';
                tomorrowContainer.innerHTML = '';
                const todayEvents = data.filter(e => e.is_today);
                const tomorrowEvents = data.filter(e => e.is_tomorrow);
                if (todayEvents.length === 0) todayContainer.innerHTML = '<p class="text-xs text-gray-400">No events today.</p>';
                if (tomorrowEvents.length === 0) tomorrowContainer.innerHTML = '<p class="text-xs text-gray-400">No events tomorrow.</p>';
                todayEvents.forEach(event => {
                    const html = `<div class="flex items-start gap-2 mb-3 cursor-pointer" onclick="openViewModalById(${event.id})">
                                    <span class="w-2 h-2 rounded-full mt-2" style="background:${event.color}"></span>
                                    <div><p class="text-sm font-semibold">${escapeHtml(event.title)}</p>
                                    ${event.label ? `<p class="text-xs text-gray-600">${escapeHtml(event.label)}</p>` : ''}
                                    <p class="text-xs text-gray-400">${event.date} • ${event.time}</p></div></div>`;
                    todayContainer.insertAdjacentHTML('beforeend', html);
                });
                tomorrowEvents.forEach(event => {
                    const html = `<div class="flex items-start gap-2 mb-3 cursor-pointer" onclick="openViewModalById(${event.id})">
                                    <span class="w-2 h-2 rounded-full mt-2" style="background:${event.color}"></span>
                                    <div><p class="text-sm font-semibold">${escapeHtml(event.title)}</p>
                                    ${event.label ? `<p class="text-xs text-gray-600">${escapeHtml(event.label)}</p>` : ''}
                                    <p class="text-xs text-gray-400">${event.date} • ${event.time}</p></div></div>`;
                    tomorrowContainer.insertAdjacentHTML('beforeend', html);
                });
            })
            .catch(error => console.error("Upcoming Fetch Error:", error));
            
    }
    window.loadUpcomingEvents = loadUpcomingEvents;

    // Helper to escape HTML to prevent XSS
    function escapeHtml(str) {
        if (!str) return '';
        return str.replace(/[&<>]/g, function(m) {
            if (m === '&') return '&amp;';
            if (m === '<') return '&lt;';
            if (m === '>') return '&gt;';
            return m;
        });
    }

    /* =========================================================
       DOM CONTENT LOADED – INITIALIZE EVERYTHING
    ========================================================= */
    document.addEventListener("DOMContentLoaded", function () {
        console.log("DOM Ready – Initializing Calendar & Modals");

        /* ---------- CALENDAR CREATE FLOW ---------- */
        const createBtn = document.getElementById("createBtn");
        const createDropdown = document.getElementById("createDropdown");
        const createFromDateBtn = document.getElementById("createFromDateBtn");
        let dismissCreateDropdownOnScroll = null;
        const modalByCreateType = {
            event: "eventModal",
            offsite: "offsiteModal",
            official_business: "offsiteModal",
            leave: "leaveModal",
            holiday: "holidayModal"
        };
        const createTypeLabels = {
            event: { title: "Create Activity", submit: "Save Activity" },
            offsite: { title: "Add Off Site", submit: "Save Event" },
            official_business: { title: "Add Official Business", submit: "Save Official Business" },
            leave: { title: "Add Leave", submit: "Save Leave" },
            holiday: { title: "Add Holiday", submit: "Save Holiday" }
        };

        function getCreateDate(form) {
            const selectedDate = form.querySelector('[name="start_date"]')?.value
                || form.querySelector('[name="single_date"]')?.value;
            const match = selectedDate?.match(/^(\d{4})-(\d{2})-(\d{2})/);
            if (match) {
                return new Date(Number(match[1]), Number(match[2]) - 1, Number(match[3]));
            }

            return window.pendingClickDate instanceof Date && !Number.isNaN(window.pendingClickDate.getTime())
                ? window.pendingClickDate
                : null;
        }

        function setCreateType(form, type) {
            const settings = createTypeLabels[type] || createTypeLabels.event;
            const typeInput = form.querySelector('[name="type"]');
            const modal = form.closest(".calendar-modal");
            const title = modal.querySelector(".calendar-modal-title");
            const submitButton = form.querySelector(".calendar-modal-submit-btn");
            const typeSelect = form.querySelector("[data-create-event-type]");

            if (typeInput) typeInput.value = type;
            form.dataset.type = type;
            if (typeSelect) typeSelect.value = type;
            if (title) title.textContent = settings.title;
            if (submitButton) submitButton.textContent = settings.submit;
        }

        function openCreateForm(type = "event", date = null) {
            const modalId = modalByCreateType[type] || modalByCreateType.event;
            const modal = document.getElementById(modalId);
            const form = modal?.querySelector("form");
            if (!modal || !form) return;

            form.reset();
            form.removeAttribute("data-editing");
            const methodField = form.querySelector('input[name="_method"]');
            if (methodField) methodField.remove();
            form.method = "POST";
            form.action = form.dataset.storeUrl;
            window.clearErrors(form);
            form.querySelector("select[name='visibility_type']")?.dispatchEvent(new Event("change"));

            form.querySelectorAll(".flatpickr-input").forEach(input => {
                if (input._flatpickr) input._flatpickr.clear();
            });

            const allDayCheck = form.querySelector("[name='all_day']");
            if (allDayCheck) {
                allDayCheck.checked = true;
                allDayCheck.dispatchEvent(new Event("change"));
            }

            if (date instanceof Date && !Number.isNaN(date.getTime())) {
                const dateStr = `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, "0")}-${String(date.getDate()).padStart(2, "0")}`;
                ["start_date", "end_date"].forEach(name => {
                    const input = form.querySelector(`[name="${name}"]`);
                    if (input?._flatpickr) {
                        input._flatpickr.setDate(dateStr, false);
                    } else if (input) {
                        input.value = dateStr;
                    }
                });
            }

            setCreateType(form, type);
            form.querySelector(".title-counter").textContent = "0";
            const notesCounter = form.querySelector("#notesCounter");
            if (notesCounter) notesCounter.textContent = "0";
            form.querySelector("[data-create-type-select-wrapper]")?.classList.remove("hidden");

            window.openModal(modalId);
            createDropdown?.classList.add("hidden");
            createDropdown?.classList.remove("flex");
        }

        if (createBtn) {
            createBtn.addEventListener("click", function(event) {
                event.preventDefault();
                window.pendingClickDate = null;
                openCreateForm();
            });
        }

        if (createFromDateBtn) {
            createFromDateBtn.addEventListener("click", function(event) {
                event.preventDefault();
                openCreateForm("event", window.pendingClickDate);
            });
        }

        document.querySelectorAll("[data-create-event-type]").forEach(select => {
            select.addEventListener("change", function() {
                const currentForm = this.closest("form");
                const currentModal = this.closest(".calendar-modal");
                const type = this.value;
                const targetModalId = modalByCreateType[type] || modalByCreateType.event;
                if (!currentForm || !currentModal || currentForm.dataset.editing === "true") return;

                if (targetModalId === currentModal.id) {
                    setCreateType(currentForm, type);
                    return;
                }

                const selectedDate = getCreateDate(currentForm);
                window.closeModal(currentModal.id);
                openCreateForm(type, selectedDate);
            });
        });

        document.addEventListener("click", function(event) {
            if (createDropdown && !createDropdown.contains(event.target)) {
                createDropdown.classList.add("hidden");
                createDropdown.classList.remove("flex");
                if (dismissCreateDropdownOnScroll) {
                    window.removeEventListener("scroll", dismissCreateDropdownOnScroll);
                    dismissCreateDropdownOnScroll = null;
                }
            }
        });

        /* ---------- MODAL OVERLAY CLOSE (outside click) ---------- */
        document.querySelectorAll(".calendar-modal").forEach(modal => {
            modal.addEventListener("click", function (e) {
                if (e.target.classList.contains("calendar-modal-overlay")) {
                    window.closeModal(modal.id);
                }
            });
        });

        /* ---------- ALL DAY TOGGLE (per modal) ---------- */
        document.querySelectorAll(".calendar-modal").forEach(modal => {
            const checkbox = modal.querySelector("input[name='all_day']");
            const allDayWrapper = modal.querySelector(".all-day-mode");
            const timeWrapper = modal.querySelector(".time-mode");
            if (!checkbox || !allDayWrapper || !timeWrapper) return;

            checkbox.addEventListener("change", function() {
                if (this.checked) {
                    allDayWrapper.classList.remove("hidden");
                    timeWrapper.classList.add("hidden");
                } else {
                    allDayWrapper.classList.add("hidden");
                    timeWrapper.classList.remove("hidden");

                    // Fill missing time fields with defaults (8 AM - 5 PM)
                    const startTime = modal.querySelector("[name='start_time']");
                    const endTime   = modal.querySelector("[name='end_time']");
                    if (startTime && !startTime.value) {
                        startTime.value = "08:00";
                        if (startTime._flatpickr) startTime._flatpickr.setDate("08:00", false);
                    }
                    if (endTime && !endTime.value) {
                        endTime.value = "17:00";
                        if (endTime._flatpickr) endTime._flatpickr.setDate("17:00", false);
                    }
                }
            });
        });

        /* ---------- VISIBILITY TYPE TOGGLE (section field) ---------- */
        function initVisibilityToggle() {
            document.querySelectorAll(".calendar-modal").forEach(modal => {
                const visibilitySelect = modal.querySelector("select[name='visibility_type']");
                const sectionField = modal.querySelector(".section-field");
                const sectionSelect = modal.querySelector("select[name='section_id']");
                if (!visibilitySelect || !sectionField) return;
                function toggleSectionField() {
                    if (visibilitySelect.value === "section") {
                        sectionField.classList.remove("hidden");
                        if (sectionSelect) sectionSelect.disabled = false;
                    } else {
                        sectionField.classList.add("hidden");
                        if (sectionSelect) {
                            sectionSelect.disabled = true;
                            sectionSelect.value = "";
                        }
                    }
                }
                toggleSectionField();
                visibilitySelect.addEventListener("change", toggleSectionField);
            });
        }
        initVisibilityToggle();

        /* ---------- AJAX FORM SUBMISSION (REAL FETCH) ---------- */
        document.querySelectorAll(".calendar-ajax-form").forEach(form => {
            if (form.dataset.ajaxBound) return;
            form.dataset.ajaxBound = "true";

            form.addEventListener("submit", async function(event) {
                event.preventDefault();
                window.clearErrors(this);

                // ========== TIME ORDER & EMPTY VALIDATION ==========
                const allDayCheck = this.querySelector("[name='all_day']");
                const isAllDay = allDayCheck ? allDayCheck.checked : true;

                if (!isAllDay) {
                    const startTimeInput = this.querySelector("[name='start_time']");
                    const endTimeInput = this.querySelector("[name='end_time']");
                    let startTime = startTimeInput?.value;
                    let endTime = endTimeInput?.value;

                    if (!startTime || !endTime) {
                        window.showErrors({
                            start_time: ["Start time is required."],
                            end_time: ["End time is required."]
                        }, this);
                        return;
                    }

                    if (startTime >= endTime) {
                        window.showErrors({ end_time: ["End time must be after start time."] }, this);
                        return;
                }
            }

                // ========== CRITICAL FIX: Ensure date values are set before submission ==========
                // For all-day events, make sure start_date and end_date have values
                if (isAllDay) {
                    let startDateInput = this.querySelector("[name='start_date']");
                    let endDateInput = this.querySelector("[name='end_date']");
                    
                    // If hidden fields are empty, try to get values from visible fields
                    if ((!startDateInput || !startDateInput.value) && !isAllDay) {
                        const singleDate = this.querySelector("[name='single_date']")?.value;
                        if (singleDate) {
                            if (!startDateInput) {
                                startDateInput = document.createElement("input");
                                startDateInput.type = "hidden";
                                startDateInput.name = "start_date";
                                this.appendChild(startDateInput);
                            }
                            if (!endDateInput) {
                                endDateInput = document.createElement("input");
                                endDateInput.type = "hidden";
                                endDateInput.name = "end_date";
                                this.appendChild(endDateInput);
                            }
                            startDateInput.value = singleDate;
                            endDateInput.value = singleDate;
                        }
                    }
                } else {
                    // For timed events, build datetime strings
                    const singleDate = this.querySelector("[name='single_date']")?.value || "";
                    const startTime = this.querySelector("[name='start_time']")?.value || "00:00";
                    const endTime   = this.querySelector("[name='end_time']")?.value   || "23:59";

                    const fullStart = singleDate ? `${singleDate} ${startTime}:00` : "";
                    const fullEnd   = singleDate ? `${singleDate} ${endTime}:00` : "";

                    let startDateInput = this.querySelector("[name='start_date']");
                    let endDateInput   = this.querySelector("[name='end_date']");

                    if (!startDateInput) {
                        startDateInput = document.createElement("input");
                        startDateInput.type = "hidden";
                        startDateInput.name = "start_date";
                        this.appendChild(startDateInput);
                    }
                    if (!endDateInput) {
                        endDateInput = document.createElement("input");
                        endDateInput.type = "hidden";
                        endDateInput.name = "end_date";
                        this.appendChild(endDateInput);
                    }

                    startDateInput.value = fullStart;
                    endDateInput.value   = fullEnd;
                }
                // ================================================================

                const formData = new FormData(this);
                const url = this.action || this.dataset.storeUrl;

                // Log what we're submitting for debugging
                console.log("Submitting form data:", {
                    url: url,
                    title: formData.get('title'),
                    start_date: formData.get('start_date'),
                    end_date: formData.get('end_date'),
                    focal_person_id: formData.get('focal_person_id'),
                    isEditing: this.dataset.editing === 'true'
                });

                try {
                    const isEditing = this.dataset.editing === 'true';
                    const method = isEditing ? 'POST' : 'POST'; // Always POST, _method field handles PUT

                    const response = await fetch(url, {
                        method: method,
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
                        },
                        body: formData
                    });

                    const result = await response.json();

                    if (response.ok) {
                        const modal = this.closest(".calendar-modal");
                        if (modal) window.closeModal(modal.id);
                        if (window.calendar) window.calendar.refetchEvents();
                        loadUpcomingEvents();
                        if (typeof refreshUpcomingEventsWithFilters === "function") refreshUpcomingEventsWithFilters();
                        if (typeof showToast === "function") {
                            showToast(isEditing ? "Event updated successfully" : "Event created successfully", "success");
                        }
                    } else {
                        if (result.errors) {
                            window.showErrors(result.errors, this);
                        } else {
                            let errorMsg = "Something went wrong.";
                            if (result.error) {
                                errorMsg = result.error;
                            } else if (result.message) {
                                errorMsg = result.message;
                            } else if (response.status === 403) {
                                errorMsg = "You don't have permission to perform this action.";
                            } else if (response.status === 422) {
                                errorMsg = "Validation failed. Please check your input.";
                            } else {
                                errorMsg = `Server error (${response.status}): ${response.statusText}`;
                            }
                            
                            if (typeof showToast === "function") {
                                showToast(errorMsg, "error");
                            } else {
                                alert(errorMsg);
                            }
                        }
                    }
                    
                } catch (error) {
                    console.error("AJAX submit error:", error);
                    let errorMsg = "Network error – please check your connection.";
                    if (error.message) errorMsg += " " + error.message;
                    
                    if (typeof showToast === "function") {
                        showToast(errorMsg, "error");
                    } else {
                        alert(errorMsg);
                    }
                }
            });
        });

        // /* ---------- FLATPICKR INITIALIZATION ---------- */
        // if (typeof flatpickr !== "undefined") {
        //     document.querySelectorAll(".calendar-modal").forEach(modal => {
        //         const form = modal.querySelector("form");
        //         if (!form) return;
        //         const startDate = form.querySelector("[name='start_date']");
        //         const endDate = form.querySelector("[name='end_date']");
        //         const singleDate = form.querySelector("[name='single_date']");
        //         const startTime = form.querySelector("[name='start_time']");
        //         const endTime = form.querySelector("[name='end_time']");

        //         let endDatePicker = null;
        //         if (startDate) {
        //             flatpickr(startDate, {
        //                 dateFormat: "Y-m-d",
        //                 allowInput: true,
        //                 onChange: function(selectedDates) {
        //                     if (endDatePicker && selectedDates.length) {
        //                         endDatePicker.set("minDate", selectedDates[0]);
        //                         if (endDatePicker.selectedDates[0] && endDatePicker.selectedDates[0] < selectedDates[0]) {
        //                             endDatePicker.clear();
        //                         }
        //                     }
        //                 }
        //             });
        //         }
        //         if (endDate) endDatePicker = flatpickr(endDate, { dateFormat: "Y-m-d", allowInput: true });
        //         if (singleDate) flatpickr(singleDate, { dateFormat: "Y-m-d", allowInput: true });
        //         if (startTime) {
        //             flatpickr(startTime, {
        //                 enableTime: true,
        //                 noCalendar: true,
        //                 dateFormat: "H:i",
        //                 time_24hr: true,
        //                 allowInput: true,
        //                 onChange: function(selectedDates, timeStr) {
        //                     if (endTime && endTime._flatpickr && timeStr) {
        //                         endTime._flatpickr.set("minTime", timeStr);
        //                         if (endTime.value && endTime.value < timeStr) endTime._flatpickr.clear();
        //                     }
        //                 }
        //             });
        //         }
        //         if (endTime) {
        //             flatpickr(endTime, {
        //                 enableTime: true,
        //                 noCalendar: true,
        //                 dateFormat: "H:i",
        //                 time_24hr: true,
        //                 allowInput: true
        //             });
        //         }
        //     });
        // }

        /* ---------- CALENDAR FILTERS ---------- */
        const calendarFilters = document.querySelectorAll(".calendar-filter");
        function normalize(val) {
            return (val || "").toString().trim().toLowerCase().replace(/\s+/g, "");
        }
        function getUncheckedFilters() {
            return Array.from(calendarFilters).filter(f => !f.checked).map(f => normalize(f.value));
        }
        function eventShouldBeHidden(event) {
            const unchecked = getUncheckedFilters();
            const type = normalize(event.extendedProps.type);
            const section = normalize(event.extendedProps.section);
            const visibility = normalize(event.extendedProps.visibility_type);
            return unchecked.includes(type) || unchecked.includes(section) || unchecked.includes(visibility);
        }
        window.refreshCalendarWithFilters = function() {
            if (!window.calendar) return;
            window.calendar.getEvents().forEach(event => {
                event.setProp("display", eventShouldBeHidden(event) ? "none" : "auto");
            });
        };
        window.refreshUpcomingEventsWithFilters = function() {
            const todayContainer = document.getElementById("todayEventsContainer");
            const tomorrowContainer = document.getElementById("tomorrowEventsContainer");
            if (!todayContainer || !tomorrowContainer) return;
            fetch("/calendar/upcoming")
                .then(res => res.json())
                .then(data => {
                    const unchecked = getUncheckedFilters();
                    const filterEvent = (e) => {
                        const type = normalize(e.type);
                        const section = normalize(e.section);
                        const visibility = normalize(e.visibility_type);
                        return !(unchecked.includes(type) || unchecked.includes(section) || unchecked.includes(visibility));
                    };
                    const todayEvents = data.filter(e => e.is_today && filterEvent(e));
                    const tomorrowEvents = data.filter(e => e.is_tomorrow && filterEvent(e));
                    todayContainer.innerHTML = todayEvents.length === 0 ? '<p class="text-xs text-gray-400">No events today.</p>' : '';
                    tomorrowContainer.innerHTML = tomorrowEvents.length === 0 ? '<p class="text-xs text-gray-400">No events tomorrow.</p>' : '';
                    todayEvents.forEach(event => {
                        const html = `<div class="flex items-start gap-2 mb-3 cursor-pointer" onclick="openViewModalById(${event.id})">
                                        <span class="w-2 h-2 rounded-full mt-2" style="background:${event.color}"></span>
                                        <div><p class="text-sm font-semibold">${escapeHtml(event.title)}</p>
                                        ${event.label ? `<p class="text-xs text-gray-600">${escapeHtml(event.label)}</p>` : ''}
                                        <p class="text-xs text-gray-400">${event.date} • ${event.time}</p></div></div>`;
                        todayContainer.insertAdjacentHTML('beforeend', html);
                    });
                    tomorrowEvents.forEach(event => {
                        const html = `<div class="flex items-start gap-2 mb-3 cursor-pointer" onclick="openViewModalById(${event.id})">
                                        <span class="w-2 h-2 rounded-full mt-2" style="background:${event.color}"></span>
                                        <div><p class="text-sm font-semibold">${escapeHtml(event.title)}</p>
                                        ${event.label ? `<p class="text-xs text-gray-600">${escapeHtml(event.label)}</p>` : ''}
                                        <p class="text-xs text-gray-400">${event.date} • ${event.time}</p></div></div>`;
                        tomorrowContainer.insertAdjacentHTML('beforeend', html);
                    });
                })
                .catch(err => console.error("Upcoming Events Filter Error:", err));
        };
        calendarFilters.forEach(filter => {
            filter.addEventListener("change", () => {
                window.refreshCalendarWithFilters();
                window.refreshUpcomingEventsWithFilters();
            });
        });
        const clearFiltersBtn = document.getElementById('clearFiltersBtn');
        if (clearFiltersBtn) {
            clearFiltersBtn.addEventListener('click', function() {
                document.querySelectorAll('.calendar-filter').forEach(cb => cb.checked = false);
                window.refreshCalendarWithFilters();
                window.refreshUpcomingEventsWithFilters();
            });
        }

        /* ---------- FULLCALENDAR INITIALIZATION ---------- */
        const calendarEl = document.getElementById("calendarContainer");
        if (calendarEl && typeof FullCalendar !== "undefined") {
            function isMobile() { return window.innerWidth < 768; }
            function getInitialView() {
                if (window.innerWidth < 576) return "listWeek";
                if (window.innerWidth < 768) return "timeGridDay";
                return "dayGridMonth";
            }
            function getHeaderToolbar() {
                if (window.innerWidth < 576) return { left: 'prev,next', center: 'title', right: 'today' };
                if (window.innerWidth < 768) return { left: 'prev,next today', center: 'title', right: 'listWeek,timeGridDay' };
                return { left: 'prev,next today', center: 'title', right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek' };
            }

            window.calendar = new FullCalendar.Calendar(calendarEl, {
                timeZone: 'Asia/Manila',  
                eventTimeFormat: { hour: '2-digit', minute: '2-digit', hour12: true },
                initialDate: new Date().toISOString().split('T')[0], // today's date (YYYY-MM-DD)
                initialView: getInitialView(),
                height: "100%",
                contentHeight: "auto",
                expandRows: false,
                stickyHeaderDates: true,
                handleWindowResize: true,
                windowResizeDelay: 100,
                headerToolbar: getHeaderToolbar(),
                footerToolbar: isMobile() ? { left: '', center: 'dayGridMonth,timeGridWeek,listWeek', right: '' } : false,
                buttonText: { today: 'Today', month: 'Month', week: 'Week', day: 'Day', list: 'List' },
                eventDisplay: "block",
                navLinks: true,
                selectable: false,
                editable: false,
                dateClick: function(info) {
                    info.jsEvent.stopPropagation();
                    window.pendingClickDate = info.date;
                    const dropdown = document.getElementById('createDropdown');
                    if (!dropdown) return;
                    dropdown.style.position = "fixed";
                    dropdown.style.left = `${Math.min(info.jsEvent.clientX, window.innerWidth - 130)}px`;
                    dropdown.style.top = `${Math.min(info.jsEvent.clientY, window.innerHeight - 60)}px`;
                    dropdown.style.right = "auto";
                    dropdown.style.marginTop = "0";
                    dropdown.classList.remove("hidden");
                    dropdown.classList.add("flex");
                    if (dismissCreateDropdownOnScroll) {
                        window.removeEventListener("scroll", dismissCreateDropdownOnScroll);
                    }
                    dismissCreateDropdownOnScroll = function() {
                        dropdown.classList.add("hidden");
                        dropdown.classList.remove("flex");
                        window.removeEventListener("scroll", dismissCreateDropdownOnScroll);
                        dismissCreateDropdownOnScroll = null;
                    };
                    window.addEventListener("scroll", dismissCreateDropdownOnScroll, { passive: true });
                    const closeHandler = function(e) {
                        if (!dropdown.contains(e.target)) {
                            dropdown.classList.add("hidden");
                            dropdown.classList.remove("flex");
                            if (dismissCreateDropdownOnScroll) {
                                window.removeEventListener("scroll", dismissCreateDropdownOnScroll);
                                dismissCreateDropdownOnScroll = null;
                            }
                            document.removeEventListener("click", closeHandler);
                        }
                    };
                    setTimeout(() => document.addEventListener("click", closeHandler), 10);
                },
                dayMaxEvents: isMobile() ? 2 : 3,
                dayMaxEventRows: isMobile() ? 2 : 3,
                moreLinkClassNames: ['fc-custom-more-link'],
                moreLinkClick: function(info) {
                    if (isMobile()) {
                        window.calendar.changeView('listDay', info.date);
                        return 'none';
                    }
                    info.jsEvent.preventDefault();
                    const hiddenEvents = info.hiddenSegs;
                    const existingPop = document.querySelector('.fc-custom-more-popover');
                    if (existingPop) existingPop.remove();
                    const pop = document.createElement("div");
                    pop.className = "fc-custom-more-popover";
                    const closeBtn = document.createElement("button");
                    closeBtn.className = "popover-close-btn";
                    closeBtn.innerHTML = "×";
                    closeBtn.addEventListener("click", () => pop.remove());
                    pop.appendChild(closeBtn);
                    hiddenEvents.forEach(seg => {
                        const event = seg.event;
                        const ev = document.createElement("div");
                        ev.className = "popover-event";
                        ev.setAttribute("role", "button");
                        ev.setAttribute("tabindex", "0");
                        const colorDot = document.createElement("span");
                        colorDot.className = "popover-event-dot";
                        colorDot.style.backgroundColor = event.backgroundColor || '#3788d8';
                        ev.appendChild(colorDot);
                        const titleSpan = document.createElement("span");
                        titleSpan.textContent = event.title;
                        ev.appendChild(titleSpan);
                        const handleClick = () => { window.openViewModal(event); pop.remove(); };
                        ev.addEventListener("click", handleClick);
                        ev.addEventListener("keydown", (e) => { if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); handleClick(); } });
                        pop.appendChild(ev);
                    });
                    document.body.appendChild(pop);
                    const rect = info.jsEvent.target.getBoundingClientRect();
                    const popWidth = 280, popMaxHeight = 320;
                    const calendarRect = calendarEl.getBoundingClientRect();
                    const toolbarHeight = 70;
                    let left = rect.left + window.scrollX;
                    let top = rect.bottom + window.scrollY + 8;
                    if (left + popWidth > window.innerWidth - 16) left = window.innerWidth - popWidth - 16;
                    if (left < 16) left = 16;
                    const topOfCalendarContent = calendarRect.top + window.scrollY + toolbarHeight;
                    if (top < topOfCalendarContent) top = topOfCalendarContent;
                    if (top + popMaxHeight > window.innerHeight + window.scrollY - 16) {
                        const topAbove = rect.top + window.scrollY - popMaxHeight - 8;
                        if (topAbove > topOfCalendarContent) top = topAbove;
                        else top = window.innerHeight + window.scrollY - popMaxHeight - 16;
                    }
                    pop.style.cssText = `position:absolute; top:${top}px; left:${left}px; width:${popWidth}px; max-height:${popMaxHeight}px; overflow-y:auto; font-size:14px; background:white; border:1px solid #e5e7eb; padding:12px; box-shadow:0 10px 25px rgba(0,0,0,0.15); border-radius:8px; z-index:9999;`;
                    setTimeout(() => {
                        document.addEventListener("click", function handler(e) {
                            if (!pop.contains(e.target)) { pop.remove(); document.removeEventListener("click", handler); }
                        });
                    }, 10);
                    return 'none';
                },
                eventDidMount: function(info) {
                    info.el.classList.add('fc-event-touch-friendly');
                    if (!isMobile()) info.el.setAttribute('title', info.event.title);
                },
                events: function(fetchInfo, successCallback, failureCallback) {
                    fetch("/calendar/events")
                        .then(response => response.json())
                        .then(data => {
                            successCallback(data);   // data already has correct start/end
                            setTimeout(() => window.refreshCalendarWithFilters(), 50);
                        })
                        .catch(error => {
                            console.error("Event Fetch Error:", error);
                            failureCallback(error);
                        });
                },
                eventClick: function(info) {
                    info.jsEvent.preventDefault();
                    window.openViewModal(info.event);
                },
                views: {
                    dayGridMonth: { height: "auto", dayMaxEvents: isMobile() ? 2 : 4, titleFormat: { year: 'numeric', month: isMobile() ? 'short' : 'long' } },
                    timeGridWeek: { height: 700, scrollTime: "08:00:00", slotMinTime: "06:00:00", slotMaxTime: "20:00:00", dayHeaderFormat: { weekday: isMobile() ? 'narrow' : 'short', day: 'numeric' }, slotLabelFormat: { hour: 'numeric', minute: '2-digit', hour12: true } },
                    timeGridDay: { height: 700, scrollTime: "08:00:00", slotMinTime: "06:00:00", slotMaxTime: "20:00:00", titleFormat: { year: 'numeric', month: 'short', day: 'numeric' } },
                    listWeek: { height: 700, listDayFormat: { weekday: 'long', month: 'short', day: 'numeric' }, listDaySideFormat: false, noEventsText: 'No events this week' },
                    listDay: { height: 700, listDayFormat: { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' }, noEventsText: 'No events today' }
                }
            });
            window.calendar.render();

            // Resize handling
            let resizeTimeout;
            function handleResize() {
                clearTimeout(resizeTimeout);
                resizeTimeout = setTimeout(() => {
                    if (!window.calendar) return;
                    const mobile = isMobile();
                    const currentView = window.calendar.view.type;
                    window.calendar.setOption('headerToolbar', getHeaderToolbar());
                    window.calendar.setOption('footerToolbar', mobile ? { left: '', center: 'dayGridMonth,timeGridWeek,listWeek', right: '' } : false);
                    window.calendar.setOption('height', '100%');
                    window.calendar.setOption('dayMaxEvents', mobile ? 2 : 3);
                    if (mobile && !currentView.startsWith('list')) window.calendar.changeView('listWeek');
                    else if (!mobile && currentView.startsWith('list')) window.calendar.changeView('dayGridMonth');
                    window.calendar.updateSize();
                }, 150);
            }
            window.addEventListener('resize', handleResize);
            window.addEventListener('orientationchange', () => setTimeout(handleResize, 50));
            handleResize();
        }
        // // ---------- MINI CALENDAR & TWO‑WAY SYNC (no deadlocks) ----------
        // const miniCalendarEl = document.getElementById('miniCalendar');
        // if (miniCalendarEl) {
        //     let isSyncing = false;

        //     function scheduleSyncUnlock() {
        //         setTimeout(() => { isSyncing = false; }, 50);
        //     }

        //     const miniCalendar = new FullCalendar.Calendar(miniCalendarEl, {
        //         initialDate: new Date().toISOString().split('T')[0], // today
        //         initialView: 'dayGridMonth',
        //         headerToolbar: { left: 'prev', center: 'title', right: 'next' },
        //         height: 'auto',
        //         fixedWeekCount: false,
        //         showNonCurrentDates: true,
        //         dayHeaderFormat: { weekday: 'narrow' },
        //         titleFormat: { year: 'numeric', month: 'short' },

        //         dateClick: function(info) {
        //             if (window.calendar && !isSyncing) {
        //                 isSyncing = true;
        //                 scheduleSyncUnlock();
        //                 window.calendar.gotoDate(info.date);
        //             }
        //         },

        //         datesSet: function(info) {
        //             highlightCurrentDate();

        //             if (window.calendar && !isSyncing) {
        //                 // mini was changed independently (prev/next or clicked date)
        //                 isSyncing = true;
        //                 scheduleSyncUnlock();
        //                 window.calendar.gotoDate(info.view.currentStart);
        //             } else if (isSyncing) {
        //                 // sync from main calendar just completed → clear lock
        //                 isSyncing = false;
        //             }
        //         }
        //     });

        //     miniCalendar.render();
        //     window.miniCalendar = miniCalendar;

        //     // ✅ Initial alignment: mini follows the main calendar
        //     if (window.calendar) {
        //         miniCalendar.gotoDate(window.calendar.getDate());
        //     }

        //     // Main calendar's datesSet → push to mini
        //     if (window.calendar) {
        //         window.calendar.on('datesSet', function(info) {
        //             if (isSyncing) {
        //                 isSyncing = false;
        //                 return;
        //             }
        //             if (window.miniCalendar) {
        //                 isSyncing = true;
        //                 scheduleSyncUnlock();
        //                 window.miniCalendar.gotoDate(info.view.currentStart);
        //             }
        //         });
        //     }

        //     function highlightCurrentDate() {
        //         miniCalendarEl.querySelectorAll('.fc-daygrid-day').forEach(day => day.classList.remove('mini-cal-selected'));
        //         const todayCell = miniCalendarEl.querySelector('.fc-day-today');
        //         if (todayCell) todayCell.classList.add('mini-cal-selected');
        //     }
        // }
        // ---------- MINI CALENDAR (standalone, for debugging) ----------
        // ---------- MINI CALENDAR & TWO‑WAY SYNC (bulletproof) ----------
// ---------- MINI CALENDAR & TWO‑WAY SYNC (reliable) ----------
        const miniCalendarEl = document.getElementById('miniCalendar');
        if (miniCalendarEl) {
            let miniReady = false;
            let skipNextMiniDatesSet = false;   // ignore mini's datesSet when pushed by main
            let skipNextMainDatesSet = false;   // ignore main's datesSet when pushed by mini

            const miniCalendar = new FullCalendar.Calendar(miniCalendarEl, {
                initialDate: new Date().toISOString().split('T')[0],
                initialView: 'dayGridMonth',
                headerToolbar: { left: 'prev', center: 'title', right: 'next' },
                height: 'auto',
                fixedWeekCount: false,
                showNonCurrentDates: true,
                dayHeaderFormat: { weekday: 'narrow' },
                titleFormat: { year: 'numeric', month: 'short' },

                dateClick: function(info) {
                    if (window.calendar && miniReady && !skipNextMiniDatesSet) {
                        skipNextMainDatesSet = true;        // we are pushing main now
                        window.calendar.gotoDate(info.date);
                    }
                },

                datesSet: function(info) {
                    highlightCurrentDate();

                    if (!miniReady) {
                        miniReady = true;          // first render – ignore
                        return;
                    }

                    // If this datesSet was triggered by the main calendar pushing us,
                    // just clear the flag and stop.
                    if (skipNextMiniDatesSet) {
                        skipNextMiniDatesSet = false;
                        return;
                    }

                    // Otherwise, the user manually changed the mini calendar (prev/next)
                    // → push the main calendar forward.
                    if (window.calendar && !skipNextMainDatesSet) {
                        skipNextMainDatesSet = true;        // signal that mini pushed main
                        window.calendar.gotoDate(info.view.currentStart);
                    }
                }
            });

            miniCalendar.render();
            window.miniCalendar = miniCalendar;

            // Initial alignment: silently make the mini follow the main calendar
            if (window.calendar) {
                skipNextMiniDatesSet = true;    // suppress the upcoming mini datesSet
                miniCalendar.gotoDate(window.calendar.getDate());
            }

            // Main calendar's datesSet → push to mini (when not initiated by mini)
            if (window.calendar) {
                window.calendar.on('datesSet', function(info) {
                    // If the mini calendar just pushed us, clear that flag and do nothing.
                    if (skipNextMainDatesSet) {
                        skipNextMainDatesSet = false;
                        return;
                    }

                    // Otherwise, the user changed the main calendar manually → push to mini.
                    if (window.miniCalendar && miniReady) {
                        skipNextMiniDatesSet = true;        // suppress mini's next datesSet
                        window.miniCalendar.gotoDate(info.view.currentStart);
                    }
                });
            }

            function highlightCurrentDate() {
                miniCalendarEl.querySelectorAll('.fc-daygrid-day').forEach(day => day.classList.remove('mini-cal-selected'));
                const todayCell = miniCalendarEl.querySelector('.fc-day-today');
                if (todayCell) todayCell.classList.add('mini-cal-selected');
            }
        }
        // ---------- FILTER CALENDAR COLLAPSE (FIX) ----------
    const toggleBtn = document.querySelector('.collapsible-toggle');
    const filterContent = document.getElementById('filterCalendarContent');
    const toggleIcon = toggleBtn ? toggleBtn.querySelector('.collapsible-icon') : null;

    function syncCollapseIcon() {
        if (!filterContent || !toggleIcon) return;
        if (filterContent.classList.contains('hidden')) {
            toggleIcon.classList.add('rotate-180');
        } else {
            toggleIcon.classList.remove('rotate-180');
        }
    }

    if (toggleBtn && filterContent) {
        // Set initial icon state (content is visible by default → arrow points down)
        syncCollapseIcon();

        // Toggle on click
        toggleBtn.addEventListener('click', function(e) {
            e.preventDefault();
            filterContent.classList.toggle('hidden');
            toggleIcon.classList.toggle('rotate-180');
        });
    }
        // Load upcoming events initially
        loadUpcomingEvents();
        if (typeof window.refreshUpcomingEventsWithFilters === 'function') window.refreshUpcomingEventsWithFilters();
       
        const goToCalendarBtn = document.getElementById("goToCalendarBtn");
            if (goToCalendarBtn) {
                goToCalendarBtn.addEventListener("click", function() {
                    window.location.href = '/calendar';
                });
            }
    }); // end DOMContentLoaded

    // --- 100‑character title limit handler (works for all modals) ---
    function handleTitleInput(input) {
        const len = input.value.length;
        const max = 100;

        const row = input.closest('.calendar-modal-row');
        if (!row) return;
        const limitRow = row.nextElementSibling;
        if (!limitRow || !limitRow.classList.contains('title-limit-row')) return;

        const counter = limitRow.querySelector('.title-counter');
        const warning = limitRow.querySelector('.title-warning');

        if (counter) counter.textContent = len;

        if (len >= max) {
            input.classList.add('input-glow-red');
            if (warning) warning.classList.remove('hidden');
        } else {
            input.classList.remove('input-glow-red');
            if (warning) warning.classList.add('hidden');
        }
    }

    // ✅ Make it globally accessible for inline oninput handlers
    window.handleTitleInput = handleTitleInput;

    // --- Also initialise the counter when a modal opens ---
    (function() {
        const originalOpenModal = window.openModal;
        window.openModal = function(modalId) {
            originalOpenModal(modalId);
            const modal = document.getElementById(modalId);
            if (!modal) return;
            const titleInput = modal.querySelector('.title-input');
            if (titleInput) handleTitleInput(titleInput);   // set initial count
        };
    })();
})();