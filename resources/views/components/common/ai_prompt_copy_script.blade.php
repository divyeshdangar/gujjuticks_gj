<script>
    (function() {
        var csrfEl = document.getElementById('ai-prompts-csrf');
        var csrfToken = csrfEl ? csrfEl.getAttribute('data-csrf') : '';

        function fallbackCopy(text) {
            var textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.setAttribute('readonly', '');
            textarea.style.position = 'fixed';
            textarea.style.left = '-9999px';
            document.body.appendChild(textarea);
            textarea.select();
            try {
                return document.execCommand('copy');
            } catch (error) {
                return false;
            } finally {
                document.body.removeChild(textarea);
            }
        }

        function copyPromptText(prompt) {
            if (!prompt) {
                return Promise.reject(new Error('Prompt text is empty.'));
            }

            if (navigator.clipboard && navigator.clipboard.writeText) {
                return navigator.clipboard.writeText(prompt).catch(function() {
                    if (fallbackCopy(prompt)) {
                        return;
                    }
                    return Promise.reject(new Error('Copy failed.'));
                });
            }

            if (fallbackCopy(prompt)) {
                return Promise.resolve();
            }

            return Promise.reject(new Error('Copy failed.'));
        }

        function setButtonState(button, label, disabled, timeoutMs, resetLabel) {
            button.textContent = label;
            button.disabled = !!disabled;

            if (timeoutMs && resetLabel) {
                setTimeout(function() {
                    button.textContent = resetLabel;
                    button.disabled = false;
                }, timeoutMs);
            }
        }

        function updateCopyCount(uniqueId, copyCount) {
            if (typeof copyCount !== 'number' || !isFinite(copyCount)) {
                return;
            }

            document.querySelectorAll('.js-copy-count').forEach(function(counter) {
                if (counter.getAttribute('data-uid') === uniqueId) {
                    counter.textContent = copyCount.toLocaleString() + ' copies';
                    counter.setAttribute('data-copy-count', String(copyCount));
                }
            });
        }

        document.querySelectorAll('.copy-prompt-btn').forEach(function(btn) {
            btn.addEventListener('click', function() {
                var button = this;
                var prompt = button.getAttribute('data-prompt');
                var url = button.getAttribute('data-copy-url');
                var uniqueId = button.getAttribute('data-unique-id');
                var originalLabel = button.textContent;

                copyPromptText(prompt).then(function() {
                    setButtonState(button, 'Copied!', true, 2000, originalLabel);

                    if (!url || !csrfToken) {
                        return;
                    }

                    var fd = new FormData();
                    fd.append('_token', csrfToken);

                    fetch(url, {
                        method: 'POST',
                        body: fd,
                        headers: {
                            'Accept': 'application/json',
                            'X-Requested-With': 'XMLHttpRequest'
                        }
                    }).then(function(response) {
                        if (!response.ok) {
                            return null;
                        }
                        return response.json();
                    }).then(function(data) {
                        if (data && data.success) {
                            updateCopyCount(uniqueId, Number(data.copy_count));
                        }
                    }).catch(function() {});
                }).catch(function() {
                    setButtonState(button, 'Copy failed', true, 1800, originalLabel);
                });
            });
        });
    })();
</script>
