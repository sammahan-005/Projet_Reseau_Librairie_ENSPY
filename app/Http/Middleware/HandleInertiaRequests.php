<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $activeSubscription = $request->user()
            ? DB::table('subcription__users')
                ->where('subcription__users.user_id', $request->user()->id)
                ->where('subcription__users.end', '>=', now())
                ->join('subscriptions', 'subscriptions.id', '=', 'subcription__users.subscription_id')
                ->select('subscriptions.*', 'subcription__users.remaining', 'subcription__users.id as pivot_id')
                ->latest('subcription__users.created_at')
                ->first()
            : null;

        return [
            ...parent::share($request),
            'name' => config('app.name'),
            'auth' => [
                'user' => $request->user(),
                'subscription' => $activeSubscription ? [
                    'id' => $activeSubscription->id,
                    'pivot_id' => $activeSubscription->pivot_id,
                    'type' => $activeSubscription->type,
                    'kind' => $activeSubscription->kind,
                    'duration' => $activeSubscription->duration,
                    'remaining_seconds' => $activeSubscription->remaining * 60,
                ] : null,
            ],
            'sidebarOpen' => ! $request->hasCookie('sidebar_state') || $request->cookie('sidebar_state') === 'true',
        ];
    }
}
