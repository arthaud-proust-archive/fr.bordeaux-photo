<x-view.card width="full" class="mb-12" :src="$result->photo">
    <x-slot name="title">
        <span class="text-xl text-p1">#{{ $result->place }}</span>
        <span class="text-sm">
            {{ $result->title }} 
            @if(Auth::user() && Auth::user()->hashid == $result->author)
                Votre photo 
                @if($result->final_notes !== "[]")
                    <x-view.link muted :href="route('photo.show', $result->hashid)" text="Commentaires et notes" />
                @endif
            @else
                par {{ $result->authorModel->name }}
            @endif
            <!-- <x-view.link muted :href="route('profil.show', $result->author)" :text="$result->authorModel->name" /> -->
        </span>
        <div class="pl-6 inline-block">
        @foreach(json_decode($result->nominations, true) as $nomination) 
            <img class="m-1 w-4/12 md:w-4/12 inline-block" src="{{ asset('assets/'.$result->criteres[$nomination][2][1].'.svg') }}" title="{{ $result->criteres[$nomination][2][0] }}">
        @endforeach
        </div>
    </x-slot>
</x-view.card>