<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\Subscription;
use App\Models\Payment;

class PlansController extends Controller
{
    public function index(Request $request)
    {
        $subscriptions = Subscription::with(['payment', 'users'])->latest()->paginate(10);
        $totalRevenue = Payment::where('status', 'completed')->sum('amount');

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
