<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function adminDashboard(){
        return view('AdminPage.index');
    }

    public function login(){
        return view('Auth.login');
    }

    public function food(){
        return view('UserPage.food');
    }


    public function checklogin(Request $req){
        $validator = Validator::make($req->all(), [
            'name' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $req->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            // Chuyển hướng đến một route chung, hoặc route home
            return redirect()->route('admin.adminDashboard'); // Hoặc redirect()->route('home');
        }

        return redirect()->back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.'])->withInput();
    
    }

    public function register(){
        return view('Auth.register');
    }

    public function registeruser(Request $req){
        // dd(123);
        $req -> validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = new User();
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password'));
        $user->save();

        return redirect('login');
    }

    public function addUser(){
        return view('AdminPage.addUser');
    }

    public function store(Request $req)
    {
        $req -> validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:Admin,User,Shop',
        ]);

        $user = new User();
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->password = Hash::make($req->input('password'));
        $user->role = $req->input('role');
        $user->save();

        return redirect()->route('admin.showUser')->with('success', 'Đã thêm người dùng thành công.');
    }

    public function showUser(){
        $users = User::paginate(5);
        return view('AdminPage.User',compact(
            'users'
        ));
    }

    public function infoUser($id){
        $users = User::find($id);
        return view('AdminPage.infoUser',compact(
            'users'
        ));
    }

    public function editUser($id){
        $users = User::find($id);
        return view('AdminPage.updateUser',compact(
            'users'
        ));
    }

    public function updateUser(Request $req,$id){
        $users = User::find($id);
        $users ->update([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
        ]);
        return redirect()->route('admin.showUser')->with('success', 'Đã cập nhật người dùng thành công');
    }

    public function deleteUser($id){
        $users = User::find($id);
        $users->delete();
        return redirect()->route('admin.showUser')->with('success', 'Đã xóa người dùng thành công');
    }
}
