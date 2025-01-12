<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // dd('ok');
        if (!Auth::check()) {
            return redirect()->route('login'); // Chuyển hướng đến trang đăng nhập nếu chưa đăng nhập
        }

        $user = Auth::user(); // Lấy thông tin người dùng một lần

        switch ($user->role) {
            case 'admin':
                return $next($request);
            case 'user':
                return redirect()->route('user.dashboard');
            case 'shop':
                return redirect()->route('dashboard.index');
            default:
                // Xử lý trường hợp role không xác định
                Auth::logout(); // Đăng xuất người dùng
                return redirect()->route('login')->with('error', 'Vai trò không hợp lệ.'); // Chuyển hướng đến trang đăng nhập với thông báo lỗi
        }
    }
}
