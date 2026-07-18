@include('errors.partials.page', [
    'code' => '404',
    'kicker' => 'Error 404 · Live check',
    'title' => 'Page not available',
    'lead' => 'The page you’re looking for doesn’t exist, may have moved, or the link is incomplete. Let’s get you back to something useful.',
    'label' => 'Not found',
    'showPath' => true,
    'chips' => ['HTTP 404', 'NO ROUTE', 'NULL PATH', 'OFF MAP', 'RETRY?', 'DEAD LINK'],
    'wire' => ['route miss', 'handler null', 'recover → home', 'services desk', 'contact link'],
    'logs' => [
        'tracing request…',
        'checking route table…',
        'no matching handler…',
        'fallback → recovery links',
    ],
    'statuses' => ['Signal lost', 'Route missing', 'Path offline', 'No match', 'Retrying…', 'Dead end'],
])
