<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    protected $fillable = [
        'thumbnail',
        'title',
        'fulltext',
        'likes',
        'views',
    ];

    public function tags()
    {
        return $this->belongsToMany(Tags::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

}
