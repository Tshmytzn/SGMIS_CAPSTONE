<?php
function convertToAmPm($time) {
    $dateTime = DateTime::createFromFormat('H:i', $time);
    if ($dateTime) {
        return $dateTime->format('h:i A');
    } else {
        return 'Invalid time format';
    }
}

function RandId($length) {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);

    $randomID = '';

    for ($i = 0; $i < $length; $i++) {
        $randomID .= $characters[rand(0, $charactersLength - 1)];
    }
    
    return $randomID;
}