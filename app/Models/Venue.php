<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Venue extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Venue';

    protected $primaryKey = 'v_id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'location',
        'latitude',
        'longitude',
    ];

    public function courses()
    {
        return $this->hasMany('App\Course');
    }
}
