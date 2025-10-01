<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
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
            opacity: 0.25;
            pointer-events: none;
        }

        .card-dark {
            background: #18181b;
            color: #fff;
        }

        .card-dark .text-gray-900,
        .card-dark .text-gray-700 {
            color: #fff !important;
        }

        .section-title {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            margin-bottom: 1.25rem;
        }

        .section-title-bar {
            width: 8px;
            height: 32px;
            border-radius: 8px;
            background: linear-gradient(to bottom, #AC1754, #F7A8C4);
        }

        @media (max-width: 768px) {
            .dashboard-cards {
                grid-template-columns: 1fr !important;
            }
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
    <nav class="gradient-bg p-4 text-white flex flex-col md:flex-row md:justify-between md:items-center shadow-lg relative z-10">
        <span class="font-bold text-2xl tracking-wide mb-2 md:mb-0">School Library <span class="text-black">- Admin
            </span></span>
        <div class="flex flex-col md:flex-row gap-2 md:gap-4">
            <div class="flex gap-2 md:gap-4">
                <a href="{{ route('admin.dashboard') }}" class="hover:underline font-semibold">Dashboard</a>
                <a href="{{ route('admin.books') }}" class="hover:underline font-semibold">Books</a>
                <a href="{{ route('admin.borrowings') }}" class="hover:underline font-semibold">Verify Borrowings</a>
            </div>
            <form method="POST" action="{{ route('logout') }}" class="inline md:ml-4">
                @csrf
                <button type="submit"
                    class="gradient-bg text-white px-4 py-2 rounded font-semibold shadow hover:opacity-90 transition duration-200">
                    Logout
                </button>
            </form>
        </div>
    </nav>
    <div class="max-w-7xl mx-auto mt-10 bg-white rounded-2xl shadow-2xl p-8 md:p-12 relative z-10">
        <h1 class="text-4xl font-extrabold mb-10 text-black tracking-wide text-center">Admin Dashboard</h1>
        <div class="grid dashboard-cards grid-cols-1 md:grid-cols-3 gap-8 mb-12">
            <div class="card-dark rounded-xl p-8 shadow flex flex-col items-center border-2 border-pink-500">
                <div class="text-5xl font-extrabold mb-2">{{ $booksCount }}</div>
                <div class="mt-2 text-lg font-semibold">Total Books</div>
            </div>
            <div class="card-dark rounded-xl p-8 shadow flex flex-col items-center border-2 border-pink-400">
                <div class="text-5xl font-extrabold mb-2">{{ $borrowedCount }}</div>
                <div class="mt-2 text-lg font-semibold">Books Borrowed</div>
            </div>
            <div class="card-dark rounded-xl p-8 shadow flex flex-col items-center border-2 border-pink-300">
                <div class="text-5xl font-extrabold mb-2">{{ $borrowings->count() }}</div>
                <div class="mt-2 text-lg font-semibold">Recent Activities</div>
            </div>
        </div>

        <div class="mb-12">
            <div class="section-title">
                <div class="section-title-bar"></div>
                <h2 class="text-2xl font-bold text-black">Recent Borrowing Activities</h2>
            </div>
            <div class="overflow-x-auto rounded-xl shadow bg-gray-50">
                <table class="w-full border bg-black bg-opacity-80 text-white rounded-xl">
                    <thead>
                        <tr class="bg-gradient-to-r from-pink-500 to-pink-300 text-white">
                            <th class="p-3 border">User</th>
                            <th class="p-3 border">Book</th>
                            <th class="p-3 border">Status</th>
                            <th class="p-3 border">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrowings as $borrowing)
                        <tr>
                            <td class="p-3 border">{{ $borrowing->user->name }}</td>
                            <td class="p-3 border">{{ $borrowing->book->title }}</td>
                            <td class="p-3 border">
                                @if($borrowing->status === 'pending')
                                <span class="text-yellow-400 font-semibold">Pending</span>
                                @else
                                <span class="text-green-400 font-semibold">Verified</span>
                                @endif
                            </td>
                            <td class="p-3 border">{{ $borrowing->created_at->format('d M Y H:i') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div>
            <div class="section-title">
                <div class="section-title-bar"></div>
                <h2 class="text-2xl font-bold text-black">Books Data</h2>
            </div>
            <div class="overflow-x-auto rounded-xl shadow bg-gray-50">
                <table class="w-full border bg-black bg-opacity-80 text-white rounded-xl">
                    <thead>
                        <tr class="bg-gradient-to-r from-pink-500 to-pink-300 text-white">
                            <th class="p-3 border">Cover</th>
                            <th class="p-3 border">Title</th>
                            <th class="p-3 border">Author</th>
                            <th class="p-3 border">ISBN</th>
                            <th class="p-3 border">Year</th>
                            <th class="p-3 border">Pages</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                        <tr>
                            <td class="p-3 border text-center">
                                @if($book->cover)
                                <img src="{{ asset('storage/'.$book->cover) }}" alt="cover"
                                    class="h-12 mx-auto rounded shadow border-2 border-pink-400">
                                @else
                                <span class="text-gray-400 italic">No Cover</span>
                                @endif
                            </td>
                            <td class="p-3 border">{{ $book->title }}</td>
                            <td class="p-3 border">{{ $book->author }}</td>
                            <td class="p-3 border">{{ $book->isbn }}</td>
                            <td class="p-3 border">{{ $book->year }}</td>
                            <td class="p-3 border">{{ $book->pages }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</body>

</html>