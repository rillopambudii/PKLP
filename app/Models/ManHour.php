<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManHour extends Model
{
      protected $fillable = [
        'master_location_id',
        'month',
        'man_power',
        'man_hours',
        'year'
    ];

    public function location()
    {
        return $this->belongsTo(
            MasterLocation::class,
            'master_location_id'
        );
    }
}
