<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;
class AuthenticationController extends Controller
{
    public function login()
    {
        return view('Auth.login');
    }
    public function checklogin(Request $req)
    {
        $validator = Validator::make($req->all(), [
            'email' => 'required',
            'password' => 'required',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $credentials = $req->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $req->session()->regenerate();

            // Chuyển hướng đến một route chung, hoặc route home
            return redirect()->route('admin.adminDashboard'); // Hoặc redirect()->route('home');
        }

        return redirect()->back()->withErrors(['email' => 'Thông tin đăng nhập không chính xác.'])->withInput();

    }
    public function register()
    {
        return view('Auth.register');
    }

    public function registeruser(Request $req)
    {
        // dd(123);
        $req->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user = new User();
        $user->name = $req->input('name');
        $user->email = $req->input('email');
        $user->role = 'User';
        $user->password = Hash::make($req->input('password'));
        $user->save();

        return redirect('login');
    }
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Handle Google Callback
    public function handleGoogleCallback()
    {
        try {
            $googleUser = Socialite::driver('google')->stateless()->user();
            $user = User::where('email', $googleUser->getEmail())->first();

            if ($user) {
                // Người dùng đã tồn tại, đăng nhập người dùng
                Auth::login($user);
            } else {
                // Người dùng chưa tồn tại, tạo người dùng mới
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt('password') // Bạn có thể thay đổi mật khẩu mặc định
                ]);

                Auth::login($user);
            }

            // Regenerate session
            session()->regenerate();
            // Chuyển hướng đến trang chủ hoặc trang mong muốn
            return redirect()->route('admin.adminDashboard');
        } catch (\Exception $e) {
            // Xử lý lỗi nếu có
            return redirect()->route('login')->withErrors(['msg' => 'Đăng nhập bằng Google thất bại, vui lòng thử lại.']);
        }
    }


}
