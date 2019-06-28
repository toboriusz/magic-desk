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
        'asset_type_id',
        'name',
        'description'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
       'pivot'
    ];

    protected $dates = ['deleted_at'];

    public function assetType()
    {
        return $this->belongsTo(AssetType::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }

}
