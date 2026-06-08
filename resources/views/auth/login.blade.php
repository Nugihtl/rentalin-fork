<x-guest-layout>
    <main class="auth-wrapper">

        {{-- LEFT PANEL --}}
        <section class="auth-left">

            <div class="auth-left-content">

                <a href="{{ route('home') }}" class="auth-logo">
                    <img
                        src="{{ asset('assets/img/logo/logo.png') }}"
                        alt="Rentalin"
                        class="logo-img">
                </a>

                <h1 class="auth-headline">
                    Layanan Sewa Menyewa Terpercaya
                </h1>

                <p class="auth-description">
                    Bergabunglah dengan ribuan pengguna lainnya.
                    Transaksi aman, barang terjamin, dan proses yang transparan.
                    Sewa barang impian Anda sekarang!
                </p>

                <div class="auth-members">

                    <div class="member-avatars">
                        <img src="https://i.pravatar.cc/100?img=1" alt="">
                        <img src="https://i.pravatar.cc/100?img=11" alt="">
                        <img src="https://i.pravatar.cc/100?img=12" alt="">
                    </div>

                    <div class="member-text">
                        <h4>Lebih dari 20rb+ Anggota</h4>
                        <p>Dipercaya oleh layanan pramutamu kami</p>
                    </div>

                </div>

            </div>

        </section>

        {{-- RIGHT PANEL --}}
        <section class="auth-right">

            <div class="auth-card">

                <h2 class="auth-title">
                    Log In
                </h2>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    {{-- EMAIL --}}
                    <div class="form-group">

                        <label for="email">
                            Email
                        </label>

                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            placeholder="Masukkan email"
                            required
                            autofocus
                            autocomplete="username">

                        <x-input-error
                            :messages="$errors->get('email')"
                            class="mt-2" />

                    </div>

                    {{-- PASSWORD --}}
                    <div class="form-group">

                        <label for="password">
                            Password
                        </label>

                        <input
                            id="password"
                            type="password"
                            name="password"
                            placeholder="Masukkan password"
                            required
                            autocomplete="current-password">

                        <x-input-error
                            :messages="$errors->get('password')"
                            class="mt-2" />

                    </div>

                    {{-- REMEMBER --}}
                    <div style="margin-bottom:20px;">

                        <label style="display:flex;align-items:center;gap:8px;">
                            <input
                                type="checkbox"
                                name="remember">

                            <span>
                                Ingat saya
                            </span>
                        </label>

                    </div>

                    {{-- FORGOT PASSWORD --}}
                    @if (Route::has('password.request'))

                        <a
                            href="{{ route('password.request') }}"
                            class="forgot-password">

                            Lupa Password?

                        </a>

                    @endif

                    {{-- LOGIN BUTTON --}}
                    <button
                        type="submit"
                        class="btn-full">

                        Log In

                    </button>

                </form>

                {{-- DIVIDER --}}
                <div class="auth-divider">
                    <span>
                        ATAU LANJUTKAN DENGAN
                    </span>
                </div>

                {{-- GOOGLE --}}
                <div style="display: flex; justify-content: center; margin-top: 15px; margin-bottom: 20px;">
                    <a href="{{ route('google.login') }}" 
                       style="display: flex; width: 100%; align-items: center; justify-content: center; gap: 8px; padding: 10px 24px; border: 1px solid #d1d5db; border-radius: 8px; text-decoration: none; color: #1f2937; font-weight: 500; background-color: #ffffff; transition: background-color 0.2s ease-in-out;"
                       onmouseover="this.style.backgroundColor='#f9fafb'" 
                       onmouseout="this.style.backgroundColor='#ffffff'">
                       
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 48 48" width="20px" height="20px">
                            <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                            <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                            <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                            <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                        </svg>
                        Google
                    </a>
                </div>

                {{-- FOOTER --}}
                <div class="auth-footer">

                    Belum punya akun?

                    <a href="{{ route('register') }}">
                        Daftar sekarang
                    </a>

                </div>

            </div>

        </section>

    </main>
</x-guest-layout>