<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;
    use SoftDeletes;

    protected $date = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'firstname', 'lastname', 'email', 'password', 'area', 'role', 'position_id', 'center_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function getNameAttribute()
    {
        return $this->firstname.' '.$this->lastname;
    }

    public function Position()
    {
        return $this->belongsTo(Position::class);
    }

    public function Center()
    {
        return $this->belongsTo(Center::class);
    }

    public function changessystems()
    {
        return $this->hasMany(ChangesSystem::class);
    }
}
