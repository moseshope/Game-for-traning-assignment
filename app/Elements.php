<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elements extends Model
{
    protected $fillable =
    ['IDChallenge', 'category', 'label', 'difficulty'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
  

}
