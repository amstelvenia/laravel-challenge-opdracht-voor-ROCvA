<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\Image\Enums\Fit;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Spatie\Image\Manipulations;

class Woningen extends Model implements HasMedia
{
    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('woningen')->singleFile()
              ->width(100)
              ->height(100)
              ->sharpen(10);
    }

    protected $fillable = [
        'naam',
        'beschrijving',
        'oppervlakte',
        'prijs',
    ];
    protected $table = 'woningens';
    use HasFactory, InteractsWithMedia;
}
