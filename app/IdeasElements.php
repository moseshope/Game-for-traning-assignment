<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeasElements extends Model
{
    protected $fillable = ['character', 'place', 'ressource', 'quest', 'warning', 'treasure', 'rebounds' ,'disruptive'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function idea()
    {
        return $this->belongsTo(Ideas::class);
    }
}
