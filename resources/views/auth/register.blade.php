<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: linear-gradient(to right, #e0f2ff, #ffffff);
        }

        .register-box {
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

    <div class="w-full max-w-md p-8 rounded-lg register-box">
        <h2 class="text-2xl font-bold mb-6 text-center text-dark">Buat Akun Baru</h2>

        <form method="POST" action="{{ route('register') }}">
            @csrf

            {{-- Name --}}
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-dark mb-1">Nama</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" required autofocus autocomplete="name"
                    class="w-full px-4 py-2 border border-blue-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                @error('name')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-dark mb-1">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" required autocomplete="username"
                    class="w-full px-4 py-2 border border-blue-200 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-300">
                @error('email')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-4 relative">
                <label for="password" class="block text-sm font-medium text-dark mb-1">Password</label>
                <input type="password" id="password" name="password" required autocomplete="new-password"
                    class="w-full px-4 py-2 border border-blue-200 rounded-md pr-10 focus:outline-none focus:ring-2 focus:ring-blue-300">
                <button type="button" onclick="togglePassword('password', 'eye1-open', 'eye1-closed')" class="absolute right-3 top-9 text-gray-600">
                    <span id="eye1-open">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                        </svg>
                    </span>
                    <span id="eye1-closed" class="hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                            <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z"/>
                            <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>
                        </svg>
                    </span>
                </button>
                @error('password')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Confirm Password --}}
            <div class="mb-4 relative">
                <label for="password_confirmation" class="block text-sm font-medium text-dark mb-1">Konfirmasi Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required autocomplete="new-password"
                    class="w-full px-4 py-2 border border-blue-200 rounded-md pr-10 focus:outline-none focus:ring-2 focus:ring-blue-300">
                <button type="button" onclick="togglePassword('password_confirmation', 'eye2-open', 'eye2-closed')" class="absolute right-3 top-9 text-gray-600">
                    <span id="eye2-open">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0"/>
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7"/>
                        </svg>
                    </span>
                    <span id="eye2-closed" class="hidden">
                        <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                            class="bi bi-eye-slash-fill" viewBox="0 0 16 16">
                            <path d="m10.79 12.912-1.614-1.615a3.5 3.5 0 0 1-4.474-4.474l-2.06-2.06C.938 6.278 0 8 0 8s3 5.5 8 5.5a7 7 0 0 0 2.79-.588M5.21 3.088A7 7 0 0 1 8 2.5c5 0 8 5.5 8 5.5s-.939 1.721-2.641 3.238l-2.062-2.062a3.5 3.5 0 0 0-4.474-4.474z"/>
                            <path d="M5.525 7.646a2.5 2.5 0 0 0 2.829 2.829zm4.95.708-2.829-2.83a2.5 2.5 0 0 1 2.829 2.829zm3.171 6-12-12 .708-.708 12 12z"/>
                        </svg>
                    </span>
                </button>
                @error('password_confirmation')
                    <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Redirect ke login --}}
            <div class="flex items-center justify-between mt-6">
                <a href="{{ route('login') }}" class="text-sm link-dark hover:underline">Sudah punya akun?</a>
                <button type="submit" class="btn-primary px-4 py-2 rounded-md font-semibold shadow-sm">
                    Daftar
                </button>
            </div>
        </form>
    </div>

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
