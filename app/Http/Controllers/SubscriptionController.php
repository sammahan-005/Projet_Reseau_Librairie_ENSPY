<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
use App\Models\subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;


class SubscriptionController extends Controller
{

    public function index(){

        $subscriptions = Subscription::orderBy("created_at","desc")->paginate(10);
        return Inertia::render('subscription/index', [
            'subscriptions' => $subscriptions,
        ]);
    }
    public function create(){
        return Inertia::render('subcription/create');
    }


    public function store(SubscriptionRequest $request){
       
        $validated = $request->validated();
        $subscription = subscription::create($validated);
        $subscription->users()->attach(Auth::id());

        return redirect()->route('subscription/index'); 
    }

    public function simulate(Request $request)
    {
        $validated = $request->validate([
            'book_id' => ['required', 'exists:books,id'],
            'kind' => ['required', 'in:hourly,plan'],
            'hours' => ['required_if:kind,hourly', 'nullable', 'integer', 'min:1', 'max:12'],
            'plan' => ['required_if:kind,plan', 'nullable', 'in:standard,medium,premium'],
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:30'],
            'payment_mode' => ['required', 'string', 'max:40'],
            'payment_password' => ['required', 'string', 'max:80'],
            'screenshot' => ['nullable', 'image', 'max:4096'],
        ]);

        $plans = [
            'standard' => ['duration' => 30, 'price' => 2500, 'type' => 'standard'],
            'medium' => ['duration' => 60, 'price' => 5000, 'type' => 'medium'],
            'premium' => ['duration' => 120, 'price' => 9000, 'type' => 'Premium'],
        ];

        // Handle optional screenshot upload
        if ($request->hasFile('screenshot')) {
            $path = $request->file('screenshot')->store('screenshots', 'public');
            $validated['screenshot_path'] = $path;
        }

        if ($validated['kind'] === 'hourly') {
            $hours = (int) $validated['hours'];
            $payload = [
                'duration' => $hours * 60,
                'price' => $hours * 700,
                'type' => 'standard',
            ];
        } else {
            $payload = [
                ...$plans[$validated['plan']],
            ];
        }

        // Create subscription
        $subscription = subscription::create(array_merge($payload, [
            'user_id' => Auth::id(),
        ]));

        // Create simulated payment
        $subscription->paiement()->create([
            'amount' => $payload['price'],
            'payment_method' => $validated['payment_mode'],
            'status' => 'completed',
            'payment_date' => now(),
        ]);

        // Attach user to pivot table 'subcription__users'
        $subscription->users()->attach(Auth::id(), [
            'remaining' => $subscription->duration,
            'start' => now(),
            'end' => now()->addDays(30),
        ]);

        return redirect()
            ->route('books.read', $validated['book_id'])
            ->with('success', 'Souscription validée avec succès.');
    }

   

}
