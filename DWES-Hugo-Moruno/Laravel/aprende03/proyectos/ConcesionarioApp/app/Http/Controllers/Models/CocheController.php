<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\ModelosCoche;
use Illuminate\Http\Request;
use App\Models\Coche;
use function PHPUnit\Framework\isNull;

class CocheController extends Controller
{

    public function index()
    {
        $coches = Coche::all();
        return view('admin.coches.index', compact('coches'));
    }

    public function create()
    {
        $modelos = ModelosCoche::all();
        $clientes = Cliente::all();
        return view('admin.coches.create', compact('modelos', 'clientes'));
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'color' => 'required|string|max:255',
            'matricula' => 'required|string|max:255|unique:coches,matricula',
            'cliente_id' => 'nullable|exists:clientes,id',
            'modelo_coche_id' => 'nullable|exists:modelos_coches,id',
            'vendido' => '',
        ]);
        isset($validatedData['vendido']) ? $validatedData['vendido'] = 1 : $validatedData['vendido'] = 0;
        $validatedData['cliente_id'] == null ? $validatedData['vendido'] = 0 : $validatedData['vendido'] = 1;
        Coche::create($validatedData);

        return redirect()->route('admin.coches.index')->with('success', 'Coche creado exitosamente.');
    }

    public function show(string $id)
    {
        $coche = Coche::findOrFail($id);
        $modelos = ModelosCoche::all();
        $clientes = Cliente::all();
        return view('admin.coches.show', compact('coche', 'modelos', 'clientes'));
    }

    public function edit(string $id)
    {
        $coche = Coche::findOrFail($id);
        $modelos = ModelosCoche::all();
        $clientes = Cliente::all();
        return view('admin.coches.edit', compact('coche', 'modelos', 'clientes'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'color' => 'required|string|max:255',
            'matricula' => 'required|string|max:255|unique:coches,matricula,' . $id,
            'cliente_id' => 'nullable|exists:clientes,id',
            'modelo_coche_id' => 'nullable|exists:modelos_coches,id',
            'vendido' => '',
        ]);

        isset($validatedData['vendido']) ? $validatedData['vendido'] = 1 : $validatedData['vendido'] = 0;
        $validatedData['cliente_id'] == null ? $validatedData['vendido'] = 0 : $validatedData['vendido'] = 1;
        $coche = Coche::findOrFail($id);
        $coche->update($validatedData);

        return redirect()->route('admin.coches.index');
    }


    public function destroy(string $id)
    {
        try {
            $coche = Coche::findOrFail($id);
            $coche->delete();
            return to_route('admin.coches.index');
        } catch (\Exception $e) {
            return to_route('admin.coches.index');
        }
    }

}
