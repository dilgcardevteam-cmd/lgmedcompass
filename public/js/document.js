
        function openUploadModal() {
    document.getElementById('uploadModal').style.display = 'flex';
}

function closeUploadModal() {
    document.getElementById('uploadModal').style.display = 'none';
}

// Close when clicking outside modal
document.getElementById('uploadModal').addEventListener('click', function(e) {
    if (e.target === this) closeUploadModal();
});

// Close on ESC
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') closeUploadModal();
});

   document.addEventListener('DOMContentLoaded', function () {
    const deleteModal = document.getElementById('deleteModal');
    const deleteForm  = document.getElementById('deleteForm');

    deleteModal.addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const action = button.getAttribute('data-action');

        deleteForm.action = action;
    });
});
   let searchTimeout = null;

document.getElementById('liveSearch').addEventListener('keyup', function () {

    clearTimeout(searchTimeout);

    searchTimeout = setTimeout(() => {

        let searchValue = this.value;

        fetch(`/documents/live-search?search=${searchValue}`)
            .then(response => response.json())
            .then(data => {

                let results = document.getElementById('documentResults');
                results.innerHTML = '';

                if (data.length === 0) {
                    results.innerHTML = `
                        <div class="table-row">
                            <div>No documents found.</div>
                        </div>
                    `;
                    return;
                }

                data.forEach(doc => {

                    results.innerHTML += `
                        <div class="table-row">

                            <div class="subject-column">
                                <div class="subject-title">
                                    ${doc.subject_title}
                                </div>
                                <div class="subject-focal">
                                    Focal Person: ${doc.focal_person}
                                </div>
                            </div>

                            <div>
                                <div class="progress-bar-wrapper">
                                    <div class="progress-bar-fill" style="width:50%;">
                                        50%
                                    </div>
                                </div>
                            </div>

                            <div class="status-cell">
                                <span class="status blue">In Progress</span>
                            </div>

                            <div>
                                ${new Date(doc.deadline).toLocaleDateString()}
                            </div>

                            <div class="actions">
                                <button class="edit-btn">Edit</button>
                            </div>

                        </div>
                    `;
                });
            });

    }, 300); // 300ms delay (prevents server spam)
});
document.addEventListener('DOMContentLoaded', () => {

    document.querySelectorAll('.real-file-input').forEach(input => {

        input.addEventListener('change', function () {
            const wrapper = this.closest('.file-input-wrapper');
            const placeholder = wrapper.querySelector('.file-placeholder');

            if (!this.files || this.files.length === 0) return;

            // Clear existing displayed files
            placeholder.innerHTML = '';

            // Show newly selected files
            Array.from(this.files).forEach(file => {
                const span = document.createElement('span');
                span.className = 'file-pill';
                span.textContent = '📄 ' + file.name;
                placeholder.appendChild(span);
            });
        });

    });

});

document.addEventListener('change', function (e) {

    if (!e.target.classList.contains('real-file-input')) return;

    const input = e.target;
    const wrapper = input.closest('.file-input-wrapper');
    const placeholder = wrapper.querySelector('.file-placeholder');

    if (!input.files.length) {
        placeholder.textContent = 'No file chosen';
        return;
    }

    placeholder.innerHTML = '';

    Array.from(input.files).forEach(file => {
        const span = document.createElement('span');
        span.className = 'file-pill';
        span.textContent = '📄 ' + file.name;
        placeholder.appendChild(span);
    });
});
