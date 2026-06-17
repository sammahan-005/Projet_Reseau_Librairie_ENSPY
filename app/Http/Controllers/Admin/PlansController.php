<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\subscription;
use App\Models\paiement;

class PlansController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = subscription::with(['paiement', 'users'])->latest()->paginate(10);
        $totalRevenue = paiement::where('status', 'completed')->sum('amount');

        return Inertia::render('admin/Plans/Index', [
            'subscriptions' => $subscriptions,
            'totalRevenue' => $totalRevenue,
        ]);
    }

    public function create(Request $request)
    {
        return Inertia::render('admin/Plans/Create');
    }
}
