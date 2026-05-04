<?php

namespace App\Http\Controllers;
use App\Http\Requests\bookRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\book;

class bookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $books = book::all();

        // Render the Home page so the root route can display the books list
        return Inertia::render('home', [
            'books' => $books,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
       return Inertia::render('books/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(bookRequest $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('pdf_file')) {
            
            $path = $request->file('pdf_file')->store('books', 'public');
            
            
            $validated['pdf_path'] = $path;
        }

        $book = book::create($validated);

        return redirect()->route('books.index')->with('success', 'Livre ajouté !');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::findOrFail($id);
        return Inertia::render('books/show', [
            'book' => $book,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $book = Book::findOrFail($id);

        return Inertia::render('books/edit', [
            'book'=> $book,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(bookRequest $request, string $id)
    {
        $book = Book::findOrFail($id);

        $validated = $request->validated();

        $book->update($validated);

        return redirect()->route('books.show', $book->id);
        
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();
        return redirect()->route('books.index');
    }
}
