<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\paiement;
use App\Http\Requests\paiementRequest;

class paiementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $paiement = paiement::all();
        return Inertia::render('paiements/index', [
            'paiements'=> $paiement]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('paiement/create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(paiementRequest $request)
    {
        $validated = $request->validated();
        paiement::create($validated);
        return redirect()->route('paiements.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $paiement = paiement::find($id);
        return Inertia::render('paiement/show', [
            'paiement'=> $paiement]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $paiement = paiement::find($id);
        return Inertia::render('paiement/edit', [
            'paiement'=> $paiement]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(paiementRequest $request, string $id)
    {
        $validated = $request->validated();
        $paiement = paiement::find($id);
        $paiement->update($validated);
        return redirect()->route('paiements.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $paiement = paiement::find($id);
        $paiement->delete();
        return redirect()->route('paiements.index');
    }
}
