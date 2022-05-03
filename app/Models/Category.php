<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'description',
        'parent_id',
        'level'
    ];

    function sub_categories()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }


    function parent()
    {
        return $this->belongsTo(Category::class);
    }


    function brands()
    {
        return $this->hasMany(Brand::class, 'cat_id');
    }


    function products()
    {
        return $this->hasMany(Product::class, 'cat_id');
    }

}
