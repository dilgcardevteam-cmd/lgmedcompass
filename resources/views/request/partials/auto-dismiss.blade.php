<script>
    document.querySelectorAll('[data-auto-dismiss]').forEach((message) => {
        const delay = Number(message.dataset.autoDismiss);

        window.setTimeout(() => {
            message.classList.replace('opacity-100', 'opacity-0');
            window.setTimeout(() => message.remove(), 500);
        }, delay);
    });
</script>
