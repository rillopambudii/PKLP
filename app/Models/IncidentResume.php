<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class IncidentResume extends Model
{
    protected $fillable = [

        'investigation_number',

        'incident_date',

        'master_location_id',

        'area',

        'company',

        'title_of_incident',

        'incident_description',

        'root_cause',

        'category',

        'incident_category',

        'severity_level',

        'investigation_status',

        'completion_target',

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