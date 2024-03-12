<?php

namespace App\Models;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Document extends Model
{
    use HasFactory;

    protected $fillable=[
        'slug',
        'title',
        'url'
    ];
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Document $document ){
            $document->slug = $document->slug ?? str($document->title)->slug();
        });
    }
    public function user():BelongsTo{
        return $this->belongsTo(User::class);
    }
    public function scopeHimePage(Builder $query){
        $query->where('on_home_page',true)
        ->orderBy('sorting')
        ->limit('6');

    }
}
