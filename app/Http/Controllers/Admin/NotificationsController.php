<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Inertia\Inertia;

class NotificationsController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('admin/Notifications/Index');
    }

    public function create(Request $request)
    {
        return Inertia::render('admin/Notifications/Create');
    }
}
