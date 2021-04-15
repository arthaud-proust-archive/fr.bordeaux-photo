<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-5xl text-p1 leading-tight"></h1>
    </x-slot>

    <x-view.section class="bg-s1" width="">
        <x-slot name="title">
            Changer de mot de passe
        </x-slot>

        <x-form.base :action="route('password.set')" method="POST" submitColor="green" submitText="Changer" cancel>
            <x-form.field type="password" label="Ancien mot de passe" name="old_password"/>
            <x-form.field type="password" label="Nouveau mot de passe" name="password"/>
            <x-form.field type="password" label="Confirmer ce mot de passe" name="password_confirmation"/>
        </x-form.base>
    </x-view.section>
</x-app-layout>