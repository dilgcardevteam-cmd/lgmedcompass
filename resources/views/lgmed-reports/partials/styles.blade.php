<style>
    .lr-page { max-width: 100%; padding: 1.5rem; font-family: 'Figtree', sans-serif; color: #1f2937; }
    .lr-head { display: flex; flex-wrap: wrap; justify-content: space-between; align-items: center; gap: 1rem; margin-bottom: 1rem; }
    .lr-head h1 { font-size: 1.5rem; font-weight: 700; margin: 0; }
    .lr-card { background: #fff; border: 1px solid #fde7b0; border-radius: .75rem; box-shadow: 0 4px 14px rgba(120, 53, 15, .06); padding: 1rem; }
    .lr-filters { display: flex; flex-wrap: wrap; gap: .75rem; align-items: flex-end; margin-bottom: 1rem; }
    .lr-filters label { display: block; font-size: .75rem; font-weight: 600; color: #6b7280; margin-bottom: .2rem; }
    .lr-filters input, .lr-filters select, .lr-field input, .lr-field select, .lr-field textarea {
        width: 100%; border: 1px solid #d1d5db; border-radius: .5rem; padding: .45rem .6rem; font-size: .875rem; background: #fff;
    }
    .lr-filters .lr-search { min-width: 240px; flex: 1; }
    .lr-btn { display: inline-flex; align-items: center; gap: .35rem; border: 0; border-radius: .5rem; padding: .5rem .9rem; font-size: .875rem; font-weight: 600; cursor: pointer; text-decoration: none; background: #f59e0b; color: #fff; }
    .lr-btn:hover { background: #d97706; }
    .lr-btn.secondary { background: #e5e7eb; color: #374151; }
    .lr-btn.secondary:hover { background: #d1d5db; }
    .lr-btn.danger { background: #ef4444; }
    .lr-btn.danger:hover { background: #dc2626; }
    .lr-btn.sm { padding: .3rem .55rem; font-size: .75rem; }
    .lr-table-wrap { overflow-x: auto; border: 1px solid #f3f4f6; border-radius: .5rem; }
    .lr-table { width: 100%; border-collapse: collapse; font-size: .875rem; table-layout: fixed; min-width: 2800px; }
    .lr-table th { background: #fef3c7; text-align: left; padding: .8rem 1rem; white-space: normal; line-height: 1.3; border-bottom: 2px solid #f6c76f; position: sticky; top: 0; }
    .lr-table td { padding: .85rem 1rem; border-bottom: 1px solid #f3f4f6; vertical-align: top; line-height: 1.55; overflow-wrap: anywhere; word-break: break-word; white-space: pre-line; }
    .lr-table tbody tr:nth-child(even) td { background: #fffdf7; }
    .lr-table tr:hover td { background: #fffbeb; }
    .lr-table td.lr-actions { white-space: nowrap; }
    .lr-table td.lr-actions .lr-btn { margin-right: .25rem; }
    .lr-table td .lr-badge { display: inline-block; vertical-align: top; padding: 0 .65rem; line-height: 1.35rem; }
    .lr-badge { display: inline-block; padding: .1rem .5rem; border-radius: 999px; font-size: .7rem; font-weight: 600; background: #d1fae5; color: #065f46; }
    .lr-badge.off { background: #e5e7eb; color: #4b5563; }
    .lr-empty { text-align: center; padding: 2rem; color: #6b7280; }
    .lr-flash { padding: .75rem 1rem; border-radius: .5rem; margin-bottom: 1rem; font-size: .875rem; }
    .lr-flash.success { background: #d1fae5; color: #065f46; }
    .lr-flash.error { background: #fee2e2; color: #991b1b; }
    .lr-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 1rem; }
    .lr-field.full { grid-column: 1 / -1; }
    .lr-field label { display: block; font-size: .8rem; font-weight: 600; margin-bottom: .25rem; }
    .lr-field .lr-hint, .lr-hint { font-size: .72rem; color: #9ca3af; font-weight: 400; margin-top: .2rem; }
    .lr-legend { font-size: .95rem; font-weight: 700; color: #92400e; padding: 0 .4rem; }

    .lr-dialog { position: fixed; inset: 0; margin: auto; width: min(900px, calc(100vw - 32px)); max-height: calc(100vh - 32px); padding: 24px; overflow-y: auto; border: 0; border-radius: 20px; color: #1e293b; box-shadow: 0 24px 70px rgba(15, 23, 42, .3); }
    .lr-dialog-x { position: sticky; top: 0; float: right; z-index: 5; margin: 0 0 0 8px; padding: 0; border: 0; background: transparent; color: #525252; font-size: 28px; line-height: 1; cursor: pointer; }
    .lr-dialog-x:hover { color: #1e293b; }
    .lr-dialog::backdrop { background: rgba(15, 23, 42, .55); }
    .lr-dialog h2 { margin: 0 0 6px; font-size: 1.4rem; font-weight: 800; }
    .lr-dialog .lr-sub { margin: 0 0 16px; font-size: .85rem; color: #64748b; }
    .lr-dialog fieldset { border: 1px solid #e2e8f0; border-radius: 14px; padding: 12px 14px 14px; margin: 0 0 14px; }
    .lr-dialog input:focus-visible, .lr-dialog select:focus-visible, .lr-dialog textarea:focus-visible, .lr-dialog button:focus-visible { outline: 3px solid #f59e0b; outline-offset: 2px; }
    .lr-dialog .lr-field input, .lr-dialog .lr-field select, .lr-dialog .lr-field textarea { border-color: #cbd5e1; border-radius: 10px; padding: 10px 12px; }
    .lr-dialog .lr-field input[type="checkbox"], .lr-dialog input[type="checkbox"] {
        -webkit-appearance: checkbox; appearance: auto; width: 16px; height: 16px; min-width: 16px; padding: 0; margin: 0;
        border: 0; flex-shrink: 0; accent-color: #1e293b; cursor: pointer; background: transparent;
    }
    .lr-dialog-actions { display: flex; justify-content: flex-end; gap: 10px; margin-top: 6px; }
    .lr-dialog-actions button { padding: 10px 14px; border: 0; border-radius: 10px; font: inherit; font-weight: 700; cursor: pointer; }
    .lr-dialog-cancel { background: #e2e8f0; color: #1e293b; }
    .lr-dialog-submit { background: #1e293b; color: #fff; }
    .lr-dialog-delete { background: #dc2626; color: #fff; }
    .lr-dialog-delete:hover { background: #b91c1c; }
    .lr-alert { background: #fee2e2; color: #991b1b; border-radius: 10px; padding: 10px 12px; font-size: .85rem; margin-bottom: 14px; }
    .lr-alert ul { margin: 0; padding-left: 1.1rem; }
    .lr-multi { border: 1px solid #cbd5e1; border-radius: 10px; padding: 6px 10px; max-height: 220px; overflow-y: auto; }
    .lr-multi label { display: flex; align-items: center; gap: .5rem; font-weight: 400; font-size: .8rem; margin: 0; padding: 3px 0; }
    .lr-delete-body { display: flex; align-items: flex-start; gap: 16px; }
    .lr-delete-icon { display: flex; width: 44px; height: 44px; flex-shrink: 0; align-items: center; justify-content: center; border-radius: 50%; background: #fee2e2; color: #b91c1c; font-size: 20px; }
    .lr-error { color: #dc2626; font-size: .75rem; margin-top: .2rem; }
    .lr-muted { color: #9ca3af; }
    .lr-tag { display: inline-flex; align-items: center; gap: .3rem; padding: .15rem .65rem; border-radius: 999px; font-size: .75rem; font-weight: 600; background: #fef3c7; color: #92400e; }
    .lr-detail-hero { background: linear-gradient(135deg, #fffbeb, #fef3c7); border: 1px solid #fde7b0; border-radius: 1rem; padding: 1.5rem 1.75rem; margin-bottom: 1rem; box-shadow: 0 4px 14px rgba(120, 53, 15, .06); }
    .lr-detail-tags { display: flex; flex-wrap: wrap; gap: .5rem; align-items: center; margin-bottom: 1rem; }
    .lr-detail-title { margin: .25rem 0 0; font-size: 1.5rem; line-height: 1.4; font-weight: 700; color: #1e293b; white-space: pre-line; overflow-wrap: anywhere; }
    .lr-detail-section { margin-bottom: 1rem; padding: 1.25rem 1.5rem; }
    .lr-detail-heading { margin: 0 0 1rem; padding-bottom: .6rem; border-bottom: 1px solid #fde7b0; font-size: 1rem; font-weight: 700; color: #92400e; }
    .lr-detail-grid { display: grid; grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 1.25rem 2rem; }
    .lr-detail-item.wide { grid-column: 1 / -1; }
    .lr-detail-label { font-size: .72rem; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; color: #6b7280; margin-bottom: .3rem; }
    .lr-detail-value { font-size: .95rem; line-height: 1.6; color: #1f2937; overflow-wrap: anywhere; }
    .lr-pre { white-space: pre-line; }
    .lr-chips { display: flex; flex-wrap: wrap; gap: .5rem; }
    .lr-chip { display: inline-flex; align-items: center; gap: .4rem; padding: .3rem .75rem; border-radius: 999px; background: #f1f5f9; color: #1e293b; font-size: .85rem; font-weight: 500; white-space: normal; }
    @media (max-width: 700px) { .lr-detail-grid { grid-template-columns: 1fr; } }
</style>
