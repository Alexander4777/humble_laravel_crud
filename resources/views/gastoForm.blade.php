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

        <div>
            <canvas id="myChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chart.js/dist/chart.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/chartjs-adapter-date-fns/dist/chartjs-adapter-date-fns.bundle.min.js"></script>

        <script>
            const ctx = document.getElementById('myChart');
            async function datos() {
                const res = await fetch('http://localhost:8000/gastos');
                const json = await res.json();
                console.log(json);
                const filteredUsers = json.map(user => {
                    return Object.fromEntries(Object.entries(user).filter(([key]) => key === 'cantidad' || key === 'fecha'));
                });
                console.log(filteredUsers);
                new Chart(ctx, {
                type: 'line',
                data: {
                    datasets: [{
                        data: filteredUsers
                    }]
                },
                options: {
                    parsing: {
                        xAxisKey: 'fecha',
                        yAxisKey: 'cantidad'
                    },
                    scales: {
                        x: {
                            type: 'time',
                        }
                    }
                }
            });
                return filteredUsers;
            }

            datos();
            
            
        </script>
    </main>
</body>

</html>