<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-5xl text-p1 leading-tight"></h1>
    </x-slot>

    <div class="mx-auto w-full sm:max-w-xl mt-6 bg-white overflow-hidden sm:rounded-lg">
        <x-application-banner class=" fill-current text-gray-500" />
        </div>
    <x-view.section class="bg-s1" width="">
        <x-slot name="title">
            Se connecter
        </x-slot>

        <x-form.base :action="route('login')" method="POST" submitColor="green" submitText="Connexion" :actions="['Pas de compte?'=>route('register')]">
            <x-form.field type="input" label="Email" name="email"/>
            <x-form.field type="password" label="Mot de passe" name="password" desc="Vous l'avez oublié? On peut <a href='{{ route('password.request') }}' class='ml-1 underline'>s'arranger</a>"/>
        </x-form.base>
    </x-view.section>
</x-app-layout>
