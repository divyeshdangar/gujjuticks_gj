(function () {
    if (!document.body.classList.contains("site-body--home")) return;

    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    // Live local time (Asia/Kolkata)
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

    // Live clock with seconds (activity rail)
    function updateClockSeconds() {
        var el = document.querySelector("[data-clock-seconds]");
        if (!el) return;
        try {
            el.textContent = new Intl.DateTimeFormat("en-IN", {
                timeZone: "Asia/Kolkata",
                hour: "2-digit",
                minute: "2-digit",
                second: "2-digit",
                hour12: false,
            }).format(new Date());
        } catch (e) {
            el.textContent = "";
        }
    }
    updateClockSeconds();
    setInterval(updateClockSeconds, 1000);

    // Session timer in hero meta
    var sessionStart = Date.now();
    function updateSessionLive() {
        var el = document.querySelector("[data-session-live]");
        if (!el) return;
        var secs = Math.floor((Date.now() - sessionStart) / 1000);
        var m = Math.floor(secs / 60);
        var s = secs % 60;
        el.textContent =
            "On page " +
            (m > 0 ? m + "m " : "") +
            s +
            "s";
    }
    updateSessionLive();
    setInterval(updateSessionLive, 1000);

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
                : "Available for new projects · Reply within 1 day";
            var cta = document.querySelector("[data-cta-live]");
            if (cta) {
                cta.textContent = open
                    ? "Team online · Open for project inquiries"
                    : "Available for new projects · Reply within 1 day";
            }
        } catch (e) {
            label.textContent = "Available for new projects";
        }
    }
    updateAvailability();
    setInterval(updateAvailability, 60000);

    // Typewriter rotating phrases
    var typeEl = document.querySelector("[data-type-rotate]");
    if (typeEl) {
        var phrases = [
            "custom apps",
            "modern websites",
            "business software",
            "MVPs that ship",
            "dashboards & portals",
            "integrations",
        ];
        var phraseIdx = 0;
        var charIdx = phrases[0].length;
        var deleting = false;
        var typePaused = false;

        function typeTick() {
            if (typePaused || reduceMotion) return;
            var current = phrases[phraseIdx];
            if (!deleting) {
                charIdx += 1;
                typeEl.textContent = current.slice(0, charIdx);
                if (charIdx >= current.length) {
                    deleting = true;
                    typePaused = true;
                    setTimeout(function () {
                        typePaused = false;
                        typeTick();
                    }, 1600);
                    return;
                }
            } else {
                charIdx -= 1;
                typeEl.textContent = current.slice(0, charIdx);
                if (charIdx <= 0) {
                    deleting = false;
                    phraseIdx = (phraseIdx + 1) % phrases.length;
                }
            }
            setTimeout(typeTick, deleting ? 36 : 72);
        }

        if (reduceMotion) {
            var rotateIdx = 0;
            setInterval(function () {
                rotateIdx = (rotateIdx + 1) % phrases.length;
                typeEl.textContent = phrases[rotateIdx];
            }, 3000);
        } else {
            setTimeout(typeTick, 900);
        }
    }

    // Live activity feed
    var activityEl = document.querySelector("[data-activity-text]");
    if (activityEl) {
        var activities = [
            "Reviewing new project briefs…",
            "Scoping a custom dashboard build…",
            "Preparing website launch checklist…",
            "Accepting new project inquiries…",
            "Aligning milestones for a startup MVP…",
            "Ready for your next product conversation…",
        ];
        var actIdx = 0;
        setInterval(function () {
            actIdx = (actIdx + 1) % activities.length;
            if (reduceMotion) {
                activityEl.textContent = activities[actIdx];
                return;
            }
            activityEl.classList.add("is-swap");
            setTimeout(function () {
                activityEl.textContent = activities[actIdx];
                activityEl.classList.remove("is-swap");
            }, 280);
        }, 4200);
    }

    // Scroll progress bar
    var progressEl = document.querySelector("[data-scroll-progress]");
    function updateProgress() {
        if (!progressEl) return;
        var doc = document.documentElement;
        var max = doc.scrollHeight - window.innerHeight;
        var pct = max > 0 ? (window.scrollY / max) * 100 : 0;
        progressEl.style.width = Math.min(100, Math.max(0, pct)) + "%";
    }
    updateProgress();
    window.addEventListener("scroll", updateProgress, { passive: true });
    window.addEventListener("resize", updateProgress);

    // Pointer glow on ambient background
    var glow = document.querySelector("[data-ambient-glow]");
    if (glow && !reduceMotion) {
        var glowX = window.innerWidth / 2;
        var glowY = window.innerHeight * 0.3;
        var targetX = glowX;
        var targetY = glowY;
        var glowRaf = null;

        function paintGlow() {
            glowX += (targetX - glowX) * 0.08;
            glowY += (targetY - glowY) * 0.08;
            glow.style.left = glowX + "px";
            glow.style.top = glowY + "px";
            glowRaf = requestAnimationFrame(paintGlow);
        }

        window.addEventListener(
            "pointermove",
            function (e) {
                targetX = e.clientX;
                targetY = e.clientY;
                glow.classList.add("is-on");
                if (!glowRaf) glowRaf = requestAnimationFrame(paintGlow);
            },
            { passive: true }
        );
    }

    // Soft particle field on canvas
    var canvas = document.querySelector("[data-ambient-canvas]");
    if (canvas && !reduceMotion && canvas.getContext) {
        var ctx = canvas.getContext("2d");
        var particles = [];
        var dpr = Math.min(window.devicePixelRatio || 1, 2);
        var running = true;

        function resizeCanvas() {
            var w = window.innerWidth;
            var h = window.innerHeight;
            canvas.width = Math.floor(w * dpr);
            canvas.height = Math.floor(h * dpr);
            canvas.style.width = w + "px";
            canvas.style.height = h + "px";
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);

            var count = Math.min(48, Math.floor((w * h) / 28000));
            particles = [];
            for (var i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * w,
                    y: Math.random() * h,
                    r: 0.6 + Math.random() * 1.4,
                    vx: (Math.random() - 0.5) * 0.25,
                    vy: -0.15 - Math.random() * 0.35,
                    a: 0.12 + Math.random() * 0.28,
                });
            }
        }

        function drawParticles() {
            if (!running) return;
            var w = window.innerWidth;
            var h = window.innerHeight;
            ctx.clearRect(0, 0, w, h);
            for (var i = 0; i < particles.length; i++) {
                var p = particles[i];
                p.x += p.vx;
                p.y += p.vy;
                if (p.y < -4) {
                    p.y = h + 4;
                    p.x = Math.random() * w;
                }
                if (p.x < -4) p.x = w + 4;
                if (p.x > w + 4) p.x = -4;
                ctx.beginPath();
                ctx.fillStyle = "rgba(225, 29, 72," + p.a + ")";
                ctx.arc(p.x, p.y, p.r, 0, Math.PI * 2);
                ctx.fill();
            }
            requestAnimationFrame(drawParticles);
        }

        resizeCanvas();
        drawParticles();
        window.addEventListener("resize", resizeCanvas);

        document.addEventListener("visibilitychange", function () {
            running = !document.hidden;
            if (running) drawParticles();
        });
    }

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
        faq.addEventListener(
            "toggle",
            function (e) {
                var target = e.target;
                if (!target.open || !target.classList.contains("hm-faq__item")) return;
                faq.querySelectorAll(".hm-faq__item").forEach(function (item) {
                    if (item !== target) item.open = false;
                });
            },
            true
        );
    }
})();
