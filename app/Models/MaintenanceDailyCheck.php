<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MaintenanceDailyCheck extends Model
{
    protected $fillable = [
        'maintenance_item_id',
        'check_date',
        'status',
        'note',
    ];

    public function item()
    {
        return $this->belongsTo(
            MaintenanceItem::class,
            'maintenance_item_id'
        );
    }
}