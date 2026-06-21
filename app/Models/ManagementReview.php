<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ManagementReview extends Model
{
    protected $fillable = [

        'meeting_date',

        'topic',

        'discussion_result',

        'person_in_charge',

        'follow_up',

        'follow_up_status',

        'target_date',

        'realization_date',

        'additional_notes',

        'year',
    ];
}