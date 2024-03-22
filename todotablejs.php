<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DataTables Example</title>
    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Include DataTables library -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>

    <table id="example" class="display" style="width:100%">
    </table>

    <div style="width: 500px;">
        <canvas id='chart'></canvas>
    </div>

    <script>
        var xhr = new XMLHttpRequest();
        xhr.open("GET", "fetchtodos.php", true);
        xhr.onload = function () {
            if (xhr.status === 200) {
                var data = JSON.parse(xhr.responseText);
                console.log(data); // Use your fetched data here
                $("#example").DataTable({
                    columns: [{
                            title: "ID",
                            data: "id"
                        },
                        {
                            title: "Title",
                            data: "title"
                        },
                        {
                            title: "Description",
                            data: "description"
                        },
                        {
                            title: "Assigned_to",
                            data: "assigned_to"
                        },
                        {
                            title: "Status",
                            data: "status"
                        },
                    ],
                    data: data,
                });
            } else {
                console.log("Request failed. Status: " + xhr.status);
            }
        };
        xhr.send();


        (async function () {
            const data = [{
                    year: 2010,
                    count: 10
                },
                {
                    year: 2011,
                    count: 20
                },
                {
                    year: 2012,
                    count: 15
                },
                {
                    year: 2013,
                    count: 25
                },
                {
                    year: 2014,
                    count: 22
                },
                {
                    year: 2015,
                    count: 30
                },
                {
                    year: 2016,
                    count: 28
                },
            ];

            new Chart(
                document.getElementById('chart'), {
                    type: 'bar',
                    data: {
                        labels: data.map(row => row.year),
                        datasets: [{
                            label: 'Acquisitions by year',
                            data: data.map(row => row.count)
                        }]
                    }
                }
            );
        })();
    </script>
</body>

</html>