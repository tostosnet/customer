<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    /**
     * The table associated with this model.
     *
     * @var string
     */
    protected $table = 'models';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'brand_id'
    ];


    function category()
    {
        return $this->belongsTo(Category::class);
    }


    function brand()
    {
        return $this->belongsTo(Brand::class);
    }


    function products()
    {
        return $this->hasMany(Product::class, 'model_id');
    }
}
