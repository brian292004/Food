<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function adminDashboard(){
        return view('AdminPage.index');
    }


    public function food(){
        return view('UserPage.food');
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
