<?php
function convertToAmPm($time) {
    $dateTime = DateTime::createFromFormat('H:i', $time);
    if ($dateTime) {
        return $dateTime->format('h:i A');
    } else {
        return 'Invalid time format';
    }
}