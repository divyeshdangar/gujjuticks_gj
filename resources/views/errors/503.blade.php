@include('errors.partials.page', [
    'code' => '503',
    'kicker' => 'Error 503 · Availability',
    'title' => 'Temporarily unavailable',
    'lead' => 'The service is down for maintenance or overloaded. Please check back shortly.',
    'label' => 'Unavailable',
    'showPath' => false,
    'chips' => ['HTTP 503', 'MAINTENANCE', 'BUSY', 'OFFLINE', 'WAIT', 'RETRY'],
    'wire' => ['service offline', 'maintenance window', 'retry soon', 'recover → home', 'status pending'],
    'logs' => [
        'checking availability…',
        'service unavailable…',
        'maintenance or overload…',
        'fallback → try again later',
    ],
    'statuses' => ['Offline', 'Maintenance', 'Overloaded', 'Retry later', 'Stand by'],
])
