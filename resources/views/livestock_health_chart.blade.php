
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LiveStock Health Chart</title>
    <!-- Include Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div style="width: 80%; margin: auto;">
        <canvas id="healthChart"></canvas>
    </div>

    <script>
        // Get data from the PHP variables passed to the view
        var timestamps = <?php echo json_encode($timestamps); ?>;
        var datasets = <?php echo json_encode($datasets); ?>;
  
        // Create the line chart
  var ctx = document.getElementById('healthChart').getContext('2d');
        var healthChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: timestamps,
                datasets: datasets,
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                title: {
                    display: true,
                    text: 'LiveStock Health Chart',
                },
                scales: {
                    x: {
                        type: 'category',
                        labels: timestamps,
                        title: {
                            display: true,
                            text: 'Date',
                        },
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Count',
                        },
                    },
                },
            },
        });
    </script>
</body>
</html>