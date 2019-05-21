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

// Get lookups
function str_well($value){
    return ucfirst(str_replace('_', ' ', $value));
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
function deskQueueNumberFormat($floor_id, $scheme){
    $lastNumber = \App\DeskQueue::getDeskQueues($floor_id)->count() + 1;
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

    return \App\Floor::getBy('id', $floor_id)->name_en . '-' . $lastNumber;
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