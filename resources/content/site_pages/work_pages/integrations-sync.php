<?php

return array (
  'label' => 'Case study',
  'heading' => 'CRM and payments sync',
  'lead' => 'A practical integration layer that stopped copy-paste between CRM, payments, and a spreadsheet — with failure handling the ops team could trust.',
  'meta_title' => 'Case Study: System Integrations | GujjuTicks',
  'meta_description' => 'How GujjuTicks connected CRM and payments so a growing team stopped reconciling data by hand.',
  'client' => 'Growing operations team',
  'industry' => 'Operations / SaaS ops',
  'year' => '2024',
  'role' => 'Integration partner — mapping, build, monitoring basics',
  'duration' => '5 weeks to stable sync',
  'stack' => 
  array (
    0 => 'APIs',
    1 => 'Webhooks',
    2 => 'Laravel jobs',
    3 => 'Logging',
  ),
  'highlights' => 
  array (
    0 => 
    array (
      'value' => '2',
      'label' => 'Systems connected',
    ),
    1 => 
    array (
      'value' => '0',
      'label' => 'Daily copy-paste',
    ),
    2 => 
    array (
      'value' => '5 wks',
      'label' => 'Map to stable sync',
    ),
    3 => 
    array (
      'value' => 'Alerts',
      'label' => 'On failed jobs',
    ),
  ),
  'overview' => 'Sales lived in the CRM. Payments lived elsewhere. Ops reconciled both in a spreadsheet every day. GujjuTicks mapped the real handoffs, built a sync with clear rules and retries, and left the team with visibility when something failed — instead of silent drift.',
  'challenge' => 
  array (
    'heading' => 'The challenge',
    'body' => 'Growth made manual reconciliation fragile. Missed updates meant wrong customer status, delayed follow-ups, and hours of cleanup every week.',
    'points' => 
    array (
      0 => 'Customer and payment state lived in two tools',
      1 => 'Staff copied fields by hand into a master sheet',
      2 => 'Failures were discovered late — often by a confused customer',
      3 => 'No agreed source of truth for “paid” vs “active”',
    ),
  ),
  'approach' => 
  array (
    'heading' => 'Our approach',
    'body' => 'We treated integration as an ops product: define ownership of each field, sync only what matters, and make failures visible.',
    'points' => 
    array (
      0 => 'Mapped which system owns each piece of data',
      1 => 'Started with one direction of sync for the highest-pain fields',
      2 => 'Added retries, logs, and a simple failure alert',
      3 => 'Documented runbooks so the team could recover without us',
    ),
  ),
  'solution' => 
  array (
    'heading' => 'What we built',
    'body' => 'A focused sync — not a brittle “connect everything” mashup.',
    'features' => 
    array (
      0 => 
      array (
        'title' => 'Field-level sync rules',
        'text' => 'Clear ownership so CRM and payments stop fighting over the same facts.',
      ),
      1 => 
      array (
        'title' => 'Webhook + job processing',
        'text' => 'Events processed reliably with retries when a provider blips.',
      ),
      2 => 
      array (
        'title' => 'Failure visibility',
        'text' => 'Logs and alerts when a sync fails — so ops can act before customers notice.',
      ),
      3 => 
      array (
        'title' => 'Ops runbook',
        'text' => 'Handover notes for common failures and how to re-run safely.',
      ),
    ),
  ),
  'timeline' => 
  array (
    0 => 
    array (
      'phase' => 'Week 1',
      'title' => 'Map',
      'text' => 'Systems, fields, ownership, and failure modes.',
    ),
    1 => 
    array (
      'phase' => 'Weeks 2–4',
      'title' => 'Build',
      'text' => 'Sync jobs, webhooks, retries, and logging.',
    ),
    2 => 
    array (
      'phase' => 'Week 5',
      'title' => 'Stabilize',
      'text' => 'Pilot with live traffic, alerts, and runbook.',
    ),
    3 => 
    array (
      'phase' => 'After',
      'title' => 'Hand over',
      'text' => 'Document next integrations worth doing.',
    ),
  ),
  'outcome' => 
  array (
    'heading' => 'The outcome',
    'body' => 'Ops stopped reconciling by hand. Customer status stayed consistent. The team has a pattern for the next integration instead of another spreadsheet bridge.',
    'results' => 
    array (
      0 => 'Daily copy-paste removed for the synced fields',
      1 => 'Fewer “why is this customer wrong?” fire drills',
      2 => 'Visible failures instead of silent drift',
      3 => 'A clear backlog for the next system to connect',
    ),
  ),
  'quote' => 
  array (
    'text' => 'The spreadsheet was the product. Now the sync is — and we only look when something actually breaks.',
    'by' => 'Ops lead (anonymized)',
    'role' => 'Growing team',
  ),
  'cta' => 
  array (
    'eyebrow' => 'Connect your tools',
    'text' => 'Tired of copy-paste between CRM, payments, and sheets?',
    'secondary_label' => 'System integrations',
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
