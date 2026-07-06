<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Borrowing;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class BorrowingController extends Controller
{
    /** Late-return penalty applied per day overdue (in the app's currency unit). */
    private const PENALTY_PER_DAY = 100;

    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Borrowing::with(['user', 'book'])->latest();

        // A plain "user" only ever sees their own borrowings.
        if (! $user->isStaff()) {
            $query->where('user_id', $user->id);
        }

        if ($request->filled('status')) {
            $status = (string) $request->input('status');

            if ($status === 'late') {
                $query->whereNull('returned_at')->where('due_at', '<', now());
            } else {
                $query->where('status', $status);
            }
        }

        $borrowings = $query->paginate(15)->withQueryString();

        return view('borrowings.index', compact('borrowings'));
    }

    public function create()
    {
        $users = User::orderBy('first_name')->get();
        $books = Book::where('available_copies', '>', 0)->orderBy('title')->get();

        return view('borrowings.create', compact('users', 'books'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'user_id'     => 'required|exists:users,id',
            'book_id'     => 'required|exists:books,id',
            'borrowed_at' => 'required|date',
        ]);

        try {
            DB::transaction(function () use ($data) {
                $book = Book::where('id', $data['book_id'])->lockForUpdate()->firstOrFail();

                if ($book->available_copies < 1) {
                    throw new \RuntimeException('no_stock');
                }

                $data['due_at'] = Carbon::parse($data['borrowed_at'])->addDays(15);
                $data['status'] = 'borrowed';

                Borrowing::create($data);

                $book->decrement('available_copies');
            });
        } catch (\RuntimeException $e) {
            if ($e->getMessage() === 'no_stock') {
                return back()->withErrors(['book_id' => 'Aucun exemplaire disponible pour ce livre.'])->withInput();
            }
            throw $e;
        }

        return redirect()->route('borrowings.index')->with('success', 'Emprunt créé avec succès.');
    }

    public function show(Borrowing $borrowing)
    {
        $this->authorizeView($borrowing);

        return view('borrowings.show', compact('borrowing'));
    }

    public function edit(Borrowing $borrowing)
    {
        $users = User::orderBy('first_name')->get();
        $books = Book::orderBy('title')->get();

        return view('borrowings.edit', compact('borrowing', 'users', 'books'));
    }

    public function update(Request $request, Borrowing $borrowing)
    {
        $data = $request->validate([
            'borrowed_at' => 'required|date',
            'due_at'      => 'required|date|after_or_equal:borrowed_at',
        ]);

        $borrowing->update($data);

        return redirect()->route('borrowings.index')->with('success', 'Emprunt mis à jour.');
    }

    public function destroy(Borrowing $borrowing)
    {
        DB::transaction(function () use ($borrowing) {
            // If the book was never returned, give the copy back to the pool.
            if (! $borrowing->returned_at) {
                $borrowing->book()->increment('available_copies');
            }

            $borrowing->delete();
        });

        return redirect()->route('borrowings.index')->with('success', 'Emprunt supprimé.');
    }

    /**
     * Mark a borrowing as returned, restock the book, and apply a late
     * penalty automatically if it's overdue.
     */
    public function returnBook(Borrowing $borrowing)
    {
        if ($borrowing->returned_at) {
            return back()->with('success', 'Ce livre a déjà été rendu.');
        }

        DB::transaction(function () use ($borrowing) {
            $isLate = now()->greaterThan($borrowing->due_at);
            $daysLate = $isLate ? now()->diffInDays($borrowing->due_at) : 0;

            $borrowing->update([
                'returned_at'    => now(),
                'status'         => $isLate ? 'late' : 'returned',
                'penalty_amount' => $daysLate * self::PENALTY_PER_DAY,
            ]);

            $borrowing->book()->increment('available_copies');
        });

        return back()->with('success', 'Livre marqué comme rendu.');
    }

    /**
     * A plain user may only view their own borrowings; staff can view all.
     */
    private function authorizeView(Borrowing $borrowing): void
    {
        $user = Auth::user();

        if (! $user->isStaff() && $borrowing->user_id !== $user->id) {
            abort(403, "Vous n'avez pas la permission de voir cet emprunt.");
        }
    }
}
