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
    if (estimateRoot) {
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
    }

    // Tech stack recommender
    var stackRoot = document.querySelector("[data-tl-stack]");
    if (!stackRoot) return;

    var stackConfig;
    try {
        stackConfig = JSON.parse(stackRoot.getAttribute("data-tl-config") || "{}");
    } catch (err) {
        stackConfig = {};
    }

    var catalog = stackConfig.catalog || {};
    var whys = stackConfig.whys || {};
    var nextStepsMap = stackConfig.nextSteps || {};
    var stackWizard = stackRoot.querySelector("[data-tl-stack-wizard]");
    var quizSection = stackRoot.querySelector("[data-tl-quiz]");
    var results = stackRoot.querySelector("[data-tl-results]");
    var sendSection = stackRoot.querySelector("[data-tl-send]");
    var layersEl = stackRoot.querySelector("[data-tl-layers]");
    var chipsEl = stackRoot.querySelector("[data-tl-answer-chips]");
    var factsEl = stackRoot.querySelector("[data-tl-primary-facts]");
    var nextListEl = stackRoot.querySelector("[data-tl-next-list]");

    var fieldProduct = stackRoot.querySelector("[data-tl-field-product]");
    var fieldSurface = stackRoot.querySelector("[data-tl-field-surface]");
    var fieldPriority = stackRoot.querySelector("[data-tl-field-priority]");
    var fieldPrimary = stackRoot.querySelector("[data-tl-field-primary]");
    var capFields = stackRoot.querySelector("[data-tl-capability-fields]");
    var layerFields = stackRoot.querySelector("[data-tl-layer-fields]");

    var surfaceLabels = {
        marketing: "Marketing site",
        web: "Web product",
        spa: "SPA dashboard",
        mobile: "Mobile / PWA",
        native: "Native apps",
    };
    var priorityLabels = {
        fast: "Ship fast",
        scale: "Scale & reliability",
        growth: "SEO & growth",
        maintain: "Easy to maintain",
    };
    var capabilityLabels = {
        auth: "Login",
        payments: "Payments",
        admin: "Admin",
        integrations: "Integrations",
        cms: "CMS",
        ai: "AI",
        mobile: "Mobile",
        notifications: "Notifications",
        analytics: "Analytics",
        multiuser: "Roles / teams",
    };

    var stackIdx = 0;
    var stackSteps = stackWizard
        ? Array.prototype.slice.call(stackWizard.querySelectorAll("[data-tl-step]"))
        : [];
    var stackDots = stackWizard
        ? Array.prototype.slice.call(stackWizard.querySelectorAll("[data-tl-step-dot]"))
        : [];

    function showStackStep(i) {
        stackIdx = Math.max(0, Math.min(stackSteps.length - 1, i));
        stackSteps.forEach(function (step, n) {
            var on = n === stackIdx;
            step.hidden = !on;
            step.classList.toggle("is-on", on);
        });
        stackDots.forEach(function (dot, n) {
            dot.classList.toggle("is-on", n === stackIdx);
            dot.classList.toggle("is-done", n < stackIdx);
        });
    }

    function validateStackStep(i) {
        var step = stackSteps[i];
        if (!step) return true;
        var required = Array.prototype.slice.call(
            step.querySelectorAll("input[required], select[required], textarea[required]")
        );
        for (var r = 0; r < required.length; r++) {
            var el = required[r];
            if (el.type === "radio") {
                var checked = step.querySelector('input[name="' + el.name + '"]:checked');
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

    function selectedProduct() {
        var el = stackRoot.querySelector("[data-tl-product]:checked");
        return el ? el.value : "";
    }

    function selectedSurface() {
        var el = stackRoot.querySelector("[data-tl-surface]:checked");
        return el ? el.value : "";
    }

    function selectedPriority() {
        var el = stackRoot.querySelector("[data-tl-priority]:checked");
        return el ? el.value : "";
    }

    function selectedCapabilities() {
        return Array.prototype.slice
            .call(stackRoot.querySelectorAll("[data-tl-capability]:checked"))
            .map(function (el) {
                return el.value;
            });
    }

    function addScore(scores, slug, n) {
        if (!catalog[slug]) return;
        scores[slug] = (scores[slug] || 0) + n;
    }

    function recommend(product, surface, capabilities, priority) {
        var scores = {};

        if (product === "Website") {
            addScore(scores, "wordpress", 4);
            addScore(scores, "cms-content", 4);
            addScore(scores, "performance-seo", 3);
            addScore(scores, "web-apps", 1);
            addScore(scores, "hosting-devops", 2);
        } else if (product === "Custom software") {
            addScore(scores, "laravel", 5);
            addScore(scores, "admin-panels", 4);
            addScore(scores, "apis-integrations", 3);
            addScore(scores, "databases", 3);
            addScore(scores, "web-apps", 2);
            addScore(scores, "hosting-devops", 2);
        } else if (product === "Custom app" || product === "MVP") {
            addScore(scores, "mvp-stack", 5);
            addScore(scores, "laravel", 4);
            addScore(scores, "web-apps", 3);
            addScore(scores, "databases", 2);
            addScore(scores, "hosting-devops", 2);
        } else {
            addScore(scores, "mvp-stack", 4);
            addScore(scores, "laravel", 3);
            addScore(scores, "web-apps", 2);
            addScore(scores, "hosting-devops", 2);
        }

        if (surface === "marketing") {
            addScore(scores, "cms-content", 3);
            addScore(scores, "wordpress", 3);
            addScore(scores, "performance-seo", 3);
            addScore(scores, "web-apps", 1);
        } else if (surface === "web") {
            addScore(scores, "web-apps", 4);
            addScore(scores, "laravel", 2);
            addScore(scores, "databases", 1);
        } else if (surface === "spa") {
            addScore(scores, "react", 5);
            addScore(scores, "apis-integrations", 3);
            addScore(scores, "web-apps", 2);
            addScore(scores, "laravel", 2);
        } else if (surface === "mobile") {
            addScore(scores, "mobile-apps", 5);
            addScore(scores, "apis-integrations", 2);
            addScore(scores, "authentication-security", 1);
        } else if (surface === "native") {
            addScore(scores, "native-mobile", 5);
            addScore(scores, "apis-integrations", 3);
            addScore(scores, "authentication-security", 2);
        }

        capabilities.forEach(function (key) {
            if (key === "auth") addScore(scores, "authentication-security", 4);
            if (key === "payments") addScore(scores, "payments", 4);
            if (key === "admin") addScore(scores, "admin-panels", 4);
            if (key === "integrations") addScore(scores, "apis-integrations", 4);
            if (key === "cms") addScore(scores, "cms-content", 3);
            if (key === "ai") addScore(scores, "ai-features", 4);
            if (key === "notifications") {
                addScore(scores, "apis-integrations", 2);
                addScore(scores, "web-apps", 1);
            }
            if (key === "analytics") {
                addScore(scores, "admin-panels", 2);
                addScore(scores, "databases", 2);
            }
            if (key === "multiuser") {
                addScore(scores, "authentication-security", 3);
                addScore(scores, "admin-panels", 2);
            }
            if (key === "mobile") {
                addScore(scores, "mobile-apps", 3);
                if (surface === "native") addScore(scores, "native-mobile", 2);
            }
        });

        if (priority === "fast") {
            addScore(scores, "mvp-stack", 4);
            addScore(scores, "wordpress", product === "Website" ? 2 : 0);
        } else if (priority === "scale") {
            addScore(scores, "quality-testing", 4);
            addScore(scores, "hosting-devops", 3);
            addScore(scores, "databases", 2);
        } else if (priority === "growth") {
            addScore(scores, "performance-seo", 4);
            addScore(scores, "cms-content", 1);
        } else if (priority === "maintain") {
            addScore(scores, "laravel", 3);
            addScore(scores, "mvp-stack", 2);
            addScore(scores, "quality-testing", 2);
            addScore(scores, "hosting-devops", 2);
        }

        var ranked = Object.keys(scores)
            .map(function (slug) {
                return { slug: slug, score: scores[slug] };
            })
            .sort(function (a, b) {
                return b.score - a.score;
            });

        if (!ranked.length) {
            ranked = [{ slug: "mvp-stack", score: 1 }];
        }

        var primaryCandidates = ["mvp-stack", "laravel", "wordpress", "react", "native-mobile"];
        var primary = ranked[0];
        for (var i = 0; i < ranked.length; i++) {
            if (primaryCandidates.indexOf(ranked[i].slug) !== -1) {
                primary = ranked[i];
                break;
            }
        }

        // Prefer wordpress as primary for marketing websites
        if (product === "Website" && (surface === "marketing" || !surface)) {
            var wp = ranked.find(function (r) {
                return r.slug === "wordpress";
            });
            if (wp && wp.score >= (scores["cms-content"] || 0)) {
                primary = wp;
            }
        }

        var layers = ranked
            .filter(function (r) {
                return r.slug !== primary.slug;
            })
            .slice(0, 6);

        return {
            primary: primary.slug,
            layers: layers.map(function (r) {
                return r.slug;
            }),
        };
    }

    function fillList(el, items, className) {
        if (!el) return;
        el.innerHTML = "";
        (items || []).forEach(function (text) {
            if (!text) return;
            var li = document.createElement("li");
            if (className) li.className = className;
            li.textContent = text;
            el.appendChild(li);
        });
    }

    function fillCard(slug, opts) {
        opts = opts || {};
        var item = catalog[slug] || {};
        if (opts.linkEl) {
            opts.linkEl.textContent = item.title || slug;
            opts.linkEl.href = item.url || "#";
        }
        if (opts.tagEl) opts.tagEl.textContent = item.tag || "";
        if (opts.summaryEl) {
            opts.summaryEl.textContent = item.lead || item.summary || "";
        }
        if (opts.whyEl) opts.whyEl.textContent = whys[slug] || "";
        fillList(opts.toolsEl, item.tools || []);
        fillList(opts.fitEl, item.fit_points || []);
    }

    function renderLayerCard(slug, i) {
        var item = catalog[slug];
        if (!item) return null;

        var article = document.createElement("article");
        article.className = "tl-stack-card";
        article.style.animationDelay = 0.08 * (i + 1) + "s";

        var tag = document.createElement("p");
        tag.className = "tl-stack-card__tag";
        tag.textContent = item.tag || "";

        var h = document.createElement("h4");
        h.className = "tl-stack-card__title";
        var a = document.createElement("a");
        a.href = item.url || "#";
        a.textContent = item.title || slug;
        h.appendChild(a);

        var summary = document.createElement("p");
        summary.className = "tl-stack-card__summary";
        summary.textContent = item.summary || item.lead || "";

        var meta = document.createElement("p");
        meta.className = "tl-stack-card__meta";
        meta.textContent = [item.best_for, item.maturity].filter(Boolean).join(" · ");

        var tools = document.createElement("ul");
        tools.className = "tl-stack-card__tools";
        fillList(tools, item.tools || []);

        var why = document.createElement("p");
        why.className = "tl-stack-card__why";
        why.textContent = whys[slug] || "";

        article.appendChild(tag);
        article.appendChild(h);
        article.appendChild(summary);
        if (meta.textContent) article.appendChild(meta);
        article.appendChild(tools);
        article.appendChild(why);
        return article;
    }

    function renderRecommendation() {
        var product = selectedProduct();
        var surface = selectedSurface();
        var priority = selectedPriority();
        var capabilities = selectedCapabilities();
        var result = recommend(product, surface, capabilities, priority);
        var primary = catalog[result.primary] || {};

        var titleEl = stackRoot.querySelector("[data-tl-primary-title]");
        var whyEl = stackRoot.querySelector("[data-tl-primary-why]");
        if (titleEl) titleEl.textContent = primary.title || result.primary;
        if (whyEl) {
            whyEl.textContent =
                primary.lead ||
                whys[result.primary] ||
                "A practical starting stack based on what you selected.";
        }

        fillCard(result.primary, {
            linkEl: stackRoot.querySelector("[data-tl-primary-link]"),
            tagEl: stackRoot.querySelector("[data-tl-primary-tag]"),
            summaryEl: stackRoot.querySelector("[data-tl-primary-summary]"),
            whyEl: stackRoot.querySelector("[data-tl-primary-card-why]"),
            toolsEl: stackRoot.querySelector("[data-tl-primary-tools]"),
            fitEl: stackRoot.querySelector("[data-tl-primary-fit]"),
        });

        var bestEl = stackRoot.querySelector("[data-tl-fact-best]");
        var maturityEl = stackRoot.querySelector("[data-tl-fact-maturity]");
        var deliveryEl = stackRoot.querySelector("[data-tl-fact-delivery]");
        if (bestEl) bestEl.textContent = primary.best_for || "—";
        if (maturityEl) maturityEl.textContent = primary.maturity || "—";
        if (deliveryEl) deliveryEl.textContent = primary.delivery || "—";
        if (factsEl) {
            factsEl.hidden = !(primary.best_for || primary.maturity || primary.delivery);
        }

        if (chipsEl) {
            chipsEl.innerHTML = "";
            var chipValues = [product, surfaceLabels[surface] || surface, priorityLabels[priority] || priority]
                .concat(
                    capabilities.map(function (key) {
                        return capabilityLabels[key] || key;
                    })
                )
                .filter(Boolean);
            chipValues.forEach(function (label) {
                var li = document.createElement("li");
                li.textContent = label;
                chipsEl.appendChild(li);
            });
        }

        if (layersEl) {
            layersEl.innerHTML = "";
            result.layers.forEach(function (slug, i) {
                var card = renderLayerCard(slug, i);
                if (card) layersEl.appendChild(card);
            });
        }

        fillList(nextListEl, nextStepsMap[priority] || nextStepsMap.fast || []);

        if (fieldProduct) fieldProduct.value = product;
        if (fieldSurface) fieldSurface.value = surface;
        if (fieldPriority) fieldPriority.value = priority;
        if (fieldPrimary) fieldPrimary.value = result.primary;

        if (capFields) {
            capFields.innerHTML = "";
            capabilities.forEach(function (key) {
                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "capabilities[]";
                input.value = key;
                capFields.appendChild(input);
            });
        }

        if (layerFields) {
            layerFields.innerHTML = "";
            result.layers.forEach(function (slug) {
                var input = document.createElement("input");
                input.type = "hidden";
                input.name = "layer_slugs[]";
                input.value = slug;
                layerFields.appendChild(input);
            });
        }
    }

    function showResults() {
        renderRecommendation();
        if (quizSection) quizSection.hidden = true;
        if (results) {
            results.hidden = false;
            results.scrollIntoView({ behavior: "smooth", block: "start" });
        }
    }

    function restartQuiz() {
        if (results) results.hidden = true;
        if (sendSection) sendSection.hidden = true;
        if (quizSection) quizSection.hidden = false;
        showStackStep(0);
        if (quizSection) quizSection.scrollIntoView({ behavior: "smooth", block: "start" });
    }

    if (stackWizard) {
        stackWizard.addEventListener("click", function (e) {
            var next = e.target.closest("[data-tl-next]");
            var prev = e.target.closest("[data-tl-prev]");
            var finish = e.target.closest("[data-tl-finish]");
            if (next) {
                if (!validateStackStep(stackIdx)) return;
                showStackStep(stackIdx + 1);
            }
            if (prev) showStackStep(stackIdx - 1);
            if (finish) {
                if (!validateStackStep(stackIdx)) return;
                showResults();
            }
        });
        showStackStep(0);
    }

    var openStackSend = stackRoot.querySelector("[data-tl-open-send]");
    if (openStackSend && sendSection) {
        openStackSend.addEventListener("click", function () {
            renderRecommendation();
            sendSection.hidden = false;
            sendSection.scrollIntoView({ behavior: "smooth", block: "start" });
        });
    }

    var restartBtn = stackRoot.querySelector("[data-tl-restart]");
    if (restartBtn) {
        restartBtn.addEventListener("click", restartQuiz);
    }

    // Restore results + send form after validation errors
    if (stackRoot.hasAttribute("data-tl-show-send")) {
        if (fieldProduct && fieldProduct.value) {
            var productInput = stackRoot.querySelector(
                '[data-tl-product][value="' + fieldProduct.value + '"]'
            );
            if (productInput) productInput.checked = true;
        }
        if (fieldSurface && fieldSurface.value) {
            var surfaceInput = stackRoot.querySelector(
                '[data-tl-surface][value="' + fieldSurface.value + '"]'
            );
            if (surfaceInput) surfaceInput.checked = true;
        }
        if (fieldPriority && fieldPriority.value) {
            var priorityInput = stackRoot.querySelector(
                '[data-tl-priority][value="' + fieldPriority.value + '"]'
            );
            if (priorityInput) priorityInput.checked = true;
        }

        if (selectedProduct() && selectedSurface() && selectedPriority()) {
            showResults();
            if (sendSection) sendSection.hidden = false;
        } else if (sendSection) {
            sendSection.hidden = false;
        }
    }
})();
