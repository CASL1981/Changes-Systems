<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $fillable = ['description'];

    public function changessystems()
    {
        return $this->hasMany(ChangesSystem::class);
    }
}
