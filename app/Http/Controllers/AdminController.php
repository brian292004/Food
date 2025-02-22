<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class AdminController extends Controller
{
    public function adminDashboard(){
        return view('AdminPage.User.index');
    }

    public function food(){
        return view('UserPage.food');
    }
    public function Home(){
        return view('Home');
    }
    public function addUser(){
        return view('AdminPage.User.addUser');
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

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }

    public function showUser(){
        $users = User::paginate(5);
        return view('AdminPage.User.User',compact(
            'users'
        ));
    }

    public function infoUser($id){
        $users = User::find($id);
        return view('AdminPage.User.infoUser',compact(
            'users'
        ));
    }

    public function editUser($id){
        $users = User::find($id);
        return view('AdminPage.User.updateUser',compact(
            'users'
        ));
    }

    public function updateUser(Request $req, $id) {
        $req->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
    
        $users = User::find($id);
    
        if (!$users) {
            return redirect()->route('admin.showUser')->with('error', 'Người dùng không tồn tại');
        }
    
        $users->update([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
        ]);
    
        if ($req->hasFile('avatar')) {
            $avatar = $req->file('avatar');
            $avatarName = time().'.'.$avatar->getClientOriginalExtension();
            $path = $avatar->storeAs('avatars', $avatarName, 'public');
            $users->update(['avatar' => $avatarName]);
        }
    
        return redirect()->route('admin.showUser')->with('success', 'Đã cập nhật người dùng thành công');
    }

    public function deleteUser($id){
        $users = User::find($id);
        $users->delete();
        return redirect()->route('admin.showUser')->with('success', 'Đã xóa người dùng thành công');
    }

    public function searchUsers(Request $request){
        $keyword = $request->input('keyword');
        $users = User::where('name', 'like', "%$keyword%")
                 ->orWhere('email', 'like', "%$keyword%")
                 ->orWhere('role', 'like', "%$keyword%")
                 ->paginate(3);
        return view('AdminPage.User.User',compact(
            'users'
        ))->with('message', 'Results found.');
    }

    public function lockAccount(Request $request, $id){
        $user = User::find($id);
        if ($user) {
            if ($user->status == 'Unlock') {
                $status = [
                    'user_id' => $id,
                    'locked_by' => $request->input('locked_by'),
                    'reason' => $request->input('reason'),
                    'lock_start_time' => $request->input('lock_start_time'),
                    'is_locked' => true
                ];
                $filename = storage_path('app/public/status/lockAccount.json');
                $existingData = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];
                $existingData[] = $status;
                file_put_contents($filename, json_encode($existingData, JSON_PRETTY_PRINT));

                $user->status = 'Lock';
                $user->save();
                return redirect()->route('admin.showUser')->with('success', 'Đã thay đổi trạng thái tài khoản thành công');
            } else {
                $user->status = 'Unlock';
                $user->save();
                return redirect()->route('admin.showUser')->with('success', 'Đã thay đổi trạng thái tài khoản thành công');
            }
        }
        return redirect()->route('admin.showUser')->with('error', 'Không thể thay đổi trạng thái tài khoản');
    }
    
}
