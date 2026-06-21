<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditFinding extends Model
{
    protected $fillable = [
        'internal_audit_id',
        'clause',
        'finding_description',
        'finding_type',
        'corrective_action',
        'person_in_charge',
        'target_date',
        'completion_date',
        'status',
    ];

    public function audit()
    {
        return $this->belongsTo(
            InternalAudit::class,
            'internal_audit_id'
        );
    }
}