<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'point', 'language'
    ];

    public function problem(){
        return $this->belongsTo('App\Problem');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
