<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Site extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'shortcode', 
        'latitude', 
        'longitude', 
        'phone', 
        'address1', 
        'address2', 
        'city', 
        'postcode', 
        'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    protected $dates = ['deleted_at'];

    public function technicians()
    {
        return $this->hasMany(Technician::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

    public function employees()
    {
        return $this->hasMany(Employee::class);
    }
}
