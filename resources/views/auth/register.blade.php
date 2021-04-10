<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-5xl text-p1 leading-tight"></h1>
    </x-slot>

    <div class="mx-auto w-full sm:max-w-2xl mt-6 bg-white overflow-hidden sm:rounded-lg">
        <x-application-banner class=" fill-current text-gray-500" />
        </div>
    <x-view.section class="bg-s1" width="">
        <x-slot name="title">
            Créer mon compte
        </x-slot>

        <x-form.base :action="route('register')" method="POST" submitColor="green" submitText="Inscription" :actions="['Déjà membre? Connectez-vous'=>route('login')]">
            <x-form.field type="input" label="Nom" name="name"/>
            <x-form.field type="input" label="Email" name="email"/>
            <x-form.field type="password" label="Mot de passe" name="password"/>
            <x-form.field type="password" label="Répéter le mot de passe" name="password_confirmation"/>
        </x-form.base>
    </x-view.section>
</x-app-layout>
