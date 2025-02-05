<?php

namespace App\Http\Controllers\Models;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Utils\ImageController;
use App\Models\Marca;
use App\Models\ModelosCoche;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ModelosController extends Controller
{
    public function index()
    {
        return view('admin.modelo.index', ['modelos' => ModelosCoche::all()]);
    }

    public function destacados()
    {
        $modelosMasVendidos = DB::table('coches')
            ->select('modelo_coche_id', DB::raw('COUNT(*) as total_vendidos'))
            ->groupBy('modelo_coche_id')
            ->orderByDesc('total_vendidos')
            ->limit(4)
            ->get();

        $modelos = ModelosCoche::whereIn('id', $modelosMasVendidos->pluck('modelo_coche_id'))
            ->get()
            ->sortByDesc(fn($modelo) => $modelosMasVendidos->firstWhere('modelo_coche_id', $modelo->id)->total_vendidos);

        return view('destacados', compact('modelos', 'modelosMasVendidos'));
    }

    public function show($identificador)
    {
        return view('admin.modelo.show', [
            'modelo' => ModelosCoche::where('identificador', $identificador)->firstOrFail(),
            'marcas' => Marca::all()
        ]);
    }

    public function showPublic($identificador)
    {
        return view('modelo.show', ['modelo' => ModelosCoche::where('identificador', $identificador)->firstOrFail()]);
    }

    public function create()
    {
        return view('admin.modelo.create', ['marcas' => Marca::all()]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'identificador' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'tipo' => 'required|string|max:255',
            'anho' => 'nullable|integer|min:1960|max:' . date('Y'),
            'marca_id' => 'required|exists:marcas,id',
            'imagen' => '',
            'descontinuado' => '',
        ]);

        if ($request->hasFile('imagen')) {
            $validatedData['imagen'] = ImageController::saveImageByType($request, 'modelos');
        }

        ModelosCoche::create($validatedData);
        return redirect()->route('admin.modelos.index')->with('success', 'Modelo creado exitosamente.');
    }

    public function edit($identificador)
    {
        return view('admin.modelo.edit', [
            'modelo' => ModelosCoche::where('identificador', $identificador)->firstOrFail(),
            'marcas' => Marca::all()
        ]);
    }

    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'identificador' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'tipo' => 'nullable|string|max:255',
            'anho' => 'nullable|integer|min:1960|max:' . date('Y'),
            'marca_id' => 'required|exists:marcas,id',
            'imagen' => '',
            'descontinuado' => '',
        ]);

        $modelo = ModelosCoche::findOrFail($id);

        if ($request->hasFile('imagen')) {
            if ($modelo->imagen) {
                Storage::disk('private')->delete($modelo->imagen);
            }
            $validatedData['imagen'] = ImageController::saveImageByType($request, 'modelos');
        }

        $modelo->update($validatedData);
        return redirect()->route('admin.modelos.index')->with('success', 'Modelo actualizado exitosamente.');
    }

    public function destroy($identificador)
    {
        try {
            $modelo = ModelosCoche::where('identificador', $identificador)->firstOrFail();
            if ($modelo->imagen) {
                Storage::disk('private')->delete($modelo->imagen);
            }
            $modelo->delete();
            return redirect()->route('admin.modelos.index')->with('success', 'Modelo eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('admin.modelos.index')->with('error', 'No se pudo eliminar el modelo.');
        }
    }
}
