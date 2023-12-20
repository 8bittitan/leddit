<?php

use function Laravel\Folio\{name};

name('sub.show');

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800 dark:text-gray-200">
            /l/{{ $sub->name }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white mt-4 grid grid-cols-[640px,1fr] gap-8">
        <div>
            <x-primary-button class="justify-center block w-full mb-4" type="button">Create a post</x-primary-button>

            <ul>
                @foreach ($sub->posts as $post)
                    <li class="mb-4">
                        <h3 class="text-2xl font-semibold">{{ $post->title }}</h3>
                        <p>{{ $post->content }}</p>
                    </li>
                @endforeach
            </ul>
        </div>
        <div class="flex flex-col p-4 space-y-4 border border-gray-200">
            <div>
                <span>About Community</span>

                <h3><a href="{{ route('sub.show', ['sub' => $sub]) }}">l/{{ $sub->slug }}</a></h3>
            </div>

            <div>
                {{ $sub->description }}
            </div>

            <div class="flex flex-col space-y-2">
                <livewire:components.post.follow-button :user="Auth::user()" :sub="$sub" />
                <a href="{{ route('sub.submit', ['sub' => $sub]) }}"
                    class="inline-flex items-center justify-center px-4 py-2 text-xs font-semibold tracking-widest text-white uppercase transition duration-150 ease-in-out bg-gray-800 border border-transparent rounded-md dark:bg-gray-200 dark:text-gray-800 hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800">Create
                    Post
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
