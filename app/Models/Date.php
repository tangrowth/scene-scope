<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function performance()
    {
        return $this->belongsTo(Performance::class);
    }
}
