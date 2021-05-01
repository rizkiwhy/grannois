<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Student extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'user_id',
        'place_of_birth',
        'date_of_birth',
        'student_parent_number',
        'national_student_parent_number',
        'competency_of_expertise_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function competencyOfExpertise()
    {
        return $this->belongsTo(
            CompetencyOfExpertise::class,
            'competency_of_expertise_id',
            'id'
        );
    }

    public function graduation()
    {
        return $this->hasOne(Graduation::class, 'student_id', 'id');
    }
}
