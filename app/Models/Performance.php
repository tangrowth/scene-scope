<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Performance extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function company()
    {
        return $this->belongsTo(Company::class);
    }
    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
    public function dates()
    {
        return $this->hasMany(Date::class);
    }

}
