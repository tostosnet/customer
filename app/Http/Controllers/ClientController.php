<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\Product;
use App\Models\Guarantor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
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
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->get_states();
        return view('client.form', ['states' => $this->states, 'keys' => $this->keys]);
    }


    function clients()
    {
        $clients = Client::all();
        // dd( Client::where('id', '101')->with('orders.product')->get()[0]->orders[0]->product->name);
        return view('client.clients', ['clients' => $clients]);
    }


    function profile(Client $client)
    {
        $this->get_states();
        $guarantors = $this->toArray($client->guarantors);
        $products = $this->toArray($client->products);
        $availProducts = $this->toArray(Product::where('status', 0)->get());
        $payments = $this->toArray($client->payments);
        return view('client.profile', [
            'client'        => $client,
            'guarantors'    => $guarantors,
            'payments'      => $payments,
            'products'      => $products,
            'availProducts' => $availProducts,
            'states'        => $this->states,
            'keys'          => $this->keys
        ]);
        // data_fill();
    }


    /**
     * create client basic information
     */
    public function create(Request $request)
    {
        $data = $request->validate([
            'surname'           => 'required',
            'first_name'        => 'required',
            "second_name"       => '',
            'phone_number'      => 'required|integer',
            "phone_number2"     => 'integer',
            "street"            => 'required',
            "city"              => 'required',
            'state'             => 'required',
            'email'             => 'required',
            'photo'             => 'required|image|max:5048',
            'gender'            => 'required',
            'marital_status'    => 'required',
            'id_type'           => 'required',
            'id_number'         => 'required',
            'id_issue_date'     => 'required|date',
            'id_expiry_date'    => 'date',
            'id_photo'          => 'image|max:5048',
            'form_photo'        => 'image|max:5048',
            'signature_photo'   => 'image|max:5048',
            'product_id'        => 'required|numeric'
        ]);
        // check if email exists
        if ($this->email_exists($data)) {
            return back()->withErrors([
                'email' => 'A Client with this Account already exist.'
            ]);
        }
        // store images
        foreach ($data as $key => $value) {
            if (stristr($key, 'photo')) {
                $imagePath = $request->$key->store('uploads/clients', 'public');
                $data[$key] = $imagePath;
            }
        }
        // save client
        $client = auth()->user()->clients()->create(['email' => $data['email']], $data); 

        // process order
        $data = $request->validate(['product_id' => 'required']);
        $data['manager_id'] = auth()->id();

        $order = $client->orders()->create($data); //save order
        $order->product()->update(['status' => 1, 'client_id' => $client->id]); // update product status

        return request()->query('grt') ? redirect('/g/create?cid='.$client->id) : redirect('/c');
    }


    function email_exists($data)
    {
        if (Client::where([
            'email'         => $data['email'],
            'manager_id'    => auth()->id()
            ])->exists()) return true;
    }


    function update(Client $client, Request $request)
    {
        $data = $request->validate([
            'surname'           => 'required',
            'first_name'        => 'required',
            "second_name"       => '',
            'phone_number'      => 'required',
            "phone_number2"     => '',
            "street"            => 'required',
            "city"              => 'required',
            'state'             => 'required',
            'marital_status'    => 'required',
            'id_type'           => 'required',
            'id_number'         => 'required',
            'id_issue_date'     => 'required',
            'id_expiry_date'    => ''
        ]);

        $client->update($data);

        return redirect('/c/profile/'.$client->id);
    }


    /**
     * update profile email
     */
    public function update_email(Client $client, Request $request)
    {
        $data = $request->validate(['email' => 'required|email']);

        if ($this->email_exists($data)) {
            return back()->withErrors([
                'email' => 'Email already exist, choose another'
            ]);
        }
        $client->update($data);

        return redirect("/c/profile/{$client->id}");
    }


    /**
     * update manager's profile photo
     */
    public function update_photo(Client $client, Request $request)
    {
        $name = array_keys($_FILES)[0];
        $request->validate([$name => 'required|image|max:5048']);
        $imagePath = $request->$name->store('uploads/clients', 'public');

        $client->update([$name => $imagePath]);

        return redirect("/c/profile/{$client->id}");
    }


    function del_all_guarantor(Client $client)
    {
        $client->guarantors()->delete();
        return redirect("/c/profile/{$client->id}");
    }


    function del_guarantor(Client $client, $gid)
    {
        $client->guarantors()->where('id', $gid)->delete();
        return redirect("/c/profile/{$client->id}");
    }


}
