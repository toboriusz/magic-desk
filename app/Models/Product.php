<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asset_type_id',
        'brand',
        'model',
        'part_no',
        'description'
    ];

    protected $visible = [
        'id',
        'brand',
        'model',
        'part_no',
        'description',
    ];

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
