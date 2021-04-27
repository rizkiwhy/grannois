<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Announcement extends Model
{
    use HasFactory;

    protected $fillable = ['activity_id', 'publish_date', 'publisher', 'note'];

    public function activity()
    {
        return $this->belongsTo(Activity::class, 'activity_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'publisher', 'id');
    }
}
