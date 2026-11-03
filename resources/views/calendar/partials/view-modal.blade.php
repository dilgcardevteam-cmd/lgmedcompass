<div id="viewModal"
     class="fixed inset-0 z-[99999] hidden flex items-center justify-center bg-black/50 backdrop-blur-sm"
     role="dialog"
     aria-modal="true"
     aria-labelledby="modal-title">

    <div class="absolute inset-0"></div>

    <div id="viewModalCard"
        class="relative z-10 w-full max-w-xl max-h-[90vh] overflow-y-auto bg-white rounded-[28px] shadow-[0_30px_80px_rgba(0,0,0,0.12)] p-10 space-y-8"
        onclick="event.stopPropagation()">

        <!-- Header -->
        <div class="flex justify-between items-start mb-4">
            <div class="space-y-2 pr-6">
                <span id="viewType" class="inline-flex items-center rounded-full bg-amber-50 px-3 py-1 text-[10px] font-bold text-amber-600 ring-1 ring-amber-200 uppercase tracking-widest"></span>
                <h2 id="viewTitle" class="text-3xl font-black text-gray-900 leading-tight">Not defined</h2>
            </div>
            <div class="flex items-left gap-1">
                <!-- Edit & Delete (hidden in dashboard mode) -->
                <button type="button" id="editEventBtn" class="p-2 rounded-full text-gray-400 hover:text-gray-900 hover:bg-gray-100 transition">
                    <x-heroicon-o-pencil class="w-6 h-6"/>
                </button>
                <button type="button" id="deleteEventBtn" class="p-2 rounded-full text-red-600 hover:text-red-700 hover:bg-red-50 transition">
                    <x-heroicon-o-trash class="w-6 h-6"/>
                </button>
                <!-- Go to Calendar button (visible only in dashboard mode) -->
                <button type="button" id="goToCalendarBtn" class="p-2 rounded-full text-blue-600 hover:text-blue-700 hover:bg-blue-50 transition hidden">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </button>
                <button onclick="closeModal('viewModal')" class="p-2 rounded-full text-gray-400 hover:text-gray-900 hover:bg-gray-100 transition">
                    <x-heroicon-o-x-mark class="w-6 h-6"/>
                </button>
            </div>
        </div>

        <!-- Divider -->
        <div class="border-t border-gray-100"></div>

        <!-- Body (unchanged) -->
        <div class="space-y-5">
            <div class="flex items-center gap-4 px-6 py-5 rounded-2xl bg-gray-50 border border-gray-100">
                <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-amber-50">
                    <x-heroicon-o-calendar-days class="w-5 h-5"/>
                </div>
                <div>
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Schedule</p>
                    <p id="viewDate" class="text-sm font-semibold text-gray-800">Not defined</p>
                </div>
            </div>

            <div id="rowLink" class="flex items-center gap-4 px-6 py-5 rounded-2xl bg-gray-50 border border-gray-100">
                <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-amber-50">
                    <x-heroicon-o-link class="w-5 h-5"/>
                </div>
                <div class="truncate">
                    <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Link</p>
                    <p id="viewLink" class="text-sm font-semibold text-gray-800 truncate">Not defined</p>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <div id="rowLeaveType" class="hidden flex items-center gap-4 px-6 py-5 rounded-2xl bg-gray-50 border border-gray-100 sm:col-span-2">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-amber-50">
                        <x-heroicon-o-document-text class="w-5 h-5"/>
                    </div>
                    <div>
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Type of Leave</p>
                        <p id="viewLeaveType" class="text-sm font-semibold text-gray-800"></p>
                    </div>
                </div>

                <div id="rowLocation" class="flex items-start gap-4 px-6 py-5 rounded-2xl bg-gray-50 border border-gray-100 sm:col-span-2">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-amber-50">
                        <x-heroicon-o-map-pin class="w-5 h-5"/>
                    </div>
                    <div class="truncate">
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Location</p>
                        <p id="viewLocation" class="text-sm font-semibold text-gray-800 whitespace-normal break-words leading-relaxed"></p>
                    </div>
                </div>

                <div id="rowFocalPerson" class="flex items-center gap-4 px-6 py-5 rounded-2xl bg-gray-50 border border-gray-100">
                    <div class="flex items-center justify-center w-10 h-10 rounded-xl bg-amber-50">
                        <x-heroicon-o-user class="w-5 h-5"/>
                    </div>
                    <div class="calendar-event-focal-person-content">
                        <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Focal Person(s)</p>
                        <div id="viewFocalPerson" class="calendar-event-focal-person-list"></div>
                    </div>
                </div>
            </div>

            <div id="rowNotes" class="flex items-center gap-4 px-6 py-5 rounded-2xl bg-gray-50 border border-gray-100">
                <div class="flex items-center gap-3 mb-3">
                    <div class="flex items-center justify-center w-9 h-9 rounded-lg bg-amber-50">
                        <x-heroicon-o-pencil-square class="w-5 h-5"/>
                    </div>
                    <span class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">Remarks & Notes</span>
                </div>
                <p id="viewNotes" class="text-sm text-gray-600 leading-relaxed italic">No additional notes provided.</p>
            </div>
        </div>

        <!-- Footer (unchanged) -->
        <div class="flex justify-between items-center pt-6 border-t border-gray-100">
            <p class="text-[11px] font-bold text-gray-400 uppercase tracking-widest">
                Created by: <span id="viewCreatedBy" class="text-gray-900 ml-1"></span>
            </p>
            <span id="viewVisibility" class="inline-flex items-center rounded-full bg-amber-50 px-4 py-1.5 text-[11px] font-bold text-amber-600 ring-1 ring-amber-200 uppercase"></span>
        </div>
    </div>
