<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Inertia\Response;

class DashboardController extends Controller
{
    public function index(Request $request): Response
    {
        $user = $request->user();

        $history = DB::table('book_user')
            ->join('books', 'book_user.book_id', '=', 'books.id')
            ->where('book_user.user_id', $user->id)
            ->select('books.id', 'books.title', 'books.genre', 'book_user.duration', 'book_user.updated_at')
            ->orderByDesc('book_user.updated_at')
            ->get();

        $booksRead = $history->unique('id')->count();
        $minutes = (int) $history->sum(fn ($item) => (int) ($item->duration ?? 0));

        $byGenre = $history
            ->groupBy('genre')
            ->map(fn ($items, $genre) => [
                'label' => $genre,
                'minutes' => (int) $items->sum(fn ($item) => (int) ($item->duration ?? 0)),
            ])
            ->values();

        $maxGenreMinutes = max($byGenre->max('minutes') ?? 0, 1);
        $genres = $byGenre->map(fn ($item) => [
            ...$item,
            'percent' => round(($item['minutes'] / $maxGenreMinutes) * 100),
        ]);

        $weekly = collect(range(6, 0))
            ->map(function ($daysAgo) use ($history) {
                $date = now()->subDays($daysAgo);
                $dayMinutes = $history
                    ->filter(fn ($item) => $item->updated_at && \Illuminate\Support\Carbon::parse($item->updated_at)->isSameDay($date))
                    ->sum(fn ($item) => (int) ($item->duration ?? 0));

                return [
                    'label' => $date->translatedFormat('D'),
                    'minutes' => (int) $dayMinutes,
                ];
            });

        $maxDailyMinutes = max($weekly->max('minutes') ?? 0, 1);
        $weekly = $weekly->map(fn ($item) => [
            ...$item,
            'height' => max(round(($item['minutes'] / $maxDailyMinutes) * 100), $item['minutes'] > 0 ? 12 : 4),
        ]);

        $activeSubscription = DB::table('subscriptions')
            ->where('user_id', $user->id)
            ->where('created_at', '>=', now()->subMonth())
            ->latest()
            ->first();

        return Inertia::render('Dashboard', [
            'stats' => [
                'books_read' => $booksRead,
                'reading_hours' => round($minutes / 60, 1),
                'sessions' => $history->count(),
                'favorite_genre' => $genres->sortByDesc('minutes')->first()['label'] ?? 'Aucun',
                'subscription' => $activeSubscription?->type ?? 'Aucun',
            ],
            'genres' => $genres,
            'weekly' => $weekly,
            'recent' => $history->take(5)->values(),
        ]);
    }
}
