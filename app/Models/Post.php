<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    use HasFactory;
    use HasSlug;

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }

    public function toSearchableArray(): array
    {
        return [
            'title',
            'name',
            'slug',
            'content',
        ];
    }

    protected $fillable = [
        'name',
        'title',
        'slug',
        'content',
        'owner_id',
        'sub_id',
    ];

    public function owner(): BelongsTo
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function sub(): BelongsTo
    {
        return $this->belongsTo(Sub::class, 'sub_id');
    }
}
