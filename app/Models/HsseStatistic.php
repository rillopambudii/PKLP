<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HsseStatistic extends Model
{
    protected $fillable = [

        'master_location_id',

        'month',

        'year',

        'nearmiss',

        'environment',

        'property_damage',

        'hipo',

        'first_aid',

        'medical_treatment',

        'lti',

        'fatality',
    ];

    public function location()
    {
        return $this->belongsTo(
            MasterLocation::class,
            'master_location_id'
        );
    }
}
