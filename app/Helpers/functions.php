<?php
use Hashids\Hashids;
use App\Models\Config;
use \Gumlet\ImageResize;
use Carbon\Carbon;
use App\Models\Page;



if(!function_exists('getPathAndFile')) {
    function getPathAndFile($source)
    {
        $pos = strrpos($source, "/");
        $path = substr($source, 0, $pos+1);
        $file = substr($source, $pos+1);
        return compact('path', 'file');
    }
}


if(!function_exists('compress_image')) {
    function compress_image($img_src, $quality=80, $nameByQuality=false)
    {
        $path_parts = pathinfo($img_src);
        $ext = $path_parts['extension'];
        $path = $path_parts['dirname'];
        $name = $path_parts['filename'];

        $src_url = public_path($img_src);
        if($nameByQuality) {
            $dest_url = public_path($path).'/'.$name.'-'.$quality.'.'.$ext;
        } else {
            $dest_url = public_path($img_src);
        }
        
        $info = getimagesize($src_url);
        if ($info['mime'] == 'image/jpeg') $image = imagecreatefromjpeg($src_url);
        elseif ($info['mime'] == 'image/gif') $image = imagecreatefromgif($src_url);
        elseif ($info['mime'] == 'image/png') $image = imagecreatefrompng($src_url);
        imagejpeg($image, $dest_url, $quality);
    }
}

if(!function_exists('resize_image')) {
    function resize_image($img_src, $size, $nameBySize=false) {
        $path_parts = pathinfo($img_src);
        $ext = $path_parts['extension'];
        $path = $path_parts['dirname'];
        $name = $path_parts['filename'];

        $src_url = public_path($img_src);
        if($nameBySize) {
            $dest_url = public_path($path).'/'.$name.'-'.$size.'.'.$ext;
        } else {
            $dest_url = public_path($img_src);
        }
        
        $image = new ImageResize($src_url);
        $image->resizeToWidth($size);
        $image->save($dest_url);
    }
}

if(!function_exists('page')) {
    function page($url) {
        return route('page.show', $url);
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
        return Carbon::createFromTimestamp($timestamp)->locale('fr_FR')->isoFormat($format);
    }
}

if(!function_exists('timestampToDate')) {
    function timestampToDate($timestamp, $onlyDate=false) {
        $d = Carbon::createFromTimestamp($timestamp);
        if($onlyDate) {
            $d->hour = 0;
            $d->minute = 0;
        }
        return $d->format('Y-m-d'); 
    }
}

if(!function_exists('dateToTimestamp')) {
    function dateToTimestamp($date, $onlyDate=false) {
        $d = Carbon::create($date);
        if($onlyDate) {
            $d->hour = 0;
            $d->minute = 0;
        }
        return $d->timestamp; 
    }
}


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

if(!function_exists('infoPagesRoute')) {
    function infoPagesRoute() {
        $routes = '<p class="ql-snow ql-toolbar text-sm font-medium text-p1"><span class="block">Pour créer un lien vers une page, il faut mettre <code class="bg-s0 px-1 rounded">page-<span class="text-red0">...hashid</span></code> dans "link" (<svg class="inline h-5 ql-link ql-snow" viewbox="0 0 18 18"><line class="ql-stroke" x1="7" x2="11" y1="7" y2="11"></line> <path class="ql-even ql-stroke" d="M8.9,4.577a3.476,3.476,0,0,1,.36,4.679A3.476,3.476,0,0,1,4.577,8.9C3.185,7.5,2.035,6.4,4.217,4.217S7.5,3.185,8.9,4.577Z"></path> <path class="ql-even ql-stroke" d="M13.423,9.1a3.476,3.476,0,0,0-4.679-.36,3.476,3.476,0,0,0,.36,4.679c1.392,1.392,2.5,2.542,4.679.36S14.815,10.5,13.423,9.1Z"></path></svg>)</span><span class="block">Voici les pages avec leur <b>hashid</b>:</span>';
        foreach(Page::select('id', 'title')->get() as $trucmuche) {
            $routes.= $trucmuche->title.': <code class="bg-s0 px-1 rounded text-red0">'.$trucmuche->hashid.'</code>, ';
        }
        $routes.='</p>';
        return $routes;
    }
};
