@php
$e = [
    ['title'=>'Recrutement', 'url'=>page('nous-rejoindre')],
    ['title'=>'Mentions légales', 'url'=>page('mentions-legales')],
    ['title'=>'Conditions d\'utilisation', 'url'=>page('conditions-utilisation')],
    ['title'=>'Règlement RGPD', 'url'=>page('rgpd')],
];
@endphp

<footer class="mt-6 rounded-t-3xl max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-s2 text-p2 flex flex-row flex-wrap lg:flex-nowrap justify-evenly">
    <x-footer.links title="Liens" :links="$e" />
    <x-footer.section title="À propos">
        <p>Nous sommes de jeunes Bordelais et Bordelaises qui apportons de l'évènementiel à la ville en organisant des concours photo aux thèmes variés.</p>
    </x-footer.section>

    <x-footer.section title="Contact">
        <p>Une question? Envie de nous aider?</p>
        <p>Engagez la conversation avec nous sur <a class="underline" href="https://www.instagram.com/photo_a_bordeaux/">instagram</a> ou <a class="underline" href="https://www.facebook.com/photo.a.bordeaux">facebook</a></p>
    </x-footer.section>
</footer>
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 bg-s2 text-p2 flex flex-row flex-wrap justify-between">
    <span class="px-6 mx-6">Développé par <a href="https://arthaud.dev" class="underline">Arthaud Proust</a></span>
    <span class="px-6 mx-6">&copy; 2021-{{ Carbon\Carbon::now()->year }} Bordeaux photo</span>
</div>
