<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentCourse extends Model
{
    
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Student_Course';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'u_id',
        'c_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'u_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'c_id');
    }
}
