(function () {
    if (!document.body.classList.contains("site-body--error")) return;

    var page = document.querySelector("[data-er-page]");
    if (!page) return;

    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;
    var status = page.querySelector("[data-er-status]");
    var digits = Array.prototype.slice.call(page.querySelectorAll("[data-er-digit]"));
    var glitch = page.querySelector("[data-er-glitch]");
    var logLines = Array.prototype.slice.call(page.querySelectorAll("[data-er-log-line]"));
    var coords = page.querySelector("[data-er-coords]");
    var glow = page.querySelector("[data-er-glow]");
    var visual = page.querySelector("[data-er-visual]");

    var messages = [
        "Signal lost",
        "Route missing",
        "Path offline",
        "No match",
        "Retrying…",
        "Dead end",
    ];
    try {
        var custom = JSON.parse(page.getAttribute("data-er-statuses") || "[]");
        if (Array.isArray(custom) && custom.length) messages = custom;
    } catch (e) {}
    var msgIdx = 0;
    var logIdx = 0;

    function pulseGlitch() {
        if (glitch) {
            glitch.classList.remove("is-on");
            void glitch.offsetWidth;
            glitch.classList.add("is-on");
        }
        digits.forEach(function (digit, i) {
            window.setTimeout(function () {
                digit.classList.remove("is-glitch");
                void digit.offsetWidth;
                digit.classList.add("is-glitch");
            }, i * 70);
        });
    }

    function cycleStatus() {
        if (!status) return;
        msgIdx = (msgIdx + 1) % messages.length;
        status.textContent = messages[msgIdx];
        pulseGlitch();
    }

    function cycleLog() {
        if (!logLines.length) return;
        logLines.forEach(function (line) {
            line.classList.remove("is-on");
        });
        logLines[logIdx].classList.add("is-on");
        logIdx = (logIdx + 1) % logLines.length;
    }

    if (!reduceMotion) {
        cycleLog();
        setInterval(cycleStatus, 2400);
        setInterval(cycleLog, 1600);
    } else if (status) {
        status.textContent = messages[0];
        if (logLines[0]) logLines[0].classList.add("is-on");
    }

    // Pointer glow + coords
    if (!reduceMotion && visual) {
        visual.addEventListener("pointermove", function (e) {
            var rect = visual.getBoundingClientRect();
            var x = Math.round(((e.clientX - rect.left) / rect.width) * 100);
            var y = Math.round(((e.clientY - rect.top) / rect.height) * 100);
            if (coords) coords.textContent = "x:" + String(x).padStart(2, "0") + " y:" + String(y).padStart(2, "0");
            if (glow) {
                glow.style.left = e.clientX + "px";
                glow.style.top = e.clientY + "px";
                glow.classList.add("is-on");
            }
        });
        visual.addEventListener("pointerleave", function () {
            if (glow) glow.classList.remove("is-on");
            if (coords) coords.textContent = "x:00 y:00";
        });
    }

    // Floating particles
    var canvas = page.querySelector("[data-er-particles]");
    if (canvas && !reduceMotion && canvas.getContext) {
        var ctx = canvas.getContext("2d");
        var dpr = Math.min(window.devicePixelRatio || 1, 2);
        var w = 0;
        var h = 0;
        var particles = [];
        var running = true;

        function seed() {
            var count = Math.max(18, Math.min(36, Math.floor((w * h) / 28000)));
            particles = [];
            for (var i = 0; i < count; i++) {
                particles.push({
                    x: Math.random() * w,
                    y: Math.random() * h,
                    r: 0.8 + Math.random() * 1.8,
                    vx: (Math.random() - 0.5) * 0.35,
                    vy: -0.15 - Math.random() * 0.45,
                    a: 0.15 + Math.random() * 0.35,
                });
            }
        }

        function resize() {
            var rect = page.getBoundingClientRect();
            w = Math.max(1, Math.floor(rect.width));
            h = Math.max(1, Math.floor(rect.height));
            canvas.width = Math.floor(w * dpr);
            canvas.height = Math.floor(h * dpr);
            canvas.style.width = w + "px";
            canvas.style.height = h + "px";
            ctx.setTransform(dpr, 0, 0, dpr, 0, 0);
            seed();
        }

        function draw() {
            if (!running) return;
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
            requestAnimationFrame(draw);
        }

        resize();
        draw();
        window.addEventListener("resize", resize);
        document.addEventListener("visibilitychange", function () {
            running = !document.hidden;
            if (running) draw();
        });
    }
})();
