<?php

return array (
  'label' => 'System integrations',
  'heading' => 'Integrations that stop the copy-paste',
  'lead' => 'Connect CRM, payments, messaging, sheets, and internal tools — with sync rules, webhooks, and failure handling your ops team can trust.',
  'meta_title' => 'System Integration Services | GujjuTicks',
  'meta_description' => 'GujjuTicks connects business systems — CRM, payments, messaging, and internal tools — with reliable APIs, webhooks, and automation.',
  'category' => 'Connect',
  'ideal_for' => 'Ops & product teams',
  'engagement' => 'Map → contract → integrate → harden',
  'timeline' => 'Typically 3–8 weeks per integration set',
  'tools' => 
  array (
    0 => 'APIs',
    1 => 'Webhooks',
    2 => 'Sync jobs',
    3 => 'Mapping',
    4 => 'Logging',
  ),
  'highlights' => 
  array (
    0 => 
    array (
      'value' => 'Sync',
      'label' => 'Systems stay aligned',
    ),
    1 => 
    array (
      'value' => 'Less',
      'label' => 'Manual bridging work',
    ),
    2 => 
    array (
      'value' => 'Fail',
      'label' => 'Errors that surface',
    ),
    3 => 
    array (
      'value' => 'Own',
      'label' => 'Documented runbooks',
    ),
  ),
  'overview' => 'Integrations fail silently when they are treated as “just connect the API.” We design source-of-truth rules, retries, and logging so your tools share data without turning your team into the middleware.',
  'who_we_help' => 
  array (
    'heading' => 'Who we help',
    'body' => 'Teams drowning in duplicate entry between systems that should already talk.',
    'points' => 
    array (
      0 => 'Ops moving data between CRM and sheets daily',
      1 => 'Products that need payment or messaging providers wired in',
      2 => 'Businesses connecting a new custom app to existing tools',
      3 => 'Teams tired of “integration projects” that only work in demos',
    ),
  ),
  'when_fit' => 
  array (
    'heading' => 'A good fit when',
    'body' => 'People are the integration — and that does not scale.',
    'points' => 
    array (
      0 => 'Two or more systems must share customers, orders, or status',
      1 => 'You need webhooks for near-real-time updates',
      2 => 'Failed syncs currently go unnoticed',
      3 => 'You want a documented way to re-run or pause jobs',
    ),
  ),
  'approach' => 
  array (
    'heading' => 'How we integrate',
    'body' => 'Design for the unhappy path first.',
    'points' => 
    array (
      0 => 'Name the source of truth for each field',
      1 => 'Prefer idempotent jobs and clear retries',
      2 => 'Log enough to debug without leaking secrets',
      3 => 'Give ops a way to investigate and recover',
    ),
  ),
  'deliverables' => 
  array (
    'heading' => 'What we deliver',
    'body' => 'Connections that survive real traffic.',
    'features' => 
    array (
      0 => 
      array (
        'title' => 'CRM & tool sync',
        'text' => 'Keep customer and deal data aligned across systems.',
      ),
      1 => 
      array (
        'title' => 'Payment & messaging hooks',
        'text' => 'Wire providers into product workflows.',
      ),
      2 => 
      array (
        'title' => 'Custom API bridges',
        'text' => 'Connect your app to partner or legacy systems.',
      ),
      3 => 
      array (
        'title' => 'Automation jobs',
        'text' => 'Scheduled or event-driven updates.',
      ),
      4 => 
      array (
        'title' => 'Monitoring basics',
        'text' => 'Visibility when something fails.',
      ),
      5 => 
      array (
        'title' => 'Runbook notes',
        'text' => 'How to pause, replay, or escalate.',
      ),
    ),
  ),
  'included' => 
  array (
    'heading' => 'Typical integration engagement',
    'items' => 
    array (
      0 => 'System and field mapping workshop',
      1 => 'API/webhook design notes',
      2 => 'Implementation in staging',
      3 => 'Failure and retry handling',
      4 => 'Production cutover support',
      5 => 'Ops handover documentation',
    ),
  ),
  'process' => 
  array (
    0 => 
    array (
      'phase' => '01',
      'title' => 'Map',
      'text' => 'Systems, fields, ownership.',
    ),
    1 => 
    array (
      'phase' => '02',
      'title' => 'Contract',
      'text' => 'Events, errors, and rules.',
    ),
    2 => 
    array (
      'phase' => '03',
      'title' => 'Build',
      'text' => 'Connectors and jobs.',
    ),
    3 => 
    array (
      'phase' => '04',
      'title' => 'Harden',
      'text' => 'Retries, logs, go-live.',
    ),
  ),
  'outcome' => 
  array (
    'heading' => 'What you walk away with',
    'body' => 'Fewer manual bridges — and integrations that fail loudly instead of silently.',
    'results' => 
    array (
      0 => 'Working sync or provider connection in production',
      1 => 'Documented field ownership',
      2 => 'Fewer mystery data mismatches',
      3 => 'A path to add the next system cleanly',
    ),
  ),
  'proof' => 
  array (
    'heading' => 'Related',
    'items' => 
    array (
      0 => 
      array (
        'label' => 'Service',
        'title' => 'System integrations',
        'text' => 'Full integrations service.',
        'route' => 'pages.services.show',
        'params' => 
        array (
          'slug' => 'system-integrations',
        ),
      ),
      1 => 
      array (
        'label' => 'Service',
        'title' => 'Custom software',
        'text' => 'When integrations sit inside a larger system.',
        'route' => 'pages.services.show',
        'params' => 
        array (
          'slug' => 'custom-software',
        ),
      ),
      2 => 
      array (
        'label' => 'Technology',
        'title' => 'APIs & integrations',
        'text' => 'How we approach the stack.',
        'route' => 'pages.technology.show',
        'params' => 
        array (
          'slug' => 'apis-integrations',
        ),
      ),
    ),
  ),
  'tech_links' => 
  array (
    'heading' => 'Technology we use',
    'items' => 
    array (
      0 => 
      array (
        'title' => 'APIs & integrations',
        'slug' => 'apis-integrations',
        'text' => 'Contracts and webhooks',
      ),
      1 => 
      array (
        'title' => 'Payments',
        'slug' => 'payments',
        'text' => 'Checkout providers',
      ),
      2 => 
      array (
        'title' => 'Laravel',
        'slug' => 'laravel',
        'text' => 'Reliable job runners',
      ),
      3 => 
      array (
        'title' => 'Databases',
        'slug' => 'databases',
        'text' => 'Source-of-truth models',
      ),
    ),
  ),
  'faqs' => 
  array (
    0 => 
    array (
      'q' => 'Can you integrate any tool?',
      'a' => 'If it has a usable API or export path, usually yes. We will flag weak or undocumented systems early.',
    ),
    1 => 
    array (
      'q' => 'What if the provider is down?',
      'a' => 'We design retries and visibility so your team knows and can recover.',
    ),
    2 => 
    array (
      'q' => 'Do you build Zapier-only setups?',
      'a' => 'Sometimes for light needs. Mission-critical sync usually belongs in your app with proper logging.',
    ),
    3 => 
    array (
      'q' => 'Will this include a UI?',
      'a' => 'Often a small admin view to inspect sync status — scoped in the engagement.',
    ),
  ),
  'cta' => 
  array (
    'eyebrow' => 'Connect the stack',
    'text' => 'List the tools that should talk. We will propose a practical integration plan.',
    'secondary_label' => 'APIs & integrations',
    'secondary_route' => 'pages.technology.show',
    'secondary_params' => 
    array (
      'slug' => 'apis-integrations',
    ),
  ),
  'sections' => 
  array (
  ),
);
