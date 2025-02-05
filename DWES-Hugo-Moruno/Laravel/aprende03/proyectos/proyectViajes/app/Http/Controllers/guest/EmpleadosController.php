<?php

namespace App\Http\Controllers\guest;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\Request;

class empleadosController extends Controller
{
    public function __invoke()
    {
        $empleados = Empleado::paginate(10);
        return view('guest.empleados')//, compact('clientes') Reemplaza a ->with('clientes', $clientes);
        ->with('empleados', $empleados);
    }
}
