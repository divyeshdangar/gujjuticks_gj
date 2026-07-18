(function () {
    if (!document.body.classList.contains("site-body--ai-prompts")) return;

    var reduceMotion = window.matchMedia("(prefers-reduced-motion: reduce)").matches;

    // Typewriter rotating phrases
    var typeEl = document.querySelector("[data-type-rotate]");
    if (typeEl) {
        var phrases = [
            "finish tasks faster",
            "write clearer drafts",
            "code with less guesswork",
            "ship marketing copy",
            "generate better images",
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
                    window.setTimeout(function () {
                        typePaused = false;
                        typeTick();
                    }, 1400);
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
            window.setTimeout(typeTick, deleting ? 36 : 58);
        }

        if (!reduceMotion) {
            window.setTimeout(typeTick, 900);
        }
    }

    // Detail: AI constellation (nodes, links, signal packets)
    var aiCanvas = document.querySelector("[data-ap-ai]");
    if (aiCanvas && !reduceMotion && aiCanvas.getContext) {
        var aCtx = aiCanvas.getContext("2d");
        var aiStage = aiCanvas.parentElement;
        var aDpr = Math.min(window.devicePixelRatio || 1, 2);
        var aw = 0;
        var ah = 0;
        var aNodes = [];
        var aPackets = [];
        var aTick = 0;
        var aRunning = true;

        function seedAi() {
            var count = Math.max(18, Math.min(36, Math.floor((aw * ah) / 16000)));
            aNodes = [];
            aPackets = [];
            for (var i = 0; i < count; i++) {
                aNodes.push({
                    x: Math.random() * aw,
                    y: Math.random() * ah,
                    vx: (Math.random() - 0.5) * 0.32,
                    vy: (Math.random() - 0.5) * 0.32,
                    r: 1.3 + Math.random() * 1.7,
                    pulse: Math.random() * Math.PI * 2,
                });
            }
        }

        function resizeAi() {
            var rect = aiStage.getBoundingClientRect();
            aw = Math.max(1, Math.floor(rect.width));
            ah = Math.max(1, Math.floor(rect.height));
            aiCanvas.width = Math.floor(aw * aDpr);
            aiCanvas.height = Math.floor(ah * aDpr);
            aiCanvas.style.width = aw + "px";
            aiCanvas.style.height = ah + "px";
            aCtx.setTransform(aDpr, 0, 0, aDpr, 0, 0);
            seedAi();
        }

        function spawnAiPacket(links) {
            if (!links.length) return;
            var link = links[Math.floor(Math.random() * links.length)];
            aPackets.push({
                a: link.a,
                b: link.b,
                t: 0,
                speed: 0.01 + Math.random() * 0.016,
            });
            if (aPackets.length > 16) aPackets.shift();
        }

        function drawAi() {
            if (!aRunning) return;
            aCtx.clearRect(0, 0, aw, ah);
            aTick += 1;

            for (var i = 0; i < aNodes.length; i++) {
                var n = aNodes[i];
                n.x += n.vx;
                n.y += n.vy;
                n.pulse += 0.03;
                if (n.x < -12) n.x = aw + 12;
                if (n.x > aw + 12) n.x = -12;
                if (n.y < -12) n.y = ah + 12;
                if (n.y > ah + 12) n.y = -12;
            }

            var links = [];
            for (var a = 0; a < aNodes.length; a++) {
                for (var b = a + 1; b < aNodes.length; b++) {
                    var dx = aNodes[a].x - aNodes[b].x;
                    var dy = aNodes[a].y - aNodes[b].y;
                    var dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 110) {
                        links.push({ a: a, b: b, alpha: 1 - dist / 110 });
                    }
                }
            }

            if (aTick % 26 === 0) spawnAiPacket(links);

            // Soft center glow (model core)
            var cg = aCtx.createRadialGradient(aw * 0.5, ah * 0.48, 4, aw * 0.5, ah * 0.48, Math.min(aw, ah) * 0.28);
            cg.addColorStop(0, "rgba(225, 29, 72, 0.12)");
            cg.addColorStop(1, "rgba(225, 29, 72, 0)");
            aCtx.fillStyle = cg;
            aCtx.fillRect(0, 0, aw, ah);

            for (var l = 0; l < links.length; l++) {
                var link = links[l];
                var na = aNodes[link.a];
                var nb = aNodes[link.b];
                aCtx.beginPath();
                aCtx.moveTo(na.x, na.y);
                aCtx.lineTo(nb.x, nb.y);
                aCtx.strokeStyle = "rgba(225, 29, 72," + (link.alpha * 0.22).toFixed(3) + ")";
                aCtx.lineWidth = 1;
                aCtx.stroke();
            }

            for (var p = aPackets.length - 1; p >= 0; p--) {
                var packet = aPackets[p];
                packet.t += packet.speed;
                if (packet.t >= 1) {
                    aPackets.splice(p, 1);
                    continue;
                }
                var pa = aNodes[packet.a];
                var pb = aNodes[packet.b];
                if (!pa || !pb) {
                    aPackets.splice(p, 1);
                    continue;
                }
                var px = pa.x + (pb.x - pa.x) * packet.t;
                var py = pa.y + (pb.y - pa.y) * packet.t;
                var grad = aCtx.createRadialGradient(px, py, 0, px, py, 7);
                grad.addColorStop(0, "rgba(225, 29, 72, 0.9)");
                grad.addColorStop(1, "rgba(225, 29, 72, 0)");
                aCtx.beginPath();
                aCtx.arc(px, py, 7, 0, Math.PI * 2);
                aCtx.fillStyle = grad;
                aCtx.fill();
                aCtx.beginPath();
                aCtx.arc(px, py, 1.8, 0, Math.PI * 2);
                aCtx.fillStyle = "rgba(17, 19, 24, 0.9)";
                aCtx.fill();
            }

            for (var j = 0; j < aNodes.length; j++) {
                var node = aNodes[j];
                var glowR = node.r + 1.4 + Math.sin(node.pulse) * 0.8;
                aCtx.beginPath();
                aCtx.arc(node.x, node.y, glowR, 0, Math.PI * 2);
                aCtx.fillStyle = "rgba(225, 29, 72, 0.12)";
                aCtx.fill();
                aCtx.beginPath();
                aCtx.arc(node.x, node.y, node.r, 0, Math.PI * 2);
                aCtx.fillStyle =
                    j % 4 === 0 ? "rgba(17, 19, 24, 0.55)" : "rgba(225, 29, 72, 0.75)";
                aCtx.fill();
            }

            requestAnimationFrame(drawAi);
        }

        resizeAi();
        drawAi();
        window.addEventListener("resize", resizeAi);
        document.addEventListener("visibilitychange", function () {
            aRunning = !document.hidden;
            if (aRunning) drawAi();
        });
    }

    // Hero neural net (light rose/ink)
    var neural = document.querySelector("[data-ap-neural]");
    if (neural && !reduceMotion && neural.getContext) {
        var nCtx = neural.getContext("2d");
        var stage = neural.parentElement;
        var nodes = [];
        var packets = [];
        var nDpr = Math.min(window.devicePixelRatio || 1, 2);
        var nw = 0;
        var nh = 0;
        var nTick = 0;
        var nRunning = true;

        function resizeNeural() {
            var rect = stage.getBoundingClientRect();
            nw = Math.max(1, Math.floor(rect.width));
            nh = Math.max(1, Math.floor(rect.height));
            neural.width = Math.floor(nw * nDpr);
            neural.height = Math.floor(nh * nDpr);
            neural.style.width = nw + "px";
            neural.style.height = nh + "px";
            nCtx.setTransform(nDpr, 0, 0, nDpr, 0, 0);

            var count = Math.max(22, Math.min(42, Math.floor((nw * nh) / 22000)));
            nodes = [];
            packets = [];
            for (var i = 0; i < count; i++) {
                nodes.push({
                    x: Math.random() * nw,
                    y: Math.random() * nh,
                    vx: (Math.random() - 0.5) * 0.28,
                    vy: (Math.random() - 0.5) * 0.28,
                    r: 1.4 + Math.random() * 1.6,
                    pulse: Math.random() * Math.PI * 2,
                });
            }
        }

        function spawnPacket(links) {
            if (!links.length) return;
            var link = links[Math.floor(Math.random() * links.length)];
            packets.push({
                a: link.a,
                b: link.b,
                t: 0,
                speed: 0.01 + Math.random() * 0.014,
            });
            if (packets.length > 14) packets.shift();
        }

        function drawNeural() {
            if (!nRunning) return;
            nCtx.clearRect(0, 0, nw, nh);
            nTick += 1;

            for (var i = 0; i < nodes.length; i++) {
                var n = nodes[i];
                n.x += n.vx;
                n.y += n.vy;
                n.pulse += 0.025;
                if (n.x < -16) n.x = nw + 16;
                if (n.x > nw + 16) n.x = -16;
                if (n.y < -16) n.y = nh + 16;
                if (n.y > nh + 16) n.y = -16;
            }

            var links = [];
            for (var a = 0; a < nodes.length; a++) {
                for (var b = a + 1; b < nodes.length; b++) {
                    var dx = nodes[a].x - nodes[b].x;
                    var dy = nodes[a].y - nodes[b].y;
                    var dist = Math.sqrt(dx * dx + dy * dy);
                    if (dist < 120) {
                        links.push({ a: a, b: b, alpha: 1 - dist / 120 });
                    }
                }
            }

            if (nTick % 32 === 0) spawnPacket(links);

            for (var l = 0; l < links.length; l++) {
                var link = links[l];
                var na = nodes[link.a];
                var nb = nodes[link.b];
                nCtx.beginPath();
                nCtx.moveTo(na.x, na.y);
                nCtx.lineTo(nb.x, nb.y);
                nCtx.strokeStyle = "rgba(225, 29, 72," + (link.alpha * 0.18).toFixed(3) + ")";
                nCtx.lineWidth = 1;
                nCtx.stroke();
            }

            for (var p = packets.length - 1; p >= 0; p--) {
                var packet = packets[p];
                packet.t += packet.speed;
                if (packet.t >= 1) {
                    packets.splice(p, 1);
                    continue;
                }
                var pa = nodes[packet.a];
                var pb = nodes[packet.b];
                if (!pa || !pb) {
                    packets.splice(p, 1);
                    continue;
                }
                var px = pa.x + (pb.x - pa.x) * packet.t;
                var py = pa.y + (pb.y - pa.y) * packet.t;
                var grad = nCtx.createRadialGradient(px, py, 0, px, py, 7);
                grad.addColorStop(0, "rgba(225, 29, 72, 0.75)");
                grad.addColorStop(1, "rgba(225, 29, 72, 0)");
                nCtx.beginPath();
                nCtx.arc(px, py, 7, 0, Math.PI * 2);
                nCtx.fillStyle = grad;
                nCtx.fill();
                nCtx.beginPath();
                nCtx.arc(px, py, 2, 0, Math.PI * 2);
                nCtx.fillStyle = "rgba(17, 19, 24, 0.85)";
                nCtx.fill();
            }

            for (var j = 0; j < nodes.length; j++) {
                var node = nodes[j];
                var glowR = node.r + 1.2 + Math.sin(node.pulse) * 0.7;
                nCtx.beginPath();
                nCtx.arc(node.x, node.y, glowR, 0, Math.PI * 2);
                nCtx.fillStyle = "rgba(225, 29, 72, 0.1)";
                nCtx.fill();
                nCtx.beginPath();
                nCtx.arc(node.x, node.y, node.r, 0, Math.PI * 2);
                nCtx.fillStyle =
                    j % 4 === 0 ? "rgba(17, 19, 24, 0.55)" : "rgba(225, 29, 72, 0.7)";
                nCtx.fill();
            }

            requestAnimationFrame(drawNeural);
        }

        resizeNeural();
        drawNeural();
        window.addEventListener("resize", resizeNeural);
        document.addEventListener("visibilitychange", function () {
            nRunning = !document.hidden;
            if (nRunning) drawNeural();
        });
    }

    // Scroll progress
    var progress = document.querySelector("[data-scroll-progress]");
    if (progress) {
        function updateProgress() {
            var doc = document.documentElement;
            var max = doc.scrollHeight - window.innerHeight;
            var pct = max > 0 ? (window.scrollY / max) * 100 : 0;
            progress.style.width = pct.toFixed(2) + "%";
        }
        updateProgress();
        window.addEventListener("scroll", updateProgress, { passive: true });
    }

    // Pointer glow
    var glow = document.querySelector("[data-ambient-glow]");
    if (glow && !reduceMotion) {
        var glowX = window.innerWidth / 2;
        var glowY = window.innerHeight * 0.3;
        var targetX = glowX;
        var targetY = glowY;
        var glowRaf = 0;

        function paintGlow() {
            glowX += (targetX - glowX) * 0.12;
            glowY += (targetY - glowY) * 0.12;
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

    // Soft rose particle field (home-style)
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
    var revealEls = document.querySelectorAll(".ap-reveal");
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
        if (reduceMotion) {
            el.textContent = target.toLocaleString();
            return;
        }
        var start = 0;
        var duration = 1100;
        var started = performance.now();
        function frame(now) {
            var t = Math.min(1, (now - started) / duration);
            var eased = 1 - Math.pow(1 - t, 3);
            var value = Math.round(start + (target - start) * eased);
            el.textContent = value.toLocaleString();
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

    // Copy prompt (detail page)
    var csrfEl = document.getElementById("ai-prompts-csrf");
    var csrfToken = csrfEl ? csrfEl.getAttribute("data-csrf") : "";
    document.querySelectorAll(".copy-prompt-btn").forEach(function (btn) {
        btn.addEventListener("click", function () {
            var prompt = btn.getAttribute("data-prompt");
            var url = btn.getAttribute("data-copy-url");
            if (!prompt) return;

            function markCopied() {
                var label = btn.textContent;
                btn.textContent = "Copied!";
                btn.classList.add("is-copied");
                btn.disabled = true;
                window.setTimeout(function () {
                    btn.textContent = label;
                    btn.classList.remove("is-copied");
                    btn.disabled = false;
                }, 2000);

                var countEl = document.querySelector("[data-copy-count]");
                if (countEl) {
                    var n = parseInt(String(countEl.textContent).replace(/,/g, ""), 10);
                    if (!isNaN(n)) countEl.textContent = (n + 1).toLocaleString();
                }

                if (url && csrfToken) {
                    var fd = new FormData();
                    fd.append("_token", csrfToken);
                    fetch(url, {
                        method: "POST",
                        body: fd,
                        headers: {
                            Accept: "application/json",
                            "X-Requested-With": "XMLHttpRequest",
                        },
                    }).catch(function () {});
                }
            }

            if (navigator.clipboard && navigator.clipboard.writeText) {
                navigator.clipboard.writeText(prompt).then(markCopied).catch(function () {
                    fallbackCopy(prompt, markCopied);
                });
            } else {
                fallbackCopy(prompt, markCopied);
            }
        });
    });

    function fallbackCopy(text, done) {
        var area = document.createElement("textarea");
        area.value = text;
        area.setAttribute("readonly", "");
        area.style.position = "absolute";
        area.style.left = "-9999px";
        document.body.appendChild(area);
        area.select();
        try {
            document.execCommand("copy");
            done();
        } catch (e) {}
        document.body.removeChild(area);
    }
})();
