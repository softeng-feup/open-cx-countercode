<div id="card_body">
                <h4 class="font-weight-normal mb-3">Weekly Visitors</h4>
                <h2 class="font-weight-normal mb-5">123456</h2>
                <p class="card-text">Attendance: 93%</p>
</div>

<div id="card_body">
                <h4 class="font-weight-normal mb-3">Today's Visitors</h4>
                <h2 class="font-weight-normal mb-5">54678</h2>
                <p class="card-text">Attendance: 78%</p>
</div>

<div class="graph">
                  <h4 class="card-title">Room Attendance</h4>
                  <canvas id="line-chart" height="200"></canvas>
</div>

<div class="graph">
                  <h4 class="card-title">Satisfaction Chart</h4>
                  <canvas id="satisfaction-chart" height="200"></canvas>
</div>

<div class="card-body">
    <h4 class="card-title">Speakers</h4>
    <div class="table-responsive">
    <table class="table">
        <thead>
        <tr>
            <th>
            Name
            </th>
            <th>
            Subject
            </th>
            <th>
            Status
            </th>
            <th>
            Next Talk
            </th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="py-1">
            <img src="images/faces/nelson.jpg" class="mr-2" alt="image">
            Nelson Gregório
            </td>
            <td>
            Git - The basics
            </td>
            <td>
            <label class="badge badge-gradient-success">FREE</label>
            </td>
            <td>
            Dec 5, 2019
            </td>
        </tr>
        <tr>
            <td class="py-1">
            <img src="images/faces/face2.jpg" class="mr-2" alt="image">
            Stella Donelly
            </td>
            <td>
            Polyrhythms and math
            </td>
            <td>
            <label class="badge badge-gradient-warning">IN PROGRESS</label>
            </td>
            <td>
            Dec 12, 2019
            </td>
        </tr>
        <tr>
            <td class="py-1">
            <img src="images/faces/face3.jpg" class="mr-2" alt="image">
            Marina Michel
            </td>
            <td>
            Marine biology and JavaScript
            </td>
            <td>
            <label class="badge badge-gradient-secondary">UNAVAILABLE</label>
            </td>
            <td>
            Dec 16, 2019
            </td>
        </tr>
        <tr>
            <td class="py-1">
            <img src="images/faces/face4.jpg" class="mr-2" alt="image">
            John Doe
            </td>
            <td>
            The perks of anonimity
            </td>
            <td>
            <label class="badge badge-gradient-success">FREE</label>
            </td>
            <td>
            Dec 3, 2019
            </td>
        </tr>
        </tbody>
    </table>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>
<script>
    new Chart(document.getElementById("line-chart"), {
        type: 'line',
        data: {
                labels: [0, 2, 4, 6, 8, 10, 12, 14, 16, 18, 20, 22, 24, 26, 28, 30, 32, 34, 36, 38, 40, 42, 44, 48, 50, 52, 54, 56, 58, 60],
                datasets: [{ 
                    data: [0, 20, 40, 60, 80, 107, 113, 117, 122, 126, 129, 131, 133, 135, 135, 136, 136, 136, 135, 135, 135, 134, 134, 135, 135, 136, 138, 139, 141, 143],
                    label: "B301",
                    borderColor: "#3e95cd",
                    fill: false
                }
                // { 
                //     data: [0,0,20,30,30,34,44,50,20,0],
                //     label: "B302",
                //     borderColor: "#3fb26d",
                //     fill: false
                // }
            ]
        },
        options: {
            title: {
            display: true,
            text: 'People in the rooms'
            }
        }
    });


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

