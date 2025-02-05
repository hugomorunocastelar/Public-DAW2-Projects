<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class GastoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gastos = Gasto::where('user_id', Auth::id())->get();
        $conceptos = Concepto::all();
        return view('gastos.index', compact('gastos', 'conceptos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $gasto = new Gasto();
        $conceptos = Concepto::all();
        return view('gastos.create', compact('gasto', 'conceptos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if ($request->hasFile('imagen')) {
            $request['imagen'] = ImageController::saveImageByType($request, 'gastos');
        }

        Gasto::create($request);
        return redirect()->route('gastos.index')->with('success', 'Gasto actualizado exitosamente.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return view('gastos.show', [
            'gasto' => Gasto::where('id', $id)->firstOrFail(),
            'conceptos' => Concepto::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        return view('gastos.edit', [
            'gasto' => Gasto::where('id', $id)->firstOrFail(),
            'conceptos' => Concepto::all()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validatedData = $request->validate([
            'conceptos_id' => 'required|integer',
            'user_id' => 'required|integer',
            'gasto' => 'required|double|',
            'imagen' => '',
            'descontinuado' => 'date',
        ]);

        $gasto = Gasto::findOrFail($id);

        if ($request->hasFile('imagen')) {
            if ($gasto->imagen) {
                Storage::disk('private')->delete($gasto->imagen);
            }
            $validatedData['imagen'] = ImageController::saveImageByType($request, 'gastos');
        }

        $gasto->update($validatedData);
        return redirect()->route('gastos.index')->with('success', 'Gasto actualizado exitosamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $gasto = Gasto::where('id', $id)->firstOrFail();
            if ($gasto->imagen) {
                Storage::disk('private')->delete($gasto->imagen);
            }
            $gasto->delete();
            return redirect()->route('gastos')->with('success', 'Gasto eliminado exitosamente.');
        } catch (\Exception $e) {
            return redirect()->route('gastos')->with('error', 'No se pudo eliminar el gasto.');
        }
    }
}
