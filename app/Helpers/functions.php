<?php
use Hashids\Hashids;
use App\Models\Config;
use \Gumlet\ImageResize;


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