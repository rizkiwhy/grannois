<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompetencyOfExpertise extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'label', 'active'];

    public function student()
    {
        return $this->hasMany(
            Student::class,
            'competency_of_expertise_id',
            'id'
        );
    }
}
