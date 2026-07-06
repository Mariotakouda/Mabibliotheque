<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index(Request $request)
    {
        $search = trim((string) $request->query('q'));
        $categoryId = $request->integer('category_id') ?: null;

        $books = Book::query()
            ->with('category')
            ->when($search, function ($query, $search) {
                $query->where(function ($q) use ($search) {
                    $q->where('title', 'like', "%{$search}%")
                        ->orWhere('author', 'like', "%{$search}%")
                        ->orWhere('isbn', 'like', "%{$search}%");
                });
            })
            ->when($categoryId, fn ($query, $categoryId) => $query->where('category_id', $categoryId))
            ->orderBy('title')
            ->paginate(12)
            ->withQueryString();

        $categories = Category::orderBy('name')->get();

        return view('books.index', compact('books', 'categories', 'search', 'categoryId'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'isbn'         => 'required|string|max:32|unique:books',
            'published_at' => 'nullable|date|before_or_equal:today',
            'summary'      => 'nullable|string|max:5000',
            'total_copies' => 'required|integer|min:1|max:10000',
            'category_id'  => 'required|exists:categories,id',
            'cover_path'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $data['available_copies'] = $data['total_copies'];

        if ($request->hasFile('cover_path')) {
            $data['cover_path'] = $request->file('cover_path')->store('covers', 'public');
        }

        Book::create($data);

        return redirect()->route('books.index')->with('success', 'Livre ajouté.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        $categories = Category::orderBy('name')->get();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'isbn'         => 'required|string|max:32|unique:books,isbn,' . $book->id,
            'published_at' => 'nullable|date|before_or_equal:today',
            'summary'      => 'nullable|string|max:5000',
            'total_copies' => 'required|integer|min:1|max:10000',
            'category_id'  => 'required|exists:categories,id',
            'cover_path'   => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // Keep available_copies consistent if total_copies shrinks/grows.
        $borrowedCount = $book->total_copies - $book->available_copies;
        $data['available_copies'] = max(0, $data['total_copies'] - $borrowedCount);

        if ($request->hasFile('cover_path')) {
            $data['cover_path'] = $request->file('cover_path')->store('covers', 'public');
        }

        $book->update($data);

        return redirect()->route('books.index')->with('success', 'Livre mis à jour.');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('books.index')->with('success', 'Livre supprimé.');
    }
}
