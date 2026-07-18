<?php

return [

    'services' => [
        'hub' => [
            'label' => 'Services',
            'heading' => 'What GujjuTicks builds',
            'lead' => 'Custom apps, websites, and software for startups and growing teams — clear scope, steady delivery, launches you can run.',
            'meta_title' => 'Services — Custom Apps, Websites & Software | GujjuTicks',
            'meta_description' => 'Explore GujjuTicks services: custom app development, modern websites, and business software for startups and growing teams.',
            'intro' => 'Pick the engagement that matches your goal. Every service includes discovery, a clear v1 scope, weekly demos, and launch support — so you always know what happens next.',
            'highlights' => [
                ['value' => '3', 'label' => 'Core service lines'],
                ['value' => 'v1', 'label' => 'Scoped first releases'],
                ['value' => '1 day', 'label' => 'Typical first reply'],
                ['value' => 'End-to-end', 'label' => 'From brief to go-live'],
            ],
            'who' => [
                'heading' => 'Who these services are for',
                'items' => [
                    [
                        'title' => 'Startups',
                        'text' => 'MVPs, first customer apps, and websites that support early traction and fundraising conversations.',
                    ],
                    [
                        'title' => 'Growing businesses',
                        'text' => 'Custom tools and sites that replace spreadsheet chaos and present the brand clearly online.',
                    ],
                    [
                        'title' => 'Product & ops teams',
                        'text' => 'Extra build capacity for features, portals, dashboards, and integrations when deadlines are tight.',
                    ],
                ],
            ],
            'principles' => [
                'heading' => 'How every engagement runs',
                'items' => [
                    [
                        'title' => 'Clear scope first',
                        'text' => 'We lock what “done” means before heavy build — so timelines stay honest.',
                    ],
                    [
                        'title' => 'Weekly visible progress',
                        'text' => 'Demos you can click, not status theatre. You see the product take shape.',
                    ],
                    [
                        'title' => 'Launch is part of the job',
                        'text' => 'Hosting basics, handover notes, and a prioritized backlog for what comes next.',
                    ],
                    [
                        'title' => 'Direct partnership',
                        'text' => 'Talk to the build team. Fast updates by email or WhatsApp — no long chain of layers.',
                    ],
                ],
            ],
            'process' => [
                ['phase' => '01', 'title' => 'Discover', 'text' => 'Goals, users, constraints, and a realistic v1.'],
                ['phase' => '02', 'title' => 'Plan', 'text' => 'Milestones, design direction, and success criteria.'],
                ['phase' => '03', 'title' => 'Build', 'text' => 'Iterative delivery with demos every week.'],
                ['phase' => '04', 'title' => 'Launch', 'text' => 'Go live, hand over, and optionally keep improving.'],
            ],
            'items' => [
                [
                    'slug' => 'custom-apps',
                    'tag' => '01',
                    'title' => 'Custom apps',
                    'summary' => 'Web and mobile product apps, portals, and MVPs tailored to your workflows.',
                ],
                [
                    'slug' => 'websites',
                    'tag' => '02',
                    'title' => 'Websites',
                    'summary' => 'Fast marketing and product sites that present your brand and convert visitors.',
                ],
                [
                    'slug' => 'custom-software',
                    'tag' => '03',
                    'title' => 'Custom software',
                    'summary' => 'Internal tools, integrations, and automation that reduce manual work.',
                ],
            ],
        ],
        'pages' => [
            'custom-apps' => [
                'label' => 'Custom apps',
                'heading' => 'Custom apps built around real users',
                'lead' => 'From MVP to production — web apps, customer portals, and admin tools shaped to how your team and customers actually work. We help you scope, build, launch, and keep improving.',
                'meta_title' => 'Custom App Development | GujjuTicks',
                'meta_description' => 'GujjuTicks designs and builds custom web and mobile apps, admin portals, and MVPs for startups and growing businesses — clear scope, steady delivery, launch support.',
                'category' => 'Product build',
                'ideal_for' => 'Startups & growing teams',
                'engagement' => 'Discovery → build → launch',
                'timeline' => 'Typically 6–12 weeks for v1',
                'tools' => ['Laravel', 'Modern web UI', 'APIs', 'PWA / mobile-ready', 'Cloud hosting'],
                'highlights' => [
                    ['value' => 'MVP', 'label' => 'Ship a usable first version'],
                    ['value' => 'Portal', 'label' => 'Customer & team access'],
                    ['value' => 'Admin', 'label' => 'Ops without spreadsheets'],
                    ['value' => 'Grow', 'label' => 'Iterate after launch'],
                ],
                'overview' => 'Off-the-shelf tools force your process to bend. GujjuTicks builds custom apps around your real workflows — so founders can validate a product, and operators can run day-to-day work without fighting generic software. You get a partner for scope, design, build, and go-live — not just code thrown over the wall.',
                'who_we_help' => [
                    'heading' => 'Who we help',
                    'body' => 'Teams that need a product or internal app that fits — and a partner who will own delivery through launch.',
                    'points' => [
                        'Founders shipping a first product or MVP to real users',
                        'Businesses replacing spreadsheet-heavy portals and handoffs',
                        'Product teams needing extra build capacity on a deadline',
                        'Operators who need role-based tools their staff will actually use',
                    ],
                ],
                'when_fit' => [
                    'heading' => 'A good fit when',
                    'body' => 'You need more than a template — a product that matches your process and can grow with you.',
                    'points' => [
                        'SaaS-style or internal tools do not match your workflow',
                        'You need auth, roles, and multi-step product flows',
                        'You want a clear v1 scope — not an endless wishlist',
                        'You care about launch, handover, and what comes next',
                    ],
                ],
                'approach' => [
                    'heading' => 'How we help you succeed',
                    'body' => 'We treat custom apps as products people use daily. Clarity beats feature count. Demos beat slide decks.',
                    'points' => [
                        'Short discovery to lock users, jobs, and success criteria',
                        'Cut scope to the flows that prove value in v1',
                        'Weekly demos so you always see progress',
                        'Launch with hosting basics and a prioritized next backlog',
                    ],
                ],
                'deliverables' => [
                    'heading' => 'What we can build for you',
                    'body' => 'Practical app types we deliver end-to-end — from first version to production use.',
                    'features' => [
                        [
                            'title' => 'Product MVPs',
                            'text' => 'A focused first release so you can onboard early users, learn fast, and decide what to build next.',
                        ],
                        [
                            'title' => 'Customer portals',
                            'text' => 'Secure login areas where customers view status, submit requests, or manage their account.',
                        ],
                        [
                            'title' => 'Admin & ops dashboards',
                            'text' => 'Internal tools for your team — queues, filters, roles, and actions without spreadsheet chaos.',
                        ],
                        [
                            'title' => 'Workflow apps',
                            'text' => 'Apps that move work through clear stages — approvals, assignments, and handoffs you can trust.',
                        ],
                        [
                            'title' => 'Mobile-ready experiences',
                            'text' => 'Responsive and PWA-friendly apps when your users live on phones.',
                        ],
                        [
                            'title' => 'API-backed products',
                            'text' => 'Solid backends and APIs so web, mobile, and integrations share one source of truth.',
                        ],
                    ],
                ],
                'included' => [
                    'heading' => 'What is typically included',
                    'items' => [
                        'Discovery workshop and written v1 scope',
                        'UX direction for primary screens and flows',
                        'Application build (auth, roles, core features)',
                        'Admin or ops surface where needed',
                        'Staging + production deploy with SSL',
                        'Handover notes and a prioritized post-launch backlog',
                    ],
                ],
                'process' => [
                    ['phase' => '01', 'title' => 'Discover', 'text' => 'Users, constraints, success metrics, and a hard cut for v1.'],
                    ['phase' => '02', 'title' => 'Design & plan', 'text' => 'Key flows, milestones, and what “done” looks like.'],
                    ['phase' => '03', 'title' => 'Build', 'text' => 'Iterative delivery with demos you can click every week.'],
                    ['phase' => '04', 'title' => 'Launch & support', 'text' => 'Go live, hand over, and optionally keep improving.'],
                ],
                'outcome' => [
                    'heading' => 'What you walk away with',
                    'body' => 'A usable app in production — plus clarity on what to build next. We stay with you through launch so you are not left guessing.',
                    'results' => [
                        'Working custom app your users can use',
                        'Clear ownership of roles, data, and workflows',
                        'Hosting-ready deployment and access notes',
                        'A next-sprint backlog based on real priorities',
                    ],
                ],
                'proof' => [
                    'heading' => 'Related proof',
                    'items' => [
                        [
                            'label' => 'Case study',
                            'title' => 'Startup MVP launch',
                            'text' => 'How we cut scope and shipped a first product in eight weeks.',
                            'route' => 'pages.work.show',
                            'params' => ['slug' => 'startup-mvp'],
                        ],
                        [
                            'label' => 'Case study',
                            'title' => 'Operations dashboard',
                            'text' => 'Replacing spreadsheet ops with a role-based app.',
                            'route' => 'pages.work.show',
                            'params' => ['slug' => 'ops-dashboard'],
                        ],
                        [
                            'label' => 'Capability',
                            'title' => 'MVP development',
                            'text' => 'Our approach to first versions that teach you something.',
                            'route' => 'pages.capabilities.show',
                            'params' => ['slug' => 'mvp-development'],
                        ],
                    ],
                ],
                'tech_links' => [
                    'heading' => 'Technology we use',
                    'items' => [
                        ['title' => 'Laravel', 'slug' => 'laravel', 'text' => 'Solid product backends and admin tools'],
                        ['title' => 'Web apps', 'slug' => 'web-apps', 'text' => 'Clear interfaces for daily use'],
                        ['title' => 'APIs', 'slug' => 'apis-integrations', 'text' => 'Connect apps and automate handoffs'],
                        ['title' => 'Mobile & PWA', 'slug' => 'mobile-apps', 'text' => 'Phone-ready product experiences'],
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'How long does a custom app take?',
                        'a' => 'A focused v1 often lands in about 6–12 weeks depending on scope. We confirm timeline after a short discovery — not before we understand the work.',
                    ],
                    [
                        'q' => 'Do you only build MVPs?',
                        'a' => 'No. We build MVPs, portals, dashboards, and ongoing product features. MVP is simply how many projects start when learning speed matters.',
                    ],
                    [
                        'q' => 'Will we own the code?',
                        'a' => 'Yes. Project deliverables and ownership are agreed in writing before build work begins. We design for handoff, not lock-in.',
                    ],
                    [
                        'q' => 'Can you maintain the app after launch?',
                        'a' => 'Yes. Many clients keep us on for fixes, small features, and hosting upkeep after go-live.',
                    ],
                ],
                'cta' => [
                    'eyebrow' => 'Start with a short brief',
                    'text' => 'Tell us what users need to do. We will help you shape a realistic v1 and a path to launch.',
                    'secondary_label' => 'See MVP case study',
                    'secondary_route' => 'pages.work.show',
                    'secondary_params' => ['slug' => 'startup-mvp'],
                ],
                'sections' => [],
            ],
            'websites' => [
                'label' => 'Websites',
                'heading' => 'Websites that look sharp and convert',
                'lead' => 'Marketing and product websites with clear messaging, strong performance, and room to update as you grow — so visitors understand what you do and know how to enquire.',
                'meta_title' => 'Website Development | GujjuTicks',
                'meta_description' => 'GujjuTicks builds modern company websites and landing pages that present your brand clearly, load fast, and convert visitors into enquiries.',
                'category' => 'Brand & conversion',
                'ideal_for' => 'Startups & growing companies',
                'engagement' => 'Audit → design → build → launch',
                'timeline' => 'Typically 3–6 weeks to launch',
                'tools' => ['Responsive UI', 'SEO basics', 'Contact flows', 'Performance', 'Editable sections'],
                'highlights' => [
                    ['value' => 'Clear', 'label' => 'Offer visitors understand fast'],
                    ['value' => 'Fast', 'label' => 'Mobile-first performance'],
                    ['value' => 'Convert', 'label' => 'Paths to enquire & WhatsApp'],
                    ['value' => 'Own', 'label' => 'Easy content updates'],
                ],
                'overview' => 'A website should sell as clearly as your best sales call. GujjuTicks designs and builds company sites and landing pages around your real offer — structure, copy hierarchy, and CTAs that match how deals start — then ships a fast mobile-first presence you are proud to share and easy to keep current.',
                'who_we_help' => [
                    'heading' => 'Who we help',
                    'body' => 'Teams whose current site undersells them — or who need a credible launch-ready presence quickly.',
                    'points' => [
                        'Founders launching or repositioning a product or company',
                        'Service businesses that need a sharper story and enquire path',
                        'Sales-led teams tired of explaining “what we do” on every call',
                        'Growing brands replacing a dated or template-looking site',
                    ],
                ],
                'when_fit' => [
                    'heading' => 'A good fit when',
                    'body' => 'You need more than a pretty template — a site that presents the offer clearly and supports real conversations.',
                    'points' => [
                        'Visitors cannot tell what you sell or who it is for',
                        'You are raising, launching, or entering a new market',
                        'Mobile traffic is high but the site feels slow or cluttered',
                        'You want contact and WhatsApp paths that feel natural',
                    ],
                ],
                'approach' => [
                    'heading' => 'How we help you succeed',
                    'body' => 'We treat the website as a sales aid: one story, one hierarchy, and CTAs aligned to how you actually close work.',
                    'points' => [
                        'Short audit of your current site, offer, and sales objections',
                        'Rewrite structure around services, proof, and next steps',
                        'Design a calm premium look without template clutter',
                        'Ship with SEO basics, performance care, and handover notes',
                    ],
                ],
                'deliverables' => [
                    'heading' => 'What we can build for you',
                    'body' => 'Website types and pages that support growth — from first impression to enquire.',
                    'features' => [
                        [
                            'title' => 'Company websites',
                            'text' => 'Home, services, about, and contact flows that explain the offer without fluff.',
                        ],
                        [
                            'title' => 'Product marketing sites',
                            'text' => 'Pages that position a product clearly for prospects, partners, or investors.',
                        ],
                        [
                            'title' => 'Landing pages',
                            'text' => 'Campaign or offer pages focused on a single conversion goal.',
                        ],
                        [
                            'title' => 'Rebuilds & refreshes',
                            'text' => 'Replace a dated site with modern structure, messaging, and mobile performance.',
                        ],
                        [
                            'title' => 'Conversion paths',
                            'text' => 'Forms, contact pages, and WhatsApp CTAs where your audience expects them.',
                        ],
                        [
                            'title' => 'SEO-ready foundations',
                            'text' => 'Clean URLs, meta, headings, and page speed basics search engines and users reward.',
                        ],
                    ],
                ],
                'included' => [
                    'heading' => 'What is typically included',
                    'items' => [
                        'Site audit and messaging / IA recommendations',
                        'Key page designs and responsive layout',
                        'Build of primary pages (home, services, contact, and agreed extras)',
                        'Contact form and/or WhatsApp conversion paths',
                        'SEO basics (titles, descriptions, structure) and performance pass',
                        'Launch support and guidance for ongoing content updates',
                    ],
                ],
                'process' => [
                    ['phase' => '01', 'title' => 'Audit & brief', 'text' => 'Review goals, audience, competitors, and gaps in the current site.'],
                    ['phase' => '02', 'title' => 'IA & design', 'text' => 'Sitemap, key layouts, and visual direction that fits your brand.'],
                    ['phase' => '03', 'title' => 'Build', 'text' => 'Responsive pages, content load-in, forms, and polish.'],
                    ['phase' => '04', 'title' => 'Launch', 'text' => 'QA, go-live, SEO checks, and handover for updates.'],
                ],
                'outcome' => [
                    'heading' => 'What you walk away with',
                    'body' => 'A credible web presence that matches how you sell — faster to understand, easier to share, and simpler to maintain.',
                    'results' => [
                        'Clear positioning visitors grasp in seconds',
                        'Stronger enquire / contact paths on key pages',
                        'Fast, mobile-first experience',
                        'A site your team can update without breaking the design',
                    ],
                ],
                'proof' => [
                    'heading' => 'Related proof',
                    'items' => [
                        [
                            'label' => 'Case study',
                            'title' => 'Marketing website rebuild',
                            'text' => 'How we rebuilt a B2B site for clearer offer and conversion.',
                            'route' => 'pages.work.show',
                            'params' => ['slug' => 'marketing-website'],
                        ],
                        [
                            'label' => 'Capability',
                            'title' => 'Business websites',
                            'text' => 'Our approach to sites that support sales and launches.',
                            'route' => 'pages.capabilities.show',
                            'params' => ['slug' => 'business-websites'],
                        ],
                        [
                            'label' => 'Service',
                            'title' => 'Custom apps',
                            'text' => 'When your website needs a product or portal behind it.',
                            'route' => 'pages.services.show',
                            'params' => ['slug' => 'custom-apps'],
                        ],
                    ],
                ],
                'tech_links' => [
                    'heading' => 'Technology we use',
                    'items' => [
                        ['title' => 'Web apps', 'slug' => 'web-apps', 'text' => 'Modern, maintainable front-end interfaces'],
                        ['title' => 'Hosting & DevOps', 'slug' => 'hosting-devops', 'text' => 'SSL, deploy, and keep the site live'],
                        ['title' => 'Laravel', 'slug' => 'laravel', 'text' => 'When the site needs a CMS or app backend'],
                        ['title' => 'APIs', 'slug' => 'apis-integrations', 'text' => 'Forms, CRM, and marketing tool connections'],
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'How long does a website project take?',
                        'a' => 'Many company sites and rebuilds launch in about 3–6 weeks depending on page count and content readiness. We confirm timeline after a short brief.',
                    ],
                    [
                        'q' => 'Do you write the copy?',
                        'a' => 'We help with structure, hierarchy, and sharpening messaging. Final voice often comes from you — we guide what each page must say so visitors get it.',
                    ],
                    [
                        'q' => 'Can we update the site ourselves later?',
                        'a' => 'Yes. We build with clear sections and handover notes so your team can change content without redesigning from scratch.',
                    ],
                    [
                        'q' => 'Will the site work well on mobile?',
                        'a' => 'Yes. Every site we ship is mobile-first — layouts, type, and CTAs are designed for phones first, then scaled up.',
                    ],
                ],
                'cta' => [
                    'eyebrow' => 'Upgrade your web presence',
                    'text' => 'Share your current site or a short brief. We will outline a clearer structure and a path to launch.',
                    'secondary_label' => 'See website case study',
                    'secondary_route' => 'pages.work.show',
                    'secondary_params' => ['slug' => 'marketing-website'],
                ],
                'sections' => [],
            ],
            'custom-software' => [
                'label' => 'Custom software',
                'heading' => 'Custom software for how your business runs',
                'lead' => 'Internal systems and integrations that replace spreadsheets, connect your tools, and automate repetitive work — so teams operate from one source of truth.',
                'meta_title' => 'Custom Software Development | GujjuTicks',
                'meta_description' => 'GujjuTicks builds custom business software, internal tools, and integrations so teams can operate with less friction and fewer spreadsheet bridges.',
                'category' => 'Operations & systems',
                'ideal_for' => 'Growing businesses & ops teams',
                'engagement' => 'Map process → build → rollout',
                'timeline' => 'Typically 5–10 weeks for v1',
                'tools' => ['Laravel', 'Admin dashboards', 'APIs', 'Automations', 'Role-based access'],
                'highlights' => [
                    ['value' => 'Ops', 'label' => 'Tools your team runs daily'],
                    ['value' => 'Sync', 'label' => 'Systems that stay connected'],
                    ['value' => 'Auto', 'label' => 'Less manual busywork'],
                    ['value' => 'Truth', 'label' => 'One shared status view'],
                ],
                'overview' => 'Generic software leaves gaps. Spreadsheets fill them — until growth makes that fragile. GujjuTicks builds custom business software around how your team already works: internal tools, workflows, reporting, and integrations that cut copy-paste and missed handoffs. You get a practical system you can run every day — plus a partner through rollout, not just a one-off build.',
                'who_we_help' => [
                    'heading' => 'Who we help',
                    'body' => 'Operators and leaders who need software that matches their process — not another tool they have to work around.',
                    'points' => [
                        'Operations teams drowning in sheets, chats, and status chase-downs',
                        'Growing businesses that outgrew off-the-shelf workflows',
                        'Managers who need one trusted view of work and ownership',
                        'Teams connecting CRM, payments, or internal apps that do not talk today',
                    ],
                ],
                'when_fit' => [
                    'heading' => 'A good fit when',
                    'body' => 'Manual processes are slowing growth — and generic tools leave gaps you keep patching by hand.',
                    'points' => [
                        'People copy-paste between systems every day',
                        'Status lives in multiple places and nobody trusts “current”',
                        'Handoffs between roles or shifts get missed',
                        'You need software shaped to your rules, not the other way around',
                    ],
                ],
                'approach' => [
                    'heading' => 'How we help you succeed',
                    'body' => 'We start from real routines — not org charts — then ship software people will actually open.',
                    'points' => [
                        'Map day-to-day workflows, exceptions, and who owns each step',
                        'Define roles, statuses, and the minimum viable ops model for v1',
                        'Build in slices so the team can adopt without a risky big-bang cutover',
                        'Document how to run and extend the system after launch',
                    ],
                ],
                'deliverables' => [
                    'heading' => 'What we can build for you',
                    'body' => 'Business systems that reduce friction — from internal tools to integrations and automation.',
                    'features' => [
                        [
                            'title' => 'Internal business tools',
                            'text' => 'Custom apps for ops, finance, support, or field teams — built around your real jobs.',
                        ],
                        [
                            'title' => 'Ops dashboards',
                            'text' => 'Queues, filters, ownership, and status in one place your managers can trust.',
                        ],
                        [
                            'title' => 'Workflow & approvals',
                            'text' => 'Clear stages, handoffs, and permissions so work moves intentionally.',
                        ],
                        [
                            'title' => 'System integrations',
                            'text' => 'Connect CRM, payments, messaging, sheets, and internal apps so data stays in sync.',
                        ],
                        [
                            'title' => 'Automation workflows',
                            'text' => 'Jobs and triggers that remove repetitive updates and reminder chase-downs.',
                        ],
                        [
                            'title' => 'Reporting & exports',
                            'text' => 'Summaries and exports for weekly reviews — without rebuilding the spreadsheet every Monday.',
                        ],
                    ],
                ],
                'included' => [
                    'heading' => 'What is typically included',
                    'items' => [
                        'Process discovery and written scope for v1',
                        'Roles, permissions, and status model design',
                        'Build of the core tool or dashboard',
                        'Key integrations or automations agreed in scope',
                        'Staging + production deploy with access control',
                        'Rollout support, training notes, and a next-step backlog',
                    ],
                ],
                'process' => [
                    ['phase' => '01', 'title' => 'Map', 'text' => 'Workflows, pain points, and the source of truth for each field.'],
                    ['phase' => '02', 'title' => 'Design', 'text' => 'Roles, statuses, screens, and a safe migration plan from sheets.'],
                    ['phase' => '03', 'title' => 'Build', 'text' => 'Iterative delivery with demos your ops team can try.'],
                    ['phase' => '04', 'title' => 'Rollout', 'text' => 'Pilot, train, go live, and plan the next automations.'],
                ],
                'outcome' => [
                    'heading' => 'What you walk away with',
                    'body' => 'A system your team runs from daily — fewer missed handoffs, less reconciliation, and a base for future automation.',
                    'results' => [
                        'One shared source of truth for operational status',
                        'Clear ownership and permissions by role',
                        'Fewer manual bridges between tools',
                        'A foundation ready for notifications and deeper integrations',
                    ],
                ],
                'proof' => [
                    'heading' => 'Related proof',
                    'items' => [
                        [
                            'label' => 'Case study',
                            'title' => 'Operations dashboard',
                            'text' => 'How we replaced spreadsheet ops with a role-based dashboard.',
                            'route' => 'pages.work.show',
                            'params' => ['slug' => 'ops-dashboard'],
                        ],
                        [
                            'label' => 'Capability',
                            'title' => 'System integrations',
                            'text' => 'Connecting tools so data moves without copy-paste.',
                            'route' => 'pages.capabilities.show',
                            'params' => ['slug' => 'system-integrations'],
                        ],
                        [
                            'label' => 'Capability',
                            'title' => 'Admin dashboards',
                            'text' => 'Internal portals teams use every day.',
                            'route' => 'pages.capabilities.show',
                            'params' => ['slug' => 'admin-dashboards'],
                        ],
                    ],
                ],
                'tech_links' => [
                    'heading' => 'Technology we use',
                    'items' => [
                        ['title' => 'Laravel', 'slug' => 'laravel', 'text' => 'Reliable backends for business rules and admin'],
                        ['title' => 'APIs & integrations', 'slug' => 'apis-integrations', 'text' => 'Connect CRM, payments, and internal tools'],
                        ['title' => 'Web apps', 'slug' => 'web-apps', 'text' => 'Dashboards and portals people can actually use'],
                        ['title' => 'Hosting & DevOps', 'slug' => 'hosting-devops', 'text' => 'Secure deploy and ongoing upkeep'],
                    ],
                ],
                'faqs' => [
                    [
                        'q' => 'How is this different from a custom app?',
                        'a' => 'Custom apps often focus on a product for customers. Custom software here means internal systems — ops tools, workflows, and integrations that make the business run smoother.',
                    ],
                    [
                        'q' => 'Can you replace our spreadsheets gradually?',
                        'a' => 'Yes. We usually pilot with one team or workflow first, then expand — so you are not forced into a risky overnight cutover.',
                    ],
                    [
                        'q' => 'Do you integrate with tools we already use?',
                        'a' => 'Often yes — CRM, payments, email, messaging, and similar systems. We map what must sync and design for failures, not only the happy path.',
                    ],
                    [
                        'q' => 'Will you support us after rollout?',
                        'a' => 'Yes. Many clients keep us on for fixes, small features, and new automations once the first system is live.',
                    ],
                ],
                'cta' => [
                    'eyebrow' => 'Fix the spreadsheet bottleneck',
                    'text' => 'Tell us where work gets stuck. We will help you shape a practical v1 system and a safe rollout path.',
                    'secondary_label' => 'See ops dashboard case study',
                    'secondary_route' => 'pages.work.show',
                    'secondary_params' => ['slug' => 'ops-dashboard'],
                ],
                'sections' => [],
            ],
        ],
    ],

    'technology' => [
        'hub' => [
            'label' => 'Technology',
            'heading' => 'The stack we build with',
            'lead' => 'Practical technologies chosen for reliability, maintainability, and speed to launch — not hype.',
            'meta_title' => 'Technology — How GujjuTicks Builds | GujjuTicks',
            'meta_description' => 'See the technologies GujjuTicks uses to build custom apps, websites, APIs, and software — Laravel, modern web apps, integrations, and more.',
            'intro' => 'Browse how we use each layer of the stack — what it is good for, what we deliver, and when it is the right fit for your project.',
            'items' => [
                [
                    'slug' => 'laravel',
                    'tag' => 'Backend',
                    'title' => 'Laravel',
                    'summary' => 'Robust PHP applications, admin panels, and APIs on a proven framework.',
                ],
                [
                    'slug' => 'web-apps',
                    'tag' => 'Frontend',
                    'title' => 'Modern web apps',
                    'summary' => 'Fast, clear interfaces for products, dashboards, and customer-facing tools.',
                ],
                [
                    'slug' => 'apis-integrations',
                    'tag' => 'Connect',
                    'title' => 'APIs & integrations',
                    'summary' => 'Connect systems, automate handoffs, and keep data moving reliably.',
                ],
                [
                    'slug' => 'mobile-apps',
                    'tag' => 'Mobile',
                    'title' => 'Mobile & PWA',
                    'summary' => 'Mobile-ready experiences and progressive web apps when native is not required.',
                ],
                [
                    'slug' => 'hosting-devops',
                    'tag' => 'Ops',
                    'title' => 'Hosting & DevOps',
                    'summary' => 'Deployments, SSL, uptime basics, and ongoing maintenance support.',
                ],
            ],
        ],
        'pages' => [
            'laravel' => [
                'label' => 'Laravel',
                'heading' => 'Laravel for solid product backends',
                'lead' => 'We use Laravel to ship maintainable apps — authentication, admin tools, APIs, and business logic you can grow on without rewriting every year.',
                'meta_title' => 'Laravel Development | GujjuTicks',
                'meta_description' => 'GujjuTicks builds custom Laravel applications, admin panels, and APIs for startups and growing businesses.',
                'category' => 'Backend',
                'best_for' => 'Web products, portals, admin systems',
                'maturity' => 'Battle-tested framework',
                'delivery' => 'MVP to production apps',
                'tools' => ['Laravel', 'PHP', 'Eloquent', 'Queues', 'REST APIs'],
                'highlights' => [
                    ['value' => 'Auth', 'label' => 'Roles & sessions built in'],
                    ['value' => 'API', 'label' => 'Clean endpoints for apps'],
                    ['value' => 'Admin', 'label' => 'Panels your team can run'],
                    ['value' => 'Grow', 'label' => 'Code you can extend'],
                ],
                'overview' => 'Laravel is our default for custom web backends when you need structure, security patterns, and a codebase the next engineer can understand. We use it for product apps, customer portals, admin tools, and the APIs that connect them.',
                'when_fit' => [
                    'heading' => 'When Laravel is a fit',
                    'body' => 'Choose Laravel when you need a serious web application — not a static brochure — with real users, permissions, and business rules.',
                    'points' => [
                        'You are building a custom app or internal portal',
                        'You need auth, roles, and workflow logic',
                        'You want APIs for a web or mobile client',
                        'Long-term maintainability matters more than a trendy experiment',
                    ],
                ],
                'approach' => [
                    'heading' => 'How we use it',
                    'body' => 'We keep the stack boring on purpose — conventions first, custom only where your product needs it.',
                    'points' => [
                        'Model the domain around real user jobs',
                        'Ship critical flows first; park nice-to-haves',
                        'Use queues, mail, and jobs for reliable side work',
                        'Document handoff so your team is not stuck',
                    ],
                ],
                'deliverables' => [
                    'heading' => 'What we deliver',
                    'body' => 'Production-minded Laravel work — scoped, tested on critical paths, and ready to host.',
                    'features' => [
                        [
                            'title' => 'Custom web applications',
                            'text' => 'Product backends with the rules, data, and workflows your business actually needs.',
                        ],
                        [
                            'title' => 'Admin panels',
                            'text' => 'Ops and content tools so your team can support users without asking engineering every time.',
                        ],
                        [
                            'title' => 'REST APIs',
                            'text' => 'Stable endpoints for web apps, mobile clients, and partner systems.',
                        ],
                        [
                            'title' => 'Auth & permissions',
                            'text' => 'Sign-in, roles, and access control shaped to how your organization works.',
                        ],
                    ],
                ],
                'process' => [
                    ['phase' => '01', 'title' => 'Scope', 'text' => 'Users, flows, and a clear definition of v1.'],
                    ['phase' => '02', 'title' => 'Model', 'text' => 'Data shape, roles, and API or page boundaries.'],
                    ['phase' => '03', 'title' => 'Build', 'text' => 'Iterative delivery with demos you can click.'],
                    ['phase' => '04', 'title' => 'Launch', 'text' => 'Deploy, harden, and hand over with notes.'],
                ],
                'outcome' => [
                    'heading' => 'What you walk away with',
                    'body' => 'A maintainable Laravel foundation — not a fragile prototype — plus a path for the next features.',
                    'results' => [
                        'Working product or admin surface in production',
                        'Clear code structure for future engineers',
                        'Hosting-ready deployment',
                        'Prioritized backlog for the next release',
                    ],
                ],
                'cta' => [
                    'eyebrow' => 'Build on Laravel',
                    'text' => 'Need a custom app, portal, or API on a solid Laravel base?',
                    'secondary_label' => 'Custom apps',
                    'secondary_route' => 'pages.services.show',
                    'secondary_params' => ['slug' => 'custom-apps'],
                ],
                'sections' => [],
            ],
            'web-apps' => [
                'label' => 'Web apps',
                'heading' => 'Modern web app interfaces',
                'lead' => 'Interfaces that feel fast and clear — for products, dashboards, and tools people use every day, on desktop and mobile.',
                'meta_title' => 'Web App Development | GujjuTicks',
                'meta_description' => 'GujjuTicks designs and builds modern web application interfaces for products, dashboards, and business tools.',
                'category' => 'Frontend',
                'best_for' => 'Product UI, dashboards, portals',
                'maturity' => 'Responsive & accessible',
                'delivery' => 'Design through front-end build',
                'tools' => ['HTML/CSS', 'Modern JS', 'Responsive UI', 'Design systems'],
                'highlights' => [
                    ['value' => 'UX', 'label' => 'Clarity over clutter'],
                    ['value' => 'Fast', 'label' => 'Snappy everyday use'],
                    ['value' => 'Mobile', 'label' => 'Works on small screens'],
                    ['value' => 'Own', 'label' => 'Maintainable front-end'],
                ],
                'overview' => 'A strong backend is wasted if the interface fights the user. We design and build web app UIs that make primary jobs obvious — with responsive layouts, sensible states, and code your team can keep improving.',
                'when_fit' => [
                    'heading' => 'When this fits',
                    'body' => 'You need a product or internal tool people will open daily — not a one-page marketing site.',
                    'points' => [
                        'Dashboards, portals, or multi-step product flows',
                        'You care about speed and readability on mobile',
                        'Current UI is confusing or inconsistent',
                        'You want a clean front-end that matches a Laravel or API backend',
                    ],
                ],
                'approach' => [
                    'heading' => 'How we design & build',
                    'body' => 'Usability first. Visual polish supports the job — it does not replace it.',
                    'points' => [
                        'Map the primary jobs before pixels',
                        'Prototype key screens early for feedback',
                        'Build responsive layouts with clear hierarchy',
                        'Keep components consistent so the product feels coherent',
                    ],
                ],
                'deliverables' => [
                    'heading' => 'What we deliver',
                    'body' => 'Front-end work that is ready to connect to your product backend.',
                    'features' => [
                        [
                            'title' => 'Product interfaces',
                            'text' => 'Screens and flows for the jobs users hire your product to do.',
                        ],
                        [
                            'title' => 'Dashboards & portals',
                            'text' => 'Dense data made scannable — tables, filters, empty states, and actions.',
                        ],
                        [
                            'title' => 'Responsive layouts',
                            'text' => 'Desktop-quality tools that still work on tablets and phones.',
                        ],
                        [
                            'title' => 'Maintainable UI code',
                            'text' => 'Structured front-end so new screens do not become a one-off mess.',
                        ],
                    ],
                ],
                'process' => [
                    ['phase' => '01', 'title' => 'Flows', 'text' => 'Define the jobs and happy paths.'],
                    ['phase' => '02', 'title' => 'UI direction', 'text' => 'Layout, hierarchy, and interaction patterns.'],
                    ['phase' => '03', 'title' => 'Build', 'text' => 'Implement responsive screens and states.'],
                    ['phase' => '04', 'title' => 'Polish', 'text' => 'Performance, accessibility basics, handoff.'],
                ],
                'outcome' => [
                    'heading' => 'What you walk away with',
                    'body' => 'An interface people can learn quickly — and a front-end foundation that does not fight every new feature.',
                    'results' => [
                        'Clear primary actions on key screens',
                        'Consistent patterns across the product',
                        'Mobile-ready layouts',
                        'Front-end ready to pair with your API or Laravel app',
                    ],
                ],
                'cta' => [
                    'eyebrow' => 'Upgrade the interface',
                    'text' => 'Need a web app UI that feels fast, clear, and ready for real users?',
                    'secondary_label' => 'View work',
                    'secondary_route' => 'pages.work',
                    'secondary_params' => [],
                ],
                'sections' => [],
            ],
            'apis-integrations' => [
                'label' => 'APIs & integrations',
                'heading' => 'APIs and system integrations',
                'lead' => 'Connect the tools you already use — payments, CRM, messaging, analytics — or expose clean APIs for your own products and partners.',
                'meta_title' => 'API & Integration Development | GujjuTicks',
                'meta_description' => 'GujjuTicks builds APIs and third-party integrations so your apps, websites, and business tools work together.',
                'category' => 'Connect',
                'best_for' => 'Sync, automation, partner APIs',
                'maturity' => 'Reliable handoffs',
                'delivery' => 'Endpoints, webhooks, sync jobs',
                'tools' => ['REST APIs', 'Webhooks', 'OAuth', 'Queues', 'Third-party SDKs'],
                'highlights' => [
                    ['value' => 'API', 'label' => 'Stable contracts'],
                    ['value' => 'Sync', 'label' => 'Less copy-paste work'],
                    ['value' => 'Hooks', 'label' => 'Event-driven updates'],
                    ['value' => 'Logs', 'label' => 'Easier debugging'],
                ],
                'overview' => 'Integrations remove busywork when they are designed around failure cases — retries, logging, and clear ownership. We build APIs and connectors so your apps, CRMs, payments, and ops tools stay in sync.',
                'when_fit' => [
                    'heading' => 'When this fits',
                    'body' => 'Your team is the integration — copying data between systems every day.',
                    'points' => [
                        'Two or more tools must share customers, orders, or status',
                        'You need a public or private API for a client app',
                        'Payments, email, or messaging should fire automatically',
                        'Manual spreadsheet bridges are becoming a risk',
                    ],
                ],
                'approach' => [
                    'heading' => 'How we approach integrations',
                    'body' => 'We design for the unhappy path: timeouts, duplicates, and partial failures.',
                    'points' => [
                        'Define the source of truth for each field',
                        'Prefer idempotent jobs and clear retry rules',
                        'Log enough to debug without exposing secrets',
                        'Document how to re-run or pause a sync',
                    ],
                ],
                'deliverables' => [
                    'heading' => 'What we deliver',
                    'body' => 'Connections your ops and product teams can trust.',
                    'features' => [
                        [
                            'title' => 'REST APIs',
                            'text' => 'Well-shaped endpoints for your apps, partners, or internal tools.',
                        ],
                        [
                            'title' => 'Provider integrations',
                            'text' => 'Payments, email, SMS, CRM, and other services wired into your product.',
                        ],
                        [
                            'title' => 'Webhooks & automation',
                            'text' => 'Event-driven updates so status moves without someone refreshing a sheet.',
                        ],
                        [
                            'title' => 'Sync & mapping',
                            'text' => 'Field maps, schedules, and rules that match how your business actually works.',
                        ],
                    ],
                ],
                'process' => [
                    ['phase' => '01', 'title' => 'Map', 'text' => 'Systems, fields, and who owns the truth.'],
                    ['phase' => '02', 'title' => 'Contract', 'text' => 'API shapes, events, and error behaviour.'],
                    ['phase' => '03', 'title' => 'Build', 'text' => 'Connectors, jobs, and observability basics.'],
                    ['phase' => '04', 'title' => 'Harden', 'text' => 'Retries, monitoring, and runbook notes.'],
                ],
                'outcome' => [
                    'heading' => 'What you walk away with',
                    'body' => 'Fewer manual bridges — and integrations that fail loudly instead of silently.',
                    'results' => [
                        'Working sync or API in production',
                        'Documented contracts for future clients',
                        'Basic logging for support and debugging',
                        'A path to add the next system without starting over',
                    ],
                ],
                'cta' => [
                    'eyebrow' => 'Connect your stack',
                    'text' => 'Ready to stop copy-pasting between tools?',
                    'secondary_label' => 'Integrations capability',
                    'secondary_route' => 'pages.capabilities.show',
                    'secondary_params' => ['slug' => 'system-integrations'],
                ],
                'sections' => [],
            ],
            'mobile-apps' => [
                'label' => 'Mobile & PWA',
                'heading' => 'Mobile-ready apps and PWAs',
                'lead' => 'Reach users on phones with progressive web apps or mobile-first product experiences — without always needing a full native build.',
                'meta_title' => 'Mobile App & PWA Development | GujjuTicks',
                'meta_description' => 'GujjuTicks builds mobile-ready applications and progressive web apps for startups and growing teams.',
                'category' => 'Mobile',
                'best_for' => 'Field teams, customers on phones',
                'maturity' => 'PWA & responsive-first',
                'delivery' => 'Mobile UX + installable web',
                'tools' => ['PWA', 'Responsive UI', 'Mobile UX', 'Offline-friendly patterns'],
                'highlights' => [
                    ['value' => 'PWA', 'label' => 'Installable experiences'],
                    ['value' => 'One', 'label' => 'Codebase to ship & update'],
                    ['value' => 'Fast', 'label' => 'Phone-first flows'],
                    ['value' => 'Field', 'label' => 'Built for on-the-go use'],
                ],
                'overview' => 'Not every product needs two native app stores on day one. We build mobile-first web apps and PWAs when you need phone reach quickly — with touch-friendly flows and a path to deepen later if native becomes necessary.',
                'when_fit' => [
                    'heading' => 'When this fits',
                    'body' => 'Your users live on phones, and speed-to-ship matters more than app-store ceremony.',
                    'points' => [
                        'Customers or staff primarily use mobile browsers',
                        'You want installable feel without a full native team',
                        'You already have (or plan) a web backend / API',
                        'You need to iterate features weekly, not per store review',
                    ],
                ],
                'approach' => [
                    'heading' => 'How we approach mobile',
                    'body' => 'Design for thumbs first. Desktop can be a wider version of the same jobs.',
                    'points' => [
                        'Prioritize the three flows people open on the go',
                        'Keep forms short and states obvious',
                        'Use PWA capabilities where they add real value',
                        'Plan offline or flaky-network behaviour when needed',
                    ],
                ],
                'deliverables' => [
                    'heading' => 'What we deliver',
                    'body' => 'Mobile experiences that feel intentional — not a shrunk desktop site.',
                    'features' => [
                        [
                            'title' => 'Progressive web apps',
                            'text' => 'Installable web apps with a focused shell for repeat use.',
                        ],
                        [
                            'title' => 'Mobile-first product flows',
                            'text' => 'Touch-friendly UI for the jobs that matter on a small screen.',
                        ],
                        [
                            'title' => 'Responsive portals',
                            'text' => 'Customer or field portals that stay usable away from a desk.',
                        ],
                        [
                            'title' => 'API-ready clients',
                            'text' => 'Front-ends that sit cleanly on your Laravel or REST backend.',
                        ],
                    ],
                ],
                'process' => [
                    ['phase' => '01', 'title' => 'Jobs', 'text' => 'Which mobile moments matter most.'],
                    ['phase' => '02', 'title' => 'UX', 'text' => 'Thumb-friendly flows and layouts.'],
                    ['phase' => '03', 'title' => 'Build', 'text' => 'Responsive UI / PWA shell and states.'],
                    ['phase' => '04', 'title' => 'Ship', 'text' => 'Device QA, deploy, and iterate.'],
                ],
                'outcome' => [
                    'heading' => 'What you walk away with',
                    'body' => 'Mobile reach without locking yourself into the heaviest path too early.',
                    'results' => [
                        'Phone-ready product experience',
                        'Faster release cycle than dual native apps',
                        'Shared backend with your web product',
                        'A clear decision point if native is needed later',
                    ],
                ],
                'cta' => [
                    'eyebrow' => 'Go mobile',
                    'text' => 'Need a PWA or mobile-first product experience for your users?',
                    'secondary_label' => 'Custom apps',
                    'secondary_route' => 'pages.services.show',
                    'secondary_params' => ['slug' => 'custom-apps'],
                ],
                'sections' => [],
            ],
            'hosting-devops' => [
                'label' => 'Hosting & DevOps',
                'heading' => 'Hosting, deploy, and upkeep',
                'lead' => 'Getting live is part of the job — SSL, environments, backup basics, and optional ongoing maintenance so your product stays online.',
                'meta_title' => 'Hosting & DevOps | GujjuTicks',
                'meta_description' => 'GujjuTicks helps deploy and maintain custom apps and websites with practical hosting, SSL, and upkeep support.',
                'category' => 'Ops',
                'best_for' => 'Launch & keep products online',
                'maturity' => 'Practical, not overbuilt',
                'delivery' => 'Deploy, SSL, staging, upkeep',
                'tools' => ['Linux hosting', 'SSL', 'CI-friendly deploys', 'Backups', 'Monitoring basics'],
                'highlights' => [
                    ['value' => 'Live', 'label' => 'Production deploys'],
                    ['value' => 'SSL', 'label' => 'Secure by default'],
                    ['value' => 'Stage', 'label' => 'Safe place to test'],
                    ['value' => 'Care', 'label' => 'Optional maintenance'],
                ],
                'overview' => 'A build is not done until it is reachable, secure, and recoverable. We set up practical hosting and deployment for early-stage and growing products — enough rigor to sleep at night, without enterprise theatre.',
                'when_fit' => [
                    'heading' => 'When this fits',
                    'body' => 'You need the product online, with a clear path to update it — not a DIY maze.',
                    'points' => [
                        'You are launching an app or site for real users',
                        'You want staging separate from production',
                        'SSL, backups, and basic uptime matter',
                        'You may want help after launch for fixes and updates',
                    ],
                ],
                'approach' => [
                    'heading' => 'How we run ops',
                    'body' => 'Simple environments, repeatable deploys, and documentation your team can follow.',
                    'points' => [
                        'Separate staging and production where it helps',
                        'Automate what you will do more than once',
                        'Keep secrets out of the repo',
                        'Write a short runbook for common tasks',
                    ],
                ],
                'deliverables' => [
                    'heading' => 'What we deliver',
                    'body' => 'Operational basics that match the size of your product.',
                    'features' => [
                        [
                            'title' => 'Production hosting',
                            'text' => 'Server or platform setup suited to your app — with HTTPS enabled.',
                        ],
                        [
                            'title' => 'Deploy pipeline',
                            'text' => 'A repeatable way to ship updates without “works on my machine.”',
                        ],
                        [
                            'title' => 'Environments',
                            'text' => 'Staging for testing changes before customers see them.',
                        ],
                        [
                            'title' => 'Upkeep options',
                            'text' => 'Patches, fixes, and small improvements after go-live if you want a partner.',
                        ],
                    ],
                ],
                'process' => [
                    ['phase' => '01', 'title' => 'Plan', 'text' => 'Hosting choice, domains, and environments.'],
                    ['phase' => '02', 'title' => 'Provision', 'text' => 'SSL, app runtime, and access controls.'],
                    ['phase' => '03', 'title' => 'Deploy', 'text' => 'First production release and smoke checks.'],
                    ['phase' => '04', 'title' => 'Maintain', 'text' => 'Backups, monitoring basics, optional care.'],
                ],
                'outcome' => [
                    'heading' => 'What you walk away with',
                    'body' => 'A live product with a sane path to update — and fewer launch-day surprises.',
                    'results' => [
                        'App or site reachable over HTTPS',
                        'Documented deploy steps',
                        'Staging available for safer changes',
                        'Option for ongoing support after launch',
                    ],
                ],
                'cta' => [
                    'eyebrow' => 'Go live confidently',
                    'text' => 'Need hosting, deploy, and upkeep handled with your build?',
                    'secondary_label' => 'Contact us',
                    'secondary_route' => 'form.contact',
                    'secondary_params' => [],
                ],
                'sections' => [],
            ],
        ],
    ],

    'capabilities' => [
        'hub' => [
            'label' => 'Capabilities',
            'heading' => 'Outcomes we help you ship',
            'lead' => 'Solution-shaped engagements — from first MVP to dashboards, websites, integrations, and product rebuilds.',
            'meta_title' => 'Capabilities | GujjuTicks',
            'meta_description' => 'GujjuTicks capabilities: MVP development, admin dashboards, business websites, system integrations, and product redesign.',
            'items' => [
                [
                    'slug' => 'mvp-development',
                    'tag' => 'Startups',
                    'title' => 'MVP development',
                    'summary' => 'A focused first version so you can learn from real users faster.',
                ],
                [
                    'slug' => 'admin-dashboards',
                    'tag' => 'Ops',
                    'title' => 'Admin dashboards',
                    'summary' => 'Internal tools and portals that make day-to-day work clearer.',
                ],
                [
                    'slug' => 'business-websites',
                    'tag' => 'Marketing',
                    'title' => 'Business websites',
                    'summary' => 'Credible sites and landing pages that support sales and launches.',
                ],
                [
                    'slug' => 'system-integrations',
                    'tag' => 'Connect',
                    'title' => 'System integrations',
                    'summary' => 'Connect tools and automate handoffs across your stack.',
                ],
                [
                    'slug' => 'product-redesign',
                    'tag' => 'Modernize',
                    'title' => 'Product redesign',
                    'summary' => 'Rebuild or refresh an existing product when it is holding you back.',
                ],
            ],
        ],
        'pages' => [
            'mvp-development' => [
                'label' => 'MVP development',
                'heading' => 'MVPs that ship and teach you something',
                'lead' => 'We help founders cut scope to what matters, build a usable first release, and set up the next iteration.',
                'meta_title' => 'MVP Development | GujjuTicks',
                'meta_description' => 'GujjuTicks builds startup MVPs — focused first versions of apps and software so you can launch and learn faster.',
                'sections' => [
                    [
                        'heading' => 'How we approach MVPs',
                        'body' => 'Clarity over feature count. A release your users can actually try.',
                        'bullets' => [
                            'Scope workshop and milestone plan',
                            'Core user flows only for v1',
                            'Launch support and iteration roadmap',
                        ],
                    ],
                ],
            ],
            'admin-dashboards' => [
                'label' => 'Admin dashboards',
                'heading' => 'Dashboards your team will actually use',
                'lead' => 'Admin panels and ops dashboards that surface the right data and actions — without burying people in clutter.',
                'meta_title' => 'Admin Dashboard Development | GujjuTicks',
                'meta_description' => 'GujjuTicks builds admin dashboards and internal portals for teams that need clearer operations and control.',
                'sections' => [
                    [
                        'heading' => 'Typical features',
                        'body' => 'Built around roles, workflows, and the metrics that matter.',
                        'bullets' => [
                            'Role-based access and permissions',
                            'Tables, filters, and exports',
                            'Status workflows and approvals',
                            'Charts and operational summaries',
                        ],
                    ],
                ],
            ],
            'business-websites' => [
                'label' => 'Business websites',
                'heading' => 'Websites that support growth',
                'lead' => 'Company sites and campaign pages with clear structure, strong brand presence, and conversion-minded CTAs.',
                'meta_title' => 'Business Website Development | GujjuTicks',
                'meta_description' => 'GujjuTicks designs and builds business websites and landing pages for startups and growing companies.',
                'sections' => [
                    [
                        'heading' => 'What is included',
                        'body' => 'A site that looks intentional and stays maintainable.',
                        'bullets' => [
                            'Home, services, and contact flows',
                            'Landing pages for campaigns',
                            'SEO-friendly structure and meta',
                            'Easy content updates',
                        ],
                    ],
                ],
            ],
            'system-integrations' => [
                'label' => 'System integrations',
                'heading' => 'Make your tools work together',
                'lead' => 'We connect CRMs, payments, messaging, sheets, and custom apps so information moves without manual busywork.',
                'meta_title' => 'System Integrations | GujjuTicks',
                'meta_description' => 'GujjuTicks integrates business systems and APIs so your apps and tools share data reliably.',
                'sections' => [
                    [
                        'heading' => 'Outcomes',
                        'body' => 'Fewer spreadsheet bridges. Fewer missed updates.',
                        'bullets' => [
                            'API and webhook connections',
                            'Sync and automation rules',
                            'Error handling and logging basics',
                            'Documentation for your team',
                        ],
                    ],
                ],
            ],
            'product-redesign' => [
                'label' => 'Product redesign',
                'heading' => 'Modernize what is holding you back',
                'lead' => 'Rebuild or refresh an aging product — better UX, cleaner architecture, and a plan to migrate without chaos.',
                'meta_title' => 'Product Redesign | GujjuTicks',
                'meta_description' => 'GujjuTicks helps redesign and rebuild apps and software products that need a modern UX and maintainable codebase.',
                'sections' => [
                    [
                        'heading' => 'How redesigns work',
                        'body' => 'We start from pain points and usage — then redesign what matters most first.',
                        'bullets' => [
                            'Audit of current flows and tech debt',
                            'UX and information architecture refresh',
                            'Phased rebuild or targeted overhaul',
                            'Handover and training for your team',
                        ],
                    ],
                ],
            ],
        ],
    ],

    'work' => [
        'hub' => [
            'label' => 'Work',
            'heading' => 'Selected project types',
            'lead' => 'Representative engagements — anonymized where needed — showing how we approach apps, dashboards, and websites from discovery to launch.',
            'meta_title' => 'Work & Case Studies | GujjuTicks',
            'meta_description' => 'See how GujjuTicks approaches custom apps, dashboards, and websites for startups and growing teams.',
            'intro' => 'Each case study covers the challenge, how we scoped the work, what shipped, and what changed for the team afterward.',
        ],
        'pages' => [
            'startup-mvp' => [
                'label' => 'Case study',
                'heading' => 'Startup MVP launch',
                'lead' => 'A focused first product for an early-stage team that needed to validate demand with real users — without burning months on a feature wishlist.',
                'meta_title' => 'Case Study: Startup MVP | GujjuTicks',
                'meta_description' => 'How GujjuTicks scoped and shipped a startup MVP — from discovery to a usable first release with auth, core workflow, and admin.',
                'client' => 'Early-stage startup',
                'industry' => 'SaaS / product',
                'year' => '2025',
                'role' => 'Product partner — discovery, design, build, launch',
                'duration' => '8 weeks to v1',
                'stack' => ['Laravel', 'Modern web UI', 'PostgreSQL', 'Cloud hosting'],
                'highlights' => [
                    ['value' => '3', 'label' => 'Core user flows in v1'],
                    ['value' => '8 wks', 'label' => 'Discovery to launch'],
                    ['value' => '1', 'label' => 'Admin surface for ops'],
                    ['value' => 'v2', 'label' => 'Backlog ready day one'],
                ],
                'overview' => 'The founders had a strong product idea and early interest, but the backlog kept growing. GujjuTicks helped cut scope to a shippable MVP: authentication, the primary workflow, and a light admin view — then launched with a clear plan for what comes next.',
                'challenge' => [
                    'heading' => 'The challenge',
                    'body' => 'The team could describe the vision clearly, but every conversation added another “must-have.” Without a hard cut, the first release risked becoming a mini platform — late, expensive, and hard to learn from.',
                    'points' => [
                        'Feature requests outpaced validated user needs',
                        'No shared definition of “done” for version one',
                        'Founders needed something real users could try, not a slide deck',
                        'Budget and runway required a short, predictable build window',
                    ],
                ],
                'approach' => [
                    'heading' => 'Our approach',
                    'body' => 'We treated the MVP as a learning instrument: lock the job-to-be-done, ship the smallest useful product, and leave a prioritized backlog — not a rewrite.',
                    'points' => [
                        'One-week discovery to map users, constraints, and success metrics',
                        'Locked three core flows; parked everything else as “post-launch”',
                        'Weekly demos so scope stayed honest and visible',
                        'Simple admin for the team to support early users without spreadsheets',
                    ],
                ],
                'solution' => [
                    'heading' => 'What we built',
                    'body' => 'A production-ready first version centered on the primary workflow — not a prototype throwaway.',
                    'features' => [
                        [
                            'title' => 'Account & access',
                            'text' => 'Sign-up, login, and role-aware sessions so early users and the team stayed separated cleanly.',
                        ],
                        [
                            'title' => 'Primary product workflow',
                            'text' => 'The three flows that prove the value proposition — create, progress, and complete the core job.',
                        ],
                        [
                            'title' => 'Lightweight admin',
                            'text' => 'A focused ops view to review activity, support users, and spot issues without building a full console.',
                        ],
                        [
                            'title' => 'Launch readiness',
                            'text' => 'Hosting, SSL, basic error visibility, and a handover note the founders could run with.',
                        ],
                    ],
                ],
                'timeline' => [
                    ['phase' => 'Week 1', 'title' => 'Discover', 'text' => 'Users, constraints, success criteria, and a cut scope for v1.'],
                    ['phase' => 'Week 2', 'title' => 'Design & plan', 'text' => 'Key screens, data model sketch, and milestone checklist.'],
                    ['phase' => 'Weeks 3–7', 'title' => 'Build', 'text' => 'Auth, core flows, admin, and iterative demos.'],
                    ['phase' => 'Week 8', 'title' => 'Launch', 'text' => 'Hardening, deploy, handover, and prioritized v2 backlog.'],
                ],
                'outcome' => [
                    'heading' => 'The outcome',
                    'body' => 'The team launched a usable product on schedule — with enough signal to talk to users and investors, and a backlog ordered by learning value instead of opinion.',
                    'results' => [
                        'Shippable MVP live within the agreed window',
                        'Clear separation between “now” and “next” features',
                        'Founders able to onboard early users without spreadsheet ops',
                        'v2 roadmap based on real usage, not guesswork',
                    ],
                ],
                'quote' => [
                    'text' => 'We finally stopped debating the perfect product and shipped something people could use. The cut scope was the unlock.',
                    'by' => 'Founder (anonymized)',
                    'role' => 'Early-stage SaaS',
                ],
                'cta' => [
                    'eyebrow' => 'Build your MVP',
                    'text' => 'Want a focused first version like this — clear scope, real users, next steps ready?',
                    'secondary_label' => 'MVP capability',
                    'secondary_route' => 'pages.capabilities.show',
                    'secondary_params' => ['slug' => 'mvp-development'],
                ],
                'sections' => [],
            ],
            'ops-dashboard' => [
                'label' => 'Case study',
                'heading' => 'Operations dashboard',
                'lead' => 'An internal dashboard that replaced scattered spreadsheets for a growing operations team — one source of truth for status, handoffs, and ownership.',
                'meta_title' => 'Case Study: Ops Dashboard | GujjuTicks',
                'meta_description' => 'How GujjuTicks built an operations dashboard with roles, workflows, and filters to replace manual spreadsheet chaos.',
                'client' => 'Growing business',
                'industry' => 'Operations',
                'year' => '2025',
                'role' => 'Build partner — discovery, UX, dashboard, rollout',
                'duration' => '6 weeks to v1',
                'stack' => ['Laravel', 'Admin UI', 'MySQL', 'Role-based access'],
                'highlights' => [
                    ['value' => '1', 'label' => 'Shared ops workspace'],
                    ['value' => '4', 'label' => 'Role types supported'],
                    ['value' => '6 wks', 'label' => 'Sheet chaos to live'],
                    ['value' => '0', 'label' => 'Copy-paste handoffs'],
                ],
                'overview' => 'Operations lived across multiple spreadsheets, chats, and inboxes. Status was always somebody’s best guess. GujjuTicks designed and shipped a web dashboard around real daily workflows — with roles, filters, and clear ownership — so the team could stop reconciling sheets.',
                'challenge' => [
                    'heading' => 'The challenge',
                    'body' => 'Growth made the spreadsheet model brittle. Updates lagged, handoffs got missed, and nobody trusted a single “current” view of work.',
                    'points' => [
                        'Status scattered across sheets, email, and chat',
                        'No consistent ownership when items moved between people',
                        'Managers spent hours reconciling conflicting versions',
                        'New hires needed tribal knowledge just to find the truth',
                    ],
                ],
                'approach' => [
                    'heading' => 'Our approach',
                    'body' => 'We mapped the real day-to-day path of work — not the org chart — then built a dashboard that mirrored those statuses, permissions, and filters.',
                    'points' => [
                        'Shadowed ops routines to capture actual steps and exceptions',
                        'Defined roles and what each role can see or change',
                        'Designed status transitions that match how work already moved',
                        'Shipped in slices so the team could adopt without a big-bang cutover',
                    ],
                ],
                'solution' => [
                    'heading' => 'What we built',
                    'body' => 'A practical ops dashboard the team could run from — not a BI vanity board.',
                    'features' => [
                        [
                            'title' => 'Role-based access',
                            'text' => 'Operators, leads, and admins see the right queues and actions — without exposing everything to everyone.',
                        ],
                        [
                            'title' => 'Status workflows',
                            'text' => 'Clear states and transitions so handoffs are intentional, visible, and auditable.',
                        ],
                        [
                            'title' => 'Filters & search',
                            'text' => 'Find work by owner, status, date, or priority instead of scrolling a giant sheet.',
                        ],
                        [
                            'title' => 'Exports & summaries',
                            'text' => 'Light reporting for weekly reviews — without sending people back to spreadsheets.',
                        ],
                    ],
                ],
                'timeline' => [
                    ['phase' => 'Week 1', 'title' => 'Discover', 'text' => 'Map workflows, pain points, and the minimum viable ops model.'],
                    ['phase' => 'Week 2', 'title' => 'Design', 'text' => 'Roles, statuses, key screens, and migration plan from sheets.'],
                    ['phase' => 'Weeks 3–5', 'title' => 'Build', 'text' => 'Dashboard, permissions, filters, and iterative team demos.'],
                    ['phase' => 'Week 6', 'title' => 'Rollout', 'text' => 'Pilot with one squad, train, then expand usage.'],
                ],
                'outcome' => [
                    'heading' => 'The outcome',
                    'body' => 'The team runs day-to-day work from one place. Handoffs are clearer, managers stop reconciling versions, and the product is ready for automation later.',
                    'results' => [
                        'Single shared source of truth for operational status',
                        'Fewer missed handoffs between people and shifts',
                        'Faster onboarding for new ops team members',
                        'Foundation ready for notifications and automations',
                    ],
                ],
                'quote' => [
                    'text' => 'We stopped asking “which sheet is right?” The dashboard became the meeting.',
                    'by' => 'Operations lead (anonymized)',
                    'role' => 'Growing business',
                ],
                'cta' => [
                    'eyebrow' => 'Replace spreadsheet ops',
                    'text' => 'Need a dashboard your team will actually use every day?',
                    'secondary_label' => 'Dashboard capability',
                    'secondary_route' => 'pages.capabilities.show',
                    'secondary_params' => ['slug' => 'admin-dashboards'],
                ],
                'sections' => [],
            ],
            'marketing-website' => [
                'label' => 'Case study',
                'heading' => 'Marketing website rebuild',
                'lead' => 'A clearer company website for a team that needed stronger positioning, sharper messaging, and an obvious path to enquire.',
                'meta_title' => 'Case Study: Marketing Website | GujjuTicks',
                'meta_description' => 'How GujjuTicks rebuilt a B2B marketing website for clearer positioning, faster pages, and stronger conversion paths.',
                'client' => 'Growth-stage company',
                'industry' => 'B2B services',
                'year' => '2024',
                'role' => 'Design & build — IA, copy structure, front-end, launch',
                'duration' => '5 weeks to launch',
                'stack' => ['Modern HTML/CSS', 'Responsive UI', 'SEO basics', 'Contact flows'],
                'highlights' => [
                    ['value' => '5 wks', 'label' => 'Audit to live site'],
                    ['value' => '1', 'label' => 'Clear offer story'],
                    ['value' => '3', 'label' => 'Primary conversion paths'],
                    ['value' => '100%', 'label' => 'Mobile-first layouts'],
                ],
                'overview' => 'The existing site looked generic and did not explain what the company sold — or how to start. GujjuTicks rebuilt structure, messaging, and design around services and outcomes, then launched a fast mobile-first site with strong CTAs aligned to sales conversations.',
                'challenge' => [
                    'heading' => 'The challenge',
                    'body' => 'Prospects landed, scrolled, and still could not answer “what do you do?” Sales had to re-explain the offer on every call.',
                    'points' => [
                        'Homepage buried the offer under vague claims',
                        'No clear path from interest to contact',
                        'Pages felt dated and slow on mobile',
                        'Content was hard for the team to update confidently',
                    ],
                ],
                'approach' => [
                    'heading' => 'Our approach',
                    'body' => 'We treated the website as a sales aid: one story, one hierarchy, and CTAs that match how deals actually start.',
                    'points' => [
                        'Interviewed sales and founders on real objections',
                        'Rewrote IA around services, proof, and next steps',
                        'Designed a calm premium look without template clutter',
                        'Shipped with meta, performance basics, and editable sections',
                    ],
                ],
                'solution' => [
                    'heading' => 'What we built',
                    'body' => 'A marketing site that presents the brand clearly and makes enquire the natural next step.',
                    'features' => [
                        [
                            'title' => 'Offer-led structure',
                            'text' => 'Home, services, and proof pages that answer what you sell and who it is for — quickly.',
                        ],
                        [
                            'title' => 'Conversion paths',
                            'text' => 'Primary and secondary CTAs to contact and WhatsApp where the audience expects them.',
                        ],
                        [
                            'title' => 'Mobile-first design',
                            'text' => 'Layouts that stay readable and fast on phones — where many first visits happen.',
                        ],
                        [
                            'title' => 'Maintainable content',
                            'text' => 'Clear sections and guidance so the team can update copy without breaking the design.',
                        ],
                    ],
                ],
                'timeline' => [
                    ['phase' => 'Week 1', 'title' => 'Audit & brief', 'text' => 'Review old site, competitors, and sales messaging gaps.'],
                    ['phase' => 'Week 2', 'title' => 'IA & design', 'text' => 'Sitemap, key wireframes, and visual direction.'],
                    ['phase' => 'Weeks 3–4', 'title' => 'Build', 'text' => 'Pages, responsive polish, forms, and content load-in.'],
                    ['phase' => 'Week 5', 'title' => 'Launch', 'text' => 'QA, SEO basics, go-live, and handover notes.'],
                ],
                'outcome' => [
                    'heading' => 'The outcome',
                    'body' => 'Visitors understand the offer faster. Sales conversations start warmer. The team has a site they are proud to share — and can keep current.',
                    'results' => [
                        'Clear positioning aligned with how the company sells',
                        'Stronger enquire / contact paths on key pages',
                        'Faster, more credible mobile experience',
                        'Easier ongoing content updates for the team',
                    ],
                ],
                'quote' => [
                    'text' => 'People finally get what we do before the call. The site stopped being an apology.',
                    'by' => 'Founder (anonymized)',
                    'role' => 'B2B services',
                ],
                'cta' => [
                    'eyebrow' => 'Upgrade your web presence',
                    'text' => 'Need a website that sells as clearly as your best sales call?',
                    'secondary_label' => 'Website capability',
                    'secondary_route' => 'pages.capabilities.show',
                    'secondary_params' => ['slug' => 'business-websites'],
                ],
                'sections' => [],
            ],
        ],
    ],

    'about' => [
        'label' => 'About',
        'heading' => 'A software startup that builds with you',
        'lead' => 'GujjuTicks designs and develops custom apps, websites, and business software for startups and growing teams — from Gujarat, India, working with clients locally and online.',
        'meta_title' => 'About GujjuTicks | Custom Apps, Websites & Software',
        'meta_description' => 'GujjuTicks is a software startup in Gujarat, India building custom apps, websites, and software for startups and growing businesses.',
        'sections' => [
            [
                'heading' => 'What we believe',
                'body' => 'Clear scope beats vague promises. Useful software beats flashy demos. Direct communication beats layers of process.',
            ],
            [
                'heading' => 'How we work',
                'body' => 'Discover → design & plan → build & launch → support & grow. You always know what happens next.',
            ],
            [
                'heading' => 'Who we help',
                'body' => 'Founders shipping an MVP, operators replacing spreadsheets, and product teams needing extra build capacity.',
            ],
        ],
    ],

    'legal' => [
        'privacy' => [
            'label' => 'Legal',
            'heading' => 'Privacy policy',
            'lead' => 'How GujjuTicks handles information you share through our website and contact channels.',
            'meta_title' => 'Privacy Policy | GujjuTicks',
            'meta_description' => 'Privacy policy for GujjuTicks — how we collect and use information from our website and contact forms.',
            'updated' => 'July 2026',
            'sections' => [
                [
                    'heading' => 'Information we collect',
                    'body' => 'When you contact us, we may collect your name, email, phone number, and message details. We also receive basic technical data such as browser type and pages visited via standard server or analytics logs where enabled.',
                ],
                [
                    'heading' => 'How we use information',
                    'body' => 'We use your details to respond to inquiries, discuss projects, and improve our services. We do not sell your personal information.',
                ],
                [
                    'heading' => 'Sharing',
                    'body' => 'We may use trusted processors (for example email or hosting providers) solely to operate our business. We share information when required by law.',
                ],
                [
                    'heading' => 'Contact',
                    'body' => 'For privacy questions, email info@gujjuticks.com or use our Contact page.',
                ],
            ],
        ],
        'terms' => [
            'label' => 'Legal',
            'heading' => 'Terms of use',
            'lead' => 'Guidelines for using the GujjuTicks website.',
            'meta_title' => 'Terms of Use | GujjuTicks',
            'meta_description' => 'Terms of use for the GujjuTicks website.',
            'updated' => 'July 2026',
            'sections' => [
                [
                    'heading' => 'Website use',
                    'body' => 'Content on this site is for general information about GujjuTicks services. It does not form a binding proposal until we agree scope in writing.',
                ],
                [
                    'heading' => 'Project agreements',
                    'body' => 'Custom apps, websites, and software work are governed by separate statements of work or contracts. Timelines and fees are confirmed before build work begins.',
                ],
                [
                    'heading' => 'Accuracy',
                    'body' => 'We aim to keep information current but may update pages without notice. If something looks wrong, contact us.',
                ],
                [
                    'heading' => 'Contact',
                    'body' => 'Questions about these terms: info@gujjuticks.com or our Contact page.',
                ],
            ],
        ],
    ],
];
