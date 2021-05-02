<x-view.card width="full" :src="$result->photo">
    <x-slot name="title">
        <span class="text-xl text-p1">#{{ ($results->currentPage()-1) * $results->perPage() + $loop->index+1 }}</span>
        <span class="text-sm">
            {{ $result->title }} par {{ $result->authorModel->name }}
            <!-- <x-view.link muted href="{{ route('profil.show', $result->author) }}" :text="$result->authorModel->name" /> -->
        </span>
    </x-slot>
</x-view.card>