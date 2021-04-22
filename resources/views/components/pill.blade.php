<a 
    @if($href??null) href="{{ $href }}" @endif
    class="mr-1 bg-{{$bg??'s3'}} bg-opacity-50 px-4 py-2 rounded-full text-base text-{{$color??'p3'}}">{{ $slot }}</a>