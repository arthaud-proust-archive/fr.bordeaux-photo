<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Erreur 401 - Accès restreint
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-s1 text-p1 border-b border-p3">
                    Une authentification est requise afin d'effectuer cette requête
                </div>
            </div>
        </div>
    </div>
</x-app-layout>