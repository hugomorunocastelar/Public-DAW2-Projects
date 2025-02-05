<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    {{-- ARTICULOS
    @dd($articulos) --}}
    
    {{-- @foreach ($articulos as $articulos)
    <p>{{ $articulos->ref }} - {{$articulos->descripcion}}</p>
    @endforeach --}}
    
    <div class="m-4 p-8 rounded shadow border border-fuchsia-600 bg-amber-200">
        <ul>
            @foreach ($articulos as $articulos)
            <li>{{ $articulos->ref }} - {{$articulos->descripcion}}</li>
            @endforeach
        </ul>
    </div>
    

</body>
</html>