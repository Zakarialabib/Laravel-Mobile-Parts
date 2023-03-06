<?php

declare(strict_types=1);

namespace App\Traits;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

trait HasMedia
{
    public function getImageUrlAttribute()
    {
        if (is_null($this->image)) {
            return null;
        }

        if (Str::startsWith($this->image, ['http', 'https'])) {
            return $this->image;
        }

        return Storage::disk('public')->url($this->image);
    }
}
