<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';
    protected $fillable = ['id_project', 'image_path'];

    public function project()
    {
        return $this->belongsTo('App\Models\Project', 'id_project', 'id');
    }
}
