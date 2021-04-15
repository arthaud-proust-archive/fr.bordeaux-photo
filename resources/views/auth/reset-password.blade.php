<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-5xl text-p1 leading-tight"></h1>
    </x-slot>

    <x-view.section class="bg-s1" width="">
        <x-slot name="title">
            Mot de passe oublié
        </x-slot>

        <x-form.base :action="route('password.update')" method="POST" submitColor="green" submitText="Réinitialiser le mot de passe" cancel>
            <input type="hidden" name="token" value="{{ $request->route('token') }}">
            <x-form.field type="input" label="Email" name="email"/>
            <x-form.field type="password" label="Mot de passe" name="password"/>
            <x-form.field type="password" label="Répéter le mot de passe" name="password_confirmation"/>
        </x-form.base>
    </x-view.section>
</x-app-layout>