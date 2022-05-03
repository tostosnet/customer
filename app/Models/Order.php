<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'product_id',
        'client_id',
        'manager_id',
        'npayment',
        'last_paid',
        'last_payment_id',
        'status',
        'completed_at'
    ];

    function client()
    {
        return $this->belongsTo(Client::class);
    }

    function manager()
    {
        return $this->belongsTo(User::class, 'manager_id');
    }

    function product()
    {
        return $this->belongsTo(Product::class);
    }

    function payments()
    {
        return $this->hasMany(Payment::class);
    }


}
