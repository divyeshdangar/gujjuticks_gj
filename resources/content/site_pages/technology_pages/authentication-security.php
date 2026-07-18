<?php

return array (
  'label' => 'Auth & security',
  'heading' => 'Auth and security that fit real products',
  'lead' => 'Login, roles, permissions, HTTPS, and practical hardening — enough protection for startups and growing teams without enterprise theatre.',
  'meta_title' => 'Authentication & Security | GujjuTicks',
  'meta_description' => 'GujjuTicks implements authentication, roles, permissions, HTTPS, and practical security hardening for custom apps and software.',
  'category' => 'Security',
  'best_for' => 'Portals, apps, admin access',
  'maturity' => 'Practical by default',
  'delivery' => 'Auth, roles, hardening',
  'tools' => 
  array (
    0 => 'Sessions',
    1 => 'Roles',
    2 => 'Permissions',
    3 => 'HTTPS',
    4 => 'Secrets hygiene',
  ),
  'highlights' => 
  array (
    0 => 
    array (
      'value' => 'Login',
      'label' => 'Trusted sign-in flows',
    ),
    1 => 
    array (
      'value' => 'Roles',
      'label' => 'Least-privilege access',
    ),
    2 => 
    array (
      'value' => 'HTTPS',
      'label' => 'Encrypted in transit',
    ),
    3 => 
    array (
      'value' => 'Safe',
      'label' => 'Secrets stay out of code',
    ),
  ),
  'overview' => 'Security is part of product quality. We implement authentication and access control that match how your organization works — then pair it with HTTPS, careful secret handling, and the basics that stop common mistakes.',
  'when_fit' => 
  array (
    'heading' => 'When this matters',
    'body' => 'People need to sign in — and not everyone should see or change the same things.',
    'points' => 
    array (
      0 => 'Customer portals or multi-user products',
      1 => 'Admin tools with different operator roles',
      2 => 'Apps handling personal or business data',
      3 => 'You are moving from “shared passwords” to real accounts',
    ),
  ),
  'approach' => 
  array (
    'heading' => 'How we approach security',
    'body' => 'Protect what matters for your stage — then raise the bar as you grow.',
    'points' => 
    array (
      0 => 'Define roles from real jobs, not org-chart guesswork',
      1 => 'Default to least privilege on admin actions',
      2 => 'Use HTTPS and keep secrets in environment config',
      3 => 'Review auth flows before launch, not after an incident',
    ),
  ),
  'deliverables' => 
  array (
    'heading' => 'What we deliver',
    'body' => 'Access control and basics your users and team can rely on.',
    'features' => 
    array (
      0 => 
      array (
        'title' => 'Sign-in & sessions',
        'text' => 'Reliable login, logout, and session handling for web apps.',
      ),
      1 => 
      array (
        'title' => 'Roles & permissions',
        'text' => 'Who can view, edit, approve, or administer — encoded clearly.',
      ),
      2 => 
      array (
        'title' => 'HTTPS & hosting hygiene',
        'text' => 'TLS on production and sensible environment separation.',
      ),
      3 => 
      array (
        'title' => 'Secret handling',
        'text' => 'API keys and credentials kept out of the repository.',
      ),
    ),
  ),
  'process' => 
  array (
    0 => 
    array (
      'phase' => '01',
      'title' => 'Roles',
      'text' => 'Map users and what each role must do.',
    ),
    1 => 
    array (
      'phase' => '02',
      'title' => 'Design',
      'text' => 'Auth flows and permission boundaries.',
    ),
    2 => 
    array (
      'phase' => '03',
      'title' => 'Build',
      'text' => 'Implement and verify critical access paths.',
    ),
    3 => 
    array (
      'phase' => '04',
      'title' => 'Check',
      'text' => 'HTTPS, secrets, and a short security checklist.',
    ),
  ),
  'outcome' => 
  array (
    'heading' => 'What you walk away with',
    'body' => 'Users get in safely. Admins see only what they need. Basics are not left as “later.”',
    'results' => 
    array (
      0 => 'Working auth for customers and/or staff',
      1 => 'Clear permission model documented in the product',
      2 => 'HTTPS on production',
      3 => 'Fewer shared-password workarounds',
    ),
  ),
  'cta' => 
  array (
    'eyebrow' => 'Lock access down properly',
    'text' => 'Need login, roles, and practical hardening in your next release?',
    'secondary_label' => 'Custom apps',
    'secondary_route' => 'pages.services.show',
    'secondary_params' => 
    array (
      'slug' => 'custom-apps',
    ),
  ),
  'sections' => 
  array (
  ),
);
