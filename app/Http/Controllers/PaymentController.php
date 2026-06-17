<?php

namespace App\Http\Controllers;

use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Http\Requests\PaymentRequest;
use Inertia\Inertia;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $payment = payment::all();
        return Inertia::render('payments/index', [
            'payments'=> $payment]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('payment/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PaymentRequest $request, string $id){
        $validated = $request->validated();
        $payment =payment::create($validated);
        $payment->subscription_id = $id;
        $payment->save();
        return redirect()->route('payments.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $payment = payment::find($id);
        return Inertia::render('payment/show', [
            'payment'=> $payment]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $payment = payment::find($id);
        return Inertia::render('payment/edit', [
            'payment'=> $payment]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PaymentRequest $request, string $id)
    {
        $validated = $request->validated();
        $payment = payment::find($id);
        $payment->update($validated);
        return redirect()->route('payments.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $payment = payment::find($id);
        $payment->delete();
        return redirect()->route('payments.index');
    }
}
