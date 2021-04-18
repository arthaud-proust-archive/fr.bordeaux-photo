<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-p1 leading-tight">
            Modifier votre photo pour "{{$event->title}}"
        </h2>
    </x-slot>

    <x-view.section width="3">
        <x-form.base :action="route('photo.update', $photo->hashid)" method="POST" cancel submitColor="green"  enctype="multipart/form-data">
            <x-form.field :bind="$photo" type="input" label="Titre (optionnel)" name="title" placeholder="Il pourrait donner un sens à votre photo"/>
            <x-form.field :bind="$photo" type="file" label="Photo" name="photo" mimes="image/png, image/jpeg, image/gif"/>
        </x-form.base>
    </x-view.section>

</x-app-layout>
