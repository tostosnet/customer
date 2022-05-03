<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guarantor extends Model
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
        'client_id',
        'manager_id'
    ];


    /**
     * this retrieves the client of this client
     */
    public function client()
    {
        return $this->belongsTo(Client::class);
    }


    /**
     * this retrieves the manager of this client
     */
    public function manager()
    {
        return $this->belongsTo(User::class);
    }


    function getFullNameAttributes()
    {
        return "{$this->first_name} {$this->surname}";
    }

}
