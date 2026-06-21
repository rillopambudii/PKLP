<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InternalAudit extends Model
{
    protected $fillable = [

        'audit_type',

        'audit_date',

        'master_location_id',

        'department',

        'auditor',

        'auditee',

        'status',

        'year',
    ];

    public function location()
    {
        return $this->belongsTo(
            MasterLocation::class,
            'master_location_id'
        );
    }

    public function findings()
    {
        return $this->hasMany(
            AuditFinding::class
        );
    }

    public function checklistAnswers()
    {
        return $this->hasMany(AuditChecklistAnswer::class);
    }
}