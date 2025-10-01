<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>School Library - Welcome</title>
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
            width: 700px;
            height: 700px;
            top: -180px;
            right: -220px;
            opacity: 0.22;
            pointer-events: none;
        }

        .card-dark {
            background: #18181b;
            color: #fff;
        }

        .card-hover:hover {
            transform: translateY(-8px) scale(1.03);
            box-shadow: 0 10px 32px 0 #AC1754aa;
            transition: all 0.3s cubic-bezier(.4, 2, .3, 1);
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen relative overflow-x-hidden">
    <div class="gradient-shape">
        <svg viewBox="0 0 700 700">
            <defs>
                <radialGradient id="grad1" cx="50%" cy="50%" r="80%">
                    <stop offset="0%" stop-color="#F7A8C4" />
                    <stop offset="40%" stop-color="#F37199" />
                    <stop offset="70%" stop-color="#E53888" />
                    <stop offset="100%" stop-color="#AC1754" />
                </radialGradient>
            </defs>
            <ellipse cx="350" cy="350" rx="350" ry="350" fill="url(#grad1)" />
        </svg>
    </div>
    <div class="min-h-screen flex items-center justify-center relative z-10">
        <div class="container mx-auto px-4">
            <div class="text-center mb-16">
                <h1 class="text-5xl font-extrabold mb-4 text-black tracking-wide">School Library</h1>
                <p class="text-xl text-gray-700">Welcome to our digital library system</p>
            </div>
            <div class="flex flex-col md:flex-row justify-center gap-10">
                <!-- Admin Card -->
                <div class="card-dark rounded-2xl shadow-2xl p-10 w-80 card-hover border-2 border-pink-500">
                    <div class="gradient-bg w-20 h-20 rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-4 text-white">Admin Access</h2>
                    <p class="text-gray-300 mb-6">Manage library resources and user accounts</p>
                    <div class="space-y-3">
                        <a href="/admin/login"
                            class="block gradient-bg text-white py-2 px-4 rounded-lg text-center hover:opacity-90 font-semibold shadow">Login</a>
                    </div>
                </div>

                <!-- Student Card -->
                <div class="card-dark rounded-2xl shadow-2xl p-10 w-80 card-hover border-2 border-pink-400">
                    <div class="gradient-bg w-20 h-20 rounded-full mx-auto mb-6 flex items-center justify-center shadow-lg">
                        <svg class="w-10 h-10 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13c-1.168-.776-2.754-1.253-4.5-1.253-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h2 class="text-2xl font-bold mb-4 text-white">Student Access</h2>
                    <p class="text-gray-300 mb-6">Browse and borrow books from our collection</p>
                    <div class="space-y-3">
                        <a href="/student/login"
                            class="block gradient-bg text-white py-2 px-4 rounded-lg text-center hover:opacity-90 font-semibold shadow">Login</a>
                        <a href="/student/register"
                            class="block border border-pink-400 text-white py-2 px-4 rounded-lg text-center hover:bg-pink-500 hover:text-white font-semibold shadow">Register</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>