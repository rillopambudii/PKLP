<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditChecklistAnswer extends Model
{
    protected $fillable = [
        'internal_audit_id',
        'audit_checklist_template_id',
        'answer',
        'finding_type',
        'notes',
    ];

    public function audit()
    {
        return $this->belongsTo(InternalAudit::class);
    }

    public function template()
    {
        return $this->belongsTo(
            AuditChecklistTemplate::class,
            'audit_checklist_template_id'
        );
    }
}