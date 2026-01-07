<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Ebook Master Maker</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-gray-100 flex items-center justify-center h-screen">

    <div class="w-full max-w-md bg-white rounded-xl shadow-lg p-8">
        <!-- Header -->
        <div class="text-center mb-8">
            <h1 class="text-3xl font-bold text-gray-800">Masuk</h1>
            <p class="text-gray-500 mt-2 text-sm">Silakan masuk untuk melanjutkan ke dashboard</p>
        </div>

        <!-- Form Login -->
        <form action="{{ route('login') }}" method="POST" class="space-y-6">
            @csrf

            <!-- Email -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Email</label>
                <div class="flex items-center bg-gray-50 border border-gray-300 rounded-lg px-3">
                    <i class="fa-solid fa-envelope text-gray-400 mr-2"></i>
                    <input type="email" name="email" required autocomplete="email"
                        class="w-full bg-transparent py-2.5 focus:outline-none" placeholder="contoh@mail.com">
                </div>
                @error('email')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Password -->
            <div>
                <label class="block text-gray-700 font-medium mb-1">Password</label>

                <div class="flex items-center bg-gray-50 border border-gray-300 rounded-lg px-3">
                    <i class="fa-solid fa-lock text-gray-400 mr-2"></i>

                    <input id="password" type="password" name="password" required
                        class="w-full bg-transparent py-2.5 focus:outline-none" placeholder="••••••••">


                </div>

                @error('password')
                    <p class="text-red-600 text-sm mt-1">{{ $message }}</p>
                @enderror
            </div>

            <!-- Remember me -->
            <div class="flex items-center justify-between">
                <label class="flex items-center gap-2 text-gray-600 text-sm">
                    <input type="checkbox" name="remember" class="rounded border-gray-300">
                    Ingat saya
                </label>


            </div>

            <!-- Submit -->
            <button type="submit"
                class="w-full bg-blue-600 hover:bg-blue-700 text-white py-2.5 rounded-lg font-semibold shadow-md transition">
                Masuk
            </button>
        </form>


    </div>

    <script>
        function togglePassword() {
            const passwordInput = document.getElementById('password');
            const eyeIcon = document.getElementById('eyeIcon');

            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>

</html>
