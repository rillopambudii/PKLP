<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AnnualWorkPlanSchedule extends Model
{
    protected $fillable = [

        'annual_work_plan_id',

        'month',

        'week',

        'is_planned',
        'actual_date',
    ];

    public function workPlan()
    {
        return $this->belongsTo(
            AnnualWorkPlan::class,
            'annual_work_plan_id'
        );
    }
}