</div>

<!-- DELETE CONFIRMATION MODAL (unchanged) -->
<div id="deleteConfirmModal" class="fixed inset-0 z-[999999] hidden items-center justify-center bg-black/50 backdrop-blur-sm" role="dialog">
    <div class="bg-white rounded-2xl w-full max-w-md p-6 shadow-2xl">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-xl font-bold text-gray-800">Confirm Delete</h3>
            <button onclick="closeDeleteConfirmModal()" class="text-gray-400 hover:text-gray-600">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
            </button>
        </div>
        <div class="mb-6">
            <p id="deleteConfirmMessage" class="text-gray-700">Are you sure you want to delete this event?</p>
            <p class="text-red-500 text-sm mt-2">This action cannot be undone.</p>
        </div>
        <div class="flex justify-end gap-3">
            <button onclick="closeDeleteConfirmModal()" class="px-4 py-2 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition">Cancel</button>
            <button id="confirmDeleteBtn" class="px-4 py-2 bg-red-600 text-white rounded-lg hover:bg-red-700 transition">Delete</button>
        </div>
    </div>
</div>

<!-- GLOBAL TOAST (unchanged) -->
<div id="globalToast" class="fixed top-5 right-5 z-[999999] hidden flex items-center gap-2 px-5 py-3 rounded-lg shadow-md transition-all duration-300">
    <span id="toastMessage" class="text-sm font-medium"></span>
</div>

<style>
/* existing styles ... */
#viewModalCard { padding: 2rem !important; margin: 0 !important; box-shadow: 0 30px 80px rgba(0,0,0,0.12) !important; border-radius: 1rem !important; width: min(92vw, 640px) !important; max-height: 90vh !important; overflow-y: auto !important; }
#viewModal { z-index: 999999 !important; }
body.modal-open { overflow: hidden !important; height: 100vh; }
#viewModal svg { stroke: #f59e0b !important; color: #f59e0b !important; }
#viewModal #deleteEventBtn svg { stroke: currentColor !important; color: inherit !important; }
.toast-success { background-color: #ecfdf5; border: 1px solid #10b981; color: #065f46; }
.toast-error { background-color: #fef2f2; border: 1px solid #ef4444; color: #b91c1c; }
.toast-info { background-color: #eff6ff; border: 1px solid #3b82f6; color: #1e40af; }

/* Dashboard mode: hide edit/delete, show go-to-calendar button */
#viewModal.dashboard-mode #editEventBtn,
#viewModal.dashboard-mode #deleteEventBtn {
    display: none !important;
}
#viewModal.dashboard-mode #goToCalendarBtn {
    display: inline-flex !important;
}
</style>

<script>
if (!window.openModal) {
    window.openModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        document.body.style.overflow = "hidden";
    };
}

