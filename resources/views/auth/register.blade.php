<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - School Library</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body,
        html {
            font-family: 'Poppins', 'Helvetica Neue', Helvetica, Arial, sans-serif;
        }

        .gradient-bg {
            background: linear-gradient(135deg, #AC1754, #E53888, #F37199, #F7A8C4);
        }

        .gradient-shape {
            position: absolute;
            z-index: 0;
            width: 600px;
            height: 600px;
            top: -120px;
            right: -180px;
            opacity: 0.22;
            pointer-events: none;
        }

        .card-dark {
            background: #18181b;
            color: #fff;
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen relative overflow-x-hidden">
    <div class="gradient-shape">
        <svg viewBox="0 0 600 600">
            <defs>
                <radialGradient id="grad1" cx="50%" cy="50%" r="80%">
                    <stop offset="0%" stop-color="#F7A8C4" />
                    <stop offset="40%" stop-color="#F37199" />
                    <stop offset="70%" stop-color="#E53888" />
                    <stop offset="100%" stop-color="#AC1754" />
                </radialGradient>
            </defs>
            <ellipse cx="300" cy="300" rx="300" ry="300" fill="url(#grad1)" />
        </svg>
    </div>
    <a href="{{ url('/') }}"
        class="fixed top-6 left-6 z-20 gradient-bg text-white px-4 py-2 rounded-lg font-semibold shadow hover:opacity-90 transition duration-200">
        ← Back to Welcome
    </a>
    <div class="min-h-screen flex flex-col items-center justify-center relative z-10">
        <div class="card-dark p-10 rounded-2xl shadow-2xl w-96 border-2 border-pink-400">
            <h2 class="text-3xl font-extrabold mb-6 text-center text-white">Register</h2>
            <form action="{{ route('student.register') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="block text-pink-200 text-sm font-bold mb-2" for="name">
                        Full Name
                    </label>
                    <input
                        class="shadow appearance-none border border-pink-400 rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500"
                        id="name" type="text" name="name" required>
                </div>
                <div class="mb-4">
                    <label class="block text-pink-200 text-sm font-bold mb-2" for="email">
                        Email
                    </label>
                    <input
                        class="shadow appearance-none border border-pink-400 rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500"
                        id="email" type="email" name="email" required>
                </div>
                <div class="mb-4">
                    <label class="block text-pink-200 text-sm font-bold mb-2" for="password">
                        Password
                    </label>
                    <div class="relative">
                        <input
                            class="shadow appearance-none border border-pink-400 rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500"
                            id="password" type="password" name="password" required>
                        <button type="button" onclick="togglePassword('password', this)" tabindex="-1"
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-pink-500 focus:outline-none">
                            <svg id="icon-password" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path id="icon-password-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 0a9 9 0 0118 0 9 9 0 01-18 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="mb-6">
                    <label class="block text-pink-200 text-sm font-bold mb-2" for="password_confirmation">
                        Confirm Password
                    </label>
                    <div class="relative">
                        <input
                            class="shadow appearance-none border border-pink-400 rounded w-full py-2 px-3 text-gray-900 leading-tight focus:outline-none focus:ring-2 focus:ring-pink-500"
                            id="password_confirmation" type="password" name="password_confirmation" required>
                        <button type="button" onclick="togglePassword('password_confirmation', this)" tabindex="-1"
                            class="absolute inset-y-0 right-0 px-3 flex items-center text-gray-400 hover:text-pink-500 focus:outline-none">
                            <svg id="icon-password-confirm" xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path id="icon-password-confirm-path" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 0a9 9 0 0118 0 9 9 0 01-18 0z" />
                            </svg>
                        </button>
                    </div>
                </div>
                <div class="flex items-center justify-between">
                    <button
                        class="gradient-bg text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline w-full"
                        type="submit">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
    <script>
        function togglePassword(id, btn) {
            const input = document.getElementById(id);
            const svg = btn.querySelector('svg');
            const path = svg.querySelector('path');
            if (input.type === "password") {
                input.type = "text";
                // eye-off icon
                path.setAttribute("d", "M13.875 18.825A10.05 10.05 0 0112 19c-5 0-9-4-9-7s4-7 9-7 9 4 9 7c0 1.306-.835 2.417-2.125 3.825M15 12a3 3 0 11-6 0 3 3 0 016 0z");
            } else {
                input.type = "password";
                // eye icon
                path.setAttribute("d", "M15 12a3 3 0 11-6 0 3 3 0 016 0zm-9 0a9 9 0 0118 0 9 9 0 01-18 0z");
            }
        }
    </script>
</body>

</html>