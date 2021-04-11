<?php
use Hashids\Hashids;
use App\Models\Config;
use \Gumlet\ImageResize;
use Carbon\Carbon;
use App\Models\Page;

if(!function_exists('bindPagesRoute')) {
    function bindPagesRoute($text) {
        // dd($text);
        return preg_replace_callback('/page-(([a-zA-Z]|[0-9]){4})/', function($matches) {
            // $page = Page::where('id', decodeId(substr($matches[0],1,-1)))->first();
            // return $page?$page->url:$matches[0];

            // on cherche l'url de la page
            return (Page::where('id',
                    decodeId( // via le hashid
                        substr($matches[0],5) // on enlève le '{' et le '}'
                    )
                )->first())
                // si il n'existe pas de page avec ce hashid, on retourne la chaine de caractère initiale
                ->url ?? $matches[0];
        }, $text);
    }
}

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
            return($hashid);
        }
    }
}

if(!function_exists('timestampToReadableDate')) {
    function timestampToReadableDate($timestamp, $format='OD MMMM YYYY') {
        return Carbon::createFromTimestamp($timestamp, 'Europe/London')->locale('fr_FR')->isoFormat($format);
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
