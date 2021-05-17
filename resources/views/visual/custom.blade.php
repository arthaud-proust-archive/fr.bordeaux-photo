<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Créer un visuel
        </h2>
    </x-slot>

    <div class="flex flex-col flex-wrap max-w-7xl items-center mx-auto py-6 px-4 sm:px-6 lg:px-8">
        <div class="visual custom space-y-4 text-p1">
            <canvas></canvas>
            <span class="pb-10">Clique sur l'image pour la télécharger</span>

            <x-form.field type="color" value="#0d0d0e" label="Couleur de fond" name="visual_s1"/>
            <x-form.field type="color" value="#ffffff" label="Couleur du texte" name="visual_p1"/>
            <x-form.field type="input" value="Partage et commente!" label="Texte en bas" name="visual_outerBottom"/>
            <x-form.field type="input" label="Texte en gauche" name="visual_outerLeft"/>
            <x-form.field type="input" label="Texte à droite" name="visual_outerRight"/>
            
            <x-form.field type="input" label="Titre" name="visual_title"/>
            <x-form.field type="input" label="Contenu" name="visual_content"/>

        </div>

    </div>
    <script src="{{ asset('js/visual.js') }}"></script>
</x-app-layout>
