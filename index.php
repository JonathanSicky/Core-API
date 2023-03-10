<!DOCTYPE html>
<html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Document</title>
            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    </head>
    <body>
        <?php include 'navbar.php' ?>
        <div>
            <button onclick="showData()">Show Data</button>
            <button onclick="hideData()">Hide Data</button>
            <button onclick="showChart()">Show Chart</button>
            <button onclick="hideChart()">Hide Chart</button>
        </div>
        <div id="myData" style="display:none;"></div>
        <canvas id="myChart" style="display:none;"></canvas> 
        <script>
            function showData() {
                var data = document.getElementById("myData");
                data.style.display = "block";
            }

            function hideData() {
                var data = document.getElementById("myData");
                data.style.display = "none";
            }

            function showChart() {
                var chart = document.getElementById("myChart");
                chart.style.display = "block";
            }

            function hideChart() {
                var chart = document.getElementById("myChart");
                chart.style.display = "none";
            }

            fetch('https://api.punkapi.com/v2/beers')
            .then(response => response.json())
            .then(data => {

                var mainContainer = document.getElementById('myData');
                for (var i = 0; i < data.length; i++) {
                    var div = document.createElement("div");
                    div.innerHTML = `Name : ${data[i].name} <br> Tagline : ${data[i].tagline} <hr>`
                    mainContainer.appendChild(div);
                }

                var labels = data.map(beer => beer.name);
                var abvs = data.map(beer => beer.id);
                var chartData = {
                    labels: labels,
                    datasets: [{
                        label: 'ABV %',
                        data: abvs,
                        fill: false,
                        borderColor: 'rgb(75, 192, 192)',
                        tension: 0.1
                    }]
                };

                var ctx = document.getElementById('myChart').getContext('2d');
                var myChart = new Chart(ctx, {
                    type: 'line',
                    data: chartData,
                });
            })
            .catch(err => console.log('err : ' + err));
        </script>
    </body>
</html>
