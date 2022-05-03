<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Client;

class PaymentController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * show all payments
     */
    function index()
    {
        $payments = Payment::all();
        return view('payment.index', ['payments' => $payments]);
    }


    function make_payment(Client $client)
    {
        
    }

}
