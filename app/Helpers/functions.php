<?php
use Hashids\Hashids;
use App\Models\Config;
use \Gumlet\ImageResize;
use Carbon\Carbon;

if(!function_exists('encodeId')) {
    function encodeId($id) {
        $hashids = new Hashids('', 4);
        return $hashids->encode($id);
    }
}

if(!function_exists('decodeId')) {
    function decodeId($hashid) {
        $hashids = new Hashids('', 4);
        try {
            return $hashids->decode($hashid)[0];
        } catch(Exception $e) {
            abort('404');
        }
    }
}

if(!function_exists('timestampToDate')) {
    function timestampToDate($timestamp) {
        return Carbon::createFromTimestamp($timestamp, 'Europe/London')->format('Y-m-d'); 
    }
}

if(!function_exists('dateToTimestamp')) {
    function dateToTimestamp($date) {
        return Carbon::create($date)->timestamp; 
    }
}