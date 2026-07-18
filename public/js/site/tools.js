(function () {
    if (!document.body.classList.contains("site-body--tools")) return;

    // Brief wizard
    var wizard = document.querySelector("[data-tl-wizard]");
    if (wizard) {
        var steps = Array.prototype.slice.call(wizard.querySelectorAll("[data-tl-step]"));
        var dots = Array.prototype.slice.call(document.querySelectorAll("[data-tl-step-dot]"));
        var idx = 0;

        function show(i) {
            idx = Math.max(0, Math.min(steps.length - 1, i));
            steps.forEach(function (step, n) {
                var on = n === idx;
                step.hidden = !on;
                step.classList.toggle("is-on", on);
            });
            dots.forEach(function (dot, n) {
                dot.classList.toggle("is-on", n === idx);
                dot.classList.toggle("is-done", n < idx);
            });
        }

        function validateStep(i) {
            var step = steps[i];
            if (!step) return true;
            var required = Array.prototype.slice.call(
                step.querySelectorAll("input[required], select[required], textarea[required]")
            );
            for (var r = 0; r < required.length; r++) {
                var el = required[r];
                if (el.type === "radio") {
                    var name = el.name;
                    var checked = step.querySelector('input[name="' + name + '"]:checked');
                    if (!checked) {
                        el.focus();
                        return false;
                    }
                } else if (!el.value || !String(el.value).trim()) {
                    el.focus();
                    return false;
                }
            }
            return true;
        }

        wizard.addEventListener("click", function (e) {
            var next = e.target.closest("[data-tl-next]");
            var prev = e.target.closest("[data-tl-prev]");
            if (next) {
                if (!validateStep(idx)) return;
                show(idx + 1);
            }
            if (prev) show(idx - 1);
        });

        // If validation errors exist, jump to last step (contact)
        if (wizard.querySelector(".tl-alert")) {
            show(steps.length - 1);
        } else {
            show(0);
        }
    }

    // Estimate calculator
    var estimateRoot = document.querySelector("[data-tl-estimate]");
    if (!estimateRoot) return;

    var config;
    try {
        config = JSON.parse(estimateRoot.getAttribute("data-tl-config") || "{}");
    } catch (e) {
        config = {};
    }

    var weeksEl = estimateRoot.querySelector("[data-tl-weeks]");
    var budgetEl = estimateRoot.querySelector("[data-tl-budget]");
    var summaryEl = estimateRoot.querySelector("[data-tl-summary]");
    var sendBox = estimateRoot.querySelector("[data-tl-send]");
    var addonFields = estimateRoot.querySelector("[data-tl-addon-fields]");
    var fieldType = estimateRoot.querySelector("[data-tl-field-type]");
    var fieldComplexity = estimateRoot.querySelector("[data-tl-field-complexity]");
    var fieldWeeksLow = estimateRoot.querySelector("[data-tl-field-weeks-low]");
    var fieldWeeksHigh = estimateRoot.querySelector("[data-tl-field-weeks-high]");
    var fieldLakhsLow = estimateRoot.querySelector("[data-tl-field-lakhs-low]");
    var fieldLakhsHigh = estimateRoot.querySelector("[data-tl-field-lakhs-high]");

    function selectedType() {
        var el = estimateRoot.querySelector("[data-tl-type]:checked");
        return el ? el.value : "MVP";
    }

    function selectedComplexity() {
        var el = estimateRoot.querySelector("[data-tl-complexity]:checked");
        return el ? el.value : "standard";
    }

    function selectedAddons() {
        return Array.prototype.slice
            .call(estimateRoot.querySelectorAll("[data-tl-addon]:checked"))
            .map(function (el) {
                return el.value;
            });
    }

    function fmt(n) {
        var v = Math.round(n * 10) / 10;
        return Number.isInteger(v) ? String(v) : v.toFixed(1);
    }

    function compute() {
        var type = selectedType();
        var complexity = selectedComplexity();
        var addons = selectedAddons();
        var base = (config.bases && config.bases[type]) || { weeks: [6, 12], lakhs: [2, 6] };
        var mul = (config.complexity && config.complexity[complexity]) || {
            weeksMul: 1,
            lakhsMul: 1,
            label: "Standard",
        };

        var weeksLow = base.weeks[0];
        var weeksHigh = base.weeks[1];
        var lakhsLow = base.lakhs[0];
        var lakhsHigh = base.lakhs[1];

        addons.forEach(function (key) {
            var addon = config.addOns && config.addOns[key];
            if (!addon) return;
            weeksLow += addon.weeks[0];
            weeksHigh += addon.weeks[1];
            lakhsLow += addon.lakhs[0];
            lakhsHigh += addon.lakhs[1];
        });

        weeksLow *= mul.weeksMul;
        weeksHigh *= mul.weeksMul;
        lakhsLow *= mul.lakhsMul;
        lakhsHigh *= mul.lakhsMul;

        weeksLow = Math.max(2, Math.round(weeksLow));
        weeksHigh = Math.max(weeksLow + 1, Math.round(weeksHigh));
        lakhsLow = Math.max(0.5, Math.round(lakhsLow * 10) / 10);
        lakhsHigh = Math.max(lakhsLow + 0.5, Math.round(lakhsHigh * 10) / 10);

        if (weeksEl) weeksEl.textContent = weeksLow + "–" + weeksHigh + " weeks";
        if (budgetEl) {
            budgetEl.textContent =
                lakhsHigh >= 20
                    ? "₹" + fmt(lakhsLow) + "L+ · talk to us for scope"
                    : "₹" + fmt(lakhsLow) + "L – ₹" + fmt(lakhsHigh) + "L";
        }

        if (summaryEl) {
            summaryEl.innerHTML = "";
            var chips = [type, mul.label || complexity].concat(
                addons.map(function (key) {
                    return (config.addOns[key] && config.addOns[key].label) || key;
                })
            );
            chips.forEach(function (label) {
                var li = document.createElement("li");
                li.textContent = label;
                summaryEl.appendChild(li);
            });
        }

        if (fieldType) fieldType.value = type;
        if (fieldComplexity) fieldComplexity.value = complexity;
        if (fieldWeeksLow) fieldWeeksLow.value = weeksLow;
        if (fieldWeeksHigh) fieldWeeksHigh.value = weeksHigh;
        if (fieldLakhsLow) fieldLakhsLow.value = lakhsLow;
        if (fieldLakhsHigh) fieldLakhsHigh.value = lakhsHigh;

        if (addonFields) {
            addonFields.innerHTML = "";
            addons.forEach(function (key) {
                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "addons[]";
                input.value = key;
                addonFields.appendChild(input);
            });
        }

        return { type: type, weeksLow: weeksLow, weeksHigh: weeksHigh };
    }

    estimateRoot.addEventListener("change", function (e) {
        if (
            e.target.matches("[data-tl-type], [data-tl-complexity], [data-tl-addon]")
        ) {
            compute();
            var briefLink = estimateRoot.querySelector('.tl-cross a[href*="project-brief"]');
            if (briefLink && e.target.matches("[data-tl-type]")) {
                var url = new URL(briefLink.href, window.location.origin);
                url.searchParams.set("type", selectedType());
                briefLink.href = url.pathname + url.search;
            }
        }
    });

    var openSend = estimateRoot.querySelector("[data-tl-open-send]");
    if (openSend && sendBox) {
        openSend.addEventListener("click", function () {
            compute();
            sendBox.hidden = false;
            sendBox.scrollIntoView({ behavior: "smooth", block: "start" });
        });
    }

    // Show send form if validation errors
    if (sendBox && sendBox.querySelector(".tl-alert")) {
        sendBox.hidden = false;
    }

    compute();
})();
