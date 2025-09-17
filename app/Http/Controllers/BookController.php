<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Category;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::with('category')->get();
        return view('books.index', compact('books'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('books.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'isbn'         => 'required|string|unique:books',
            'published_at' => 'nullable|date',
            'summary'      => 'nullable|string',
            'total_copies' => 'required|integer|min:1',
            'category_id'  => 'required|exists:categories,id',
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
        $categories = Category::all();
        return view('books.edit', compact('book', 'categories'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title'        => 'required|string|max:255',
            'author'       => 'required|string|max:255',
            'isbn'         => 'required|string|unique:books,isbn,' . $book->id,
            'published_at' => 'nullable|date',
            'summary'      => 'nullable|string',
            'total_copies' => 'required|integer|min:1',
            'category_id'  => 'required|exists:categories,id',
        ]);

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
