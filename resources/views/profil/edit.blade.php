<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Éditer mon profil
        </h2>
    </x-slot>

    <x-view.section width="3">
        {{-- <x-form.base :action="route('profil.delete')" method="POST" submitBtn="Supprimer mon compte:red" nobody /> --}}
        <x-form.base :action="route('profil.update')" method="POST" submitColor="green" submitText="Modifier" enctype="multipart/form-data" cancel>
            @if($user->hasRole('admin'))            
                <x-form.field :bind="$user" type="file" label="Photo de profil" desc="Vous êtes un membre du projet, cette photo apparaitra sur <a class=underline href={{route('user.equipe') }}>cette page</a>" name="img" mimes="image/png, image/jpeg, image/gif"/>
            @endif
            <x-form.field :bind="$user" type="input" label="Comment doit-on vous appeler?" name="name" desc="Pas de caractères spéciaux (&%#...)" />
            <x-form.field :bind="$user" type="input" label="Email" name="email" disabled desc="Désolé, pour l'instant ça fonctionne pas. Besoin imminent? Contactez-nous"/>
            <x-form.field :bind="$user" type="quill" label="Bio" name="bio"/>
        </x-form.base>
    </x-view.section>

</x-app-layout>