<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Employee extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone',
        'mobile',
        'site_id',
        'job_title',
        'description'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
