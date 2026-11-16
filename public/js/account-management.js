// account-management.js

// ================================
// FILTER FUNCTIONS
// ================================
window.clearSearch = function () {
    const input = document.querySelector('input[name="name"]');
    if (input) {
        input.value = "";
        input.form.submit();
    }
};

window.toggleDropdown = function (dropdownId) {
    const target = document.getElementById(dropdownId);
    document.querySelectorAll('.dropdown-menu').forEach(menu => {
        if (menu.id !== dropdownId) menu.classList.remove('show');
    });
    if (target) target.classList.toggle('show');
};

document.addEventListener('click', function (event) {
    document.querySelectorAll('[data-dropdown]').forEach(dropdown => {
        if (!dropdown.contains(event.target)) {
            const menu = dropdown.querySelector('.dropdown-menu');
            if (menu) menu.classList.remove('show');
        }
    });
});

// ================================
// COLOR PICKER SYNC
// ================================
document.addEventListener('DOMContentLoaded', function () {
    const colorInput = document.getElementById('sectionColor');
    const hexInput = document.getElementById('sectionColorHex');
    if (colorInput && hexInput) {
        colorInput.addEventListener('input', function () {
            hexInput.value = this.value.toUpperCase();
        });
        hexInput.addEventListener('input', function () {
            let value = this.value.trim();
            if (value && !value.startsWith('#')) value = '#' + value;
            value = value.toUpperCase();
            if (/^#([0-9A-F]{3}){1,2}$/.test(value)) colorInput.value = value;
            this.value = value;
        });
    }
});

// ================================
// SECTION MODAL
// ================================
function getSectionModalElements() {
    return {
        modal: document.getElementById('sectionModal'),
        title: document.getElementById('sectionModalTitle'),
        idInput: document.getElementById('sectionId'),
        nameInput: document.getElementById('sectionName'),
        colorInput: document.getElementById('sectionColor'),
    };
}

window.openSectionModal = function () {
    const { modal, title, idInput, nameInput, colorInput } = getSectionModalElements();
    const hexInput = document.getElementById('sectionColorHex');
    title.innerText = "Add Section";
    idInput.value = "";
    nameInput.value = "";
    colorInput.value = "#000000";
    if (hexInput) hexInput.value = "#000000";
    modal.classList.remove('hidden');
};

window.editSection = function (id, name, color) {
    const { modal, title, idInput, nameInput, colorInput } = getSectionModalElements();
    const hexInput = document.getElementById('sectionColorHex');
    title.innerText = "Edit Section";
    idInput.value = id;
    nameInput.value = name;
    colorInput.value = color;
    if (hexInput) hexInput.value = color.toUpperCase();
    modal.classList.remove('hidden');
};

window.closeSectionModal = function () {
    const { modal } = getSectionModalElements();
    modal.classList.add('hidden');
};

window.saveSection = function () {
    const { idInput, nameInput, colorInput } = getSectionModalElements();
    const sectionId = idInput.value;
    const sectionName = nameInput.value.trim();
    const sectionColor = colorInput.value;
    if (!sectionName) {
        showDynamicToast('Section name is required.', 'error');
        return;
    }

    const url = sectionId ? `/sections/${sectionId}` : `/sections`;
    const method = sectionId ? 'PUT' : 'POST';

    fetch(url, {
        method: method,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ name: sectionName, color: sectionColor })
    })
    .then(async response => {
        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Failed to save section');
        }
        return response.json();
    })
    .then(data => {
        closeSectionModal();
        showDynamicToast(data.message || 'Section saved successfully', 'success');
        setTimeout(() => location.reload(), 500);
    })
    .catch(error => {
        showDynamicToast(error.message || 'Error saving section', 'error');
    });
};

window.deleteSection = async function (sectionId, sectionName = 'this section') {
    const confirmed = await showConfirmModal({
        title: 'Delete Section',
        message: `Are you sure you want to delete "${sectionName}"?`,
        confirmText: 'Delete',
        warning: 'This action cannot be undone.'
    });
    if (!confirmed) return;

    try {
        const response = await fetch(`/sections/${sectionId}`, {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json'
            }
        });
        if (!response.ok) {
            const error = await response.json();
            throw new Error(error.message || 'Failed to delete section');
        }
        const data = await response.json();
        showDynamicToast(data.message || 'Section deleted successfully', 'success');
        setTimeout(() => location.reload(), 500);
    } catch (error) {
        showDynamicToast(error.message, 'error');
    }
};

