<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Image extends Model
{
    use SoftDeletes;

    protected $fillable = ['name', 'description', 'fromImage', 'fromSrc', 'repo', 'tag', 'message', 'user_type'];

    public function getInstances()
    {
        return $this->hasMany(Container::class);
    }
}
