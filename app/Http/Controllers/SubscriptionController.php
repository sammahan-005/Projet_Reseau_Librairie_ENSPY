<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubscriptionRequest;
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

   

}