// ================================
// UTILITY FUNCTIONS
// ================================
function escapeHtml(str) {
    if (!str) return '';
    return String(str)
        .replace(/&/g, '&amp;')
        .replace(/</g, '&lt;')
        .replace(/>/g, '&gt;')
        .replace(/"/g, '&quot;')
        .replace(/'/g, '&#039;');
}

function showDynamicToast(message, type = 'success') {
    const existing = document.getElementById('dynamicToast');
    if (existing) existing.remove();

    const toast = document.createElement('div');
    toast.id = 'dynamicToast';
    toast.className = `fixed top-6 right-6 z-[9999] w-96 max-w-full p-4 rounded-lg border-l-4 ${
        type === 'success' ? 'border-green-600' : 'border-red-600'
    } bg-white shadow-xl flex items-center gap-3`;

    toast.innerHTML = `
        <svg class="w-6 h-6 ${type === 'success' ? 'text-green-600' : 'text-red-600'} flex-shrink-0" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            ${type === 'success' 
                ? '<path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>'
                : '<path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/>'
            }
        </svg>
        <span class="${type === 'success' ? 'text-green-800' : 'text-red-800'} text-sm font-medium">${message}</span>
        <button onclick="this.parentElement.remove()" class="ml-auto ${type === 'success' ? 'text-green-600' : 'text-red-600'} font-bold">×</button>
    `;

    document.body.appendChild(toast);
    setTimeout(() => toast.remove(), 4000);
}

// ================================
// CONFIRMATION MODAL (Promise-based)
// ================================
window.showConfirmModal = function(options) {
    return new Promise((resolve) => {
        const modal = document.getElementById('confirmModal');
        if (!modal) return resolve(false);

        document.getElementById('confirmModalTitle').innerText = options.title || 'Confirm Delete';
        document.getElementById('confirmModalMessage').innerText = options.message || 'Are you sure you want to delete this item?';
        const warningEl = document.getElementById('confirmModalWarning');
        if (options.warning === false) {
            warningEl.style.display = 'none';
        } else {
            warningEl.style.display = 'block';
            warningEl.innerText = options.warning || 'This action cannot be undone.';
        }
        document.getElementById('confirmModalBtn').innerText = options.confirmText || 'Delete';

        const onConfirm = () => {
            closeConfirmModal();
            resolve(true);
        };
        const onCancel = () => {
            closeConfirmModal();
            resolve(false);
        };

        // Store handlers on the modal element
        modal._confirmHandler = onConfirm;
        modal._cancelHandler = onCancel;

        modal.classList.add('show');
    });
};

window.closeConfirmModal = function() {
    const modal = document.getElementById('confirmModal');
    if (!modal) return;
    modal.classList.remove('show');
    delete modal._confirmHandler;
    delete modal._cancelHandler;
};

// ================================
// INLINE EDIT FOR SECTION & ROLE
// ================================
document.addEventListener('DOMContentLoaded', function () {
    // --- Modal event listeners (once) ---
    const modal = document.getElementById('confirmModal');
    const confirmBtn = document.getElementById('confirmModalBtn');
    if (confirmBtn) {
        confirmBtn.addEventListener('click', function() {
            if (modal._confirmHandler) modal._confirmHandler();
        });
    }
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) closeConfirmModal();
        });
        // Close button and cancel button already have onclick="closeConfirmModal()" in HTML
    }

    // --- Data from Blade ---
    const sectionsData = window.sectionsData || [];
    const rolesData = window.rolesData || [];

    function buildSectionSelect(currentSectionId) {
        let html = `<select class="edit-section-select form-select">`;
        html += `<option value="">No Section</option>`;
        sectionsData.forEach(section => {
            const selected = (currentSectionId == section.id) ? 'selected' : '';
            html += `<option value="${section.id}" ${selected}>${escapeHtml(section.name)}</option>`;
        });
        html += `</select>`;
        return html;
    }

    function buildRoleSelect(currentRole) {
        let html = `<select class="edit-role-select form-select">`;
        rolesData.forEach(role => {
            const selected = (currentRole === role) ? 'selected' : '';
            html += `<option value="${role}" ${selected}>${role}</option>`;
        });
        html += `</select>`;
        return html;
    }

    async function saveRowChanges(row, oldSectionId, oldRole, oldNickname) {
        const userId = row.dataset.userId;
        const sectionSelect = row.querySelector('.edit-section-select');
        const roleSelect = row.querySelector('.edit-role-select');
        const nicknameInput = row.querySelector('.edit-nickname-input');

        if (!sectionSelect || !roleSelect || !nicknameInput) {
            console.error('Could not find account edit fields');
            return;
        }

        const newSectionId = sectionSelect.value;
        const newRole = roleSelect.value;
        const newNickname = nicknameInput.value.trim();

        // ---------- Admin Transfer Confirmation ----------
        const isCurrentUserAdmin = window.currentUserRole === 'Admin';
        const targetUserId = parseInt(userId);
        const isTargetSelf = targetUserId === window.currentUserId;
        const isNewRoleAdmin = newRole === 'Admin';
        const isOldRoleAdmin = oldRole === 'Admin';

        let confirmAdminTransfer = false;

        if (isNewRoleAdmin && !isOldRoleAdmin && isCurrentUserAdmin && !isTargetSelf && window.adminCount >= 1) {
            const confirmed = await showConfirmModal({
                title: 'Transfer Administrative Role',
                message: 'Are you sure you want to pass the Administrative role to this user? You will lose admin privileges.',
                confirmText: 'Transfer',
                warning: 'This action cannot be undone.'
            });
            if (!confirmed) {
                cancelRowEdit(row);
                return;
            }
            confirmAdminTransfer = true;
        }
        // ------------------------------------------------

        const saveBtn = row.querySelector('.save-row-btn');
        const cancelBtn = row.querySelector('.cancel-row-btn');
        if (saveBtn) saveBtn.disabled = true;
        if (cancelBtn) cancelBtn.disabled = true;
        if (saveBtn) saveBtn.innerHTML = '<i class="bi bi-hourglass-split"></i> Saving...';

        const requests = [];
        if (newSectionId != oldSectionId) {
            requests.push(fetch(window.updateSectionUrl(userId), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ _method: 'PATCH', section_id: newSectionId })
            }));
        }
        if (newRole != oldRole) {
            const rolePayload = { _method: 'PATCH', role: newRole };
            if (confirmAdminTransfer) {
                rolePayload.confirm_admin_transfer = true;
            }
            requests.push(fetch(window.updateRoleUrl(userId), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify(rolePayload)
            }));
        }
        if (newNickname !== oldNickname) {
            requests.push(fetch(window.updateNicknameUrl(userId), {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ _method: 'PATCH', nickname: newNickname })
            }));
        }

        if (requests.length === 0) {
            cancelRowEdit(row);
            return;
        }

        try {
            const responses = await Promise.all(requests);
            const messages = [];

            for (const res of responses) {
                if (!res.ok) {
                    let errorMsg = `Error ${res.status}`;
                    try {
                        const errorData = await res.json();
                        errorMsg = errorData.message || errorMsg;
                    } catch (e) {}
                    throw new Error(errorMsg);
                }
                const data = await res.json();
                messages.push(data.message);
            }

            if (newSectionId != oldSectionId) row.dataset.sectionId = newSectionId;
            if (newRole != oldRole) row.dataset.role = newRole;
            if (newNickname !== oldNickname) row.dataset.nickname = newNickname;

            cancelRowEdit(row);
            showDynamicToast(messages.join(' '), 'success');

            if (confirmAdminTransfer) {
                window.adminCount = 1;
                window.currentUserRole = 'Employee';
                // Redirect demoted admin to dashboard after a short delay to see the toast
                setTimeout(() => {
                    window.location.href = window.dashboardUrl;
                }, 1500);
            } else {
                // For non-transfer updates, optionally reload or just stay
                // If you want to reflect changes without full reload, you can skip reload
                // But to keep filters/state, a reload is fine
                setTimeout(() => location.reload(), 500);
            }
        } catch (error) {
            showDynamicToast(error.message || "Failed to update. Please try again.", 'error');
            cancelRowEdit(row);
        }
    }

    function cancelRowEdit(row, originalSectionHtml, originalRoleHtml, originalActionsHtml) {
        const nicknameDisplay = row.querySelector('.nickname-display');
        const sectionCell = row.querySelector('.section-cell');
        const roleCell = row.querySelector('.role-cell');
        const actionsCell = row.querySelector('.actions-cell');

        if (originalSectionHtml !== undefined && sectionCell) {
            sectionCell.innerHTML = originalSectionHtml;
        } else {
            const sectionId = row.dataset.sectionId;
            const section = window.sectionsData.find(s => s.id == sectionId);
            const sectionName = section ? section.name : 'No Section';
            if (sectionCell) {
                sectionCell.innerHTML = `<span class="section-display">${escapeHtml(sectionName)}</span>`;
            }
        }

        if (originalRoleHtml !== undefined && roleCell) {
            roleCell.innerHTML = originalRoleHtml;
        } else {
            const role = row.dataset.role;
            if (roleCell) {
                roleCell.innerHTML = `<span class="role-display">${escapeHtml(role)}</span>`;
            }
        }

        if (originalActionsHtml !== undefined && actionsCell) {
            actionsCell.innerHTML = originalActionsHtml;
        } else if (actionsCell) {
            const originalActions = actionsCell.getAttribute('data-original-actions');
            if (originalActions) {
                actionsCell.innerHTML = originalActions;
            }
        }

        if (nicknameDisplay) {
            nicknameDisplay.textContent = `Nickname: ${row.dataset.nickname || '—'}`;
        }

        row.classList.remove('editing');

        const editBtn = row.querySelector('.edit-row-btn');
        if (editBtn) {
            editBtn.removeEventListener('click', handleEditClick);
            editBtn.addEventListener('click', handleEditClick);
        }
    }

    function handleEditClick(e) {
        const row = e.currentTarget.closest('.account-row');
        if (!row || row.classList.contains('editing')) return;

        const sectionDisplaySpan = row.querySelector('.section-display');
        const roleDisplaySpan = row.querySelector('.role-display');
        const nicknameDisplay = row.querySelector('.nickname-display');

        if (!sectionDisplaySpan || !roleDisplaySpan || !nicknameDisplay) {
            console.error('Missing display spans in row');
            return;
        }

        const originalSectionHtml = sectionDisplaySpan.outerHTML;
        const originalRoleHtml = roleDisplaySpan.outerHTML;
        const originalSectionId = row.dataset.sectionId || '';
        const originalRole = row.dataset.role;
        const originalNickname = row.dataset.nickname || '';

        const sectionCell = row.querySelector('.section-cell');
        const roleCell = row.querySelector('.role-cell');
        const actionsCell = row.querySelector('.actions-cell');

        if (!sectionCell || !roleCell || !actionsCell) {
            console.error('Missing required cells');
            return;
        }

        const sectionSelectHtml = buildSectionSelect(originalSectionId);
        const roleSelectHtml = buildRoleSelect(originalRole);

        nicknameDisplay.innerHTML = `<input type="text" class="edit-nickname-input" maxlength="255" value="${escapeHtml(originalNickname)}" placeholder="Nickname (optional)" aria-label="Nickname">`;
        sectionCell.setAttribute('data-original-content', originalSectionHtml);
        roleCell.setAttribute('data-original-content', originalRoleHtml);
        sectionCell.innerHTML = sectionSelectHtml;
        roleCell.innerHTML = roleSelectHtml;

        const originalActionsHtml = actionsCell.innerHTML;
        actionsCell.setAttribute('data-original-actions', originalActionsHtml);
        actionsCell.innerHTML = `
            <div class="action-buttons-wrapper">
                <button type="button" class="save-row-btn btn-success"><i class="bi bi-check-lg"></i> Save</button>
                <button type="button" class="cancel-row-btn btn-secondary"><i class="bi bi-x-lg"></i> Cancel</button>
            </div>
        `;
        row.classList.add('editing');

        const saveBtn = actionsCell.querySelector('.save-row-btn');
        const cancelBtn = actionsCell.querySelector('.cancel-row-btn');

        if (saveBtn) {
            saveBtn.addEventListener('click', () => saveRowChanges(row, originalSectionId, originalRole, originalNickname));
        }
        if (cancelBtn) {
            cancelBtn.addEventListener('click', () => {
                cancelRowEdit(row, originalSectionHtml, originalRoleHtml, originalActionsHtml);
            });
        }
    }

    function attachEditListeners() {
        document.querySelectorAll('.edit-row-btn').forEach(btn => {
            btn.removeEventListener('click', handleEditClick);
            btn.addEventListener('click', handleEditClick);
        });
    }

    attachEditListeners();

    // ================================
    // USER ARCHIVING & DECLINE CONFIRMATION
    // ================================
    document.querySelectorAll('.delete-user-form').forEach(form => {
        const btn = form.querySelector('.delete-row-btn');
        if (!btn) return;
        btn.addEventListener('click', async function(e) {
            e.preventDefault();
            const userName = form.dataset.userName || 'this user';
            const confirmed = await showConfirmModal({
                title: 'Confirm Archive',
                message: `Are you sure you want to archive "${userName}"?`,
                confirmText: 'Archive',
                warning: 'This account will be deactivated. You can activate it again from the user archive.'
            });
            if (confirmed) form.submit();
        });
    });

    document.querySelectorAll('.decline-user-form').forEach(form => {
        const btn = form.querySelector('button');
        if (!btn) return;
        btn.addEventListener('click', async (e) => {
            e.preventDefault();
            const userName = form.dataset.userName || 'this user';
            const confirmed = await showConfirmModal({
                title: 'Decline Request',
                message: `Are you sure you want to decline the account request for "${userName}"?`,
                confirmText: 'Decline',
                warning: 'This action cannot be undone.'
            });
            if (confirmed) form.submit();
        });
    });
});