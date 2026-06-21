<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnualWorkPlan extends Model
{
    protected $fillable = [

        'activity_name',

        'sub_activity',

        'participant',

        'frequency',

        'year',

        'notes',
    ];

    public function schedules()
    {
        return $this->hasMany(
            AnnualWorkPlanSchedule::class
        );
    }
    
}