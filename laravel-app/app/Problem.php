<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    protected $fillable = [
        'name', 'difficulty', 'pdf_path', 'time_limit', 'memory_limit'
    ];
}
