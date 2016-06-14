<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IdeasElements extends Model
{
    protected $fillable = ['character', 'place', 'ressource', 'quest', 'warning', 'treasure'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
