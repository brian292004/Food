<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Food;
use App\Models\SaleFood;
use App\Models\Coupon;
use App\Models\UserCoupon;
use Carbon\Carbon;
use DB;

class OrderController extends Controller
{
    // Hàm tính giảm giá
    public function calculateDiscount($userId, $foodId, $couponCode = null)
    {
        $food = Food::find($foodId);
        if (!$food) {
            return response()->json(['message' => 'Food not found'], 404);
        }

        $sale = SaleFood::where('food_id', $foodId)->with('sale')->first();
        $coupon = Coupon::where('coupon_code', strtoupper($couponCode))
                        ->where('is_active', true)
                        ->where('start_time', '<=', Carbon::now())
                        ->where('end_time', '>=', Carbon::now())
                        ->first();

        $originalPrice = $food->price;
        $discount = 0;

        // Áp dụng giảm giá từ chương trình khuyến mãi
        if ($sale && $sale->sale) {
            if ($sale->sale->discount_percent) {
                $discount += ($originalPrice * $sale->sale->discount_percent / 100);
            } elseif ($sale->sale->discount_amount) {
                $discount += $sale->sale->discount_amount;
            }
        }

        // Áp dụng giảm giá từ mã giảm giá
        if ($coupon) {
            // Kiểm tra giới hạn số lần sử dụng
            $usedCoupon = UserCoupon::where('user_id', $userId)
                                    ->where('coupon_id', $coupon->id)
                                    ->first();

            if (!$usedCoupon || $usedCoupon->usage_count < $coupon->usage_limit) {
                if ($coupon->discount_percent) {
                    $discount += ($originalPrice * $coupon->discount_percent / 100);
                } elseif ($coupon->discount_amount) {
                    $discount += $coupon->discount_amount;
                }
            } else {
                return response()->json(['message' => 'Coupon usage limit exceeded'], 400);
            }
        }

        // Tổng tiền sau khi giảm giá
        $finalPrice = max(0, $originalPrice - $discount);

        return response()->json([
            'original_price' => $originalPrice,
            'discount' => $discount,
            'final_price' => $finalPrice
        ]);
    }

    // API tính tổng giá trị đơn hàng khi đặt món
    public function applyDiscount(Request $request)
    {
        $userId = $request->user_id;
        $foodId = $request->food_id;
        $couponCode = $request->coupon_code ?? null;

        return $this->calculateDiscount($userId, $foodId, $couponCode);
    }
}
