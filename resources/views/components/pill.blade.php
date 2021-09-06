 
@if($href??null) 
    <a href="{{ $href }}" 
@else
    <span
@endif
    class="mr-1 bg-{{$bg??'s3'}} bg-opacity-50 px-4 py-2 rounded-full text-base text-{{$color??'p3'}}">

        {{ $slot }}

@if($href??null) 
    </a>
@else
    </span>
@endif