<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $with = ['category', 'images'];
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'cat_id',
        'brand_id',
        'model_id',
        'description',
        'color',
        'cond',
        'receipt',
        'age',
        'publish',
        'sn',
        'sn_type',
        'price',
        'initial_price',
        'discount',
        'repay_price',
        'repay_period',
        'free_days',
        'fimage_id',
        'owner_id',
        'fimage'
    ];


    function owner()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * get the category for this product
     * @return Category
     */
    function category()
    {
        return $this->belongsTo(Category::class, 'cat_id');
    }

    /**
     * get the brand for this product
     */
    function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * get the model
     */
    function model()
    {
        return $this->belongsTo(Type::class, 'model_id');
    }


    function images()
    {
        return $this->hasMany(ProductImage::class);
    }


    function client()
    {
        return $this->belongsTo(Client::class);
    }
    

}
