<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenges extends Model
{
    protected $fillable = ['name', 'description', 'date'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
