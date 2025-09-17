<?php

namespace App\Http\Controllers;

use App\Models\Borrowing;
use App\Models\User;
use App\Models\Book;
use Illuminate\Http\Request;

class BorrowingController extends Controller
{
    public function index()
    {
        $borrowings = Borrowing::with(['user', 'book'])->latest()->get();

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $users = User::all();
        $books = Book::all();

        return view('borrowings.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'book_id'     => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
        ]);

        $data['due_at'] = now()->addDays(15);
        $data['status'] = 'borrowed';

        Borrowing::create($data);

        return redirect()->route('borrowings.index')
            ->with('success', 'Emprunt créé avec succès.');
    }
}
