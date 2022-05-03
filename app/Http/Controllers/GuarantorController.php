<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Guarantor;

class GuarantorController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * get all guarantors
     */
    function index()
    {
        $grt = Guarantor::all();
        return view('grt.guarantors', ['guarantors' => $grt]);
    }


    function form()
    {
        $this->get_states();
        $grt_id = request()->query('cid');
        return view('grt.form', ['grt_id' => $grt_id, 'states' => $this->states, 'keys' => $this->keys]);
    }


    /**
     * get one guarantor profile
     */
    function profile(Guarantor $grt)
    {
        // dd($grt);
        $this->get_states();
        return view('grt.profile', ['grt' => $grt, 'states' => $this->states, 'keys' => $this->keys]);
    }


    /**
     * create client information
     */
    function create(Request $request)
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
            'email'             => 'required',
            'photo'             => 'required|image',
            'gender'            => 'required',
            'marital_status'    => 'required',
            'id_type'           => 'required',
            'id_number'         => 'required',
            'id_issue_date'     => 'required',
            'id_expiry_date'    => '',
            'id_photo'          => 'image',
            'form_photo'        => 'image',
            'signature_photo'   => 'image'
        ]);

        foreach ($data as $key => $value) {
            if (stristr($key, 'photo')) {
                $imagePath = $request->$key->store('uploads/guarantors', 'public');
                $data[$key] = $imagePath;
            }
        }
        $cid = $request->cid;
        $data['client_id'] = $cid;
        $data['manager_id'] = auth()->id();

        Guarantor::firstOrCreate(['email' => $data['email']], $data);

        return $request->query('grt') ? redirect('/g/create?cid=' . $cid) : redirect('/c');
    }


    /**
     * update grt information
     */
    function update(Guarantor $grt, Request $request)
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
            'email'             => 'required',
            'gender'            => 'required',
            'marital_status'    => 'required',
            'id_type'           => 'required',
            'id_number'         => 'required',
            'id_issue_date'     => 'required',
            'id_expiry_date'    => '',
        ]);

        $grt->update($data);
        
        return redirect("/g/profile/{$grt->id}");
    }


    /**
     * update grt profile email
     */
    function update_email(Request $request)
    {
        $data = $request->validate(['email' => 'required|email']);

        if (Client::where('email', $data['email'])->exists()) {
            return back()->withErrors([
                'email' => 'Email already exist, choose another'
            ]);
        }
        auth()->user()->update($data);

        return redirect('/profile');
    }


    /**
     * update grt's profile photo
     */
    function update_photo(Guarantor $grt, Request $request)
    {
        $name = array_keys($_FILES)[0];
        $request->validate([$name => 'required|image']);
        $imagePath = $request->$name->store('uploads/guarantors', 'public');

        $grt->update([$name => $imagePath]);

        return redirect("/g/profile/{$grt->id}");
    }

}
