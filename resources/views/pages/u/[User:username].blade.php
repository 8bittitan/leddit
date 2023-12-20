<?php

use function Livewire\Volt\{state};
use function Laravel\Folio\{name};

name('user.show');

state(['user' => fn() => $user]);
?>

<x-app-layout>
    @volt
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            /u/{{ $user->username }}
        </h2>
    </x-slot>
    <div class="px-4 mx-auto mt-4 text-white max-w-7xl sm:px-6 lg:px-8">
        @foreach ($user->posts as $post)
            <div>
                <a href="{{route('post.show', ['sub' => $post->sub, 'post' => $post])}}">{{ $post->title }}</a>
            </div>
        @endforeach
    </div>
    @endvolt
</x-app-layout>
