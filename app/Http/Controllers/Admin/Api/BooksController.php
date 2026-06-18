<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use Inertia\Inertia;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
            'title' => ['required','string','max:255'],
            'author' => ['required','string','max:255'],
            'genre' => ['required','string'],
            'published_year' => ['required','date'],

            'cover_image' => ['nullable','image','max:4096'],
            'pdf' => ['nullable','file','mimes:pdf','max:20000'],

            'remove_cover_image' => ['nullable','boolean'],
            'remove_pdf' => ['nullable','boolean'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | Suppression image
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('remove_cover_image')) {

            if ($book->cover_image &&
                Storage::disk('public')->exists($book->cover_image)) {

                Storage::disk('public')->delete($book->cover_image);
            }

            $data['cover_image'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Nouvelle image
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('cover_image')) {

            if ($book->cover_image &&
                Storage::disk('public')->exists($book->cover_image)) {

                Storage::disk('public')->delete($book->cover_image);
            }

            $data['cover_image'] = $request
                ->file('cover_image')
                ->store('covers','public');
        }

        /*
        |--------------------------------------------------------------------------
        | Suppression PDF
        |--------------------------------------------------------------------------
        */

        if ($request->boolean('remove_pdf')) {

            if ($book->pdf_path &&
                Storage::disk('public')->exists($book->pdf_path)) {

                Storage::disk('public')->delete($book->pdf_path);
            }

            $data['pdf_path'] = null;
        }

        /*
        |--------------------------------------------------------------------------
        | Nouveau PDF
        |--------------------------------------------------------------------------
        */

        if ($request->hasFile('pdf')) {

            if ($book->pdf_path &&
                Storage::disk('public')->exists($book->pdf_path)) {

                Storage::disk('public')->delete($book->pdf_path);
            }

            $data['pdf_path'] = $request
                ->file('pdf')
                ->store('books','public');
        }

        $book->update($data);

        return redirect()
            ->route('admin.catalog.index')
            ->with('success','Livre modifié avec succès.');
    }

    public function destroy(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return back()->with('success', 'Livre supprimé');
    }
}
