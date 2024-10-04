<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Validate input data
        $request->validate([
            'login' => [
                'required', // Ini boleh jadi email atau IC
                'string',
            ],
            'password' => [
                'required',
                'string',
                'min:8', // Min 8 aksara
                'regex:/[a-z]/',      // Mesti ada huruf kecil
                'regex:/[A-Z]/',      // Mesti ada huruf besar
                'regex:/[0-9]/',      // Mesti ada nombor
                'regex:/[@$!%*#?&]/', // Mesti ada simbol
            ],
        ]);

        // Cek sama ada user guna email atau nombor IC
        $login_type = filter_var($request->input('login'), FILTER_VALIDATE_EMAIL) ? 'email' : 'ic_number';

        // Cek kredensial user berdasarkan email/IC dan password
        $user = User::where($login_type, $request->input('login'))->first();

        // Jika pengguna dijumpai dan password betul
        if ($user && Hash::check($request->input('password'), $user->password)) {
            Auth::login($user);
            return $this->authenticated($request, $user); // Redirect ke dashboard selepas login berjaya
        }

        // Jika login gagal
        return back()->withErrors([
            'login' => 'Invalid email/IC or password.',
        ]);
    }

    public function authenticated(Request $request, $user)
    {
        // Dapatkan kategori pengguna
        $kategori = $user->kategori;

        // Arahkan ke homepage mengikut kategori
        switch ($kategori) {
            case 'KPT':
                return redirect('/kpt-homepage');
            case 'PUO':
                return redirect('/puo-homepage');
            case 'KKSS':
                return redirect('/kkss-homepage');
            // Tambah lagi kes berdasarkan kategori yang lain
            default:
                return redirect('/default-homepage');
        }
    }
}
