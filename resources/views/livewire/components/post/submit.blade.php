<?php

use App\Livewire\Forms\PostForm;
use Illuminate\Support\Facades\Auth;
use App\Models\Sub;

use function Livewire\Volt\{form, computed, state, mount};

form(PostForm::class);

/** @var array $subs */

$subs = computed(function () {
    return Auth::user()->subs;
});

state(['sub']);

mount(function (?Sub $sub) {
    if ($sub) {
        $this->sub = $sub;
        $this->form->setSubId($sub);
    }
});

$save = function () {
    $newPost = $this->form->store();

    $sub = $this->subs->find($this->form->sub_id);

    $this->redirect(route('post.show', ['sub' => $sub, 'post' => $newPost]), navigate: true);
};

?>

<form wire:submit="save" class="w-full max-w-lg mx-auto mt-8">
    <div class="mb-3">
        <x-input-label for="sub_id" class="sr-only form-label">Sub</x-input-label>
        <x-select class="w-56 mt-1" wire:model="form.sub_id" id="sub_id" name="sub_id">
            <option value="">Select a sub Leddit</option>
            @foreach ($this->subs as $sub)
                <option value="{{ $sub->id }}"
                        @if($this->sub->id === $sub->id) selected @endif>{{ $sub->name }}</option>
            @endforeach
        </x-select>
        @error('form.sub_id')
        <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <x-input-label for="title" class="form-label">Title</x-input-label>
        <x-text-input wire:model="form.title" type="text" class="w-full mt-1" id="title"
                      name="title"/>
        @error('form.title')
        <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>
    <div class="mb-3">
        <x-input-label for="content" class="form-label">Content</x-input-label>
        <textarea wire:model="form.content"
                  class="w-full mt-1 border-gray-300 rounded-md shadow-sm dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600"
                  id="content" name="content"></textarea>
        @error('form.content')
        <span class="text-sm text-red-600 dark:text-red-400">{{ $message }}</span>
        @enderror
    </div>
    <div class="flex justify-end">
        <livewire:components.post.follow-button :user="Auth::user()" :sub="$this->sub"/>
        <x-primary-button class="ml-4" type="submit">Create</x-primary-button>
    </div>
</form>
