<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use App\Models\Borrowing;

class StudentDashboardController extends Controller
{
    public function index()
    {
        $books = Book::all();
        $borrowings = Borrowing::with('book')
            ->where('user_id', auth()->id())
            ->orderByDesc('created_at')
            ->get();
        return view('student.dashboard', compact('books', 'borrowings'));
    }

    public function borrow(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'borrow_date' => 'required|date|after_or_equal:today',
            'return_date' => 'required|date|after:borrow_date',
            'pickup_method' => 'required|in:ambil,antar',
        ]);

        Borrowing::create([
            'user_id' => auth()->id(),
            'book_id' => $request->book_id,
            'borrow_date' => $request->borrow_date,
            'return_date' => $request->return_date,
            'pickup_method' => $request->pickup_method,
            'status' => 'pending',
        ]);

        return redirect()->route('student.dashboard')->with('success', 'Borrow request submitted!');
    }

    public function returnBook(Request $request)
    {
        $request->validate([
            'borrowing_id' => 'required|exists:borrowings,id',
            'return_method' => 'required|in:langsung,antar',
        ]);

        $borrowing = Borrowing::where('id', $request->borrowing_id)
            ->where('user_id', auth()->id())
            ->where('status', 'verified')
            ->firstOrFail();

        $borrowing->status = 'returned';
        $borrowing->return_method = $request->return_method;
        $borrowing->save();

        return redirect()->route('student.dashboard')->with('success', 'Pengembalian buku berhasil dikonfirmasi.');
    }
}
