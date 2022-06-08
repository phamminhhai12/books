<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Alert;

class AuthController extends Controller
{
    /**
     * Register account
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        if($request->password === $request->repassword) {
            User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'phone' => $request->phone,
            ]);
            Alert::success('Success', 'Đăng ký thành công');
            return redirect()->back();
        }else {
            Alert::error('Error', 'Mật khẩu không trùng khớp');
            return redirect()->back();
        }
    }

    /**
     * Login account
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        try {
            $result = Auth::attempt(['email' => $request->email, 'password' => $request->password], true);
            if ($result) {
                if (Auth::user()->status == 0) {
                    return redirect()->back();
                }
                Alert::success('Success', 'Đăng nhập thành công');
                return redirect()->back();
            } else {
                Alert::error('Error', 'Mật khẩu / Email không đúng');
                return redirect()->back();
            }
        } catch (\Throwable $e) {
            \Log::info($e->getMessage());
        }
    }

    /**
     * Logout
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Auth::logout();
        Alert::success('Success', 'Đăng xuất thành công');
        return redirect()->route('client.home');
    }

    public function changeAccount()
    {
        $user = User::find(Auth::user()->id);
        return view('client.account', compact('user'));
    }

    public function postChangeAccount(Request $request)
    {
        if ($request->changepass) {
            if (Hash::check($request->oldpass, Auth::user()->password)) {
                if($request->newpass === $request->confirmpass){
                    User::where('email', Auth::user()->email)->update(['password' => bcrypt($request->newpass)]);
                }else{
                    Alert::error('Error', 'Mật khẩu không trùng khớp');
                    return redirect()->back();
                }
            } else {
                Alert::error('Error', 'Mật khẩu hiện tại không trùng không đúng');
                return redirect()->back();
            }
        }
        $user = Auth::user();
        $user->email = $request->email;
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();
        Alert::success('Success', 'Cập nhật thành công');
        return redirect()->back();
    }
}
