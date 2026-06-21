<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceItem extends Model
{
    protected $fillable = [
        'maintenance_checklist_id',
        'equipment',
        'item_no',
        'item_name',
        'task_description',
        'periodical_standard',
        'monitor_by',
        'remarks',
    ];

    public function checklist()
    {
        return $this->belongsTo(
            MaintenanceChecklist::class,
            'maintenance_checklist_id'
        );
    }

    public function dailyChecks()
    {
        return $this->hasMany(MaintenanceDailyCheck::class);
    }
}