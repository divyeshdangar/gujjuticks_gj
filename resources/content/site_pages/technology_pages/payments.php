<?php

return array (
  'label' => 'Payments',
  'heading' => 'Payments wired into real product flows',
  'lead' => 'Checkout, subscriptions, and payment provider integrations — implemented carefully with webhooks, status handling, and clear failure paths.',
  'meta_title' => 'Payment Integrations | GujjuTicks',
  'meta_description' => 'GujjuTicks integrates payment providers into custom apps — checkout flows, webhooks, and reliable payment status handling.',
  'category' => 'Payments',
  'best_for' => 'Checkout & billing flows',
  'maturity' => 'Production-minded',
  'delivery' => 'Provider + webhooks + UI',
  'tools' => 
  array (
    0 => 'Payment providers',
    1 => 'Webhooks',
    2 => 'Invoices status',
    3 => 'Retries',
    4 => 'Admin visibility',
  ),
  'highlights' => 
  array (
    0 => 
    array (
      'value' => 'Pay',
      'label' => 'Checkout that completes',
    ),
    1 => 
    array (
      'value' => 'Hooks',
      'label' => 'Status you can trust',
    ),
    2 => 
    array (
      'value' => 'Fail',
      'label' => 'Clear error recovery',
    ),
    3 => 
    array (
      'value' => 'Ops',
      'label' => 'Admin can investigate',
    ),
  ),
  'overview' => 'Payments are not “add a button.” They are a state machine: pending, paid, failed, refunded. We integrate providers into your product with webhooks and admin visibility so finance and support are not guessing.',
  'when_fit' => 
  array (
    'heading' => 'When this fits',
    'body' => 'Money needs to move as part of your product or service workflow.',
    'points' => 
    array (
      0 => 'One-time checkout for a product or service',
      1 => 'Subscriptions or recurring billing',
      2 => 'Deposits, invoices, or milestone payments',
      3 => 'You need payment status reflected in an admin panel',
    ),
  ),
  'approach' => 
  array (
    'heading' => 'How we implement payments',
    'body' => 'Design for delayed webhooks and user retries — not only the happy path.',
    'points' => 
    array (
      0 => 'Pick a provider that fits your market and currency needs',
      1 => 'Model payment states explicitly in the database',
      2 => 'Verify webhooks; never trust the browser alone',
      3 => 'Give admins a way to reconcile edge cases',
    ),
  ),
  'deliverables' => 
  array (
    'heading' => 'What we deliver',
    'body' => 'Payment flows your customers and ops team can rely on.',
    'features' => 
    array (
      0 => 
      array (
        'title' => 'Checkout UX',
        'text' => 'Clear pay flows with sensible loading and error states.',
      ),
      1 => 
      array (
        'title' => 'Provider integration',
        'text' => 'Secure keys, callbacks, and environment separation.',
      ),
      2 => 
      array (
        'title' => 'Webhook handling',
        'text' => 'Reliable status updates into your app.',
      ),
      3 => 
      array (
        'title' => 'Ops visibility',
        'text' => 'Admin views to find payments and investigate issues.',
      ),
    ),
  ),
  'process' => 
  array (
    0 => 
    array (
      'phase' => '01',
      'title' => 'Define',
      'text' => 'Products, amounts, currencies, and success rules.',
    ),
    1 => 
    array (
      'phase' => '02',
      'title' => 'Design',
      'text' => 'States, UI, and failure recovery.',
    ),
    2 => 
    array (
      'phase' => '03',
      'title' => 'Integrate',
      'text' => 'Provider, webhooks, and test mode.',
    ),
    3 => 
    array (
      'phase' => '04',
      'title' => 'Go live',
      'text' => 'Production keys, monitoring, and runbook.',
    ),
  ),
  'outcome' => 
  array (
    'heading' => 'What you walk away with',
    'body' => 'Payments that complete — and a system that stays honest when they do not.',
    'results' => 
    array (
      0 => 'Working checkout or billing in production',
      1 => 'Trusted payment status in your database',
      2 => 'Fewer “I paid but nothing happened” mysteries',
      3 => 'A path to refunds or retries when needed',
    ),
  ),
  'cta' => 
  array (
    'eyebrow' => 'Add payments the right way',
    'text' => 'Need checkout or billing inside your app?',
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
