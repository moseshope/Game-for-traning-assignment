<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ideas extends Model
{
    protected $fillable = ['name', 'description'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function challenge()
    {
        return $this->belongsTo(Challenges::class);
    }

    //public function getIdeas($challenge){retourne les idées d'un challenge}

}
