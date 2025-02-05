<?php

namespace App\Http\Controllers;

use App\Models\Viaje;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ViajeController extends Controller
{
    // Listado de viajes
    public function index()
    {
        $viajes = Viaje::all();
        return view('viajes.index', compact('viajes'));
    }

    // Mostrar formulario para crear un nuevo viaje
    public function create()
    {
        return view('viajes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'referencia' => 'required|string|max:15|unique:viajes',
            'titulo' => 'required|string|max:200',
            'slug' => 'required|string|max:250|unique:viajes',
            'precio' => 'nullable|numeric',
            'participantes' => 'nullable|integer',
            'salida' => 'nullable|date',
            'llegada' => 'nullable|date|after_or_equal:salida',
        ]);

        $request['slug'] = $request->input('slug') ?? Str::slug($request->input('titulo'));

        Viaje::create($request->all());

        return redirect()->route('viajes.index')
            ->with('success', 'Viaje creado exitosamente');
    }

    public function edit(Viaje $viaje)
    {
        return view('viajes.edit', compact('viaje'));
    }

    public function update(Request $request, Viaje $viaje)
    {
        $request->validate([
            'referencia' => 'required|string|max:15|unique:viajes,referencia,' . $viaje->id,
            'titulo' => 'required|string|max:200',
            'slug' => 'required|string|max:250|unique:viajes,slug,' . $viaje->id,
            'precio' => 'nullable|numeric',
            'participantes' => 'nullable|integer',
            'salida' => 'nullable|date',
            'llegada' => 'nullable|date|after_or_equal:salida',
        ]);

        $request['slug'] = $request->input('slug') ?? Str::slug($request->input('titulo'));

        $viaje->update($request->all());

        return redirect()->route('viajes.index')
            ->with('success', 'Viaje actualizado exitosamente');
    }

    public function destroy(Viaje $viaje)
    {
        $viaje->delete();

        return redirect()->route('viajes.index')
            ->with('success', 'Viaje eliminado exitosamente');
    }
}

