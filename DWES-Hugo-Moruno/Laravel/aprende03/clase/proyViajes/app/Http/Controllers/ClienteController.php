<?php

// app/Http/Controllers/ClienteController.php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{

    public function index()
    {
        $clientes = Cliente::all();
        return view('admin.clientes.index', compact('clientes'));
    }


    public function create()
    {
        return view('admin.clientes.create');
    }


    public function store(Request $request)
    {
        $request->validate([
            'nif' => 'required|string|unique:clientes,nif|max:12',
            'nombre' => 'required|string|max:20',
            'apellido1' => 'required|string|max:20',
            'apellido2' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'foto' => 'nullable|string|max:200',
            'observaciones' => 'nullable|string',
            'active' => 'required|boolean',
        ]);

        Cliente::create($request->all());

        return redirect()->route('admin.clientes.index')->with('success', 'Cliente creado exitosamente.');
    }


    public function show(Cliente $cliente)
    {
        return view('admin.clientes.show', compact('cliente'));
    }


    public function edit(Cliente $cliente)
    {
        return view('admin.clientes.edit', compact('cliente'));
    }


    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nif' => 'required|string|unique:clientes,nif,' . $cliente->id . '|max:12',
            'nombre' => 'required|string|max:20',
            'apellido1' => 'required|string|max:20',
            'apellido2' => 'nullable|string|max:20',
            'fecha_nacimiento' => 'nullable|date',
            'foto' => 'nullable|string|max:200',
            'observaciones' => 'nullable|string',
            'active' => 'required|boolean',
        ]);

        $cliente->update($request->all());

        return redirect()->route('admin.clientes.index')->with('success', 'Cliente actualizado exitosamente.');
    }


    public function destroy(Cliente $cliente)
    {
        $cliente->delete();
        return redirect()->route('admin.clientes.index')->with('success', 'Cliente eliminado exitosamente.');
    }
}
