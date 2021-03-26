@php
$alertTypes = [
    'error' => 'red-400',
    'success' => 'green-200',
    'warn' => 'yellow-200',
]
@endphp
<div class="absolute mt-20 w-full flex flex-col items-center justify-items-center">
    @if(session('status'))
    <div class="alert max-w-6xl my-2 mx-auto py-4 px-5 rounded grid grid-cols-12 grid-rows-1 auto-cols-auto bg-{{$alertTypes[session('status')]}}">
        <span class="col-span-11">{{ session('content') }}</span>
        <button type="button" class="float-right px-2 text-xl close-alert">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <!-- <div class="alert max-w-6xl my-2 mx-auto py-4 px-5 rounded grid grid-cols-12 grid-rows-1 auto-cols-auto bg-{{$alertTypes['error']}}">
        <span class="col-span-11">Lorem ipsum dolor sit amet</span>
        <button type="button" class="float-right px-2 text-xl close-alert">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> -->
</div>