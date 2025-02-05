<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\Viaje;
use Illuminate\Http\Request;

class viajesController extends Controller
{
    public function __invoke()
    {
        $viajes = Viaje::paginate(10);
        return view('guest.viajes')//, compact('clientes') Reemplaza a ->with('clientes', $clientes);
        ->with('viajes', $viajes);
    }
}
