<?php

// Get path
function get_path($path){
    return base_path() . '/' . config('vars.public') . '/' . $path;
}

// Get path
function nice_time($time){
    return \Carbon\Carbon::createFromTimeStamp(strtotime($time))->diffForHumans();
}

// Default language
function lang(){
    return app()->getLocale();
}

// Make string format
function str_well($value){
    return ucfirst(str_replace('_', ' ', $value));
}

// Store Log User Login
function storeLogUserLogin($user = null){
    return \App\UserLoginHistory::store($user);
}

// Store Log User Login
function getDeskReport($user, $status){
    $report = \App\DeskQueueStatus::getDeskQueues($user->id, $status);
    return $report;
}

// Store Log User Login
function getCurrentDeskReport($user){
    $report = \App\DeskQueue::where('desk_id', $user->desk->id)
        ->where('status', config('vars.desk_queue_status.called'))
        ->where('created_at', 'like', "%".date('Y-m-d')."%")
        ->orderBy('id', 'DESC')
        ->first();

    return $report;
}

// Store Log User Login
function getDoctorReport($user, $status){
    $report = \App\RoomQueueStatus::getRoomQueues($user->id, $status);
    return $report;
}

// Store Log User Login
function getCurrentDoctorReport($user){
    $report = \App\RoomQueue::where('room_id', $user->room->id)
        ->where('status', config('vars.room_queue_status.called'))
        ->where('created_at', 'like', "%".date('Y-m-d')."%")
        ->orderBy('id', 'DESC')
        ->first();

    return $report;
}

// Store Log User Actions
function storeLogUserAction($action, $method, $url = null, $user = null){
    $theUrl = (!is_null($url))? $url : '';
    $theUser = (is_null($user))? auth()->user()->id : $user;

    $log = \App\Log::store([
        'user_id' => $theUser,
        'method' => $method,
        'action' => $action,
        'url' => $theUrl,
    ]);

    if ($log){
        $result = true;
    }else{
        $result = false;
    }

    return $result;
}

// Upload files
function upload_file($type, $file, $path){

    $results = [
        'status' => false,
        'filename' => null,
        'mime' => null,
        'message' => null,
    ];

    $extention = strtolower($file->getClientOriginalExtension());

    $validExtentions = [];
    $file_mimes = lookups('file_mimes');

    $results['mime'] = $type . '/' . $extention;

    if ($type == "image") {
        foreach($file_mimes as $file_mime){
            $ext = strtolower(str_replace('image/', '', $file_mime->name));
            $validExtentions[] = $ext;
        }
    }
    elseif ($type == "text") {
        foreach($file_mimes as $file_mime){
            $ext = strtolower(str_replace('text/', '', $file_mime->name));
            $validExtentions[] = $ext;
        }
    }

    if (in_array($extention, $validExtentions)) {

        $filename = time().rand(1000,9999).'.'.$extention;
        $destinationPath = get_path($path);

        $upload = $file->move($destinationPath, $filename);

        if ($upload) {
            // File Uploaded
            $results['status'] = true;
            $results['filename'] = $filename;
            $results['message'] = 'Uploaded Successfully';

            return $results;
        }else{
            // Error Uploading
            $results['message'] = 'Error Uploading';

            return $results;
        }

    }else{
        // File not valid
        $results['message'] = 'File not valid';

        return $results;
    }
}

