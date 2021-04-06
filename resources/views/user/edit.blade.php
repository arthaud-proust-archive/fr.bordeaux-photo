<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Éditer mon profil
        </h2>
    </x-slot>

    <x-view.section width="3">
        <x-form.base :action="route('user.delete', $user->hashid)" method="POST" submitBtn="Supprimer le compte:red" nobody />
        <x-form.base :action="route('user.update', $user->hashid)" method="POST" submitColor="green" submitText="Modifier" cancel>
            <x-form.field :bind="$user" type="input" label="Nom" name="name"/>
            <x-form.field disabled :bind="$user" type="input" label="Email" name="email"/>
            @if(Auth::id() !== $user->id) 
            <x-form.field :bind="$user" type="select" label="Rôle" name="role" :options="$user->roles()"/>
            @endif
            <x-form.field :bind="$user" type="quill" label="Bio" name="bio"/>
        </x-form.base>
    </x-view.section>

</x-app-layout>