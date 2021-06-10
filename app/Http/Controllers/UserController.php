<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->users = new User();
    }

    public function index()
    {

        $data = [
            'admin_users' => $this->users->where('level', 'admin')->get(),
            'member_users' => $this->users->where('level', 'member')->get(),

        ];
        return view('pages.users', $data);
    }

    public function add()
    {
        return view('pages.user_add');
    }

    public function create(Request $request)
    {
        $request->validate([
            'username' => 'required|max:32|min:6|alpha_dash|unique:users,username',
            'password' => 'required|max:32|min:6',
            'name' => 'required|max:32|min:6',
            'email' => 'required|email|unique:users,email',
            'type' => 'required'
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->email = $request->email;
        $user->name = $request->name;
        $user->level = $request->type;
        $user->password = bcrypt($request->password);
        $user->status = ($request->status == null) ? 'inactive'  : 'active';
        $user->save();

        $request->session()->flash('success', $request->username . ' berhasil dibuat');
        return redirect()->route('user.add');
    }

    public function edit($id)
    {
        $data = [
            'user' => $this->users->where(['id' => decrypt($id)])->first(),
            'from' => 'users'
        ];
        return view('pages.user_edit', $data);
    }

    public function update(Request $request)
    {
        $user = $this->users->find($request->id);

        $request->validate([
            'username' => 'required|max:32',
            'name' => 'required|max:32',
            'email' => 'required|email',
            'level' => 'required'
        ]);

        $user->update([
            'username' => $request->username,
            'email' => $request->email,
            'name' => $request->name,
            'level' => $request->level,
            'status' => ($request->status == null) ? 'inactive'  : 'active',
        ]);

        $request->session()->flash('success', $request->username . ' Berhasil diupdate');

        if (str_replace(url('/'), '', url()->previous()) == "/profile") {
            return redirect()->route('profile');
        }
        return redirect()->route('user.edit', ['id' => encrypt($request->id)]);
    }

    public function delete(Request $request)
    {
        $user = $this->users->find($request->id);

        if ($request->check) {
            $user->forceDelete();
            $request->session()->flash('success', $request->username . ' berhasil dihapus permanen');
        }
        if ($user->delete()) {
            $request->session()->flash('success', $request->username . ' berhasil dihapus, check riwayat');
        }
        return redirect()->route('users');
    }

    public function profile()
    {
        $data = [
            'user' => Auth::user(),
            'from' => 'profile'
        ];
        return view('pages.user_edit', $data);
    }

    public function changePassword(Request $request)
    {

        $user = $this->users->find($request->id);

        $request->validate([
            'current_password' => 'required',
            'new_password' => 'required|same:confirm_password|min:3',
            'confirm_password' => 'required',
        ]);

        if (!Hash::check($request->current_password, $user->password)) {
            $request->session()->flash('error', 'password not match');
            return redirect()->route('profile.change.password');
        }

        $user->password = Hash::make($request->new_password);

        $user->save();

        $request->session()->flash('success', 'password berhasil di ganti');
        return redirect()->route('profile.change.password');
    }
}
