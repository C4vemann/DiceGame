<!DOCTYPE html>
<html>
	<head>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.22.2/moment.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
		<script src="https://cdn.jsdelivr.net/npm/chartjs-plugin-streaming@1.5.0/dist/chartjs-plugin-streaming.min.js"></script>

	</head>
	<body>
	
	<div style="  box-sizing: border-box; height:auto;border:3px solid black">
		<canvas id="myChart" style=""></canvas>
	</div>

	<script>
		var ctx = document.getElementById("myChart").getContext("2d");
		var chart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: [],
				datasets: [
				{
					label: "dx/dt",
					backgroundColor: "rgba(0,0,0,0)",
					borderColor: "rgba(0, 0, 255, 1)",
					pointBackgroundColor: "rgba(0,0,0,0)",
					pointBorderColor: "rgba(0,0,0,0)",
					pointHoverBackgroundColor: "rgba(0, 0, 255, 1)",
					pointHoverBorderColor: "rgba(0, 0, 255, 1)",
					data: []
				}
				]
			},
			options: {
				scales: {
					yAxes: [{
						ticks:{
							suggestedMin:0.0,
							suggestedMax:7.0
						}
					}],
					xAxes: [{
						type: 'realtime',
						ticks:{
							display:false
						}
					}]
				},
				plugins: {
					streaming: {
						onRefresh: async function(chart) {

							chart.data.labels.push(Date.now());

							/*rungekatta();*/

							let response = await fetch('./DiceRoll.php');
							let	data = await response.json();
							chart.data.datasets[0].data.push(data);
							console.log(chart.data.datasets[0].data);

						},
						delay: 1000
					}
				}
			}
		});

	</script>
	</body>
</html>