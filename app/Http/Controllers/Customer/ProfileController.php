<?php

namespace App\Http\Controllers\Customer;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('customer.profile.index', [
            'title' => 'Thông tin tài khoản',
        ]);
    }

    public function update(Request $request)
    {
        // Lấy user hiện tại
        $user = auth()->user();

        // Kiểm tra xem người dùng có đăng nhập không
        if (!$user) {
            return redirect()->route('login')->with('error', 'Bạn cần đăng nhập để cập nhật thông tin.');
        }

        // Kiểm tra xem $user có phải là 1 đối tượng User không
        if (!$user instanceof User) {
            return redirect()->back()->withErrors(['error' => 'Không tìm thấy người dùng.']);
        }

        // Xác thực dữ liệu
        // $request->validate([
        //     'fullname' => 'required|string|max:255',
        //     'email' => 'required|email|max:255|unique:users,email,' . $user->id, // Kiem tra email duy nhat, tranh trung lap
        //     'phone' => 'nullable|string|max:15',
        //     'address' => 'nullable|string|max:255',
        //     'gender' => 'nullable|string|in:Nam,Nữ',
        //     'dateOfBirth' => 'nullable|date',
        //     'password' => 'nullable|string|min:8|confirmed', // Bổ sung xác thực mật khẩu nếu có thay đổi
        // ]);


        // Cập nhật các trường thông tin
        $user->fullname = $request->input('fullname');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->address = $request->input('address');
        $user->gender = $request->input('gender');
        $user->dateOfBirth = $request->input('dateOfBirth');
        
        // // Debug user và request
        // dd($user, $request->input('password'));

        // Kiểm tra xem người dùng có thay đổi mật khẩu không
        if ($request->filled('password')) {
            $user->password = bcrypt($request->input('password')); // Mã hóa mật khẩu trước khi lưu
        }

        // Lưu lại thông tin
        try {
            $user->save();
            return redirect()->route('customer.profile')->with('success', 'Cập nhật thông tin thành công');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => 'Không thể cập nhật thông tin: ' . $e->getMessage()]);
        }
    }

}
