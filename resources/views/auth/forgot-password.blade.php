<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-5xl text-p1 leading-tight"></h1>
    </x-slot>

    <div class="mx-auto w-full sm:max-w-xl mt-6 bg-white overflow-hidden sm:rounded-lg">
        <x-application-banner class=" fill-current text-gray-500" />
        </div>
    <x-view.section class="bg-s1" width="">
        <x-slot name="title">
            Mot de passe oublié
        </x-slot>
        <p>
            Renseignez votre adresse email, nous vous enverrons un mail pour réinitialiser votre mot de passe
        </p>
        <x-form.base :action="route('password.email')" method="POST" submitColor="green" submitText="Connexion" :actions="['Je l\'ai retrouvé!'=>route('login')]">
            <x-form.field type="input" label="Email" name="email"/>
        </x-form.base>
    </x-view.section>
</x-app-layout>
