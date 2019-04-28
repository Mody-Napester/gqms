<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QueueStatus extends Model
{
    public static function getQueueStatuses($status = 'all')
    {
        $data = '';

        if ($status == 'all'){
            $data = self::all();
        }
        elseif ($status == 'desk'){
            $data = self::where('queue_type', 1)->get();
        }
        elseif ($status == 'room'){
            $data = self::where('queue_type', 2)->get();
        }

        return $data;
    }
}
