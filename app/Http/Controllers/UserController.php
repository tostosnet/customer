<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
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
        return view('profile', ['states' => $this->states, 'keys' => $this->keys]);
    }

    /**
     * update profile basic information
     */
    public function update()
    {
        $data = request()->validate([
            'surname'       => 'required',
            'firstname'     => 'required',
            "lastname"      => '',
            'username'      => 'required',
            'phone_number'  => 'required',
            "phone_number2" => '',
            "street"        => 'required',
            "city"          => 'required',
            'state'         => '',
            "company"       => '',
            "about"         => ''
        ]);

        auth()->user()->update($data);

        return redirect('/profile');
    }

    /**
     * update profile username
     */
    public function update_username(Request $request)
    {
        $data = $request->validate(['username' => 'required|string|min:3']);
        if (!preg_match("/[a-zA-Z0-9]+/", $request->username)) {
            return back()->withErrors([
                'username' => 'Please give a valid username.'
            ]);
        }
        if (User::where('username', $data['username'])->exists()) {
            return back()->withErrors([
                'username' => 'Username already exist, choose another'
            ]);
        }
        $request->user()->update($data);

        return redirect('/profile');
    }

    /**
     * update profile email
     */
    public function update_email(Request $request)
    {
        $data = $request->validate(['email' => 'required|email']);

        if (User::where('email', $data['email'])->exists()) {
            return back()->withErrors([
                'email' => 'Email already exist, choose another'
            ]);
        }
        auth()->user()->update($data);

        return redirect('/profile');
    }

    /**
     * update profile password
     */
    public function update_password(Request $request)
    {
        if (!Hash::check($request->password, $request->user()->password)) {
            return back()->withErrors([
                'password' => ['The provided password does not match our records.']
            ]);
        }
        $data = $request->validate(['new_password' => 'required|string|min:6']);

        auth()->user()->update(['password' => Hash::make($data['new_password'])]);

        return redirect('/profile');
    }

    /**
     * update manager's profile photo
     */
    public function update_photo(Request $request)
    {
        $request->validate(['photo' => 'required|image']);

        $imagePath = $request->photo->store('uploads/profile', 'public');

        auth()->user()->update(['photo' => $imagePath]);

        return redirect('/profile');
    }

    /**
     * update profile username
     */
    public function username_exists(Request $request)
    {
        if (User::where('username', $request->username)->exists()) {
            return true;
        }
        return false;
    }

    /**
     * update profile email
     */
    public function email_exists(Request $request)
    {
        $data = $request->validate(['email' => 'required|email']);

        if (User::where('email', $data['email'])->exists()) {
            return true;
        }
        return false;
    }

    public function connect(Client $client)
    {
        $users = User::all();
        $clients = Client::all();
        foreach ($clients as $i => $client) {
        foreach ($users as $i => $user) {
        if ($client->email == $user->email) {
            $client->user_id = $user->id;
            $client->save();
            return response()->json('Connected successfully');
        }}}
    }
    public function fetch(Client $client)
    {
        
    } 

}
