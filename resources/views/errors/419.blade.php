@include('errors.partials.page', [
    'code' => '419',
    'kicker' => 'Error 419 · Session check',
    'title' => 'Session not available',
    'lead' => 'Your session expired or the form token is no longer valid. Refresh the page and try again.',
    'label' => 'Expired',
    'showPath' => false,
    'chips' => ['HTTP 419', 'EXPIRED', 'CSRF', 'TOKEN OUT', 'REFRESH', 'RETRY'],
    'wire' => ['token expired', 'session timeout', 'refresh page', 'retry form', 'recover → home'],
    'logs' => [
        'validating session…',
        'csrf token mismatch…',
        'session lifetime ended…',
        'fallback → refresh & retry',
    ],
    'statuses' => ['Session expired', 'Token stale', 'Please refresh', 'Retry form', 'Timed out'],
])
