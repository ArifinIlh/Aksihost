<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: linear-gradient(to right, #e0f2ff, #ffffff);
        }

        .login-box {
            background-color: #ffffff;
            border: 1px solid #dbeafe;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
        }

        .text-dark {
            color: #111827;
        }

        .btn-primary {
            background-color: #3b82f6;
            color: #fff;
        }

        .btn-primary:hover {
            background-color: #2563eb;
        }

        .link-dark {
            color: #1f2937;
        }

        .link-dark:hover {
            color: #000;
        }
    </style>
</head>
<body class="min-h-screen flex items-center justify-center">

    <div class="w-full max-w-md p-8 rounded-lg login-box">
        <h2 class="text-2xl font-bold mb-6 text-center text-dark">Masuk ke Akun Anda</h2>

        @if(session('status'))
            <div class="mb-4 text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email -->
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-dark mb-1">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}" required autofocus
                    class="w-full px-4 py-2 border border-blue-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-4">
                <label for="password" class="block text-sm font-medium text-dark mb-1">Password</label>
                <div class="relative">
                    <input type="password" name="password" id="password" required
                        class="w-full px-4 py-2 pr-10 border border-blue-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">

                    <!-- Icon mata -->
                    <button type="button" onclick="togglePassword('password', 'eye-open', 'eye-closed')"
                        class="absolute inset-y-0 right-3 flex items-center text-gray-600">
                        <!-- Eye open -->
                        <span id="eye-open">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-eye-fill" viewBox="0 0 16 16">
                                <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                                <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                            </svg>
                        </span>
                        <!-- Eye slash -->
                        <span id="eye-closed" class="hidden">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                                <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z"/>
                                <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>
                            </svg>
                        </span>
                    </button>
                </div>
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember Me -->
            <div class="mb-4 flex items-center">
                <input type="checkbox" name="remember" id="remember" class="mr-2">
                <label for="remember" class="text-sm text-dark">Ingat saya</label>
            </div>

            <!-- Links -->
            <div class="flex justify-between mb-4 text-sm">
                <a href="{{ route('password.request') }}" class="link-dark hover:underline">Lupa password?</a>
                <a href="{{ route('register') }}" class="link-dark hover:underline">Belum punya akun?</a>
            </div>

            <!-- Submit -->
            <button type="submit" class="w-full btn-primary px-4 py-2 rounded-md font-semibold shadow-sm">
                Masuk
            </button>
        </form>
    </div>

    <!-- Toggle Script -->
    <script>
        function togglePassword(inputId, eyeOpenId, eyeClosedId) {
            const input = document.getElementById(inputId);
            const eyeOpen = document.getElementById(eyeOpenId);
            const eyeClosed = document.getElementById(eyeClosedId);

            if (input.type === 'password') {
                input.type = 'text';
                eyeOpen.classList.add('hidden');
                eyeClosed.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeOpen.classList.remove('hidden');
                eyeClosed.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
