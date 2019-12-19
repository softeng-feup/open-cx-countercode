<div id="chart_area">
    <canvas width="500px" height="400px">
<div>

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