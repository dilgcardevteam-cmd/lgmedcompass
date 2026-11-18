<dialog class="lr-dialog" id="lrFormDialog" aria-labelledby="lrFormTitle">
    <button type="button" class="lr-dialog-x" data-lr-close aria-label="Close">✕</button>
    <h2 id="lrFormTitle">Add Report</h2>
    <p class="lr-sub">Only <strong>PPA</strong> is required. Leave the rest blank if not applicable.</p>

    @if ($errors->any())
        <div class="lr-alert" role="alert">
            <ul>
                @foreach ($errors->all() as $message)
                    <li>{{ $message }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('lgmed-reports.store') }}" id="lrForm" data-store-url="{{ route('lgmed-reports.store') }}" data-update-url="{{ route('lgmed-reports.update', '__ID__') }}">
        @csrf
        <input type="hidden" name="_method" value="POST" id="lrMethod" disabled>
        <input type="hidden" name="_mode" value="create" id="lrMode">
        <input type="hidden" name="_edit_id" value="" id="lrEditId">

        <fieldset>
            <legend class="lr-legend">Basic information</legend>
            <div class="lr-grid">
                <div class="lr-field">
                    <label for="lr_item_no">No.</label>
                    <input type="number" id="lr_item_no" name="item_no" min="1">
                </div>
                <div class="lr-field full">
                    <label for="lr_ppa">PPA *</label>
                    <textarea id="lr_ppa" name="ppa" rows="2" required></textarea>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend class="lr-legend">Schedule</legend>
            <div class="lr-grid">
                <div class="lr-field">
                    <label for="lr_frequency">Frequency</label>
                    <select id="lr_frequency" name="frequency">
                        <option value="">Select how often the report is due</option>
                        @foreach ($dropdowns['frequency'] as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                    <input type="text" id="lr_frequency_other" name="frequency_other" maxlength="255" placeholder="Specify frequency" style="display:none; margin-top:.4rem;">
                </div>
                <div class="lr-field">
                    <label for="lr_timelines">Timelines (Report Submission to RO)</label>
                    <textarea id="lr_timelines" name="timelines" rows="2"></textarea>
                    <div class="lr-hint">e.g. "Not later than April 30"</div>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend class="lr-legend">Responsible persons &amp; section</legend>
            <div class="lr-grid">
                <div class="lr-field full">
                    <label for="lr_section">Section</label>
                    <select id="lr_section" name="section">
                        <option value="">Select the section in charge</option>
                        @foreach ($dropdowns['section'] as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="lr-field">
                    <label>Focal Person</label>
                    <div class="lr-multi" data-multi="focal_person">
                        @foreach ($dropdowns['person'] as $person)
                            <label><input type="checkbox" name="focal_person[]" value="{{ $person }}"> {{ $person }}</label>
                        @endforeach
                    </div>
                    <div class="lr-hint">Tick one or more people.</div>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend class="lr-legend">Submission</legend>
            <div class="lr-grid">
                <div class="lr-field">
                    <label for="lr_mode_of_submission">Mode of Submission</label>
                    <textarea id="lr_mode_of_submission" name="mode_of_submission" rows="2"></textarea>
                    <div class="lr-hint">e.g. "Through Google Sheet"</div>
                </div>
                <div class="lr-field">
                    <label for="lr_monitoring_link">Monitoring Link</label>
                    <textarea id="lr_monitoring_link" name="monitoring_link" rows="2"></textarea>
                    <div class="lr-hint">Paste the full URL starting with https://</div>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend class="lr-legend">Classification &amp; references</legend>
            <div class="lr-grid">
                <div class="lr-field">
                    <label for="lr_end_user_level">End User Level</label>
                    <select id="lr_end_user_level" name="end_user_level">
                        <option value="">Select who submits the report</option>
                        @foreach ($dropdowns['end_user_level'] as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="lr-field">
                    <label for="lr_ppa_category">PPA Category</label>
                    <select id="lr_ppa_category" name="ppa_category">
                        <option value="">Select a category</option>
                        @foreach ($dropdowns['ppa_category'] as $option)
                            <option value="{{ $option }}">{{ $option }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="lr-field">
                    <label for="lr_legal_basis_reference">Legal Basis/ Reference</label>
                    <textarea id="lr_legal_basis_reference" name="legal_basis_reference" rows="2"></textarea>
                    <div class="lr-hint">e.g. "DILG MC No. 2022-124"</div>
                </div>
                <div class="lr-field">
                    <label for="lr_reference_link">Reference Link</label>
                    <textarea id="lr_reference_link" name="reference_link" rows="2"></textarea>
                </div>
                <div class="lr-field full">
                    <label for="lr_remarks">Remarks</label>
                    <textarea id="lr_remarks" name="remarks" rows="2"></textarea>
                </div>
            </div>
        </fieldset>

        <fieldset>
            <legend class="lr-legend">Status</legend>
            <label style="font-size:.875rem; display:flex; gap:.5rem; align-items:center;">
                <input type="hidden" name="is_active" value="0">
                <input type="checkbox" name="is_active" value="1" id="lr_is_active" checked>
                Active <span class="lr-hint">(untick to mark as inactive, e.g. deferred or transferred)</span>
            </label>
        </fieldset>

        <div class="lr-dialog-actions">
            <button type="button" class="lr-dialog-cancel" data-lr-close>Cancel</button>
            <button type="submit" class="lr-dialog-submit" id="lrSubmit">Create report</button>
        </div>
    </form>
</dialog>

<dialog class="lr-dialog" id="lrDeleteDialog" style="width:min(440px, calc(100vw - 32px));" aria-labelledby="lrDeleteTitle">
    <div class="lr-delete-body">
        <div class="lr-delete-icon" aria-hidden="true"><i class="bi bi-exclamation-triangle-fill"></i></div>
        <div>
            <h2 id="lrDeleteTitle">Delete report?</h2>
            <p class="lr-sub" style="margin:8px 0 0;">Permanently delete <strong id="lrDeleteName"></strong>? This action cannot be undone.</p>
        </div>
    </div>
    <form method="POST" id="lrDeleteForm" class="lr-dialog-actions" style="margin-top:24px;">
        @csrf
        @method('DELETE')
        <button type="button" class="lr-dialog-cancel" data-lr-close>Cancel</button>
        <button type="submit" class="lr-dialog-delete">Delete</button>
    </form>
</dialog>

<script>
    (function () {
        const dialog = document.getElementById('lrFormDialog');
        const deleteDialog = document.getElementById('lrDeleteDialog');
        const form = document.getElementById('lrForm');
        if (!dialog || !form) { return; }

        const OTHER = @json(\App\Models\LgmedReport::OTHER_FREQUENCY);
        const frequency = form.elements['frequency'];
        const frequencyOther = form.elements['frequency_other'];
        const method = document.getElementById('lrMethod');

        function toggleOther() {
            frequencyOther.style.display = frequency.value === OTHER ? 'block' : 'none';
        }

        function ensureOption(select, value) {
            if (value && ![...select.options].some(o => o.value === value)) {
                select.add(new Option(value, value));
            }
        }

        function resetForm() {
            form.reset();
            form.querySelectorAll('[data-extra]').forEach(el => el.remove());
            form.querySelectorAll('select option[data-extra-option]').forEach(el => el.remove());
            toggleOther();
        }

        function fill(values) {
            ['item_no', 'ppa', 'timelines', 'mode_of_submission', 'monitoring_link',
             'legal_basis_reference', 'reference_link',
             'remarks', 'frequency_other'].forEach(name => {
                form.elements[name].value = values[name] ?? '';
            });

            ['section', 'end_user_level', 'ppa_category'].forEach(name => {
                const select = form.elements[name];
                ensureOption(select, values[name]);
                select.value = values[name] ?? '';
            });

            const freq = values.frequency ?? '';
            if (freq && ![...frequency.options].some(o => o.value === freq)) {
                frequency.value = OTHER;
                frequencyOther.value = freq;
            } else {
                frequency.value = freq;
            }
            toggleOther();

            ['focal_person'].forEach(name => {
                const box = form.querySelector('[data-multi="' + name + '"]');
                const raw = values[name] ?? '';
                const names = (Array.isArray(raw) ? raw : String(raw).split(/\r?\n/)).map(v => v.trim()).filter(Boolean);
                names.forEach(person => {
                    let checkbox = [...box.querySelectorAll('input')].find(i => i.value === person);
                    if (!checkbox) {
                        const label = document.createElement('label');
                        label.dataset.extra = '1';
                        checkbox = document.createElement('input');
                        checkbox.type = 'checkbox';
                        checkbox.name = name + '[]';
                        checkbox.value = person;
                        label.append(checkbox, ' ' + person);
                        box.prepend(label);
                    }
                    checkbox.checked = true;
                });
            });

            if ('is_active' in values) {
                form.querySelector('#lr_is_active').checked = String(values.is_active) === '1' || values.is_active === true;
            }
        }

        function openCreate() {
            resetForm();
            form.action = form.dataset.storeUrl;
            method.disabled = true;
            document.getElementById('lrMode').value = 'create';
            document.getElementById('lrEditId').value = '';
            document.getElementById('lrFormTitle').textContent = 'Add Report';
            document.getElementById('lrSubmit').textContent = 'Create report';
            dialog.showModal();
        }

        function openEdit(id, values) {
            resetForm();
            fill(values);
            form.action = form.dataset.updateUrl.replace('__ID__', id);
            method.value = 'PUT';
            method.disabled = false;
            document.getElementById('lrMode').value = 'edit';
            document.getElementById('lrEditId').value = id;
            document.getElementById('lrFormTitle').textContent = 'Edit Report';
            document.getElementById('lrSubmit').textContent = 'Save changes';
            dialog.showModal();
        }

        frequency.addEventListener('change', toggleOther);

        document.querySelectorAll('[data-lr-add]').forEach(btn => btn.addEventListener('click', openCreate));
        document.querySelectorAll('[data-lr-edit]').forEach(btn => btn.addEventListener('click', () => {
            openEdit(btn.dataset.lrEdit, JSON.parse(btn.dataset.report));
        }));
        document.querySelectorAll('[data-lr-delete]').forEach(btn => btn.addEventListener('click', () => {
            document.getElementById('lrDeleteName').textContent = btn.dataset.name;
            document.getElementById('lrDeleteForm').action = btn.dataset.lrDelete;
            deleteDialog.showModal();
        }));
        document.querySelectorAll('[data-lr-close]').forEach(btn => btn.addEventListener('click', () => {
            btn.closest('dialog').close();
        }));
        [dialog, deleteDialog].forEach(d => d.addEventListener('click', event => {
            if (event.target === d) { d.close(); }
        }));

        @if ($errors->any())
            const oldInput = @json(old());
            if (oldInput._mode === 'edit' && oldInput._edit_id) {
                openEdit(oldInput._edit_id, oldInput);
            } else {
                openCreate();
                fill(oldInput);
            }
        @endif
    })();
</script>
