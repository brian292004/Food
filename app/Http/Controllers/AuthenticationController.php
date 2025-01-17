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
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['msg' => 'Đăng nhập với Google thất bại. Vui lòng thử lại.']);
        }


        $user = User::firstOrCreate(
            ['email' => $googleUser->getEmail()],
            [
                'name' => $googleUser->getName(),
                'provider' => 'google',
                'provider_id' => $googleUser->getId(),
                'password' => bcrypt(Str::random(16)), // Mật khẩu ngẫu nhiên
                'role' => 'User',
            ]
        );

        Auth::login($user);

        return redirect($user->redirectTo());
    }
    

}
