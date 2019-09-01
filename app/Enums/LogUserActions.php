<?php

namespace App\Enums;

class LogUserActions
{
    public static $name = [
        // User
        'IndexUser' => 'Index User',
        'CreateUser' => 'Create User',
        'StoreUser' => 'Store User',
        'ShowUser' => 'Show User',
        'EditUser' => 'Edit User',
        'UpdateUser' => 'Update User',
        'DestroyUser' => 'Destroy User',

        // Floor
        'IndexFloor' => 'Index Floor',
        'CreateFloor' => 'Create Floor',
        'StoreFloor' => 'Store Floor',
        'ShowFloor' => 'Show Floor',
        'EditFloor' => 'Edit Floor',
        'UpdateFloor' => 'Update Floor',
        'DestroyFloor' => 'Destroy Floor',

        // Desk
        'IndexDesk' => 'Index Desk',
        'CreateDesk' => 'Create Desk',
        'StoreDesk' => 'Store Desk',
        'ShowDesk' => 'Show Desk',
        'EditDesk' => 'Edit Desk',
        'UpdateDesk' => 'Update Desk',
        'DestroyDesk' => 'Destroy Desk',

        // Queues
        'IndexQueueHistory' => 'Index Queue History',
    ];
}