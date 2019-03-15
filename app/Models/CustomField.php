<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class CustomField extends Model
{

    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asset_type_id',
        'order',
        'name',
        'shortcode',
        'type',
        'default_value',
        'description',
        'options'
    ];

    protected $hidden = ['pivot'];

    public function assetTypes()
    {
        return $this->belongsTo(AssetType::class);
    }

    public function assets()
    {
        return $this->belongsToMany(Asset::class)->withPivot('value');
    }
}
