(function () {
    if (!document.body.classList.contains("site-body--home")) return;

    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    // Live local time (Asia/Kolkata label)
    function updateTime() {
        var el = document.querySelector("[data-local-time]");
        if (!el) return;
        try {
            var text = new Intl.DateTimeFormat("en-IN", {
                timeZone: "Asia/Kolkata",
                hour: "numeric",
                minute: "2-digit",
                hour12: true,
            }).format(new Date());
            el.textContent = "India · " + text;
        } catch (e) {
            el.textContent = "India time";
        }
    }
    updateTime();
    setInterval(updateTime, 30000);

    // Availability label by IST business hours (Mon–Sat 10:00–19:00)
    function updateAvailability() {
        var label = document.querySelector("[data-live-label]");
        if (!label) return;
        try {
            var parts = new Intl.DateTimeFormat("en-GB", {
                timeZone: "Asia/Kolkata",
                weekday: "short",
                hour: "numeric",
                hour12: false,
            }).formatToParts(new Date());
            var weekday = "";
            var hour = 0;
            parts.forEach(function (p) {
                if (p.type === "weekday") weekday = p.value;
                if (p.type === "hour") hour = parseInt(p.value, 10);
            });
            var weekend = weekday === "Sun";
            var open = !weekend && hour >= 10 && hour < 19;
            label.textContent = open
                ? "Team online · Available for new projects"
                : "Intake open · Replies next business day";
        } catch (e) {
            label.textContent = "Available for new projects";
        }
    }
    updateAvailability();
    setInterval(updateAvailability, 60000);

    // Scroll reveal
    var revealEls = document.querySelectorAll(".hm-reveal");
    if (revealEls.length) {
        if (reduceMotion || !("IntersectionObserver" in window)) {
            revealEls.forEach(function (el) {
                el.classList.add("is-in");
            });
        } else {
            var revealObs = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add("is-in");
                            revealObs.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.16, rootMargin: "0px 0px -8% 0px" }
            );
            revealEls.forEach(function (el) {
                revealObs.observe(el);
            });
        }
    }

    // Count-up stats
    var counters = document.querySelectorAll("[data-count]");
    function animateCount(el) {
        var target = parseInt(el.getAttribute("data-count"), 10) || 0;
        var suffix = el.getAttribute("data-suffix") || "";
        if (reduceMotion) {
            el.textContent = target + suffix;
            return;
        }
        var start = 0;
        var duration = 1100;
        var started = performance.now();
        function frame(now) {
            var t = Math.min(1, (now - started) / duration);
            var eased = 1 - Math.pow(1 - t, 3);
            var value = Math.round(start + (target - start) * eased);
            el.textContent = value + suffix;
            if (t < 1) requestAnimationFrame(frame);
        }
        requestAnimationFrame(frame);
    }

    if (counters.length) {
        if (!("IntersectionObserver" in window)) {
            counters.forEach(animateCount);
        } else {
            var countObs = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            animateCount(entry.target);
                            countObs.unobserve(entry.target);
                        }
                    });
                },
                { threshold: 0.4 }
            );
            counters.forEach(function (el) {
                countObs.observe(el);
            });
        }
    }

    // Interactive process steps
    var stepsRoot = document.querySelector("[data-steps]");
    if (stepsRoot) {
        var steps = Array.prototype.slice.call(stepsRoot.querySelectorAll(".hm-steps__item"));
        function activate(step) {
            steps.forEach(function (s) {
                s.classList.toggle("is-active", s === step);
            });
        }
        steps.forEach(function (step) {
            step.addEventListener("mouseenter", function () {
                activate(step);
            });
            step.addEventListener("focus", function () {
                activate(step);
            });
            step.addEventListener("click", function () {
                activate(step);
            });
        });

        if (!reduceMotion && "IntersectionObserver" in window) {
            var idx = 0;
            var stepTimer = null;
            var stepObs = new IntersectionObserver(
                function (entries) {
                    entries.forEach(function (entry) {
                        if (!entry.isIntersecting) {
                            if (stepTimer) clearInterval(stepTimer);
                            stepTimer = null;
                            return;
                        }
                        if (stepTimer) return;
                        stepTimer = setInterval(function () {
                            idx = (idx + 1) % steps.length;
                            activate(steps[idx]);
                        }, 2800);
                    });
                },
                { threshold: 0.35 }
            );
            stepObs.observe(stepsRoot);
        }
    }

    // FAQ: keep one open at a time
    var faq = document.querySelector("[data-faq]");
    if (faq) {
        faq.addEventListener("toggle", function (e) {
            var target = e.target;
            if (!target.open || !target.classList.contains("hm-faq__item")) return;
            faq.querySelectorAll(".hm-faq__item").forEach(function (item) {
                if (item !== target) item.open = false;
            });
        }, true);
    }
})();
