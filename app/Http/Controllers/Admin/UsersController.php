<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Models\User;
use Illuminate\Support\Carbon;

class UsersController extends Controller
{
    public function index(Request $request)
    {
        $q = User::query();

        if ($request->filled('search')) {
            $q->where('name', 'like', '%'.$request->search.'%')->orWhere('email', 'like', '%'.$request->search.'%');
        }

        $users = $q->latest()->paginate(20);

        return Inertia::render('admin/Users/Index', ['users' => $users]);
    }

    public function edit(Request $request, $id)
    {
        $user = User::findOrFail($id);
        return Inertia::render('admin/Users/Edit', ['user' => $user]);
    }

    public function suspend(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->suspended_at = Carbon::now();
        $user->save();

        return back()->with('success', 'Utilisateur suspendu');
    }

    public function unsuspend(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->suspended_at = null;
        $user->save();

        return back()->with('success', 'Utilisateur rétabli');
    }

    public function destroy(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'Utilisateur supprimé');
    }
}
