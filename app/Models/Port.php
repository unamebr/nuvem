<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Port extends Model
{
    use SoftDeletes;

    protected $fillable = ['ip', 'privatePort', 'publicPort', 'type', 'networkSettings', 'disponivel'];

    public function container()
    {
        return $this->belongsTo('App\Models\Container');
    }

}
