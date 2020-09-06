<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Student_Attendance';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'u_id',
        's_id',
        'checkin_time',
        'checkout_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'u_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class, 's_id');
    }
}
