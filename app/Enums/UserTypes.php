<?php

namespace App\Enums;

class UserTypes
{
    public static $types = [
        '1' => 'Doctor',
        '2' => 'Desk',
        '3' => 'Admin',
    ];
    public static $typesReverse = [
        'Doctor' => '1',
        'Desk' => '2',
        'Admin' => '3',
    ];
}