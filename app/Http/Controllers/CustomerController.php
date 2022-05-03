<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Customer;

class CustomerController extends Controller
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
     * show all customers
     */
    function index()
    {
        $customers = Customer::all();
        return view('customer.index', ['customers' => $customers]);
    }


    function profile(Customer $customer)
    {
        $request = Request::where('customer_id', $customer->id)->get();
        return view('customer.profile', ['customer' => $customer, 'request' => $request]);
    }

}
