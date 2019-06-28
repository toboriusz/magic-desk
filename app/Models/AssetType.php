<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AssetType extends Model
{
    use SoftDeletes;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'name',
        'icon',
        'description'
    ];

    public function customFields()
    {
        return $this->hasMany(CustomField::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function assets()
    {
        return $this->hasMany(Asset::class);
    }
}
