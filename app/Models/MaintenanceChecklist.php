<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceChecklist extends Model
{
    protected $fillable = [
        'maintenance_type',
        'master_location_id',
        'month',
        'year',
        'department',
        'monitored_by',
        'remarks',
    ];

    public function location()
    {
        return $this->belongsTo(
            MasterLocation::class,
            'master_location_id'
        );
    }
    public function items()
    {
        return $this->hasMany(MaintenanceItem::class);
    }
}