<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VesselCertificate extends Model
{
    protected $fillable = [

        'master_location_id',

        'certificate_name',

        'issue_place',

        'issued_date',

        'expired_date',

        'days_valid',

        'status',

        'remarks',

        'year',
    ];

    public function location()
    {
        return $this->belongsTo(
            MasterLocation::class,
            'master_location_id'
        );
    }
}