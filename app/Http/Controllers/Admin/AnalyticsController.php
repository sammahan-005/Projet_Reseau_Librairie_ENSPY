<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;


class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $activeUsers = DB::table('users')->where('created_at', '>=', now()->subMonth())->count();

        $totalReadingMinutes = DB::table('book_user')->sum('duration');

        $readingHours = round($totalReadingMinutes / 60, 1);

        $revenue = DB::table('payments')->where('status', 'completed')->sum('amount');

        $topBooks = DB::table('book_user')
            ->select('books.id', 'books.title', DB::raw('count(book_user.id) as read_count'))
            ->join('books', 'book_user.book_id', '=', 'books.id')
            ->groupBy('books.id', 'books.title')
            ->orderByDesc('read_count')
            ->take(10)
            ->get();

        return Inertia::render('admin/Analytics/Index', [
            'active_users' => $activeUsers,
            'reading_hours' => $readingHours,
            'revenue' => $revenue,
            'top_books' => $topBooks,
        ]);
    }
}
