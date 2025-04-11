<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Models\Plan;
use App\Models\Transaccion;
use App\Models\User;
use App\Notifications\NuevaTransaccion;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Plan::class);

        $solicitudPendiente = $this->solicitudPendiente();
        $planes = Plan::all();
        return view('planes.index', compact('planes', 'solicitudPendiente'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plan, Request $request)
    {
        $this->authorize('view', $plan);

        $solicitudPendiente = $this->solicitudPendiente();

        if($solicitudPendiente){
            return redirect()->route('plan.index')->with('error', 'Ya tienes una solicitud pendiente');
        }

        return view('planes.checkout', compact('plan'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storeComprobante(Plan $plan, Request $request)
    {
        $request->validate([
            'comprobante' => 'required|file|mimes:pdf,jpg,png|max:2048'
        ]);

        $comprobante_url = $request->file('comprobante')->store('comprobantes');

        $comprobante_url = str_replace('comprobantes/', '', $comprobante_url);

        $transaccion = Transaccion::create([
            'user_id' => auth()->user()->id,
            'plan_id' => $plan->id,
            'monto' => $plan->precio,
            'comprobante' => $comprobante_url,
            'referencia' => $request->referencia
        ]);

        // Enviar correo al admin
        User::where('rol_id', UserRoles::ADMINISTRADOR)
            ->get()
            ->each(function ($user) use ($transaccion) {
                $user->notify(new NuevaTransaccion($transaccion));
            });

        return redirect()->route('vacantes.index')->with('success', 'Comprobante enviado, espera la confirmacion');

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

    private function solicitudPendiente()
    {
        return Transaccion::where('user_id', auth()->user()->id)
            ->where('estado', 'pendiente')
            ->exists();
    }
}
