<?php


namespace App\Traits\Tag;

use App\Models\Tag;

trait HasTags
{
    public function tags()
    {
        return $this->morphMany(Tag::class, 'taggable');
    }

    public function latestTag()
    {
        return $this->morphOne(Tag::class, 'taggable')->latest('id');
    }

    public function oldestTag()
    {
        return $this->morphOne(Tag::class, 'taggable')->oldest('id');
    }
}
