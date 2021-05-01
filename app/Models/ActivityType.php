<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ActivityType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'active'];

    public function activityType()
    {
        return $this->hasMany(Activity::class, 'activity_type_id', 'id');
    }
}