if (!window.closeModal) {
    window.closeModal = function(modalId) {
        const modal = document.getElementById(modalId);
        if (!modal) return;
        modal.classList.add("hidden");
        modal.classList.remove("flex");
        document.body.style.overflow = "auto";
        // Remove dashboard mode class when closing
        modal.classList.remove('dashboard-mode');
    };
}
/* =========================================================
   TOAST & DELETE CONFIRMATION (unchanged)
========================================================= */
function showToast(message, type = 'success') {
    const toast = document.getElementById('globalToast');
    const msgSpan = document.getElementById('toastMessage');
    if (!toast) return;
    toast.classList.remove('toast-success', 'toast-error', 'toast-info');
    toast.classList.add(`toast-${type}`);
    msgSpan.textContent = message;
    toast.classList.remove('hidden');
    toast.classList.add('flex');
    setTimeout(() => {
        toast.classList.add('hidden');
        toast.classList.remove('flex');
    }, 3000);
}

let pendingDeleteId = null;

function openDeleteConfirmModal(eventId, eventTitle = 'this event') {
    pendingDeleteId = eventId;
    const msgEl = document.getElementById('deleteConfirmMessage');
    if (msgEl) msgEl.innerHTML = `Are you sure you want to delete <strong>${escapeHtml(eventTitle)}</strong>?`;
    const modal = document.getElementById('deleteConfirmModal');
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }
}

function closeDeleteConfirmModal() {
    const modal = document.getElementById('deleteConfirmModal');
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }
    pendingDeleteId = null;
}

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
   OPEN ADD MODAL
========================================================= */
function openAddModal(type) {
    const map = { event: "eventModal", holiday: "holidayModal", leave: "leaveModal", offsite: "offsiteModal", official_business: "offsiteModal" };
    const modalId = map[type];
    const titles = { eventModal: "Add Activity", holidayModal: "Add Holiday", leaveModal: "Add Leave", offsiteModal: "Add Off Site" };
    const form = document.querySelector(`#${modalId} form`);
    const typeSelect = form?.querySelector("[data-create-event-type]");
    if (form) {
        form.querySelector("[data-create-type-select-wrapper]")?.classList.remove("hidden");
        const typeInput = form.querySelector('[name="type"]');
        if (typeInput) typeInput.value = type;
        const focalPersonSelect = form.querySelector('[name="focal_person_id"]');
        const focalPersonCheckboxes = form.querySelectorAll('[name="focal_person_ids[]"]');
        const isMultipleFocalPersonType = ["leave", "official_business"].includes(type)
            && focalPersonCheckboxes.length > 0;
        form.querySelector("[data-single-focal-person]")?.classList.toggle("hidden", isMultipleFocalPersonType);
        form.querySelector("[data-multiple-focal-person]")?.classList.toggle("hidden", !isMultipleFocalPersonType);
        focalPersonCheckboxes.forEach(checkbox => {
            checkbox.disabled = !isMultipleFocalPersonType;
        });
        if (focalPersonSelect) {
            focalPersonSelect.disabled = isMultipleFocalPersonType;
            focalPersonSelect.required = !isMultipleFocalPersonType;
        }
    }
    if (typeSelect) typeSelect.value = type;

    const titleEl = document.getElementById(modalId + "Title");
    if (titleEl) titleEl.textContent = type === "official_business" ? "Add Official Business" : titles[modalId];
    const submitButton = document.querySelector(`#${modalId} .calendar-modal-submit-btn`);
    if (submitButton && modalId === "offsiteModal") {
        submitButton.textContent = type === "official_business"
            ? "Save Official Business"
            : "Save Off Site";
    }
    openModal(modalId);
}

