<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Dashboard</title>
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

        .modal-bg {
            background: rgba(0, 0, 0, 0.5);
        }

        .tab-btn {
            @apply px-6 py-2 rounded-t-lg font-semibold transition duration-200;
        }

        .tab-btn-active {
            @apply gradient-bg text-white shadow;
        }

        .tab-btn-inactive {
            @apply bg-gray-200 text-gray-700 hover:bg-pink-100;
        }

        @media (max-width: 640px) {
            .gradient-shape {
                width: 300px;
                height: 300px;
                top: -60px;
                right: -90px;
            }

            .responsive-table {
                display: block;
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .tab-buttons {
                flex-direction: column;
                width: 100%;
            }

            .tab-btn {
                width: 100%;
                margin-bottom: 0.5rem;
            }

            .book-card {
                transform: none !important;
            }

            .modal-content {
                margin: 1rem;
                max-height: calc(100vh - 2rem);
            }
        }

        .error-message {
            @apply bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-4;
        }

        .success-message {
            @apply bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4;
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
    <nav class="gradient-bg p-4 text-white flex flex-col sm:flex-row justify-between items-center shadow-lg relative z-10 space-y-2 sm:space-y-0">
        <span class="font-bold text-xl sm:text-2xl tracking-wide text-center sm:text-left">School Library <span
                class="text-black">- Student</span></span>
        <form method="POST" action="{{ route('logout') }}" class="w-full sm:w-auto">
            @csrf
            <button type="submit"
                class="bg-black text-white px-4 py-2 rounded hover:bg-gray-800 font-semibold shadow w-full sm:w-auto">
                Logout
            </button>
        </form>
    </nav>

    <div class="max-w-5xl mx-auto mt-4 sm:mt-10 px-4 sm:px-6 lg:px-8">
        <!-- Error/Success Messages -->
        @if ($errors->any())
        <div class="error-message rounded-lg">
            <ul class="list-disc list-inside">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        @if (session('success'))
        <div class="success-message rounded-lg">
            {{ session('success') }}
        </div>
        @endif

        <div class="bg-white rounded-2xl shadow-2xl p-4 sm:p-10 relative z-10">
            <h1
                class="text-2xl sm:text-3xl font-extrabold mb-4 sm:mb-8 text-black tracking-wide break-words">Welcome, {{ auth()->user()->name ?? 'Student' }}!</h1>

            <div class="flex justify-center mb-10">
                <div class="inline-flex rounded-xl bg-gray-200 p-1 shadow-inner tab-buttons">
                    <button id="tab-catalog-btn"
                        class="px-6 py-2 rounded-lg font-semibold transition duration-200 focus:outline-none focus:ring-2 focus:ring-pink-400
                    gradient-bg text-white shadow tab-btn"
                        onclick="showTab('catalog')">
                        Katalog Buku
                    </button>
                    <button id="tab-activity-btn"
                        class="px-6 py-2 rounded-lg font-semibold transition duration-200 focus:outline-none focus:ring-2 focus:ring-pink-400
                    bg-gray-200 text-gray-700 hover:bg-pink-100 tab-btn"
                        onclick="showTab('activity')">
                        Aktivitas Peminjaman
                    </button>
                </div>
            </div>
            <!-- Katalog Buku -->
            <div id="tab-catalog">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 sm:gap-8 mb-10">
                    @forelse($books as $book)
                    <div class="book-card bg-black bg-opacity-80 rounded-2xl shadow-xl flex flex-col items-center p-4 sm:p-6 border-2 border-pink-400 relative hover:scale-105 transition-transform duration-200">
                        <div
                            class="w-24 sm:w-32 h-36 sm:h-48 mb-4 flex items-center justify-center bg-gray-200 rounded-lg overflow-hidden shadow">
                            @if($book->cover)
                            <img src="{{ asset('storage/'.$book->cover) }}" alt="cover" class="object-cover w-full h-full">
                            @else
                            <span class="text-gray-400 italic">No Cover</span>
                            @endif
                        </div>
                        <div class="w-full text-center">
                            <h3 class="text-lg font-bold text-white mb-1 truncate">{{ $book->title }}</h3>
                            <div class="text-pink-200 text-sm mb-1">{{ $book->author }}</div>
                            <div class="text-gray-300 text-xs mb-2">ISBN: {{ $book->isbn }}</div>
                            <div class="flex justify-center gap-3 text-xs text-gray-400 mb-4">
                                <span>{{ $book->year }}</span>
                                <span>•</span>
                                <span>{{ $book->pages }} pages</span>
                            </div>
                            <button
                                onclick="openBorrowModal({{ $book->id }}, '{{ addslashes($book->title) }}')"
                                class="gradient-bg text-white font-semibold px-4 py-2 rounded shadow hover:opacity-90 transition duration-200 w-full">
                                Pinjam
                            </button>
                        </div>
                    </div>
                    @empty
                    <div class="col-span-full text-center text-gray-500">
                        No books available at the moment.
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Aktivitas Peminjaman -->
            <div id="tab-activity" style="display:none;">
                <h2 class="text-xl font-bold mb-4 text-black">Aktivitas Peminjaman Saya</h2>
                <div class="overflow-x-auto rounded-xl shadow">
                    <table class="w-full border bg-black bg-opacity-80 text-white rounded-xl responsive-table min-w-[800px]">
                        <thead>
                            <tr class="bg-gradient-to-r from-pink-500 to-pink-300 text-white">
                                <th class="p-3 border">Buku</th>
                                <th class="p-3 border">Tanggal Pinjam</th>
                                <th class="p-3 border">Tanggal Kembali</th>
                                <th class="p-3 border">Metode</th>
                                <th class="p-3 border">Status</th>
                                <th class="p-3 border">Biaya Antaran</th>
                                <th class="p-3 border">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($borrowings as $borrowing)
                            <tr>
                                <td class="p-3 border">{{ $borrowing->book->title ?? '-' }}</td>
                                <td class="p-3 border">{{ $borrowing->borrow_date ?? '-' }}</td>
                                <td class="p-3 border">{{ $borrowing->return_date ?? '-' }}</td>
                                <td class="p-3 border">
                                    @if($borrowing->pickup_method === 'antar')
                                    <span class="text-blue-400">Diantar</span>
                                    @elseif($borrowing->pickup_method === 'ambil')
                                    <span class="text-green-400">Ambil Langsung</span>
                                    @else
                                    <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="p-3 border">
                                    @if($borrowing->status === 'pending')
                                    <span class="text-yellow-400">Menunggu Verifikasi</span>
                                    @elseif($borrowing->status === 'verified')
                                    @if($borrowing->pickup_method === 'antar')
                                    <span class="text-blue-400">Diproses (Akan Diantar)</span>
                                    @else
                                    <span class="text-green-400">Diproses (Ambil Langsung)</span>
                                    @endif
                                    @elseif($borrowing->status === 'returned')
                                    <span class="text-gray-400">Sudah Dikembalikan</span>
                                    @else
                                    <span class="text-gray-400">{{ ucfirst($borrowing->status) }}</span>
                                    @endif
                                </td>
                                <td class="p-3 border">
                                    @if($borrowing->pickup_method === 'antar')
                                    @php $biayaAntar = 10000; @endphp
                                    <span class="text-red-400">Rp{{ number_format($biayaAntar, 0, ',', '.') }}</span>
                                    @else
                                    <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                                <td class="p-3 border text-center">
                                    @if($borrowing->status === 'verified')
                                    <button
                                        onclick="openReturnModal({{ $borrowing->id }}, '{{ addslashes($borrowing->book->title ?? '-') }}')"
                                        class="gradient-bg text-white font-semibold px-4 py-2 rounded shadow hover:opacity-90 transition duration-200">Kembalikan
                                    </button>
                                    @elseif($borrowing->status === 'returned')
                                    <span class="text-green-400">Selesai</span>
                                    @else
                                    <span class="text-gray-400">-</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="p-4 text-center text-gray-400">Belum ada aktivitas peminjaman.</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal Pinjam Buku -->
    <div id="borrowModal" class="fixed inset-0 flex items-center justify-center z-50 hidden p-4">
        <div class="modal-bg absolute inset-0"></div>
        <div class="card-dark rounded-2xl shadow-2xl p-4 sm:p-8 z-10 w-full max-w-md relative border-2 border-pink-400 max-h-[90vh] overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">Pinjam Buku: <span id="modalBookTitle"></span></h2>
            <form method="POST" action="{{ route('student.borrow') }}">
                @csrf
                <input type="hidden" name="book_id" id="modalBookId">
                <div class="mb-4">
                    <label for="borrow_date" class="block text-pink-200 font-semibold mb-2">Tanggal Pinjam</label>
                    <input type="date" name="borrow_date" id="borrow_date" required
                        class="w-full px-3 py-2 border border-pink-400 rounded text-gray-900">
                </div>
                <div class="mb-4">
                    <label for="return_date" class="block text-pink-200 font-semibold mb-2">Tanggal Kembali</label>
                    <input type="date" name="return_date" id="return_date" required
                        class="w-full px-3 py-2 border border-pink-400 rounded text-gray-900">
                </div>
                <div class="mb-4">
                    <label class="block text-pink-200 font-semibold mb-2">Metode Pengambilan</label>
                    <select name="pickup_method" id="pickup_method" required
                        class="w-full px-3 py-2 border border-pink-400 rounded text-gray-900"
                        onchange="showDeliveryFee()">
                        <option value="">Pilih Metode</option>
                        <option value="ambil">Ambil Langsung</option>
                        <option value="antar">Diantar</option>
                    </select>
                </div>
                <div class="mb-4" id="deliveryFeeInfo" style="display:none;">
                    <span class="text-sm text-pink-400 font-semibold">Biaya layanan antar: Rp10.000</span>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeBorrowModal()"
                        class="bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded shadow hover:bg-gray-400 transition duration-200">Batal
                    </button>
                    <button type="submit"
                        class="gradient-bg text-white font-semibold px-4 py-2 rounded shadow hover:opacity-90 transition duration-200">
                        Ajukan Pinjam
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Pengembalian Buku -->
    <div id="returnModal" class="fixed inset-0 flex items-center justify-center z-50 hidden p-4">
        <div class="modal-bg absolute inset-0"></div>
        <div class="card-dark rounded-2xl shadow-2xl p-4 sm:p-8 z-10 w-full max-w-md relative border-2 border-pink-400 max-h-[90vh] overflow-y-auto">
            <h2 class="text-xl font-bold mb-4">Kembalikan Buku: <span id="modalReturnBookTitle"></span></h2>
            <form method="POST" action="{{ route('student.return') }}">
                @csrf
                <input type="hidden" name="borrowing_id" id="modalBorrowingId">
                <div class="mb-4">
                    <label class="block text-pink-200 font-semibold mb-2">Metode Pengembalian</label>
                    <select name="return_method" id="return_method" required
                        class="w-full px-3 py-2 border border-pink-400 rounded text-gray-900"
                        onchange="showReturnDeliveryFee()">
                        <option value="">Pilih Metode</option>
                        <option value="langsung">Langsung ke Perpustakaan</option>
                        <option value="antar">Layanan Antar</option>
                    </select>
                </div>
                <div class="mb-4" id="returnDeliveryFeeInfo" style="display:none;">
                    <span class="text-sm text-pink-400 font-semibold">Biaya layanan antar: Rp10.000</span>
                </div>
                <div class="flex justify-end gap-2">
                    <button type="button" onclick="closeReturnModal()"
                        class="bg-gray-300 text-gray-800 font-semibold px-4 py-2 rounded shadow hover:bg-gray-400 transition duration-200">Batal
                    </button>
                    <button type="submit"
                        class="gradient-bg text-white font-semibold px-4 py-2 rounded shadow hover:opacity-90 transition duration-200">
                        Konfirmasi Pengembalian
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openBorrowModal(bookId, bookTitle) {
            document.getElementById('borrowModal').classList.remove('hidden');
            document.getElementById('modalBookId').value = bookId;
            document.getElementById('modalBookTitle').innerText = bookTitle;
            document.getElementById('pickup_method').value = '';
            document.getElementById('deliveryFeeInfo').style.display = 'none';
        }

        function closeBorrowModal() {
            document.getElementById('borrowModal').classList.add('hidden');
        }

        function showDeliveryFee() {
            var method = document.getElementById('pickup_method').value;
            document.getElementById('deliveryFeeInfo').style.display = (method === 'antar') ? 'block' : 'none';
        }

        function openReturnModal(borrowingId, bookTitle) {
            document.getElementById('returnModal').classList.remove('hidden');
            document.getElementById('modalBorrowingId').value = borrowingId;
            document.getElementById('modalReturnBookTitle').innerText = bookTitle;
            document.getElementById('return_method').value = '';
            document.getElementById('returnDeliveryFeeInfo').style.display = 'none';
        }

        function closeReturnModal() {
            document.getElementById('returnModal').classList.add('hidden');
        }

        function showReturnDeliveryFee() {
            var method = document.getElementById('return_method').value;
            document.getElementById('returnDeliveryFeeInfo').style.display = (method === 'antar') ? 'block' : 'none';
        }

        function showTab(tab) {
            document.getElementById('tab-catalog').style.display = tab === 'catalog' ? 'block' : 'none';
            document.getElementById('tab-activity').style.display = tab === 'activity' ? 'block' : 'none';

            // Button style
            var catalogBtn = document.getElementById('tab-catalog-btn');
            var activityBtn = document.getElementById('tab-activity-btn');
            if (tab === 'catalog') {
                catalogBtn.classList.add('gradient-bg', 'text-white', 'shadow');
                catalogBtn.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-pink-100');
                activityBtn.classList.remove('gradient-bg', 'text-white', 'shadow');
                activityBtn.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-pink-100');
            } else {
                activityBtn.classList.add('gradient-bg', 'text-white', 'shadow');
                activityBtn.classList.remove('bg-gray-200', 'text-gray-700', 'hover:bg-pink-100');
                catalogBtn.classList.remove('gradient-bg', 'text-white', 'shadow');
                catalogBtn.classList.add('bg-gray-200', 'text-gray-700', 'hover:bg-pink-100');
            }
        }

        // Add touch event handlers for mobile
        document.addEventListener('DOMContentLoaded', function() {
            const modals = [{
                    id: 'borrowModal',
                    close: closeBorrowModal
                },
                {
                    id: 'returnModal',
                    close: closeReturnModal
                }
            ];

            modals.forEach(modal => {
                const element = document.getElementById(modal.id);
                element.addEventListener('click', function(e) {
                    if (e.target === element) {
                        modal.close();
                    }
                });
            });
        });

        // Add validation for dates
        document.getElementById('borrow_date')?.addEventListener('change', function() {
            const today = new Date();
            const selectedDate = new Date(this.value);
            if (selectedDate < today) {
                this.value = today.toISOString().split('T')[0];
            }
        });

        document.getElementById('return_date')?.addEventListener('change', function() {
            const borrowDate = new Date(document.getElementById('borrow_date').value);
            const selectedDate = new Date(this.value);
            if (selectedDate <= borrowDate) {
                alert('Return date must be after borrow date');
                this.value = '';
            }
        });
    </script>
</body>

</html>