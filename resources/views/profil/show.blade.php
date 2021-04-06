<x-app-layout>
    <x-view.section :title="$user->name">
        @if(Auth::user()->id == $user->id)
        <x-view.link :href="route('profil.edit')" text="Modifier mon profil" />
        @endif
        <div class="quillContent">
            {{$user->bio}}
        </div>

    </x-view.section>

</x-app-layout>