/* =========================================================
   FIELD SETTER (unchanged)
========================================================= */
function setField(id, value, isLink = false) {
    const el = document.getElementById(id);
    if (!el) return;

    // Truncate title to 100 characters in the view modal
    if (id === 'viewTitle') {
        let title = value || 'Not defined';
        if (title.length > 100) {
            title = title.substring(0, 100) + '…';
        }
        el.textContent = title;
        return;
    }

    if (id === 'viewNotes') {
        let displayText = value || 'No additional notes provided.';
        if (displayText.length > 1000) {
            displayText = displayText.substring(0, 1000) + '…';
        }
        el.textContent = displayText;
        return;
    }

    if (!value) {
        el.textContent = "Not defined";
        return;
    }
    if (isLink) {
        el.innerHTML = `<a href="${value}" target="_blank" class="text-blue-600 underline truncate block">Open Link</a>`;
        return;
    }
    el.textContent = value;
}

function formatReadableDate(dateObj, includeTime = false) {
    if (!dateObj || isNaN(dateObj.getTime())) return "Invalid date";
    const dateStr = dateObj.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
    if (!includeTime) return dateStr;
    const timeStr = dateObj.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
    return `${dateStr}, ${timeStr}`;
}

function formatEventDate(start, end) {
    if (!start) return "Not defined";
    const startDate = new Date(start);
    const endDate = end ? new Date(end) : null;
    const isAllDay = !endDate || (startDate.getHours() === 0 && startDate.getMinutes() === 0 && endDate.getHours() === 23 && endDate.getMinutes() === 59);
    if (isAllDay) {
        if (!endDate || startDate.toDateString() === endDate.toDateString()) return formatReadableDate(startDate, false);
        return `${formatReadableDate(startDate, false)} - ${formatReadableDate(endDate, false)}`;
    }
    if (!endDate) return formatReadableDate(startDate, true);
    const sameDay = startDate.toDateString() === endDate.toDateString();
    if (sameDay) {
        const datePart = formatReadableDate(startDate, false);
        const startTime = startDate.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
        const endTime = endDate.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
        return `${datePart}, ${startTime} – ${endTime}`;
    }
    const startDateStr = formatReadableDate(startDate, false);
    const endDateStr = formatReadableDate(endDate, false);
    const startTime = startDate.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
    const endTime = endDate.toLocaleTimeString('en-US', { hour: 'numeric', minute: '2-digit', hour12: true });
    return `${startDateStr} - ${endDateStr}, ${startTime} – ${endTime}`;
}

function applyViewModalLayout(type) {
    const rows = {
        link: document.getElementById("rowLink"),
        location: document.getElementById("rowLocation"),
        leaveType: document.getElementById("rowLeaveType"),
        focal: document.getElementById("rowFocalPerson"),
        notes: document.getElementById("rowNotes")
    };
    Object.values(rows).forEach(row => { if (row) row.style.display = "none"; });
    type = (type || "").toLowerCase();
    const layout = { event: ["link", "location", "notes"], holiday: ["notes"], leave: ["leaveType", "focal", "notes"], offsite: ["location", "focal", "notes"], official_business: ["location", "focal", "notes"] };
    (layout[type] || []).forEach(key => { if (rows[key]) rows[key].style.display = key === "notes" ? "block" : "flex"; });
}



// For dashboard usage: open by ID with dashboard mode
window.openViewModalById = async function(id, fromDashboard = false) {
    try {
        const response = await fetch(`/calendar/events/${id}`);
        const event = await response.json();
        openViewModal({ id: event.id, title: event.title, start: event.start_date, end: event.end_date, extendedProps: event }, fromDashboard);
    } catch (error) {
        console.error("Error fetching event:", error);
        showToast("Could not load event", "error");
    }
};

/* =========================================================
   DELETE EVENT (using custom confirmation modal)
========================================================= */
document.getElementById("deleteEventBtn").addEventListener("click", function () {
    const eventId = this.getAttribute("data-id");
    const eventTitle = document.getElementById("viewTitle")?.innerText || "this event";
    if (eventId) openDeleteConfirmModal(eventId, eventTitle);
});

