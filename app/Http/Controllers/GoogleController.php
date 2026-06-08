<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User; // <-- Pastikan ini ada
use Illuminate\Support\Facades\Auth; // <-- Pastikan ini ada
use Illuminate\Support\Str; // <-- Pastikan ini ada

class GoogleController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::where('email', $googleUser->getEmail())->first();

            if (!$user) {
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => bcrypt(Str::random(16)), 
                    'email_verified_at' => now(), 
                ]);
            }

            Auth::login($user);

            // Arahkan ke halaman beranda/dashboard
            return redirect()->intended('/dashboard');

        } catch (\Exception $e) {
            // Jika terjadi error, kembali ke halaman login dan bawa pesan error
            return redirect('/login')->with('error', 'Error: ' . $e->getMessage());
        }
    }
}