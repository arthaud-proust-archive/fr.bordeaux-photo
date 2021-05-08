<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-5xl text-p1 leading-tight"></h1>
    </x-slot>

    <!-- <script src="https://apis.google.com/js/platform.js" async defer></script> -->
    <div class="mx-auto w-full sm:max-w-2xl mt-6 bg-white overflow-hidden sm:rounded-lg">
        <x-application-banner class=" fill-current text-gray-500" />
        </div>
    <x-view.section class="bg-s1" width="">
        <x-slot name="title">
            Créer mon compte
        </x-slot>
        <p class="pb-6">
            En vous inscrivant vous acceptez nos <a class="underline" href="{{ page('conditions-utilisation') }}">conditions d'utilisation</a>
        </p>
        <!-- <div class="pb-6">
            Flemme de créer un nouveau compte? <div class=" g-signin2" data-onsuccess="onSignIn"></div>
        </div> -->


        <x-form.base :action="route('register')" method="POST" submitColor="green" submitText="Inscription" :actions="['Déjà membre? Connectez-vous'=>route('login')]">
            <x-form.field type="input" label="Comment doit-on vous appeler?" name="name"/>
            <x-form.field type="input" label="Adresse email" name="email" desc="On en fait quoi? Rien. <a class='ml-1 underline' href='{{ page('rgpd') }}'>Règlement RGPD</a>"/>
            <x-form.field type="password" label="Mot de passe" name="password" desc="Minimum 8 caractères. Optionnel mais conseillé: ne parlez pas de votre 🐶 et mettez des #@!%"/>
            <x-form.field type="password" label="Confirmer le mot de passe" name="password_confirmation"/>
        </x-form.base>
    </x-view.section>

    <!-- <script>
    function onSignIn(googleUser) {
        var profile = googleUser.getBasicProfile();
        console.log('ID: ' + profile.getId()); // Do not send to your backend! Use an ID token instead.
        console.log('Name: ' + profile.getName());
        console.log('Image URL: ' + profile.getImageUrl());
        console.log('Email: ' + profile.getEmail()); // This is null if the 'email' scope is not present.
    }
    </script> -->

</x-app-layout>
