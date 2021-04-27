<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        $data['page'] = 'Login';
        $data['app'] = 'Graduation Announcement';

        return view('pages.auth.login', compact('data'));
    }

    public function actionLogin(Request $request)
    {
        // validasi data request
        $validatedData = $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:5',
        ]);

        // cari user berdasarkan email
        $user = User::where('email', $request->email)->first();

        // user tidak ditemukan
        if ($user === null) {
            return redirect()
                ->route('login.view')
                ->with(
                    'error_message',
                    'Email anda tidak terdaftar, Silahkan hubungi administrator!'
                );
        } else {
            // akun tidak aktif
            if ($user->active === false) {
                return redirect()
                    ->route('login.view')
                    ->with(
                        'error_message',
                        'Akun anda tidak aktif, Silahkan hubungi administrator!'
                    );
            } else {
                // cek otentikasi
                if (
                    Auth::attempt([
                        'email' => $request->email,
                        'password' => $request->password,
                    ])
                ) {
                    return redirect()
                        ->route('dashboard.index')
                        ->with(
                            'success_message',
                            'Selamat Datang ' . Auth::user()->name
                        );
                }
                // password salah
                return redirect()
                    ->route('login.view')
                    ->with('error_message', 'Email atau Password salah!');
            }
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login.view');
    }
}
