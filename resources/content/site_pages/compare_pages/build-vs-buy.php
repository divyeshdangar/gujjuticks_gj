<?php

return [
    'label' => 'Build vs buy',
    'heading' => 'Build vs buy software',
    'lead' => 'Buy when a standard SaaS covers 80% of the job. Build when your workflow, data, or edge is the product — and off-the-shelf would force painful workarounds.',
    'answer' => 'Buy commodity tools (CRM, email, accounting) when they fit. Build custom software with GujjuTicks when your process is unique, integrations are messy, or the product itself is what you sell.',
    'meta_title' => 'Build vs Buy Software | Compare | GujjuTicks',
    'meta_description' => 'When to buy SaaS and when to build custom software — a practical decision guide from GujjuTicks.',
    'verdict' => 'Most companies should buy commodity systems and build only where custom software creates advantage or removes costly manual work.',
    'compare' => [
        'headers' => ['Factor', 'Buy (SaaS)', 'Build (custom)'],
        'rows' => [
            ['Fit to process', 'You adapt to the tool', 'Tool adapts to you'],
            ['Speed to start', 'Days to configure', 'Weeks to a scoped v1'],
            ['Ongoing cost', 'Subscriptions forever', 'Build then maintain'],
            ['Differentiation', 'Same as competitors', 'Your workflows & data'],
            ['Integrations', 'Limited by vendor APIs', 'Designed for your stack'],
            ['Best when', 'Standard business jobs', 'Unique ops or product core'],
        ],
    ],
    'choose' => [
        [
            'title' => 'Buy when',
            'points' => [
                'The job is standard — email, payments portal, basic CRM',
                'Vendors already solve compliance and updates well',
                'You would not hire engineers for this problem alone',
            ],
        ],
        [
            'title' => 'Build when',
            'points' => [
                'Staff lose hours weekly to spreadsheets and copy-paste',
                'Multiple tools must sync in a way no SaaS supports cleanly',
                'The software is part of what customers pay you for',
            ],
        ],
    ],
    'sections' => [
        [
            'heading' => 'A practical middle path',
            'body' => 'Often the answer is hybrid: buy Stripe, email, and analytics; build the workflow layer that ties your business together. GujjuTicks designs that custom layer and integrates what you already use.',
        ],
        [
            'heading' => 'Talk it through',
            'body' => 'Send a short note with the workflow that hurts most. We will say honestly whether to buy, build, or wait.',
        ],
    ],
];
