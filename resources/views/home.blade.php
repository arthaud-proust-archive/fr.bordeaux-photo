<x-app-layout>
    <x-slot name="header">
        <h1 class="mt-4 ml-4 text-5xl text-p1 leading-tight">
            À la une
        </h1>
    </x-slot>

    @authRole('admin')
    <x-view.section title="Administration">
        <x-view.link :href="route('info.create')" text="Ajouter une info à la une" />
    </x-view.section>
    @endauthRole

    <div class="mx-2 sm:mx-auto sm:px-6 lg:px-8 max-w-7xl items-start grid grid-adaptive grid-cols-1 md:grid-cols-2 auto-rows-auto gap-4">
        @foreach($infos as $info) 
                <x-view.gridSection class="max-w-xl bg-s2">
                    <x-slot name="title">
                        {{$info->title}}
                        @authRole('admin')
                            <x-view.link muted :href="route('info.edit', $info->hashid)" text="Éditer" />
                        @endauthRole
                    </x-slot>
                    <div class="mt-2 quillContent">
                        @bindPagesRoute($info->content)
                        {{-- @quillContent($info->content) --}}
                    </div>

                </x-view.gridSection>
        @endforeach
    </div>
</x-app-layout>
