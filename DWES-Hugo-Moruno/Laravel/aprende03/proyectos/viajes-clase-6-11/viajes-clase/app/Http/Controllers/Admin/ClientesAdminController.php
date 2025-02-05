<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClienteStoreRequest;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class ClientesAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::orderBy('nif')->paginate(10);
        return view('admin.clientes.index')
            ->with('clientes', $clientes);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $clientes = Cliente::latest()->paginate(10);
        return view('admin.clientes.create')
            ->with('clientes', $clientes)
            ->with('cliente', new Cliente());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClienteStoreRequest $request)
    {
        $requestData = $request->validated();
//        dd($requestData);
        try {
            $fullPath = null;
            DB::beginTransaction();
            if($request->hasFile('foto')){
                $file = $request->file('foto');
                $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
                $fileName = $uuid . '_' . $requestData['nif']
                     . '.' . $file->getClientOriginalExtension();
                $destino = env('UPLOAD_CLIENTES_FOTOS');
                $fullPath = $file->storeAs($destino, $fileName);
                $requestData['foto'] = $fileName;
            }
            throw(new \Exception('cagaste loco'));
            Cliente::create($requestData);
            DB::commit();
            return to_route('admin.clientes.index')
                ->with('alertSuccess', __('El cliente ha sido guardado.'));
        } catch (\Exception $e) {
            DB::rollBack();
            if($fullPath!=null)
            {
                Storage::delete($fullPath);
            }
            return to_route('admin.clientes.index')
                ->with('alertError', __('El cliente no ha podido ser guardado.'));
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $clientes = Cliente::orderBy('nif')->paginate(10);
        return view('admin.clientes.show')
            ->with('clientes', $clientes)
            ->with('cliente', $cliente);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cliente $cliente)
    {
        $clientes = Cliente::orderBy('nif')->paginate(10);
        return view('admin.clientes.edit')
            ->with('clientes', $clientes)
            ->with('cliente', $cliente);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        $requestData = $request->validated();
        try {
            $fullPath = null;
            DB::beginTransaction();
            if($request->hasFile('foto')){
                $file = $request->file('foto');
                if($cliente->foto)
                {
                    $fileName = $cliente->foto;
                }
                else
                {
                    $uuid = \Ramsey\Uuid\Uuid::uuid4()->toString();
                    $fileName = $uuid . '_' . $requestData['nif']
                        . '.' . $file->getClientOriginalExtension();

                }
                $destino = env('UPLOAD_CLIENTES_FOTOS');
                $fullPath = $file->storeAs($destino, $fileName);
                $requestData['foto'] = $fileName;
            }
            DB::commit();
            return to_route('admin.clientes.index')
                ->with('alertSuccess', __('El cliente ha sido modificado.'));
        } catch (\Exception $e) {
            DB::rollBack();
            if($fullPath!=null)
            {
                Storage::delete($fullPath);
            }
            return to_route('admin.clientes.index')
                ->with('alertError', __('El cliente no ha podido ser modificado.'));
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cliente $cliente)
    {
        try {
            $cliente->delete();
            return to_route('admin.clientes.index')->with('alertSuccess', __('El cliente ha sido eliminado.'));
        } catch (\Exception $e) {
            return to_route('admin.clientes.index')->with('alertError', __('El cliente no se pudo eliminar.'));
        }
    }
}
