<x-app-layout>
   <x-view.section title="{{ $user->name }} ({{$user->namedRole}})">
        <x-view.link :href="route('user.edit', $user->hashid)" text="Modifier le profil" />
        <div class="quillContent">
            {{$user->bio}}
        </div>

    </x-view.section>

</x-app-layout>
