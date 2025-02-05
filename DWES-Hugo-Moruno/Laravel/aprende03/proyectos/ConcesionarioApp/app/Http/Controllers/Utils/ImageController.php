<?php

namespace App\Http\Controllers\Utils;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ImageController extends Controller
{



    public function show($fileType, $fileName)
    {
        $pathImage = '';

        switch ($fileType) {
            case "marcas":
                $pathImage = 'app/private/marcas/';
                break;
            case "modelos":
                $pathImage = 'app/private/modelos/';
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
            $allowedTypes = ['marcas', 'modelos'];
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
