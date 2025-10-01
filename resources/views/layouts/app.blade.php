<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - School Library</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #AC1754, #E53888, #F37199, #F7A8C4);
        }

        .sidebar {
            background-color: #1a1a1a;
        }
    </style>
    @stack('styles')
</head>

<body class="bg-gray-100">
    <div class="flex min-h-screen">
        <!-- Sidebar -->
        <div class="sidebar w-64 space-y-6 py-7 px-2 absolute inset-y-0 left-0 transform -translate-x-full md:relative md:translate-x-0 transition duration-200 ease-in-out">
            <nav class="text-white">
                <div class="px-4 py-2.5 mb-6">
                    <h1 class="text-2xl font-bold">Library System</h1>
                </div>
                @yield('sidebar')
            </nav>
        </div>

        <!-- Content -->
        <div class="flex-1">
            <!-- Top Navigation -->
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
                    <h1 class="text-2xl font-bold text-gray-900">@yield('header')</h1>
                    <div class="flex items-center">
                        <span class="text-gray-700 mr-4">{{ auth()->user()->name }}</span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-gray-600 hover:text-gray-900">Logout</button>
                        </form>
                    </div>
                </div>
            </header>

            <!-- Main Content -->
            <main class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
                @yield('content')
            </main>
        </div>
    </div>
    @stack('scripts')
</body>

</html>