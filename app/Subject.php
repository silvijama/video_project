<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
 /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'ects', 'semester',
    ];

    public function user () 
    {
        return $this->belongsTo('App\User');
    }

    public function users () 
    {
        return $this->belongsToMany('App\User', 'subjects_users');
    }
    

    public function materials ()
    {
        return $this->hasMany('App\Material');
        
    }

}
