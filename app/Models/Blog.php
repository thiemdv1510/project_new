<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model
{
    protected $table = 'blogs';
    protected $fillable = ['title', 'title_japan', 'content', 'conten_japan'];

    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }
}
