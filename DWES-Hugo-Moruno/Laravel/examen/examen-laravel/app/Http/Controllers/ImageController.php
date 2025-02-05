<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{
    public function show($fileType, $fileName)
    {
        $pathImage = '';

        switch ($fileType) {
            case "gastos":
                $pathImage = 'app/private/gastos/';
                break;
            default:
                $pathImage = '';
                break;
        }

        $path = $pathImage . $fileName;

        if (Storage::exists($path)) {
            return response()->file(Storage::path($path));
        }

        return response()->file(public_path('storage/imagenes/placeholder.png'));
    }


    public static function saveImageByType(Request $request, $type)
    {
        try {
            $allowedTypes = ['agstos'];
            if (!in_array($type, $allowedTypes)) {
                throw new \Exception('Tipo no válido. Solo se permiten: ' . implode(', ', $allowedTypes));
            }

            if ($request->hasFile('imagen')) {
                $image = $request->file('imagen');
                $imagePath = $image->store('app/private/' . $type, 'local');

                return $imagePath;
            }
        } catch (\Exception $e) {
            throw new \Exception('Error al guardar la imagen: ' . $e->getMessage());
        }

        return null;
    }

}
