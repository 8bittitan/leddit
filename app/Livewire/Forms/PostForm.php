<?php

namespace App\Livewire\Forms;

use App\Models\Post;
use App\Models\Sub;
use Illuminate\Support\Str;
use Livewire\Attributes\Rule;
use Livewire\Form;

class PostForm extends Form
{
    #[Rule('required|string|min:3|max:255')]
    public string $title = '';

    #[Rule('required|string|min:3|max:255')]
    public string $content = '';

    #[Rule('required')]
    public int $sub_id;

    public function setSubId(Sub $sub)
    {
        $this->sub_id = $sub->id;
    }

    public function store(): Post
    {
        $this->validate();

        $user = auth()->user();
        $params = [
            'title' => $this->title,
            'name' => $this->title,
            'slug' => Str::slug($this->title),
            'content' => $this->content,
            'owner_id' => $user->id,
            'sub_id' => $this->sub_id,
        ];

        return Post::create($params);
    }
}
