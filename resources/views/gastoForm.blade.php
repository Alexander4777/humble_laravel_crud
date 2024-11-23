<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir gasto</title>
    <!-- Styles / Scripts -->
    @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @else

    @endif
</head>

<body class="bg-gray-200">
    <div class="container mx-auto flex justify-between items-center"> <a href="#" class="text-white text-xl font-bold">Mi Sitio</a>
        <ul class="flex space-x-4">
            <li><a href="/" class="text-blue-500 hover:text-gray-200">Inicio</a></li>
            <li><a href="/lista" class="text-blue-500 hover:text-gray-200">Lista</a></li>
            <li><a href="/grafica" class="text-blue-500 hover:text-gray-200">Grafica</a></li>
        </ul>
    </div>
    <main class="relative top-[100px]">
        <form action="/addGasto" method="post" class="flex flex-col w-1/3 h-[200px] items-center m-auto bg-red-500 rounded-lg">
            @csrf
            <br>
            <input type="text" name="nombre" id="nombre"><br>
            <select name="tipo" id="tipo" class="w-1/4">
                <option value="gasto">Gasto</option>
                <option value="ingreso">Ingreso</option>
            </select><br>
            <input type="number" name="cantidad" id="cantidad"><br>
            <input type="submit" value="Agregar" class="w-1/4 bg-blue-500 rounded-lg">
        </form>
    </main>
</body>

</html>