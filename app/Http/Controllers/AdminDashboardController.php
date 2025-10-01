<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use App\Models\Borrowing;
use Illuminate\Http\Request;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $borrowedCount = \App\Models\Borrowing::where('status', 'verified')->count();
        $booksCount = $books->count();
        $borrowings = Borrowing::with('user', 'book')->orderByDesc('created_at')->take(10)->get();
        return view('admin.dashboard', compact('books', 'booksCount', 'borrowedCount', 'borrowings'));
    }

    public function books()
    {
        $books = Book::all();
        return view('admin.books', compact('books'));
    }

    public function borrowings()
    {
        $pendingBorrowings = Borrowing::with('user', 'book')->where('status', 'pending')->get();
        return view('admin.borrowings', compact('pendingBorrowings'));
    }

    // Tambahkan method untuk menambah buku
    public function storeBook(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'isbn' => 'required|string|max:50',
            'year' => 'required|integer',
            'pages' => 'required|integer',
            'cover' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = $request->only('title', 'author', 'isbn', 'year', 'pages');

        if ($request->hasFile('cover')) {
            $data['cover'] = $request->file('cover')->store('covers', 'public');
        }

        \App\Models\Book::create($data);

        return redirect()->route('admin.dashboard')->with('success', 'Book added!');
    }

    // Verifikasi peminjaman
    public function verifyBorrowing($id)
    {
        $borrowing = Borrowing::findOrFail($id);
        $borrowing->status = 'verified';
        $borrowing->save();
        return redirect()->route('admin.dashboard')->with('success', 'Borrowing verified!');
    }
}
