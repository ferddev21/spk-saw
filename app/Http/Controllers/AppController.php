<?php

namespace App\Http\Controllers;

use App\Models\App;
use App\Models\User;
use Illuminate\Http\Request;

class AppController extends Controller
{
    public function __construct()
    {
        $this->app = new App();
    }

    public function index()
    {
        return view('install');
    }

    public function create(Request $request)
    {
        $request->validate([
            'app_name' => 'required|max:128|min:3',
            'username' => 'required|max:32|min:3|alpha_dash|unique:users,username',
            'password' => 'required|max:32|min:3',
            'name' => 'required|max:32|min:6',
            'email' => 'required|email|unique:users,email',
        ]);

        $this->app->name = $request->app_name;
        $this->app->save();

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->level = 'admin';
        $user->password = bcrypt($request->password);
        $user->status = 'active';
        $user->save();

        $request->session()->flash('success', 'instalasi berhasil silahkan login');
        return redirect()->route('login');
    }

    public function edit()
    {
        $data = [
            'app' => $this->app->first(),
        ];
        return view('pages.app_setting', $data);
    }

    public function update(Request $request)
    {
        $app = $this->app->find($request->id);

        $request->validate([
            'appname' => 'required|max:32',
        ]);

        $app->update([
            'name' => $request->appname,
        ]);

        $request->session()->flash('success', 'Nama Aplikasi Berhasil diupdate');

        return redirect()->route('app.settings');
    }
}
