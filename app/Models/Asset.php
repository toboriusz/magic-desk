<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Asset extends Model
{
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'asset_type_id', 
        'site_id', 
        'user_id', 
        'state_id', 
        'product_id',
        'name', 
        'barcode', 
        'serial_no', 
        'description'
    ];

    public function assetType()
    {
        return $this->belongsTo(AssetType::class);
    }

    public function site()
    {
        return $this->belongsTo(Site::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
