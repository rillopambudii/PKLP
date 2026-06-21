<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterLocation extends Model
{
    protected $fillable = [
        'area',
        'location',
        'name',
        'type',
    ];

    public function manHours()
    {
        return $this->hasMany(ManHour::class);
    }
}
