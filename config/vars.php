<?php

return [
    'public' => 'public',
    'syncData' => true,
    'uuid_ver' => 4,
    'defualt_password' => 12345678,
    'authorized_users' => [1],
    'default_kiosk_status' => 1,
    'go_available_user_types' => [1, 2],
    'screen_types' => [
        'kiosk' => 1,
        'reception' => 2,
    ],
    'default_room_call_count_max' => 2,
    'desk_queue_status' => [
        'waiting' => 1,
        'called' => 2,
        'skipped' => 3,
        'done' => 4,
        'call_from_skip' => 5,
    ],
    'room_queue_status' => [
        'waiting' => 6,
        'called' => 7,
        'patient_in' => 8,
        'skipped' => 9,
        'patient_out' => 10,
        'call_from_skip' => 11,
    ],

];