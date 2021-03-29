<x-app-layout>
    <x-slot name="header">
        <h2 class="pt-10 font-semibold text-5xl text-p1 leading-tight">
            Site en maintenance
        </h2>
    </x-slot>

    <x-view.section title="Et donc?">
        <p>
            Le site n'est pas encore accessible au public. Bientôt, promis. <br>
            Vous êtes un membre du projet? <x-view.link muted :href="route('login')" text="Connectez vous"/>
        </p>
    </x-view.section>

    <x-view.section title="Annonce">
        <p>
            Nous recherchons un <u>graphiste/webdesigner</u> pour travailler avec nous sur le design du site. <x-view.link muted href="https://www.instagram.com/photo_a_bordeaux/" text="Intéressé? Discutons!"/>
        </p>
    </x-view.section>
</x-app-layout>