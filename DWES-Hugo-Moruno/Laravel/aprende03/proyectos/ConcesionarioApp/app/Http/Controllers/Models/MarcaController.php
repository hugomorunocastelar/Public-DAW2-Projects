<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\ImageController;
use App\Models\Marca;
use App\Models\ModelosCoche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MarcaController extends Controller
{
    public function index()
    {
        $marcas = Marca::all();
        $modelos = ModelosCoche::all();
        return view('admin.marcas.index', compact('marcas', 'modelos'));
    }

    public function public()
    {
        $marcas = Marca::all();
        $modelos = ModelosCoche::all();
        return view('marcas.index', compact('marcas', 'modelos'));
    }

    public function create()
    {
        return view('admin.marcas.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'pais_origen' => 'nullable|string|max:255',
            'imagen' => '',
        ]);

        if ($request->hasFile('imagen')) {
            $validatedData['imagen'] = ImageController::saveImageByType($request, 'marcas');
        }

        Marca::create($validatedData);

        return redirect()->route('admin.marcas.index')->with('success', 'Marca creada exitosamente.');
    }

    public function show(string $id)
    {
        $marca = Marca::findOrFail($id);
        return view('admin.marcas.show', compact('marca'));
    }

    public function edit(string $id)
    {
        $marca = Marca::findOrFail($id);
        return view('admin.marcas.edit', compact('marca'));
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
            'pais_origen' => 'nullable|string|max:255',
            'imagen' => '',
        ]);

        $marca = Marca::findOrFail($id);

        if ($request->hasFile('imagen')) {
            if ($marca->imagen && Storage::exists($marca->imagen)) {
                Storage::delete($marca->imagen);
            }

            $validatedData['imagen'] = ImageController::saveImageByType($request, 'marcas');
        }

        $marca->update($validatedData);

        return redirect()->route('admin.marcas.index')->with('success', 'Marca actualizada exitosamente.');
    }

    public function destroy(string $id)
    {
        try {
            $marca = Marca::findOrFail($id);

            if ($marca->imagen && Storage::exists($marca->imagen)) {
                Storage::delete($marca->imagen);
            }

            $marca->delete();

            return redirect()->route('admin.marcas.index')->with('success', 'Marca eliminada exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.marcas.index')->with('error', 'No se pudo eliminar la marca.');
        }
    }
}
