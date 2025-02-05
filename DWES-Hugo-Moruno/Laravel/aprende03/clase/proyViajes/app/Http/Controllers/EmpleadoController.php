<?php

namespace App\Http\Controllers;

use App\Models\Empleado;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{

    public function index()
    {
        $empleados = Empleado::all();
        return view('empleados.index', compact('empleados'));
    }


    public function create()
    {
        return view('empleados.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nif' => 'required|string|max:12|unique:empleados',
            'nombre' => 'required|string|max:20',
            'apellido1' => 'required|string|max:20',
            'apellido2' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        Empleado::create($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado creado exitosamente');
    }


    public function edit(Empleado $empleado)
    {
        return view('empleados.edit', compact('empleado'));
    }


    public function update(Request $request, Empleado $empleado)
    {
        $request->validate([
            'nif' => 'required|string|max:12|unique:empleados,nif,' . $empleado->id,
            'nombre' => 'required|string|max:20',
            'apellido1' => 'required|string|max:20',
            'apellido2' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
        ]);

        $empleado->update($request->all());

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado actualizado exitosamente');
    }


    public function destroy(Empleado $empleado)
    {
        $empleado->delete();

        return redirect()->route('empleados.index')
            ->with('success', 'Empleado eliminado exitosamente');
    }
}

