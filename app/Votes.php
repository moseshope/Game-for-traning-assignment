<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Votes extends Model
{
  protected $primaryKey = 'IDIdea';
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
