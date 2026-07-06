<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\Category;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->isStaff()) {
            $stats = [
                'users'              => User::count(),
                'categories'         => Category::count(),
                'books'              => Book::count(),
                'active_borrowings'  => Borrowing::whereNull('returned_at')->count(),
                'overdue_borrowings' => Borrowing::whereNull('returned_at')->where('due_at', '<', now())->count(),
                'total_copies'       => Book::sum('total_copies'),
                'available_copies'   => Book::sum('available_copies'),
            ];

            $topBooks = Borrowing::selectRaw('book_id, count(*) as total')
                ->groupBy('book_id')
                ->orderByDesc('total')
                ->with('book')
                ->take(5)
                ->get();

            $recentBorrowings = Borrowing::with(['user', 'book'])->latest()->take(8)->get();

            return view('dashboard', compact('stats', 'topBooks', 'recentBorrowings'));
        }

        // Regular user: a lighter, personal dashboard.
        $myBorrowings = Borrowing::with('book')
            ->where('user_id', $user->id)
            ->latest()
            ->get();

        $stats = [
            'my_active'  => $myBorrowings->whereNull('returned_at')->count(),
            'my_overdue' => $myBorrowings->whereNull('returned_at')->where('due_at', '<', now())->count(),
            'my_total'   => $myBorrowings->count(),
        ];

        return view('dashboard', compact('stats', 'myBorrowings'));
    }
}
