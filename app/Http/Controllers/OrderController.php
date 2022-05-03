<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Product;
use App\Models\Order;

class OrderController extends Controller
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


    function create(Client $client, Request $request)
    {
        $data = $request->validate(['product_id' => 'required|numeric']);
        $data['manager_id'] = auth()->id();
        $order = $client->orders()->firstOrCreate($data);
        $order->product()->update(['status' => 1, 'client_id' => $client->id]);
        return redirect("/c/profile/{$client->id}");
    }
    function index()
    {
        $orders = Order::where('status', '=', 1)->get();
        return view('order.index', ['orders' => $orders]);

    }
    function complete()
    {
        $orders = Order::where('status', 2)->get();
        return view('order.complete', ['orders' => $orders]);

    }
    function uncomplete()
    {
        $orders = Order::where('status', 3)->get();
        return view('order.uncomplete', ['orders' => $orders]);

    }

}
