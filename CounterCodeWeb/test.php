<style>
    #chart {
        max-width: 500px;
    }
</style>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

<!DOCTYPE html>
<html lang="pt-PT">

	<head>
		<title></title>

		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		
	</head>

	<body>
        <div id="chart">
            <canvas id="line-chart" width="300" height="300"></canvas>
        </div>
    </body>
</html>

<script>
new Chart(document.getElementById("line-chart"), {
  type: 'line',
  data: {
        labels: [0,10,20,30,40,50,60,70,80,90],
        datasets: [{ 
            data: [10,20,80,90,90,102,102,90,20,0],
            label: "B301",
            borderColor: "#3e95cd",
            fill: false
        },
        { 
            data: [0,0,20,30,30,34,44,50,20,0],
            label: "B302",
            borderColor: "#3fb26d",
            fill: false
        }
    ]
  },
  options: {
    title: {
      display: true,
      text: 'People in the rooms'
    }
  }
});

</script>

