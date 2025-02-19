<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;

class ShopController extends Controller
{
    public function showShop(){
        $Shop = Shop::paginate(5);
        return view('AdminPage.Shop.index',compact(
            'Shop'
        ));
    }

    public function addShop(){
        return view('AdminPage.Shop.addShop');
    }

    public function storeShop(Request $request){
        $request->validate([
            'shop_name' => 'required',
            'shop_address' => 'required|min:5|max:255',
            'shop_phone' => 'required|numeric|digits_between:10,11',
            'shop_email' => 'required|email|unique:shops',
        ]);
        $Shop = new Shop();
        $Shop->shop_name = $request->shop_name;
        $Shop->shop_address = $request->shop_address;
        $Shop->shop_phone = $request->shop_phone;
        $Shop->shop_email = $request->shop_email;
        $Shop->save();

        return redirect()->route('admin.showShop');
    }

    public function editShop($id){
        $Shop = Shop::find($id);
        return view('AdminPage.Shop.editShop',compact(
            'Shop'
        ));
    }
    public function updateShop(Request $request,$id){
        $request->validate([
            'shop_name' => 'required',
            'shop_address' => 'required|min:5|max:255',
            'shop_phone' => 'required|numeric|digits_between:10,11',
            'shop_email' => 'required|email',
            'shop_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:10000',
        ]);
        $Shop = Shop::find($id);
        $Shop->update([
            'shop_name' => $request->input('shop_name'),
            'shop_address' => $request->input('shop_address'),
            'shop_phone' => $request->input('shop_phone'),
            'shop_email' => $request->input('shop_email'),
        ]);
        if ($request->hasFile('shop_logo')) {
            $shop_logo = $request->file('shop_logo');
            $shop_logoName = time().'.'.$shop_logo->getClientOriginalExtension();
            $path = $shop_logo->storeAs('shop_logo', $shop_logoName, 'public');
            $Shop->update(['shop_logo' => $shop_logoName]);
        }
        $Shop->save();

        return redirect()->route('admin.showShop');
    }
    public function deleteShop($id){
        $Shop = Shop::find($id);
        $Shop->delete();
        return redirect()->route('admin.showShop');
    }
    public function searchShop(Request $request){
        $keyword = $request->input('keyword');
        $Shop = Shop::where('shop_name','like', "%$keyword%")
                ->orWhere('shop_address', 'like', "%$keyword%")
                ->orWhere('shop_phone', 'like', "%$keyword%")
                ->paginate(5);
        return view('AdminPage.Shop.index',compact(
            'Shop'
        ));
    }

    public function infoShop($id){
        $Shop = Shop::find($id);
        return view('AdminPage.Shop.infoShop',compact(
            'Shop'
        ));
    }

    public function lockShop(Request $request, $id){
        $Shop = Shop::find($id);
        if ($Shop) {
            if ($Shop->shop_status == 'Unlock') {
                $shop_status = [
                    'shop_id' => $id,
                    'locked_by' => $request->input('locked_by'),
                    'reason' => $request->input('reason'),
                    'lock_start_time' => $request->input('lock_start_time'),
                    'is_locked' => true
                ];
                
                $filename = storage_path('app/public/status/lockShop.json');
                $existingData = file_exists($filename) ? json_decode(file_get_contents($filename), true) : [];
                $existingData[] = $shop_status;
                file_put_contents($filename, json_encode($existingData, JSON_PRETTY_PRINT));

                $Shop->shop_status = 'Lock';
                $Shop->save();
                return redirect()->route('admin.showShop')->with('success', 'Đã thay đổi trạng thái tài khoản thành công');
            } else {
                $Shop->shop_status = 'Unlock';
                $Shop->save();
                return redirect()->route('admin.showShop')->with('success', 'Đã thay đổi trạng thái tài khoản thành công');
            }
        }
        return redirect()->route('admin.showShop')->with('error', 'Không thể thay đổi trạng thái tài khoản');
    }
}
