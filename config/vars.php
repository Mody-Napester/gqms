<?php

return [
    'uuid_ver' => 4,
    'authorized_users' => [1],
    'default_kiosk_status' => 1,
    'go_available_user_types' => [1, 2],
    'screen_types' => [
        'kiosk' => 1,
        'reception' => 2,
    ],
    'queue_status' => [
        'waiting' => 1,
        'called' => 2,
        'skipped' => 3,
        'done' => 4,
        'cell_from_skip' => 5,
    ],

];