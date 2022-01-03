<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HouseholdMember extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'household_id',
        'user_id',
        'user_type',
        'status',
    ];


}
