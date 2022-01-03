<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Household extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    /**
     * Get Members
     */
    public function members()
    {
        return $this->hasMany('App\HouseholdMember');
    }

}
