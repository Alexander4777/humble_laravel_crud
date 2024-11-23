<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de gastos</title>
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
</head>

<body>
    <nav class="bg-blue-500 p-4">
        <div class="container mx-auto flex justify-between items-center"> <a href="#" class="text-white text-xl font-bold">Mi Sitio</a>
            <ul class="flex space-x-4">
                <li><a href="/" class="text-blue-500 hover:text-gray-200">Inicio</a></li>
                <li><a href="/lista" class="text-blue-500 hover:text-gray-200">Lista</a></li>
                <li><a href="/grafica" class="text-blue-500 hover:text-gray-200">Grafica</a></li>
            </ul>
        </div>
        <ul>
            @foreach ($gastos as $gasto)
            <li>{{$gasto->nombre}} ${{$gasto->cantidad}}
                <a href="{{route('route.editForm', $gasto->id)}}" class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Editar</a> <a href="{{route('route.delete', $gasto->id)}}" class="focus:outline-none text-white bg-red-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    Eliminar</a>
            </li> <br>
            @endforeach
        </ul>
</body>

</html>