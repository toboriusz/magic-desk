<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 
        'description'
    ];

    protected $hidden = ['pivot'];

    public function technicians()
    {
        return $this->belongsToMany(Technician::class);
    }
}