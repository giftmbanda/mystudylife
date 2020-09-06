<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Subject';

    protected $primaryKey = 's_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'code',
        'v_id',
        'c_id',
        'semester',
        'session_date',
        'number_of_attendances',
    ];


    public function venue()
    {
        return $this->belongsTo(Venue::class, 'v_id');
    }

    public function course()
    {
        return $this->belongsTo(Course::class, 'c_id');
    }
}
