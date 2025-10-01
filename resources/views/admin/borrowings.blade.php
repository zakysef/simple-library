<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Verify Borrowings</title>
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
    <nav class="gradient-bg p-4 text-white flex justify-between items-center shadow-lg relative z-10">
        <span class="font-bold text-2xl tracking-wide">School Library <span class="text-black">- Admin</span></span>
        <div class="flex gap-4">
            <a href="{{ route('admin.dashboard') }}" class="hover:underline font-semibold">Dashboard</a>
            <a href="{{ route('admin.books') }}" class="hover:underline font-semibold">Books</a>
            <a href="{{ route('admin.borrowings') }}" class="hover:underline font-semibold">Verify Borrowings</a>
            <form method="POST" action="{{ route('logout') }}" class="inline">
                @csrf
                <button type="submit" class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 ml-2 font-semibold shadow">Logout</button>
            </form>
        </div>
    </nav>
    <div class="max-w-5xl mx-auto mt-10 bg-white rounded-2xl shadow-2xl p-10 relative z-10">
        <h1 class="text-3xl font-extrabold mb-8 text-black tracking-wide">Verify Borrowings</h1>
        <div class="overflow-x-auto rounded-xl shadow">
            <table class="w-full border bg-black bg-opacity-80 text-white rounded-xl">
                <thead>
                    <tr class="bg-gradient-to-r from-pink-500 to-pink-300 text-white">
                        <th class="p-3 border">User</th>
                        <th class="p-3 border">Book</th>
                        <th class="p-3 border">Requested At</th>
                        <th class="p-3 border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pendingBorrowings as $borrowing)
                    <tr>
                        <td class="p-3 border">{{ $borrowing->user->name }}</td>
                        <td class="p-3 border">{{ $borrowing->book->title }}</td>
                        <td class="p-3 border">{{ $borrowing->created_at->format('d M Y H:i') }}</td>
                        <td class="p-3 border">
                            <form method="POST" action="{{ route('admin.borrowings.verify', $borrowing->id) }}">
                                @csrf
                                <button type="submit" class="gradient-bg text-white font-semibold px-4 py-2 rounded shadow hover:opacity-90 transition duration-200">Verify</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="p-4 text-center text-gray-400">No pending borrowings.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>