<?php

namespace App\Http\Controllers;

use App\Models\Plan;
use App\Models\Transaccion;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $planes = Plan::all();
        return view('planes.index', compact('planes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeComprobante(Plan $plan, Request $request)
    {

        $request->validate([
            'comprobante' => 'required|file|mimes:pdf,jpg,png|max:2048']);


        $comprobante_url = $request->file('comprobante')->store('comprobantes');

        Transaccion::create([
            'user_id' => auth()->user()->id,
            'plan_id' => $plan->id,
            'monto' => $plan->precio,
            'comprobante' => $comprobante_url,
            'referencia' => $request->referencia
        ]);

        return redirect()->route('vacantes.index')->with('success', 'Comprobante enviado, espera la confirmacion');

    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan, Request $request)
    {
        $plan = $plan;
        return view('planes.checkout', compact('plan'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Plan $plan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Plan $plan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plan)
    {
        //
    }
}