document.getElementById("confirmDeleteBtn").addEventListener("click", async function () {
    if (!pendingDeleteId) return;
    try {
        const response = await fetch(`/calendar/events/${pendingDeleteId}`, { method: "DELETE", headers: { "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')?.content, "Content-Type": "application/json" } });
        const data = await response.json();
        if (data.success) {
            closeDeleteConfirmModal();
            closeModal("viewModal");
            showToast("Event deleted successfully", "success");

            // ✅ Refresh calendar & upcoming events
            if (window.calendar) window.calendar.refetchEvents();
            if (typeof window.refreshUpcomingEventsWithFilters === 'function') {
                window.refreshUpcomingEventsWithFilters();
            }
        } else {
            showToast(data.message || "Failed to delete event", "error");
        }
    } catch (error) {
        console.error("Delete error:", error);
        showToast("An error occurred while deleting the event", "error");
    } finally {
        pendingDeleteId = null;
    }
});

document.getElementById("editEventBtn").addEventListener("click", async function () {
    const id = this.getAttribute("data-id");
    if (!id) {
        console.error("No event ID found");
        return;
    }
    
    try {
        const response = await fetch(`/calendar/events/${id}`);
        const event = await response.json();

        // Close the view modal
        closeModal("viewModal");

        // Which modal to open?
        const map = {
            event: "eventModal",
            offsite: "offsiteModal",
            official_business: "offsiteModal",
            leave: "leaveModal",
            holiday: "holidayModal"
        };
        const type = (event.type || "").toLowerCase();
        const modalId = map[type] || "eventModal";
        const titles = {
            eventModal: "Edit Activity",
            holidayModal: "Edit Holiday",
            leaveModal: "Edit Leave",
            offsiteModal: type === "official_business" ? "Edit Official Business" : "Edit Off Site"
        };
        const titleEl = document.getElementById(modalId + "Title");
        if (titleEl) titleEl.textContent = titles[modalId];

        openModal(modalId);
        const form = document.querySelector(`#${modalId} form`);
        if (!form) {
            console.error(`Form not found for modal ${modalId}`);
            return;
        }
        form.querySelector("[data-create-type-select-wrapper]")?.classList.add("hidden");

        // Set up PUT request
        form.setAttribute("data-editing", "true");
        
        let methodField = form.querySelector('input[name="_method"]');
        if (!methodField) {
            methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            form.appendChild(methodField);
        }
        methodField.value = 'PUT';
        
        form.action = `/calendar/events/${id}`;

        if (modalId === "eventModal") {
            const typeSelect = form.querySelector("[data-create-event-type]");
            if (typeSelect) typeSelect.value = type;
        }

        // ---------- Populate text fields ----------
        const setVal = (name, value) => {
            const el = form.querySelector(`[name="${name}"]`);
            if (el) el.value = value ?? "";
        };
        
        setVal("title", event.title);
        setVal("type", event.type);
        setVal("leave_type", event.leave_type);
        setVal("leave_type_other", event.leave_type_other);
        form.querySelector("[data-leave-type]")?.dispatchEvent(new Event("change"));
        setVal("location", event.location || "");
        setVal("link", event.link || "");
        setVal("notes", event.notes || "");
        
        // Update notes counter
        const notesTextarea = form.querySelector("#notesTextarea");
        const notesCounter = document.getElementById("notesCounter");
        if (notesTextarea && notesCounter) {
            notesCounter.textContent = (notesTextarea.value || "").length;
        }
        
        // ---------- Handle Focal Person Selection ----------
        const focalPersonSelect = form.querySelector("[name='focal_person_id']");
        const focalPersonCheckboxes = form.querySelectorAll("[name='focal_person_ids[]']");
        const singleFocalPerson = form.querySelector("[data-single-focal-person]");
        const multipleFocalPerson = form.querySelector("[data-multiple-focal-person]");
        const isMultipleFocalPersonType = ["leave", "official_business"].includes(event.type);
        if (singleFocalPerson) singleFocalPerson.classList.toggle("hidden", isMultipleFocalPersonType);
        if (multipleFocalPerson) multipleFocalPerson.classList.toggle("hidden", !isMultipleFocalPersonType);
        focalPersonCheckboxes.forEach(checkbox => {
            checkbox.disabled = !isMultipleFocalPersonType;
        });
        if (focalPersonSelect) {
            focalPersonSelect.disabled = isMultipleFocalPersonType;
            focalPersonSelect.required = !isMultipleFocalPersonType;
        }
        if (focalPersonSelect) {
            // Populate dropdown if empty
            if (focalPersonSelect.options.length <= 1 && window.usersData) {
                window.usersData.forEach(user => {
                    const option = document.createElement('option');
                    option.value = user.id;
                    option.textContent = user.name;
                    focalPersonSelect.appendChild(option);
                });
            }
            
            // Set the selected value if available
            if (event.focal_person_id) {
                focalPersonSelect.value = event.focal_person_id;
            }
            
            // Trigger change event to update section if needed
            focalPersonSelect.dispatchEvent(new Event("change"));
        }
        const selectedFocalPersonIds = event.focal_person_ids || (event.focal_person_id ? [event.focal_person_id] : []);
        focalPersonCheckboxes.forEach(checkbox => {
            checkbox.checked = selectedFocalPersonIds.map(String).includes(checkbox.value);
        });
        
        // ---------- Handle Section Selection ----------
        const sectionSelect = form.querySelector("[name='section_id']");
        if (sectionSelect && event.section_id) {
            sectionSelect.value = event.section_id;
            sectionSelect.dispatchEvent(new Event("change"));
        }
        
        // Visibility
        const visibilitySelect = form.querySelector("[name='visibility_type']");
        if (visibilitySelect) {
            visibilitySelect.value = event.visibility_type ?? "global";
            visibilitySelect.dispatchEvent(new Event("change"));
        }

        // ---------- CRITICAL: Date / time handling - PRESERVE ORIGINAL VALUES ----------
        const isAllDay = event.is_all_day === true;
        const allDayCheck = form.querySelector("[name='all_day']");
        
        if (allDayCheck) {
            allDayCheck.checked = isAllDay;
            allDayCheck.dispatchEvent(new Event("change"));
        }

        // IMPORTANT: Store the original date values for the form
        if (isAllDay) {
            // For all-day events, use the original start_display and end_display
            const startDate = event.start_display || event.start_date;
            const endDate = event.end_display || event.end_date;
            
            setVal("start_date", startDate);
            setVal("end_date", endDate);
            setVal("single_date", "");
            setVal("start_time", "");
            setVal("end_time", "");
        } else {
            // For timed events, use the original start_date and end_date from the response
            // These are already in the correct format from your controller
            if (event.start_date) {
                setVal("start_date", event.start_date);
            }
            if (event.end_date) {
                setVal("end_date", event.end_date);
            }
            
            // Also set the single_date and times for display in the form
            if (event.start_date) {
                const startDateTime = new Date(event.start_date);
                if (!isNaN(startDateTime.getTime())) {
                    const dateStr = startDateTime.toISOString().split('T')[0];
                    const timeStr = startDateTime.toLocaleTimeString('en-US', { 
                        hour: '2-digit', 
                        minute: '2-digit',
                        hour12: false 
                    });
                    setVal("single_date", dateStr);
                    setVal("start_time", timeStr);
                }
            }
            
            if (event.end_date) {
                const endDateTime = new Date(event.end_date);
                if (!isNaN(endDateTime.getTime())) {
                    const timeStr = endDateTime.toLocaleTimeString('en-US', { 
                        hour: '2-digit', 
                        minute: '2-digit',
                        hour12: false 
                    });
                    setVal("end_time", timeStr);
                }
            }
        }
        
        // Debug: Log what we're about to submit
        console.log("Edit form data:", {
            id: id,
            title: form.querySelector("[name='title']")?.value,
            focal_person_ids: Array.from(form.querySelectorAll("[name='focal_person_ids[]']:checked"), checkbox => checkbox.value),
            focal_person_id: form.querySelector("[name='focal_person_id']")?.value,
            start_date: form.querySelector("[name='start_date']")?.value,
            end_date: form.querySelector("[name='end_date']")?.value,
            is_all_day: isAllDay
        });
        
    } catch (error) {
        console.error("Error loading event for edit:", error);
        if (typeof showToast === "function") {
            showToast("Could not load event data", "error");
        }
    }
});

/* =========================================================
   CLICK OUTSIDE CLOSE (unchanged)
========================================================= */
window.addEventListener("mousedown", function(e){
    const modal = document.getElementById("viewModal");
    const card = document.getElementById("viewModalCard");
    if(modal && !modal.classList.contains("hidden")){
        if(card && !card.contains(e.target)) closeModal("viewModal");
    }
});
</script>