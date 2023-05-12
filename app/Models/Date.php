<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Date extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $casts = [
        'date' => 'datetime:Y/m/d H:i',
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
