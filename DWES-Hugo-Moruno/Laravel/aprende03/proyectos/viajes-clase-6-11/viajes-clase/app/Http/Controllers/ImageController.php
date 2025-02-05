<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function show($fileType, $fileName)
    {
        switch ($fileType)
        {
            case "CLIENTE-FOTO":
                $pathImage = env('UPLOAD_CLIENTES_FOTOS');
                break;
            default:
                $pathImage = '';
        }
        $path = $pathImage . $fileName;
        #error_log($path);
        if (Storage::exists($path))
        {
            return response()->file(Storage::path($path));
        }
        return asset('images/imagen_no_disponible.png');
    }
}


//http://localhost:8000/images/CLIENTE-FOTO/4ac91c7e-6bc7-4eab-a62c-e0f1ecd82c82_00000002A.jfif
