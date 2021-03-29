@if ($paginator->hasPages())
    <nav class="mx-auto flex flex-row flex-wrap content-center justify-center">
        @if($paginator->previousPageUrl()) 
        <x-view.link :href="$paginator->previousPageUrl()" text="Photo précédente" />
        @endif

        @if($paginator->nextPageUrl()) 
        <x-view.link :href="$paginator->nextPageUrl()" text="Photo suivante" />
        @endif
    </div>
@endif