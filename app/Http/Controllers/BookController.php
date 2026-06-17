<?php

namespace App\Http\Controllers;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\book;
use Illuminate\Support\Facades\DB;
use Inertia\Response;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): Response
    {
        $books = Book::select('id', 'title', 'author', 'genre', 'cover_image')
                     ->latest()
                     ->take(8)
                     ->get();

        return Inertia::render('Home', [
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
    public function store(BookRequest $request)
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

    public function read(book $book, Request $request): Response|\Illuminate\Http\RedirectResponse
    {
        $subscription = DB::table('subscriptions')
            ->where('user_id', $request->user()->id)
            ->where('created_at', '>=', now()->subMonth())
            ->latest()
            ->first();

        if (! $subscription) {
            return redirect()
                ->route('subscription.index')
                ->with('error', 'Veuillez souscrire à un abonnement mensuel pour lire ce livre.');
        }

        $dailyMinutes = (int) ($subscription->duration ?? 0);

        if ($dailyMinutes <= 0) {
            $dailyMinutes = match (strtolower($subscription->type ?? 'standard')) {
            'premium' => 120,
            'medium' => 60,
            default => 30,
            };
        }

        return Inertia::render('books/Read', [
            'book' => $book->only('id', 'title', 'author', 'genre', 'cover_image'),
            'subscription' => [
                'type' => $subscription->type,
                'daily_minutes' => $dailyMinutes,
                'daily_seconds' => $dailyMinutes * 60,
            ],
            'pdfUrl' => route('consultation.consultation', $book->id),
            'libraryUrl' => route('library'),
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
    public function update(BookRequest $request, string $id)
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
