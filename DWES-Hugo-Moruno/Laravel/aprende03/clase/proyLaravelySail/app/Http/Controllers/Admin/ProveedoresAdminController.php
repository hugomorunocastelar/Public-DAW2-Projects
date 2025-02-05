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
        $proveedores = Proveedor::paginate(10);
        return view('admin.proveedores.index')
            ->with('proveedores', $proveedores);
    }

    public function create()
    {
        $proveedores = Proveedor::latest()->paginate(10);
        return view('admin.proveedores.create')
            ->with('proveedor', new Proveedor())
            ->with('proveedores', $proveedores);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'nif'=>'required|unique:proveedores|min:8|max:12',
            'nombre'=>'min:3|max:20',
            'apellido1'=>'min:3|max:20',
            'apellido2'=>'min:3|max:20',
            'direccion'=>'required',
            'telefono'=>'required',
            'autonomo',
            'observaciones'=>'',
        ],[
            'nif.required'=>'El nif es requerido',
            'nif.unique'=>'El nif ya existe',
            'nif.min'=>'El nif debe tener al menos 8 caracteres',
            'nif.max'=>'El nif debe tener maximo 12 caracteres',
        ]);

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
        $proveedores = Proveedor::orderBy('nif')->get();
        return view('admin.proveedores.show')
            ->with('proveedor', $proveedor)
            ->with('proveedores', $proveedores);


    }

    public function edit(Proveedor $proveedor)
    {
        $proveedores = Proveedor::orderBy('updated_at','desc')->get();
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
