<x-guest-layout>
    <div
        class="max-w-4xl w-full bg-white rounded-3xl shadow-2xl flex overflow-hidden animate__animated animate__fadeInUp"
        style="min-height: 520px"
    >
        <!-- Left Side - Luxury Panel -->
        <div
            class="hidden lg:flex w-1/2 bg-gradient-to-tr from-indigo-800 via-indigo-900 to-indigo-950 text-white p-14 flex-col justify-center space-y-10"
        >
            <h1 class="text-5xl font-extrabold tracking-wide leading-tight drop-shadow-lg">
                Selamat Datang<br />
                di DSS Beasiswa
            </h1>
            <p class="text-lg font-semibold opacity-90 max-w-md leading-relaxed">
                Sistem Seleksi Administrasi Beasiswa berbasis web dengan desain modern, keamanan terbaik, dan kemudahan dalam pengelolaan.
            </p>

            <div class="flex space-x-8 mt-8">
                <!-- Icon + Text -->
                <div class="flex flex-col items-center space-y-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4" />
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 20a8 8 0 100-16 8 8 0 000 16z" />
                    </svg>
                    <span class="font-semibold text-sm tracking-wide">Keamanan Data</span>
                </div>

                <div class="flex flex-col items-center space-y-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4" />
                    </svg>
                    <span class="font-semibold text-sm tracking-wide">Proses Cepat</span>
                </div>

                <div class="flex flex-col items-center space-y-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 6h16M4 12h8m-8 6h16" />
                    </svg>
                    <span class="font-semibold text-sm tracking-wide">User Friendly</span>
                </div>
            </div>
        </div>

        <!-- Right Side - Form -->
        <div class="w-full lg:w-1/2 p-14 flex flex-col justify-center bg-white">
            <h2 class="text-4xl font-bold text-gray-900 mb-10 tracking-tight">
                Login Admin
            </h2>

            <form method="POST" action="{{ route('login') }}" class="space-y-8" novalidate>
                @csrf
                
                <!-- Email -->
                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        required
                        autofocus
                        placeholder="your.email@example.com"
                        class="w-full px-6 py-4 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 shadow-sm transition"
                    />
                </div>

                <!-- Password -->
                <div>
                    <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                    <div class="relative">
                        <input
                            type="password"
                            id="password"
                            name="password"
                            required
                            placeholder="••••••••"
                            class="w-full px-6 py-4 border border-gray-300 rounded-xl text-gray-900 placeholder-gray-400 shadow-sm transition"
                        />
                        <button
                            type="button"
                            onclick="togglePassword()"
                            class="absolute inset-y-0 right-4 flex items-center text-indigo-600 font-semibold select-none focus:outline-none"
                            aria-label="Toggle password visibility"
                        >
                            SHOW
                        </button>
                    </div>
                </div>

                <!-- Remember Me and Forgot Password -->
                <div class="flex justify-between items-center text-sm text-gray-600">
                    <label class="flex items-center space-x-3">
                        <input
                            type="checkbox"
                            name="remember"
                            class="h-5 w-5 rounded border-gray-300 text-indigo-600 focus:ring-indigo-500"
                        />
                        <span>Remember me</span>
                    </label>
                    <a href="#" class="hover:text-indigo-600 font-semibold transition">Lupa Password?</a>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="btn-gradient w-full py-4 rounded-xl text-white font-bold text-lg shadow-lg hover:shadow-indigo-500/50 transition duration-500"
                >
                    Login
                </button>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const input = document.getElementById('password');
            const btn = event.currentTarget;
            if (input.type === 'password') {
                input.type = 'text';
                btn.textContent = 'HIDE';
            } else {
                input.type = 'password';
                btn.textContent = 'SHOW';
            }
        }
    </script>
</x-guest-layout>