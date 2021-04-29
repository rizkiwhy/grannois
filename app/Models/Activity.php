<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_type_id',
        'school_year',
        'start_date',
        'end_date',
        'note',
    ];

    public function activityType()
    {
        return $this->belongsTo(ActivityType::class, 'activity_type_id', 'id');
    }

    public function graduation()
    {
        return $this->hasMany(Graduation::class, 'activity_id', 'id');
    }

    public function announcement()
    {
        return $this->hasMany(Announcement::class, 'activity_id', 'id');
    }
}
