<?php


function get_file_byte_unit($size)
{
    $count = 0;
    while (true) {
        $file_size = $size / 1024;
        if ($file_size < 1024) {
            break;
        }
        $count += 1;
    }
    if ($count == 0) {
        $file_size = round($file_size, 2) . 'kb';
    } else if ($count == 1) {
        $file_size = round($file_size, 2) . 'mb';
    } else if ($count == 2) {
        $file_size = round($file_size, 2) . 'gb';
    }
    return $file_size;
}


function add_date($date, $interval)
{
    if ($date == 'now') $date = date_create(date('Y-m-d'));
    else $date = date_create($date);
    date_add($date, date_interval_create_from_date_string($interval));
    return date_format($date, "Y-m-d");
}


function format_date($date, $part = '', $from_format = '', $to_format = '')
{
    if ($part == 't') {
        $format = $from_format ? $from_format : "H:i:s";
        $date = date_create_from_format($format, $date);
        return $to_format ? date_format($date, $to_format) : date_format($date, "h:i A");
    } else if ($part == 'd') {
        $format = $from_format ? $from_format : "Y-m-d";
        $date = date_create_from_format($format, $date);
        return $to_format ? date_format($date, $to_format) : date_format($date, "D, M j, Y");
    } else {
        $format = $from_format ? $from_format : "Y-m-d H:i:s";
        $date = date_create_from_format($format, $date);
        return $to_format ? date_format($date, $to_format) : date_format($date, "M j, Y h:i A");
    }
}


function format_time($time)
{
    $t = strtotime($time);
    $d = ceil((time() - $t) / 60);
    $ago = ($d > 1) ? " minutes ago." : ' minute ago';
    if ($d > 59) {
        $d = floor($d / 60);
        $ago = ($d > 1) ? " hours ago" : ' hour ago';
        if ($d > 23) {
            $d = floor($d / 24);
            $ago = ($d > 1) ? " days ago" : ' day ago';
        }
    }
    return $d . $ago;
}


/** convert currency to number 
 *  */
function currencyToNum($val = '')
{
    if ($val) return join(explode(',', $val));
}


/** convert currency to number 
 *  */
function numToCurrency($val = 0)
{
    if ($val and is_numeric($val)) {
        $val = intval($val);
        return number_format($val);
    }
    return 0;
}
