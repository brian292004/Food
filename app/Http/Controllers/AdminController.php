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
        return view('AdminPage.register');
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

        return redirect('Auth.login');
    }

    public function addUser(){
        return view('AdminPage.addUser');
    }

    public function showUser(){
        return view('AdminPage.User');
    }
}
