<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Book;
use App\Models\Category;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $books = Book::with('categories')->latest()->paginate(10);
        $categories = Category::all();

        return Inertia::render('admin/Catalog/Index', [
            'books' => $books,
            'categories' => $categories,
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('admin/Catalog/Create');
    }

    public function edit(Request $request, $id)
    {
        $book = Book::findOrFail($id);
        return Inertia::render('admin/Catalog/Edit', ['book' => $book]);
    }
}
