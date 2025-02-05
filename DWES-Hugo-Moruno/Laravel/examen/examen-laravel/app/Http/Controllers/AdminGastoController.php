<?php

namespace App\Http\Controllers;

use App\Models\Concepto;
use App\Models\Gasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminGastoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $gastos = Gasto::all();
        $conceptos = Concepto::all();
        return view('admin.gastos.index', compact('gastos', 'conceptos'));
    }
}
