<?php

namespace App\Http\Controllers\Admin\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoriesController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::latest()->paginate(20);
        return inertia::render('admin/Catalog/Index', ['categories' => $categories]);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['name']);

        $category = Category::create($data);

        return back()->with('success', 'Catégorie créée');
    }

    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        return back()->with('success', 'Catégorie mise à jour');
    }

    public function destroy(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();

        return back()->with('success', 'Catégorie supprimée');
    }
}
