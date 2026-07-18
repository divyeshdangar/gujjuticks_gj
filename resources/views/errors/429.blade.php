@include('errors.partials.page', [
    'code' => '429',
    'kicker' => 'Error 429 · Rate check',
    'title' => 'Too many requests',
    'lead' => 'You’ve hit a temporary limit. Wait a moment, then try again — or continue from the homepage.',
    'label' => 'Throttled',
    'showPath' => false,
    'chips' => ['HTTP 429', 'RATE LIMIT', 'SLOW DOWN', 'WAIT', 'COOLDOWN', 'RETRY'],
    'wire' => ['rate limited', 'cooldown active', 'wait → retry', 'recover → home', 'services desk'],
    'logs' => [
        'counting recent requests…',
        'threshold exceeded…',
        'cooling down…',
        'fallback → wait & retry',
    ],
    'statuses' => ['Slow down', 'Cooling down', 'Limit hit', 'Wait…', 'Retry soon'],
])
