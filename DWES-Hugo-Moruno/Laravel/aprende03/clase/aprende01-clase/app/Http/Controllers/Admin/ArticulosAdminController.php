<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Articulo;
use Exception;
use Illuminate\Support\Facades\Log;

class ArticulosAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articulos = Articulo::all();
        return view('admin.articulos.index')
            ->with('articulos', $articulos);
    }

    public function create()
    {
        $articulos = Articulo::all();
        return view('admin.articulos.create')
            ->with('articulos', $articulos);
    }



    public function store(Request $request)
    {
        try{
            Articulo::create($request->all());

        }catch(Exception $e){
            log::error($e->getMessage());
        }
        return to_route('admin.articulos.index');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
