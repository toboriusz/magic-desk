<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'description'
    ];

    /**
     * The attributes that should be visible for arrays.
     *
     * @var array
     */

    protected $dates = ['deleted_at'];

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

}
