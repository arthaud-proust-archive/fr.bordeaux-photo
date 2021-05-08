@props(['user', 'content'])
<div class="mb-6 flex flex-col items-start">
    <x-user.card bg="transparent" :user="$user" />
    <p class="ml-10 py-3 px-5 bg-s2 rounded-xl">
        {{ $content }}
    </p>
</div>