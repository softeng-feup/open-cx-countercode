<?php
	include_once('database/connection.php');
	$talk_id = $_POST['talk_id'];
	$talk_info = try_get_talk_info_by_id($talk_id);
?>

<?php include_once('templates/header.php'); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>

	<div class="background" id="homebackground3">
		<?php include_once('templates/navbar.php'); ?>
		<?php include_once('templates/sidebar.php'); ?>
		<div id="talk_info">
			<h2> <?php echo $talk_info['title']," by ",$talk_info['name'] ?> </h2>
			<div id="graph">
				<canvas id="line-chart" width="800" height="400"></canvas>
			</div>

			<div id="graph">
				<canvas id="satisfaction-chart" width="800" height="400"></canvas>
			</div>
		</div>
	</div>

<?php include_once('templates/footer.php'); ?>




<script>

	function encode_for_ajax(data) {
		return Object.keys(data).map(function(k){
		return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
		}).join('&')
	}
	function draw_talk_graph(talk_data) {
		console.log(talk_data);
		let start_time = talk_data[0]['timestamp'];
		let time_minutes = [];
		let people_count = [];
		let people_counter = 0;
		talk_data.forEach(point => {
			time_minutes.push(point['timestamp'] - start_time);
			people_counter += (point['is_entry'] == '1') ? 1 : -1;
			people_count.push(people_counter);
		});
		console.log(time_minutes);
		console.log(people_count);
		new Chart(document.getElementById("line-chart"), {
			type: 'line',
			data: {
					labels: time_minutes,
					datasets: [{ 
						data: people_count,
						label: "B301",
						borderColor: "#3e95cd",
						fill: false
					}
				]
			},
			options: {
				title: {
				display: true,
				text: 'Room atendance'
				}
			}
		});
	}
	function request_talk_data(talk_id) {
		if(talk_id !== null) {
			var request = new XMLHttpRequest();
			request.onreadystatechange = function () { process_talk_data(request); };
			request.open("POST", "actions/talk_processor.php", true);
			request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			request.send(encode_for_ajax({talk_id: talk_id}));
		}
	}
	function process_talk_data(request) {
		if(request.readyState === XMLHttpRequest.DONE && request.status === 200) {
			//console.log(request.responseText);
			let requestData = null;
			try {
				requestData = JSON.parse(request.responseText);
				//console.log(requestData);
			} catch (error) {
				console.log('Failed to parse request JSON data.');
			}
			if(requestData.success) {
				draw_talk_graph(requestData.talk_data);
			}
			else {
				console.log("FAIL");
			}
		}
	}
	request_talk_data(<?php echo $talk_id; ?>);
	
	// TODO: Add talk ratings

	new Chart(document.getElementById("satisfaction-chart"), {
		type: 'bar',
		data: {
				labels: [1,1.5,2,2.5,3,3.5,4,4.5,5],
				datasets: [{ 
					data: [1,0,0,0,0,4,10,40,10],
					label: "Git - The basics",
					backgroundColor: "#3e95cd",
				},
				{ 
					data: [5,4,1,0,0,0,6,55,15],
					label: "Polyrhythms and math",
					backgroundColor: "#3fb26d",
				}
			]
		},
		options: {
			title: {
			display: true,
			text: 'Talk ratings'
			}
		}
	});
</script>
