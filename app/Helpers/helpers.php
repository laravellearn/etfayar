<?php

use Carbon\Carbon;

function generate_random_number() {
    return rand(1000, 9999);
}

function generate_random_string($length = 5) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


function current_date_time() {
    $currentDateTime = Carbon::now('Asia/Tehran')->toDateTimeString();
    return $currentDateTime;
}

function current_timeStamp() {
    $currentDateTime = Carbon::now('Asia/Tehran')->getTimestamp();
    return $currentDateTime;
}

function statusClass($status) {
    if ($status == 1) {
        echo 'text-success py-1';
    } else {
        echo 'text-danger py-1';
    }

}

function statusText($status) {
    if ($status == 1) {
        echo 'فعال';
    } else {
        echo 'غیرفعال';
    }

}

function genderText($status) {
    if ($status == 'female') {
        echo 'زن';
    } else {
        echo 'مرد';
    }

}

function checkSelected($selectedId, $listItemId) {
    if ($selectedId == $listItemId) {
        return 'selected="selected"';
    }
}

function checked($value) {
    if ($value == 1) {
        return 'checked';
    }
}

function selectedInArray($value, $array, $key) {
    $details = array_column($array, $key);
    $res = in_array($value, $details);
    if ($res) {
        return 'selected="selected"';
    }
}

function checkInArray($value, $array, $key) {
    $details = array_column($array, $key);
    $res = in_array($value, $details);
    if ($res) {
        return true;
    } else {
        return false;
    }
}


function setImage($image){
    if(strpos($image, "http") !== false){
        return $image;
    } else{
        return asset('storage/app/'.$image);
    }

}


