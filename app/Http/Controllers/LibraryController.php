<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Support\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class LibraryController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();

        $history = DB::table('book_user')
            ->join('books', 'book_user.book_id', '=', 'books.id')
            ->where('book_user.user_id', $user->id)
            ->select(
                'books.id',
                'books.title',
                'books.author',
                'books.genre',
                'books.cover_image',
                'book_user.duration',
                'book_user.created_at',
                'book_user.updated_at'
            )
            ->orderByDesc('book_user.updated_at')
            ->get();

        $books = $history
            ->unique('id')
            ->values()
            ->map(fn ($item) => [
                'id' => $item->id,
                'title' => $item->title,
                'author' => $item->author,
                'genre' => $item->genre,
                'cover_image' => $item->cover_image,
                'duration' => (int) ($item->duration ?? 0),
                'progress' => min(((int) ($item->duration ?? 0)) / 120, 1),
                'is_new' => false,
                'is_favorite' => false,
                'is_downloaded' => false,
            ]);

        $favoriteGenre = $history
            ->groupBy('genre')
            ->sortByDesc(fn ($items) => $items->sum('duration'))
            ->keys()
            ->first();

        $recommendationsQuery = book::query()
            ->select('id', 'title', 'author', 'genre', 'cover_image')
            ->whereNotIn('id', $books->pluck('id'));

        if ($favoriteGenre) {
            $recommendationsQuery->where('genre', $favoriteGenre);
        }

        $recommendations = $recommendationsQuery
            ->latest()
            ->take(8)
            ->get();

        if ($favoriteGenre && $recommendations->count() < 4) {
            $extraRecommendations = book::query()
                ->select('id', 'title', 'author', 'genre', 'cover_image')
                ->whereNotIn('id', $books->pluck('id')->merge($recommendations->pluck('id')))
                ->latest()
                ->take(8 - $recommendations->count())
                ->get();

            $recommendations = $recommendations->merge($extraRecommendations);
        }

        $activity = $history
            ->take(8)
            ->map(fn ($item) => [
                'message' => "Lecture de {$item->title}",
                'when' => Carbon::parse($item->updated_at)->diffForHumans(),
            ]);

        $stats = [
            'saved' => $books->count(),
            'finished' => $books->where('progress', '>=', 1)->count(),
            'reading' => $books->where('progress', '>', 0)->where('progress', '<', 1)->count(),
            'favorites' => 0,
            'hours' => round($history->sum('duration') / 60, 1),
            'favorite_category' => $favoriteGenre,
        ];

        return Inertia::render('library/MyLibrary', [
            'user' => $user->only('id', 'name', 'email'),
            'books' => $books,
            'recommendations' => $recommendations,
            'activity' => $activity,
            'stats' => $stats,
        ]);
    }
}
