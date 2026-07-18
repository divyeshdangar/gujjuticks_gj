@include('errors.partials.page', [
    'code' => '403',
    'kicker' => 'Error 403 · Access check',
    'title' => 'Access not available',
    'lead' => 'You don’t have permission to view this page. If you think this is a mistake, sign in with the right account or contact us.',
    'label' => 'Forbidden',
    'showPath' => true,
    'chips' => ['HTTP 403', 'DENIED', 'NO ACCESS', 'LOCKED', 'AUTH?', 'RESTRICTED'],
    'wire' => ['access denied', 'permission fail', 'recover → home', 'try login', 'contact support'],
    'logs' => [
        'checking permissions…',
        'role mismatch or guest…',
        'request blocked…',
        'fallback → safe links',
    ],
    'statuses' => ['Access denied', 'Locked gate', 'No clearance', 'Blocked', 'Retry login'],
])
