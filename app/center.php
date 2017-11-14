<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class center extends Model
{
	use SoftDeletes;
	
    protected $fillable = [
        'code', 'description'
    ];

    public function user()
    {
    	return $this->hasMany(User::class);
    }

    public function changessystems()
    {
        return $this->hasMany(ChangesSystem::class);
    }
}
