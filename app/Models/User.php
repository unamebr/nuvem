<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;
    // ['admin','basic', 'advanced']
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'user_name', 'email', 'password', 'phone', 'user_type', 'acess'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['email_verified_at' => 'datetime'];

    public function machines()
    {
        return Maquina::where('user_id', $this->id);
    }

    public function containers()
    {
        return Container::where('user_id', $this->id);
    }

    public function isAdmin()
    {
        return $this->user_type == 'admin';
    }

    public function isBasic()
    {
        return $this->user_type == 'basic';
    }

    public function isAdvanced()
    {
        return $this->user_type == 'advanced';
    }
}
