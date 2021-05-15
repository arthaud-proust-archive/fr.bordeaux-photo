<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Liste des types de visuels à télécharger
        </h2>
    </x-slot>

    <div class="flex flex-row flex-wrap max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <x-view.section title="Évènements" width="3" class="bg-s2">
            <div class="py-2">
                <x-view.link route="visual.events" text="Voir les visuels"/>
            </div>
        </x-view.section>

        <x-view.section title="Lauréats" width="3" class="bg-s2">
            <div class="py-2">
                <x-view.link route="visual.laureats" text="Voir les visuels"/>
            </div>
        </x-view.section>
    </div>
</x-app-layout>
