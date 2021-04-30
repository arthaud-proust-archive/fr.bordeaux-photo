<x-app-layout>
    <x-slot name="header">
        <h2 class="pt-10 font-semibold text-5xl text-p1 leading-tight">
            Qui sommes-nous?
        </h2>
    </x-slot>

    <x-view.section class="px-0">
        <div class="px-6 text-xl md:text-2xl mb-12">
            Nous sommes de jeunes Bordelais et Bordelaises qui apportons de l'évènementiel à la ville en organisant des concours photo aux thèmes variés.
        </div>
        <div class="pt-12 flex flex-row flex-wrap items-center justify-around">
            @php
            $a=0.6;
            $h=0.6;
            // $b=0.32;
            // $b=0.9;
            $b=rand(1,10)/10;
            $k=0.6;
            @endphp
            @foreach($users as $user)
                <x-view.profilcard style="animation-delay: {{0.5+$k+$a*sin(($loop->index-$h)/$b)}}s;" class="opacity-0 fade-in" src="{{ asset($user->img) }}" :title="$user->name" :subtitle="$user->bio" />
            @endforeach
            @for($i=0; $i<=10;$i++)
            <x-view.profilcard style="animation-delay: {{1+$k+$a*sin(($i-$h)/$b)}}s;" class="opacity-0 fade-in" src="{{ asset('/assets/equipe/arthaud.jpg') }}" title="Arthaud Proust" subtitle="Jury" />
            @endfor
        </div>
    </x-view.section>
</x-app-layout>