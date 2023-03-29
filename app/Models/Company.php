<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    public function favorites()
    {
        return $this->hasMany(Favorite::class);
    }
    public function performances()
    {
        return $this->hasMany(Performance::class);
    }
}
