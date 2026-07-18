@include('errors.partials.page', [
    'code' => '500',
    'kicker' => 'Error 500 · System check',
    'title' => 'Something went wrong',
    'lead' => 'An unexpected server error stopped this page. We’ve logged it — please try again in a moment or head home.',
    'label' => 'Server error',
    'showPath' => false,
    'chips' => ['HTTP 500', 'SERVER', 'FAULT', 'RETRY', 'LOGGED', 'UNSTABLE'],
    'wire' => ['server fault', 'handler crash', 'retry soon', 'recover → home', 'contact support'],
    'logs' => [
        'running request…',
        'unexpected exception…',
        'error captured…',
        'fallback → recovery links',
    ],
    'statuses' => ['System fault', 'Unstable', 'Retrying…', 'Logged', 'Recover'],
])
