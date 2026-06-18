<?php

namespace App\Http\Controllers;
use App\Http\Requests\BookRequest;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\Book;
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
        $subscriptionUser = DB::table('subcription__users')
            ->where('subcription__users.user_id', $request->user()->id)
            ->where('subcription__users.end', '>=', now())
            ->join('subscriptions', 'subscriptions.id', '=', 'subcription__users.subscription_id')
            ->select(
                'subcription__users.id as pivot_id',
                'subcription__users.remaining',
                'subscriptions.type',
                'subscriptions.duration'
            )
            ->latest('subcription__users.created_at')
            ->first();

        if (! $subscriptionUser) {
            return redirect()
                ->route('subscription.index')
                ->with('error', 'Veuillez souscrire à un abonnement pour lire ce livre.');
        }

        $remainingMinutes = (int) $subscriptionUser->remaining;

        return Inertia::render('books/Read', [
            'book' => $book->only('id', 'title', 'author', 'genre', 'cover_image'),
            'subscription' => [
                'type' => $subscriptionUser->type,
                'daily_minutes' => (int) $subscriptionUser->duration,
                'remaining_seconds' => $remainingMinutes * 60,
                'pivot_id' => $subscriptionUser->pivot_id,
            ],
            'pdfUrl' => '/consultation/' . $book->id,
            'libraryUrl' => '/library',
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
