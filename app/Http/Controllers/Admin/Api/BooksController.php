<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Support\Str;

class BooksController extends Controller
{
    public function index(Request $request)
    {
        $q = Book::query();

        if ($request->filled('search')) {
            $q->where('title', 'like', '%'.$request->search.'%');
        }

        $books = $q->latest()->paginate(20);

        return inertia::render('admin/Catalog/Index', ['books' => $books]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'string',
            'published_year' => 'required|date',
            'cover_image' => 'nullable|image|max:4096',
            'pdf' => 'nullable|file|mimes:pdf|max:20000',
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $data['cover_image'] = $path;
        }

        if ($request->hasFile('pdf')) {
            $path = $request->file('pdf')->store('books', 'public');
            $data['pdf_path'] = $path;
        }

        $book = Book::create($data);

        return redirect()->route('admin.catalog.index')->with('success', 'Livre créé');
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'genre' => 'string',
            'published_year' => 'required|date',
            'cover_image' => 'nullable|image|max:4096',
            'pdf' => 'nullable|file|mimes:pdf|max:20000',
        ]);

        if ($request->hasFile('cover_image')) {
            $path = $request->file('cover_image')->store('covers', 'public');
            $data['cover_image'] = $path;
        }

        if ($request->hasFile('pdf')) {
            $path = $request->file('pdf')->store('books', 'public');
            $data['pdf_path'] = $path;
        }

        $book->update($data);

        return redirect()->route('admin.catalog.index')->with('success', 'Livre mis à jour');
    }

    public function destroy(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return back()->with('success', 'Livre supprimé');
    }
}
