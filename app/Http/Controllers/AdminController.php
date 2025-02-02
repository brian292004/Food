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
        return view('AdminPage.index');
    }

    // public function layout(){
    //     $users = User::all();
    //     return view('layout',compact(
    //         'users'
    //     ));
    // }

    public function food(){
        return view('UserPage.food');
    }
    public function Home(){
        return view('Home');
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

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
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

    public function updateUser(Request $req, $id) {
        $users = User::find($id);
        $users->update([
            'name' => $req->input('name'),
            'email' => $req->input('email'),
        ]);
    
        $req->validate([
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
    
        if ($req->hasFile('avatar')) {
            $avatar = $req->file('avatar');
            $avatarName = time().'.'.$avatar->getClientOriginalExtension();
            $path = $avatar->storeAs('avatars', $avatarName, 'public'); // Lưu vào storage/app/public/avatars
            $users->update(['avatar' => $avatarName]);
        } else {
            // Nếu không có avatar mới được tải lên, giữ nguyên avatar hiện tại hoặc đặt avatar mặc định nếu chưa có
            $users->update(['avatar' => 'storage/avatars/M18-30.svg']);
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
        return view('AdminPage.User',compact(
            'users'
        ))->with('message', 'Results found.');
    }

    public function lockAccount(Request $request, $id)
{
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
            // Lưu trữ thông tin khóa tài khoản vào tệp JSON trong thư mục storage/public/status
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
