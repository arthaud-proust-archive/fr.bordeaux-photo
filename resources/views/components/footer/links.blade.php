<x-footer.section :title="$title">
    @foreach($links as $link)
        <a class="my-1 hover:underline" href="{{ $link['url'] }}">{{ $link['title'] }}</a>
    @endforeach
</x-footer.section>