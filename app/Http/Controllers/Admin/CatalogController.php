<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\book;
use App\Models\Category;

class CatalogController extends Controller
{
    public function index(Request $request)
    {
        $books = book::with('categories')->latest()->paginate(10);
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
        return Inertia::render('admin/Catalog/Edit', ['id' => $id]);
    }
}
