<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagementVisit extends Model
{
    protected $fillable = [
        'visit_date',
        'participant',
        'master_location_id',
        'visit_purpose',
        'findings',
        'corrective_action',
        'person_in_charge',
        'target_date',
        'status',
        'completion_date',
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