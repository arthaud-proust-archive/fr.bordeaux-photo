<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-5xl text-p1 leading-tight"></h1>
    </x-slot>

    <x-view.section class="bg-s1" width="">
        <x-slot name="title">
            Par sécurité
        </x-slot>
        <p>
            Merci de rentrer votre mot de passe avant de continuer
        </p>
        <x-form.base :action="route('password.confirm')" method="POST" submitColor="green" submitText="Continuer" cancel>
            <x-form.field type="password" label="Mot de passe" name="password"/>
        </x-form.base>
    </x-view.section>
</x-app-layout>
