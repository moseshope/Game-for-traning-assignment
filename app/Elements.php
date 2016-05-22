<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Elements extends Model
{
    protected $fillable = 
    ['IDChallenge', 
    'character_1', 'character_2', 
    'location_1', 'location_2',
    'power_1', 'power_2',
    'goal_1', 'goal_2',
    'warning_1', 'warning_2',
    'prize_1', 'prize_2',
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
