<?php

use function Laravel\Folio\{middleware, name};

middleware(['auth']);

name('sub.submit');

?>

<x-app-layout>
    <x-slot name="header">
        <h2>Create a new Post</h2>
    </x-slot>
    <livewire:components.post.submit :sub="$sub"/>
</x-app-layout>
