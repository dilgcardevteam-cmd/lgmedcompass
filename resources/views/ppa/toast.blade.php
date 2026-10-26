<div
    id="ppaToastContainer"
    style="
        position: fixed;
        top: 1.5rem;
        right: 1.5rem;
        z-index: 99999;
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
        max-width: 24rem;
        width: 100%;
        pointer-events: none;
    "
>
    @if (session('success'))
        <script>
            window.addEventListener('load', function() {
                window.showPpaSuccessToast(@json(session('success')));
            });
        </script>
    @endif

    @if (session('error'))
        <script>
            window.addEventListener('load', function() {
                window.showPpaErrorToast(@json(session('error')));
            });
        </script>
    @endif
</div>

<style>
    #ppaToastContainer .toast-item {
        pointer-events: auto;
        display: flex;
        align-items: flex-start;
        gap: 0.75rem;
        padding: 1rem;
        border-radius: 0.75rem;
        background: white;
        box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1), 0 8px 10px -6px rgba(0, 0, 0, 0.1);
        animation: toastSlideIn 0.35s ease-out;
        position: relative;
        border-left: 4px solid #f59e0b;
    }

    #ppaToastContainer .toast-item.toast-error {
        border-left-color: #ef4444;
    }

    #ppaToastContainer .toast-item.toast-success {
        border-left-color: #10b981;
    }

    #ppaToastContainer .toast-item .toast-icon {
        flex-shrink: 0;
        width: 1.5rem;
        height: 1.5rem;
    }

    #ppaToastContainer .toast-item .toast-icon svg {
        width: 100%;
        height: 100%;
    }

    #ppaToastContainer .toast-item .toast-body {
        flex: 1;
        font-size: 0.875rem;
        line-height: 1.4;
        color: #1f2937;
    }

    #ppaToastContainer .toast-item .toast-close {
        background: none;
        border: none;
        font-size: 1.25rem;
        line-height: 1;
        cursor: pointer;
        color: #6b7280;
        padding: 0;
        margin-left: auto;
        flex-shrink: 0;
    }

    #ppaToastContainer .toast-item .toast-close:hover {
        color: #1f2937;
    }

    @keyframes toastSlideIn {
        from {
            opacity: 0;
            transform: translateX(2rem);
        }

        to {
            opacity: 1;
            transform: translateX(0);
        }
    }
</style>

<script>
    (function() {
        const container = document.getElementById('ppaToastContainer');

        function removeToast(element) {
            element.style.transition = 'opacity 0.3s, transform 0.3s';
            element.style.opacity = '0';
            element.style.transform = 'translateX(2rem)';
            setTimeout(function() {
                element.remove();
            }, 300);
        }

        function appendToast(type, message) {
            if (!container) {
                return;
            }

            const icons = {
                success: '<svg fill="none" stroke="#10b981" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/></svg>',
                error: '<svg fill="none" stroke="#ef4444" stroke-width="2" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01M5.07 19h13.86c1.54 0 2.5-1.67 1.73-3L13.73 4c-.77-1.33-2.69-1.33-3.46 0L3.34 16c-.77 1.33.19 3 1.73 3z"/></svg>',
                info: '<svg fill="none" stroke="#f59e0b" stroke-width="2" viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>',
            };

            const toast = document.createElement('div');
            toast.className = `toast-item toast-${type}`;

            const icon = document.createElement('div');
            icon.className = 'toast-icon';
            icon.innerHTML = icons[type] || icons.info;

            const body = document.createElement('div');
            body.className = 'toast-body';
            body.textContent = String(message ?? '');

            const closeButton = document.createElement('button');
            closeButton.type = 'button';
            closeButton.className = 'toast-close';
            closeButton.textContent = 'x';
            closeButton.addEventListener('click', function() {
                toast.remove();
            });

            toast.append(icon, body, closeButton);
            container.appendChild(toast);

            setTimeout(function() {
                if (toast.parentNode) {
                    removeToast(toast);
                }
            }, 4000);
        }

        window.showPpaToast = function(type, message) {
            appendToast(type, message);
        };

        window.showPpaSuccessToast = function(message) {
            window.showPpaToast('success', message);
        };

        window.showPpaErrorToast = function(message) {
            window.showPpaToast('error', message);
        };

        window.showPpaInfoToast = function(message) {
            window.showPpaToast('info', message);
        };
    })();
</script>
