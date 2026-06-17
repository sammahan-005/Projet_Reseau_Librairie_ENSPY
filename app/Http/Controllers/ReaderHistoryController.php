<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;

class ReaderHistoryController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $history = DB::table('book_user')
            ->join('books', 'book_user.book_id', '=', 'books.id')
            ->where('book_user.user_id', $user->id)
            ->select('books.id', 'books.title', 'book_user.duration', 'book_user.created_at', 'book_user.updated_at')
            ->orderByDesc('book_user.updated_at')
            ->get();

        return Inertia::render('history/Index', [
            'history' => $history,
        ]);
    }
}
