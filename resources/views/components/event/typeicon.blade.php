<svg class="inline" width="20" height="20" viewBox="0 0 15 15" fill="none" xmlns="http://www.w3.org/2000/svg" 
    title="{{ $type=='rallye'?'Rallye photo de jour':'Nocturne' }}"
>

    @include('components.event.paths.'.$type)
</svg>