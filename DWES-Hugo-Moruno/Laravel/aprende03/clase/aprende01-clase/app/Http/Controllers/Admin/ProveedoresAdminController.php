<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Proveedor;
use Exception;
use Illuminate\Support\Facades\Log;

class ProveedoresAdminController extends Controller
{
    
    public function index()
    {
        $proveedores = Proveedor::all();
        return view('admin.proveedores.index')
            ->with('proveedores', $proveedores);
    }

    public function create()
    {
        $proveedores = Proveedor::all();
        return view('admin.proveedores.create')
            ->with('proveedores', $proveedores);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->all();
            if (isset($data['autonomo'])) {
                $data['autonomo'] = 1;
            } else {
                $data['autonomo'] = 0;
            }
            Proveedor::create($request->all());
        } catch (Exception $proveedore) {
            dd($proveedore);
            log::error($proveedore->getMessage());
        }
        return to_route('admin.proveedores.index');
    }

    public function show(Proveedor $proveedor)
    {
        $proveedores = Proveedor::all();
        return view('admin.proveedores.show')
            ->with('proveedor', $proveedor)
            ->with('proveedores', $proveedores);
    }

    public function edit(Proveedor $proveedor)
    {
        $proveedores = Proveedor::all();
        return view('admin.proveedores.edit')
            ->with('proveedor', $proveedor)
            ->with('proveedores', $proveedores);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Proveedor $proveedor)
    {
        try {
            $data = $request->all();
            if (isset($data['autonomo'])) {
                $data['autonomo'] = 1;
            } else {
                $data['autonomo'] = 0;
            }
            $proveedor->update($data);
        } catch (Exception $e) {
            dd($e);
            log::error($e->getMessage());
        }
        return to_route('admin.proveedores.index');
    }

   
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Proveedor $proveedor)
    {
        $proveedor ->delete();
        return to_route('admin.proveedores.index');
        
    }

}
