<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Course';

    protected $primaryKey = 'c_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
    ];


    public function subjects()
    {
        return $this->hasMany(Subject::class, 'c_id');
    }

    public function students()
    {
        return $this->hasMany(StudentCourse::class, 'c_id');
    }
}
