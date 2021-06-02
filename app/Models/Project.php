<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $table = 'projects';
    protected $fillable = ['title', 'title_japan', 'content', 'content_japan', 'thumnail'];

    public function images()
    {
        return $this->hasMany('App\Models\Image', 'id_project', 'id');
    }
}
