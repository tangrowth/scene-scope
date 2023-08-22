<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'start_date' => 'datetime:Y/m/d H:i',
    ];
    public function performance()
    {
        return $this->belongsTo(Performance::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
