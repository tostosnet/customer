<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'parent_id',
        'level'
    ];

    function sub_locations()
    {
        return $this->hasMany(Location::class, 'parent_id');
    }


    function parent()
    {
        return $this->belongsTo(Location::class);
    }

}
