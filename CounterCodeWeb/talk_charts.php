<?php
	include_once('database/talk_q.php');
	
	
	$talk_id = $_POST['talk_id'];
	$talk_info = try_get_talk_info_by_id($talk_id);
	$now = time();

	include_once('templates/header.php');
?>

	<div class="background" id="homebackground3">
		<?php include_once('templates/navbar.php'); ?>
		<?php include_once('templates/sidebar.php'); ?>
		<div id="talk_info">
        <h2 id="title"> <?php echo $talk_info['title']," by ",$talk_info['name'] ?> </h2>
			<div id="graph">
				<canvas id="line-chart" width="800" height="400"></canvas>
			</div>

            <?php if($talk_info['date_end'] < $now) {
                    ?> 	<div id="rate_form">
                            <form id="form" method="POST" action="actions/add_rating.php">
                                <label for="talk_rating"> Please rate this talk:
                                    <input type="hidden" name="talkID" value="<?php echo $talk_id; ?>">
                                    <input type="number" name="rating" step="1" min="1" max="5">
                                    <br><button type="submit" id="register-btn">Rate</button>
                                </label>
                            </form>
                        </div>
            <?php } ?>
			<div id="graph">
				<canvas id="satisfaction-chart" width="800" height="400"></canvas>
			</div>
        </div>
    </div>

<?php include_once('templates/footer.php'); ?>



<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>

	function encode_for_ajax(data) {
		return Object.keys(data).map(function(k){
		return encodeURIComponent(k) + '=' + encodeURIComponent(data[k])
		}).join('&')
	}

	function draw_talk_attendance_graph(talk_attendance, talk_info) {

		let talk_duration = (talk_info['date_end'] - talk_info['date_start']) / 60;
		let start_time = talk_info['date_start'];

		let graph_data = [];
		let time_minutes = [];
		let time_step = 1;
		for (let i = 0; i <= talk_duration; i += time_step) {
			time_minutes.push(i);
		}

		let people_count = [];
		let people_counter = 0;
		talk_attendance.forEach(point => {
			people_counter += (point['is_entry'] == 'true') ? 1 : -1;
			graph_data.push({x: point['timestamp'] - start_time, y: people_counter});
		});

		new Chart(document.getElementById("line-chart"), {
			type: 'line',
			data: {
					labels: time_minutes,
					datasets: [{ 
						data: graph_data,
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
				},
				scales: {
            		xAxes: [{
                		display: true,
						scaleLabel: {
							display: true,
							labelString: 'Value'
						},
						ticks: {
							min: 0,
							max: 100,

							// forces step size to be 5 units
							stepSize: 5 // <----- This prop sets the stepSize
						}
					}],
					yAxes: [{
                		ticks: {
                    		suggestedMin: 0,
							stepSize: 2
                		}
            		}]
       			}
			}
		});
	}

	function draw_talk_ratings_graph(talk_ratings, talk_info) {

		let graph_data = [];

		for (let index = 0; index < talk_ratings.length; index++) {
			console.log(talk_ratings[index][0]['count_rat']);
			graph_data.push(talk_ratings[index][0]['count_rat']);
		}


		new Chart(document.getElementById("satisfaction-chart"), {
			type: 'bar',
			data: {
					labels: [1, 2, 3, 4, 5],
					datasets: [{ 
						data: graph_data,
						label: "Git - The basics",
						backgroundColor: "#3e95cd",
					}
				]
			},
			options: {
				title: {
				display: true,
				text: 'Room ratings'
				},
				scales: {
            		xAxes: [{
                		display: true,
						scaleLabel: {
							display: true,
							labelString: 'Rating'
						},
						ticks: {
							min: 1,
							max: 5,

							// forces step size to be 5 units
							stepSize: 1 // <----- This prop sets the stepSize
						}
					}],
					yAxes: [{
						ticks: {
							min: 0,
							stepSize: 1 // <----- This prop sets the stepSize
						}
            		}]
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
				console.log(requestData);
			} catch (error) {
				console.log('Failed to parse request JSON data.');
			}
			if(requestData.success) {
				draw_talk_attendance_graph(requestData.talk_attendance, requestData.talk_info);
				draw_talk_ratings_graph(requestData.talk_ratings, requestData.talk_info);
			}
			else {
				console.log("FAIL");
			}
		}
	}

	request_talk_data(<?php echo $talk_id; ?>);
	
</script>
