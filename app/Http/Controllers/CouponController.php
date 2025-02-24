<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Coupon;
use App\Models\UserCoupon;
use Carbon\Carbon;

class CouponController extends Controller
{
    // Tạo mã giảm giá mới
    public function createCoupon(Request $request)
    {
        $coupon = Coupon::create([
            'coupon_code' => strtoupper($request->coupon_code), // Chuyển mã thành chữ in hoa
            'coupon_description' => $request->coupon_description,
            'discount_percent' => $request->discount_percent,
            'discount_amount' => $request->discount_amount,
            'usage_limit' => $request->usage_limit ?? 1,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_active' => $request->is_active ?? true,
        ]);

        return response()->json(['message' => 'Coupon created successfully', 'coupon' => $coupon], 201);
    }

    // Kiểm tra mã giảm giá hợp lệ
    public function validateCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_code', strtoupper($request->coupon_code))
                        ->where('is_active', true)
                        ->where('start_time', '<=', Carbon::now())
                        ->where('end_time', '>=', Carbon::now())
                        ->first();

        if (!$coupon) {
            return response()->json(['message' => 'Invalid or expired coupon'], 400);
        }

        // Kiểm tra xem user đã dùng coupon này chưa
        $usedCoupon = UserCoupon::where('user_id', $request->user_id)
                                ->where('coupon_id', $coupon->id)
                                ->first();

        if ($usedCoupon && $usedCoupon->usage_count >= $coupon->usage_limit) {
            return response()->json(['message' => 'Coupon usage limit exceeded'], 400);
        }

        return response()->json(['message' => 'Coupon is valid', 'coupon' => $coupon]);
    }

    // Sử dụng mã giảm giá khi thanh toán
    public function applyCoupon(Request $request)
    {
        $coupon = Coupon::where('coupon_code', strtoupper($request->coupon_code))
                        ->where('is_active', true)
                        ->first();

        if (!$coupon) {
            return response()->json(['message' => 'Coupon not found'], 400);
        }

        // Ghi nhận mã giảm giá đã sử dụng
        $userCoupon = UserCoupon::updateOrCreate(
            ['user_id' => $request->user_id, 'coupon_id' => $coupon->id],
            ['usage_count' => \DB::raw('usage_count + 1')]
        );

        return response()->json(['message' => 'Coupon applied successfully', 'discount' => $coupon]);
    }
}
