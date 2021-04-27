<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Graduation extends Model
{
    use HasFactory;

    protected $fillable = [
        'activity_id',
        'student_id',
        'status',
        'certificate',
    ];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }
    public function student()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }
}
