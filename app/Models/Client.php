<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'surname',
        'first_name',
        'second_name',
        'phone_number',
        'phone_number2',
        'email',
        'street',
        'city',
        'state',
        'photo',
        'gender',
        'marital_status',
        'id_type',
        'id_number',
        'id_issue_date',
        'id_expiry_date',
        'id_photo',
        'form_photo',
        'signature_photo',
        'manager_id'
    ];


    /**
     * this retrieves the manager of this client
     */
    public function manager()
    {
        return $this->belongsTo(User::class);
    }


    function guarantors()
    {
        return $this->hasMany(Guarantor::class);
    }


    function getFullNameAttributes()
    {
        return "{$this->first_name} {$this->surname}";
    }


    function orders()
    {
        return $this->hasMany(Order::class);
    }


    function currentOrder()
    {
        return $this->hasOne(Order::class)->latestOfMany();
    }


    function payments()
    {
        return $this->hasMany(Payment::class);
    }


    function latestPayments()
    {
        return $this->hasOne(Payment::class)->ofMany(['date' => 'max', 'time' => 'max']);
    }


    function products()
    {
        return $this->hasMany(Product::class);
    }


}
