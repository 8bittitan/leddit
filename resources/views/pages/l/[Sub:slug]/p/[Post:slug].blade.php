<?php

use Illuminate\View\View;
use App\Models\Post;

use function Laravel\Folio\{name, render};

name('post.show');

render(function (View $view, Post $post) {
    return $view->with('author', $post->owner)->with('sub', $post->sub);
});

?>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">p/{{ $post->title }}</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-white mt-4 grid grid-cols-[640px,1fr] gap-8">
        <article>
            <header>
                Posted by
                <a wire:navigate href="{{route('user.show', ['user' => $author])}}">
                    u/{{$author->display_name}}
                </a>
                {{ $post->updated_at->diffForHumans() }}
            </header>
            <div class="prose dark:prose-invert">
                {{ $post->content }}
            </div>
        </article>

        <div class="border border-gray-200 p-4 flex flex-col space-y-4">
            <div>
                <span>About Community</span>

                <h3><a href="{{route('sub.show', ['sub' => $sub])}}">l/{{ $sub->slug }}</a></h3>
            </div>

            <div>
                {{$sub->description}}
            </div>

            <div class="flex flex-col space-y-2">
                <livewire:components.post.follow-button :user="Auth::user()" :sub="$sub"/>
                <a href="{{route('sub.submit', ['sub' => $sub])}}"
                   class="inline-flex items-center px-4 py-2 bg-gray-800 dark:bg-gray-200 border border-transparent rounded-md font-semibold text-xs text-white dark:text-gray-800 uppercase tracking-widest hover:bg-gray-700 dark:hover:bg-white focus:bg-gray-700 dark:focus:bg-white active:bg-gray-900 dark:active:bg-gray-300 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 dark:focus:ring-offset-gray-800 transition ease-in-out duration-150 justify-center">Create
                    Post
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