// Function to get the client IP address
function getenv_get_client_ip() {
    $ipaddress = '';
    if (getenv('HTTP_CLIENT_IP'))
        $ipaddress = getenv('HTTP_CLIENT_IP');
    else if(getenv('HTTP_X_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
    else if(getenv('HTTP_X_FORWARDED'))
        $ipaddress = getenv('HTTP_X_FORWARDED');
    else if(getenv('HTTP_FORWARDED_FOR'))
        $ipaddress = getenv('HTTP_FORWARDED_FOR');
    else if(getenv('HTTP_FORWARDED'))
        $ipaddress = getenv('HTTP_FORWARDED');
    else if(getenv('REMOTE_ADDR'))
        $ipaddress = getenv('REMOTE_ADDR');
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

// Function to get the client IP address
function server_get_client_ip() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
        $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
        $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
        $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
        $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
        $ipaddress = 'UNKNOWN';
    return $ipaddress;
}

// Desk Queue Number Format
function deskQueueNumberFormat($area, $scheme){
    $lastNumber = \App\DeskQueue::getDeskQueues($area->id)->count() + 1;

    $lastNumberZeros = '';
    
    if($lastNumber < $scheme){
        $schemeLength = strlen((string)$scheme);
        $lastNumberLength = strlen((string)$lastNumber);

        $zerosLength = $schemeLength - $lastNumberLength;

        for ($i=0; $i < $zerosLength; $i++) {
            $lastNumberZeros .= 0;
        }

        $lastNumber = $lastNumberZeros . $lastNumber;
    }

//    return $area->floor->name_en . '-' . $area->name_en . '-' . $lastNumber;
    return $area->name_en . '-' . $lastNumber;
}

// Room Queue Number Format
function roomQueueNumberFormat($floor_id, $room_id, $scheme){
    $lastNumber = \App\RoomQueue::getRoomQueues($floor_id, $room_id)->count() + 1;
//    $lastNumber = 101; // Testing

    $lastNumberZeros = '';

    if($lastNumber < $scheme){
        $schemeLength = strlen((string)$scheme);
        $lastNumberLength = strlen((string)$lastNumber);

        $zerosLength = $schemeLength - $lastNumberLength;

        for ($i=0; $i < $zerosLength; $i++) {
            $lastNumberZeros .= 0;
        }

        $lastNumber = $lastNumberZeros . $lastNumber;
    }

    return \App\Floor::getBy('id', $floor_id)->name_en . '-' . \App\Room::getBy('id', $room_id)->name_en .'-' . $lastNumber;
}

function getQueuePatientTime($queueOpj, $toType, $timeType){

    if($toType == 'desk'){
        if ($timeType == 'waiting'){
            $called = $queueOpj->deskQueueStatusHistories()->where('queue_status_id', config('vars.desk_queue_status.called'))->first()->created_at;
            $waiting = $queueOpj->created_at;
            $diffTime = $called->diffInSeconds($waiting);
        }
        elseif ($timeType == 'serve'){
            $done = $queueOpj->deskQueueStatusHistories()->where('queue_status_id', config('vars.desk_queue_status.done'))->first()->created_at;
            $called = $queueOpj->deskQueueStatusHistories()->where('queue_status_id', config('vars.desk_queue_status.called'))->first()->created_at;
            $diffTime = $done->diffInSeconds($called);
        }
    }
    elseif ($toType == 'room'){
        if ($timeType == 'waiting'){
            $called = $queueOpj->roomQueueStatusHistories()->where('queue_status_id', config('vars.room_queue_status.called'))->first()->created_at;
            $waiting = $queueOpj->created_at;
            $diffTime = $called->diffInSeconds($waiting);
        }
        elseif ($timeType == 'serve'){
            $patientOut = $queueOpj->roomQueueStatusHistories()->where('queue_status_id', config('vars.room_queue_status.patient_out'))->first()->created_at;
            $patientIn = $queueOpj->roomQueueStatusHistories()->where('queue_status_id', config('vars.room_queue_status.patient_in'))->first()->created_at;
            $diffTime = $patientOut->diffInSeconds($patientIn);
        }
    }

    return gmdate('H:i:s', $diffTime);
}

function getDeskQueuePatientServeTime($queueOpj){
    $done = $queueOpj->deskQueueStatusHistories()->where('queue_status_id', config('vars.desk_queue_status.done'))->first()->created_at;
    $called = $queueOpj->deskQueueStatusHistories()->where('queue_status_id', config('vars.desk_queue_status.called'))->first()->created_at;
    $diffTime = $done->diffInSeconds($called);

    return gmdate('H:i:s', $diffTime);
}

function getRoomQueuePatientServeTime($queueOpj){
    $patientOut = $queueOpj->roomQueueStatusHistories()->where('queue_status_id', config('vars.room_queue_status.patient_out'))->first()->created_at;
    $patientIn = $queueOpj->roomQueueStatusHistories()->where('queue_status_id', config('vars.room_queue_status.patient_in'))->first()->created_at;
    $diffTime = $patientOut->diffInSeconds($patientIn);

    return gmdate('H:i:s', $diffTime);
}