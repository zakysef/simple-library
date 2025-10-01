<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Admin - Books</title>
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
        <h1 class="text-3xl font-extrabold mb-8 text-black tracking-wide">Books Management</h1>
        <div class="mb-8">
            <button onclick="openAddBookModal()" class="gradient-bg text-white font-semibold px-4 py-2 rounded shadow hover:opacity-90 transition duration-200 mb-4">
                Add Book
            </button>
            <!-- Modal Add Book -->
            <div id="addBookModal" class="fixed inset-0 flex items-center justify-center z-50 hidden">
                <div class="absolute inset-0 bg-black opacity-40" onclick="closeAddBookModal()"></div>
                <div class="card-dark rounded-2xl shadow-2xl p-8 z-10 w-full max-w-lg relative border-2 border-pink-400">
                    <h2 class="text-xl font-bold mb-4">Add Book</h2>
                    <form method="POST" action="{{ route('admin.books.store') }}" enctype="multipart/form-data" class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @csrf
                        <div>
                            <label class="block text-pink-200 font-semibold mb-2" for="title">Title</label>
                            <input type="text" name="title" id="title" required class="w-full px-4 py-2 border border-pink-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-900">
                        </div>
                        <div>
                            <label class="block text-pink-200 font-semibold mb-2" for="author">Author</label>
                            <input type="text" name="author" id="author" required class="w-full px-4 py-2 border border-pink-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-900">
                        </div>
                        <div>
                            <label class="block text-pink-200 font-semibold mb-2" for="isbn">ISBN</label>
                            <input type="text" name="isbn" id="isbn" required class="w-full px-4 py-2 border border-pink-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-900">
                        </div>
                        <div>
                            <label class="block text-pink-200 font-semibold mb-2" for="year">Year</label>
                            <input type="number" name="year" id="year" required class="w-full px-4 py-2 border border-pink-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-900">
                        </div>
                        <div>
                            <label class="block text-pink-200 font-semibold mb-2" for="pages">Pages</label>
                            <input type="number" name="pages" id="pages" required class="w-full px-4 py-2 border border-pink-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-900">
                        </div>
                        <div>
                            <label class="block text-pink-200 font-semibold mb-2" for="cover">Book Cover</label>
                            <input type="file" name="cover" id="cover" accept="image/*" class="w-full px-4 py-2 border border-pink-400 rounded-lg focus:outline-none focus:ring-2 focus:ring-pink-500 text-gray-900">
                        </div>
                        <div class="md:col-span-2 flex justify-end gap-2 mt-2">
                            <button type="button" onclick="closeAddBookModal()" class="bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded shadow hover:bg-gray-400 transition duration-200">Cancel</button>
                            <button type="submit" class="gradient-bg text-white font-semibold px-4 py-2 rounded shadow hover:opacity-90 transition duration-200">
                                Add Book
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div>
            <h2 class="text-xl font-semibold mb-4 text-black">Books List</h2>
            <div class="overflow-x-auto rounded-xl shadow">
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
                                <img src="{{ asset('storage/'.$book->cover) }}" alt="cover" class="h-16 mx-auto rounded shadow border-2 border-pink-400">
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
    <script>
        function openAddBookModal() {
            document.getElementById('addBookModal').classList.remove('hidden');
        }

        function closeAddBookModal() {
            document.getElementById('addBookModal').classList.add('hidden');
        }
    </script>
</body>

</html>