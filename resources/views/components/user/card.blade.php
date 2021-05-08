@props(['user', 'bg'])
<a class="flex flex-row items-center bg-{{ $bg??'s3'}} rounded-xl px-2 py-2 m-1" href="{{ route('user.show', $user->hashid) }}">
    <img class="rounded-full h-10" src="{{ $user->img }}">
    <span class="mx-3 text-xl">{{ $user->name}}</span>
</a>