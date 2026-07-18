/**
 * Custom select UI for the contact form.
 * Keeps the native <select> for form submit + accessibility fallback.
 */
(function () {
    'use strict';

    function enhanceSelect(select) {
        if (select.dataset.ctEnhanced === '1') {
            return;
        }
        select.dataset.ctEnhanced = '1';

        var field = select.closest('.ct-field');
        var wrap = document.createElement('div');
        wrap.className = 'ct-select';
        if (field && field.classList.contains('is-invalid')) {
            wrap.classList.add('is-invalid');
        }

        select.classList.add('ct-select__native');
        select.parentNode.insertBefore(wrap, select);
        wrap.appendChild(select);

        var trigger = document.createElement('button');
        trigger.type = 'button';
        trigger.className = 'ct-select__trigger';
        trigger.setAttribute('aria-haspopup', 'listbox');
        trigger.setAttribute('aria-expanded', 'false');
        if (select.id) {
            trigger.id = select.id + '-trigger';
            var label = document.querySelector('label[for="' + select.id + '"]');
            if (label) {
                trigger.setAttribute('aria-labelledby', label.id || select.id + '-label');
                if (!label.id) {
                    label.id = select.id + '-label';
                }
            }
        }

        var valueEl = document.createElement('span');
        valueEl.className = 'ct-select__value';
        trigger.appendChild(valueEl);

        var chevron = document.createElement('span');
        chevron.className = 'ct-select__chevron';
        chevron.setAttribute('aria-hidden', 'true');
        trigger.appendChild(chevron);

        var list = document.createElement('ul');
        list.className = 'ct-select__list';
        list.setAttribute('role', 'listbox');
        list.setAttribute('aria-hidden', 'true');

        wrap.appendChild(trigger);
        wrap.appendChild(list);

        function selectedOption() {
            return select.options[select.selectedIndex] || null;
        }

        function syncFromSelect() {
            var opt = selectedOption();
            var text = opt ? opt.textContent : '';
            var empty = !opt || opt.value === '';
            valueEl.textContent = text;
            wrap.classList.toggle('is-placeholder', empty);
            Array.prototype.forEach.call(list.children, function (li) {
                var active = li.dataset.value === select.value;
                li.classList.toggle('is-selected', active);
                li.setAttribute('aria-selected', active ? 'true' : 'false');
            });
        }

        function buildOptions() {
            list.innerHTML = '';
            Array.prototype.forEach.call(select.options, function (opt, index) {
                var li = document.createElement('li');
                li.className = 'ct-select__option';
                li.setAttribute('role', 'option');
                li.dataset.value = opt.value;
                li.dataset.index = String(index);
                li.textContent = opt.textContent;
                if (opt.disabled) {
                    li.classList.add('is-disabled');
                    li.setAttribute('aria-disabled', 'true');
                }
                list.appendChild(li);
            });
            syncFromSelect();
        }

        function open() {
            if (wrap.classList.contains('is-open')) {
                return;
            }
            document.querySelectorAll('.ct-select.is-open').forEach(function (other) {
                if (other !== wrap) {
                    other.classList.remove('is-open');
                    var t = other.querySelector('.ct-select__trigger');
                    var l = other.querySelector('.ct-select__list');
                    if (t) t.setAttribute('aria-expanded', 'false');
                    if (l) l.setAttribute('aria-hidden', 'true');
                }
            });
            list.setAttribute('aria-hidden', 'false');
            void wrap.offsetWidth;
            wrap.classList.add('is-open');
            trigger.setAttribute('aria-expanded', 'true');
            window.requestAnimationFrame(function () {
                var selected = list.querySelector('.ct-select__option.is-selected:not(.is-disabled)')
                    || list.querySelector('.ct-select__option:not(.is-disabled)');
                if (selected) {
                    selected.focus();
                }
            });
        }

        function close(focusTrigger) {
            if (!wrap.classList.contains('is-open')) {
                return;
            }
            wrap.classList.remove('is-open');
            trigger.setAttribute('aria-expanded', 'false');
            window.setTimeout(function () {
                if (!wrap.classList.contains('is-open')) {
                    list.setAttribute('aria-hidden', 'true');
                }
            }, 220);
            if (focusTrigger !== false) {
                trigger.focus();
            }
        }

        function choose(li) {
            if (!li || li.classList.contains('is-disabled')) {
                return;
            }
            select.selectedIndex = Number(li.dataset.index);
            select.dispatchEvent(new Event('change', { bubbles: true }));
            syncFromSelect();
            close(true);
        }

        trigger.addEventListener('click', function (e) {
            e.preventDefault();
            if (wrap.classList.contains('is-open')) {
                close(true);
            } else {
                open();
            }
        });

        trigger.addEventListener('keydown', function (e) {
            if (e.key === 'ArrowDown' || e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                open();
            }
        });

        list.addEventListener('click', function (e) {
            var li = e.target.closest('.ct-select__option');
            if (li) {
                choose(li);
            }
        });

        list.addEventListener('keydown', function (e) {
            var options = Array.prototype.filter.call(
                list.querySelectorAll('.ct-select__option:not(.is-disabled)'),
                function () { return true; }
            );
            var current = document.activeElement;
            var idx = options.indexOf(current);

            if (e.key === 'Escape') {
                e.preventDefault();
                close(true);
                return;
            }
            if (e.key === 'ArrowDown') {
                e.preventDefault();
                var next = options[Math.min(idx + 1, options.length - 1)] || options[0];
                if (next) next.focus();
                return;
            }
            if (e.key === 'ArrowUp') {
                e.preventDefault();
                var prev = options[Math.max(idx - 1, 0)] || options[0];
                if (prev) prev.focus();
                return;
            }
            if (e.key === 'Enter' || e.key === ' ') {
                e.preventDefault();
                choose(current && current.classList.contains('ct-select__option') ? current : null);
            }
        });

        // Make options focusable when open
        list.addEventListener('mousedown', function (e) {
            // Prevent trigger blur race before click
            e.preventDefault();
        });

        document.addEventListener('click', function (e) {
            if (!wrap.contains(e.target)) {
                close(false);
            }
        });

        select.addEventListener('change', syncFromSelect);

        buildOptions();

        // Options need tabindex for keyboard nav
        Array.prototype.forEach.call(list.children, function (li) {
            if (!li.classList.contains('is-disabled')) {
                li.tabIndex = -1;
            }
        });
    }

    function init() {
        document.querySelectorAll('.ct-panel select').forEach(enhanceSelect);
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
})();
