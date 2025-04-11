<?php

namespace App\Http\Controllers;

use App\Enums\UserRoles;
use App\Models\Salario;
use App\Models\User;
use App\Models\Vacante;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class VacanteController extends Controller
{
    use AuthorizesRequests;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->authorize('viewAny', Vacante::class);
        return view('vacantes.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this->authorize('create', Vacante::class);

        return view('vacantes.create');
    }


    /**
     * Display the specified resource.
     */
    public function show(Vacante $vacante)
    {
       $this->authorize('view', $vacante);

        return view('vacantes.show',
            [
                'vacante' => $vacante
            ]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public
    function edit(Vacante $vacante)
    {

        $this->authorize('update', $vacante);

        return view('vacantes.edit',
            [
                'vacante' => $vacante
            ]);
    }
}
