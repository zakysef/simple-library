<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Student Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .gradient-bg {
            background: linear-gradient(135deg, #AC1754, #E53888, #F37199, #F7A8C4);
        }
    </style>
</head>

<body class="bg-gray-100 min-h-screen">
    <nav class="gradient-bg p-4 text-white flex justify-between items-center">
        <span class="font-bold text-xl">School Library - Student</span>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-white text-gray-800 px-4 py-2 rounded hover:bg-gray-200">Logout</button>
        </form>
    </nav>
    <div class="max-w-4xl mx-auto mt-10 bg-white rounded-lg shadow-lg p-8">
        <h1 class="text-3xl font-bold mb-4 text-gray-900">Student Registration</h1>
        <form method="POST" action="{{ route('student.register') }}">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="name" class="block text-gray-700 font-semibold mb-2">Name</label>
                    <input type="text" id="name" name="name" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
                <div>
                    <label for="email" class="block text-gray-700 font-semibold mb-2">Email</label>
                    <input type="email" id="email" name="email" required
                        class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
                </div>
            </div>
            <div class="mb-6">
                <label for="password" class="block text-gray-700 font-semibold mb-2">Password</label>
                <input type="password" id="password" name="password" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
            </div>
            <div class="mb-6">
                <label for="password_confirmation"
                    class="block text-gray-700 font-semibold mb-2">Confirm Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation" required
                    class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500">
            </div>
            <button type="submit"
                class="w-full bg-pink-500 text-white font-semibold py-2 px-4 rounded-lg hover:bg-pink-600 transition duration-200">
                Register
            </button>
        </form>
        <div class="mt-4 text-center">
            <a href="{{ route('student.login') }}" class="text-pink-500 hover:underline">Already have an account? Login
                here.</a>
        </div>
    </div>
</body>

</html>