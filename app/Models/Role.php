<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $hidden = ['pivot'];
    
    public function technicians()
    {
        return $this->belongsToMany(Technician::class);
    }
}
