<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Grafica</title>
</head>

<body>
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
                return Object.fromEntries(Object.entries(user).filter(([key]) => key === 'fecha' || key === 'cantidad'));
            });
            let history = [filteredUsers[0].cantidad];

            for (let i = 0; i < filteredUsers.length - 1; ++i) {
                history.push(filteredUsers[i].cantidad + filteredUsers[i + 1].cantidad);
            }

            let fechas = []

            filteredUsers.forEach(element => {
                fechas.push(element.fecha);
            });

            let data = [];
            for (let i = 0; i < fechas.length; i++) {
                let obj = {
                    x: fechas[i],
                    y: history[i]
                };
                data.push(obj);
            }
            console.log(data)
            console.log(history);
            console.log(fechas);
            new Chart(ctx, {
                type: 'line',
                data: {
                    datasets: [{
                        data: data
                    }]
                },
                options: {
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
</body>

</html>