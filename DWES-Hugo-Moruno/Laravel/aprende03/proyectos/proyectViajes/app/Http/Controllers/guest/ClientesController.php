<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use Illuminate\Http\Request;

class clientesController extends Controller
{
    public function __invoke()
    {
        $clientes = Cliente::paginate(10);
        return view('guest.clientes')//, compact('clientes') Reemplaza a ->with('clientes', $clientes);
            ->with('clientes', $clientes);
    }
}
