<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Container extends Model
{
    use SoftDeletes;

    protected $fillable = ['hashcode_maquina', 'docker_id', 'user_id', 'dataHora_instanciado', 'dataHora_finalizado', 'nickname', 'image_id'];

    public static $rules = [
        'hashcode_maquina' => ['required'],
        'docker_id' => ['required'],
        'dataHora_instanciado' => ['required', 'date'],
        'dataHora_finalizado' => ['nullable', 'date'],
    ];

    public function user()
    {
        return User::firstWhere('id', $this->user_id);
    }

    public function image()
    {
        return Image::firstWhere('id', $this->image_id);
    }

    public function commands()
    {
        return $this->hasMany('App\Models\Command');
    }
}
