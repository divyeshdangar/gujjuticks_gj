<script>
    (function() {
        document.querySelectorAll('[data-copy-update-url]').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var url = btn.getAttribute('data-copy-update-url');
                if (!url || !navigator.clipboard) {
                    return;
                }
                navigator.clipboard.writeText(url).then(function() {
                    var original = btn.textContent;
                    btn.textContent = 'Link copied!';
                    btn.classList.add('btn-success');
                    btn.classList.remove('btn-outline-secondary');
                    setTimeout(function() {
                        btn.textContent = original;
                        btn.classList.remove('btn-success');
                        btn.classList.add('btn-outline-secondary');
                    }, 2000);
                });
            });
        });
    })();
</script>
