<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-5xl text-p1 leading-tight"></h1>
    </x-slot>

    <x-view.section class="bg-s1" width="">
        <x-slot name="title">
            Vérifier votre email
        </x-slot>

        <p>
            Merci de vous être inscrit! Avant de continuer, confirmez votre email en cliquant sur le lien que nous venons de vous envoyer
        </p>

        <x-form.base :action="route('verification.send')" nobody method="POST" submitColor="gray" submitText="Pas reçu? Renvoyer un lien">
        </x-form.base>
    </x-view.section>
</x-app-layout>
