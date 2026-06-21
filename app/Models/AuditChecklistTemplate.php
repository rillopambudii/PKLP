<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AuditChecklistTemplate extends Model
{
    protected $fillable = [
        'audit_type',
        'department',
        'section',
        'clause',
        'question',
    ];
}