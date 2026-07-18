<?php

return array (
  'label' => 'APIs & integrations',
  'heading' => 'APIs and system integrations',
  'lead' => 'Connect the tools you already use — payments, CRM, messaging, analytics — or expose clean APIs for your own products and partners.',
  'meta_title' => 'API & Integration Development | GujjuTicks',
  'meta_description' => 'GujjuTicks builds APIs and third-party integrations so your apps, websites, and business tools work together.',
  'category' => 'Connect',
  'best_for' => 'Sync, automation, partner APIs',
  'maturity' => 'Reliable handoffs',
  'delivery' => 'Endpoints, webhooks, sync jobs',
  'tools' => 
  array (
    0 => 'REST APIs',
    1 => 'Webhooks',
    2 => 'OAuth',
    3 => 'Queues',
    4 => 'Third-party SDKs',
  ),
  'highlights' => 
  array (
    0 => 
    array (
      'value' => 'API',
      'label' => 'Stable contracts',
    ),
    1 => 
    array (
      'value' => 'Sync',
      'label' => 'Less copy-paste work',
    ),
    2 => 
    array (
      'value' => 'Hooks',
      'label' => 'Event-driven updates',
    ),
    3 => 
    array (
      'value' => 'Logs',
      'label' => 'Easier debugging',
    ),
  ),
  'overview' => 'Integrations remove busywork when they are designed around failure cases — retries, logging, and clear ownership. We build APIs and connectors so your apps, CRMs, payments, and ops tools stay in sync.',
  'when_fit' => 
  array (
    'heading' => 'When this fits',
    'body' => 'Your team is the integration — copying data between systems every day.',
    'points' => 
    array (
      0 => 'Two or more tools must share customers, orders, or status',
      1 => 'You need a public or private API for a client app',
      2 => 'Payments, email, or messaging should fire automatically',
      3 => 'Manual spreadsheet bridges are becoming a risk',
    ),
  ),
  'approach' => 
  array (
    'heading' => 'How we approach integrations',
    'body' => 'We design for the unhappy path: timeouts, duplicates, and partial failures.',
    'points' => 
    array (
      0 => 'Define the source of truth for each field',
      1 => 'Prefer idempotent jobs and clear retry rules',
      2 => 'Log enough to debug without exposing secrets',
      3 => 'Document how to re-run or pause a sync',
    ),
  ),
  'deliverables' => 
  array (
    'heading' => 'What we deliver',
    'body' => 'Connections your ops and product teams can trust.',
    'features' => 
    array (
      0 => 
      array (
        'title' => 'REST APIs',
        'text' => 'Well-shaped endpoints for your apps, partners, or internal tools.',
      ),
      1 => 
      array (
        'title' => 'Provider integrations',
        'text' => 'Payments, email, SMS, CRM, and other services wired into your product.',
      ),
      2 => 
      array (
        'title' => 'Webhooks & automation',
        'text' => 'Event-driven updates so status moves without someone refreshing a sheet.',
      ),
      3 => 
      array (
        'title' => 'Sync & mapping',
        'text' => 'Field maps, schedules, and rules that match how your business actually works.',
      ),
    ),
  ),
  'process' => 
  array (
    0 => 
    array (
      'phase' => '01',
      'title' => 'Map',
      'text' => 'Systems, fields, and who owns the truth.',
    ),
    1 => 
    array (
      'phase' => '02',
      'title' => 'Contract',
      'text' => 'API shapes, events, and error behaviour.',
    ),
    2 => 
    array (
      'phase' => '03',
      'title' => 'Build',
      'text' => 'Connectors, jobs, and observability basics.',
    ),
    3 => 
    array (
      'phase' => '04',
      'title' => 'Harden',
      'text' => 'Retries, monitoring, and runbook notes.',
    ),
  ),
  'outcome' => 
  array (
    'heading' => 'What you walk away with',
    'body' => 'Fewer manual bridges — and integrations that fail loudly instead of silently.',
    'results' => 
    array (
      0 => 'Working sync or API in production',
      1 => 'Documented contracts for future clients',
      2 => 'Basic logging for support and debugging',
      3 => 'A path to add the next system without starting over',
    ),
  ),
  'cta' => 
  array (
    'eyebrow' => 'Connect your stack',
    'text' => 'Ready to stop copy-pasting between tools?',
    'secondary_label' => 'Integrations capability',
    'secondary_route' => 'pages.services.show',
    'secondary_params' => 
    array (
      'slug' => 'system-integrations',
    ),
  ),
  'sections' => 
  array (
  ),
);
