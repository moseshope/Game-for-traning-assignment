<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Challenges extends Model
{
    protected $fillable = ['name', 'description', 'start_date', 'end_date', 'img_cover'];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
