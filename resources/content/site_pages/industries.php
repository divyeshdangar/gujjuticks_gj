<?php

return [
    'label' => 'Industries',
    'heading' => 'Software built for the work your industry actually does',
    'lead' => 'GujjuTicks designs and ships custom apps, websites, and business software for teams in sectors where operations, customers, and compliance cannot wait on a vague roadmap.',
    'meta_title' => 'Industries We Serve | GujjuTicks',
    'meta_description' => 'See how GujjuTicks builds custom apps, websites, and software for education, healthcare, fintech, retail, logistics, and more.',
    'intro' => 'Pick a sector to see the kinds of products we typically scope, build, and launch — then tell us what your team needs next.',

    'groups' => [
        'operations' => 'Operations',
        'consumer' => 'Consumer',
        'trust' => 'Trust & regulated',
    ],

    'industries' => [
        [
            'name' => 'Education',
            'slug' => 'education',
            'group' => 'trust',
            'summary' => 'Learning platforms and admin tools institutions can run day to day.',
            'detail' => 'Schools, institutes, and edtech teams need software that handles enrollment, content, and communication without becoming another spreadsheet farm. We build clear v1 products your staff and students can actually use.',
            'builds' => [
                'Enrollment and student portals',
                'Course or cohort management apps',
                'Internal admin dashboards',
            ],
        ],
        [
            'name' => 'Healthcare',
            'slug' => 'healthcare',
            'group' => 'trust',
            'summary' => 'Care workflows and patient-facing tools with careful access and clarity.',
            'detail' => 'Clinics and health operators need reliable flows for appointments, records handoff, and follow-ups — not flashy demos. We focus on practical interfaces, role-based access, and a launch path your team can own.',
            'builds' => [
                'Appointment and intake systems',
                'Staff and clinic operations apps',
                'Patient-facing booking websites',
            ],
        ],
        [
            'name' => 'Fintech',
            'slug' => 'fintech',
            'group' => 'trust',
            'summary' => 'Scalable product surfaces for payments, ledgers, and financial ops.',
            'detail' => 'Fintech founders and finance ops teams need trustworthy product shells: onboarding, dashboards, and back-office tools that stay understandable as volume grows. We ship a focused v1, then grow from a prioritized backlog.',
            'builds' => [
                'Customer and merchant portals',
                'Ops and reconciliation dashboards',
                'Secure account and status flows',
            ],
        ],
        [
            'name' => 'Retail',
            'slug' => 'retail',
            'group' => 'operations',
            'summary' => 'Store, catalog, and order experiences that connect online and offline.',
            'detail' => 'Retail teams move fast on catalog, inventory, and fulfillment. We build commerce-ready websites and internal tools that keep stock, orders, and customer updates in one coherent system.',
            'builds' => [
                'Storefronts and product catalogs',
                'Order and inventory ops tools',
                'Loyalty or customer account areas',
            ],
        ],
        [
            'name' => 'Real estate',
            'slug' => 'real-estate',
            'group' => 'operations',
            'summary' => 'Listing, lead, and property workflows for brokers and builders.',
            'detail' => 'Property businesses live on leads, listings, and follow-ups. We build sites and CRMs that make inventory searchable and handoffs between sales, site visits, and closing clearer.',
            'builds' => [
                'Listing and inquiry websites',
                'Lead tracking and follow-up tools',
                'Broker or builder portals',
            ],
        ],
        [
            'name' => 'Logistics',
            'slug' => 'logistics',
            'group' => 'operations',
            'summary' => 'Tracking, dispatch, and partner tools for moving goods reliably.',
            'detail' => 'Logistics operators need visibility: who has the shipment, what is delayed, and what the customer sees. We build operational apps and status surfaces that reduce phone-tag and spreadsheet chaos.',
            'builds' => [
                'Dispatch and tracking dashboards',
                'Partner or driver mobile-friendly apps',
                'Customer shipment status pages',
            ],
        ],
        [
            'name' => 'Food & restaurants',
            'slug' => 'food-restaurants',
            'group' => 'consumer',
            'summary' => 'Ordering, kitchen, and venue tools built around real service peaks.',
            'detail' => 'Food businesses need software that holds up at rush hour — menus, orders, and venue info that stay accurate. We ship practical ordering experiences and ops tools matched to how your kitchen or counter actually runs.',
            'builds' => [
                'Online menus and ordering flows',
                'Kitchen or counter order boards',
                'Multi-location venue websites',
            ],
        ],
        [
            'name' => 'Travel & hospitality',
            'slug' => 'travel-hospitality',
            'group' => 'consumer',
            'summary' => 'Booking and guest journeys that feel clear before and after arrival.',
            'detail' => 'Hotels, stays, and travel operators win when guests can book, confirm, and get answers without friction. We design booking-ready sites and guest tools with a scope you can launch and staff can maintain.',
            'builds' => [
                'Booking and availability websites',
                'Guest portal and itinerary views',
                'Property or tour operator admin tools',
            ],
        ],
        [
            'name' => 'On-demand',
            'slug' => 'on-demand',
            'group' => 'consumer',
            'summary' => 'Marketplace and service apps where request, match, and fulfill must be fast.',
            'detail' => 'On-demand products live or die on the request-to-fulfill loop. We help you lock a realistic v1 — consumer request, provider side, and admin — then improve from weekly demos you can click.',
            'builds' => [
                'Customer request and booking apps',
                'Provider or partner apps',
                'Dispatch and admin consoles',
            ],
        ],
        [
            'name' => 'SaaS & B2B tools',
            'slug' => 'saas-b2b',
            'group' => 'operations',
            'summary' => 'Product MVPs and internal platforms for teams selling software or running ops.',
            'detail' => 'Startups and product teams often need an extra build partner to ship a credible MVP or replace fragile internal tools. We work as a compact engineering bench: clear scope, modern stack, direct communication.',
            'builds' => [
                'SaaS MVPs and customer dashboards',
                'Billing-ready account areas',
                'Internal ops and workflow software',
            ],
        ],
    ],
];
