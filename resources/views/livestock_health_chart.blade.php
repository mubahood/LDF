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
        <label for="dateFilter">Filter by Date:</label>
        <select id="dateFilter" onchange="updateChart()">
            <option value="all">All Dates</option>
            @foreach ($timestamps as $timestamp)
                <option value="{{ $timestamp }}">{{ $timestamp }}</option>
            @endforeach
        </select>

        <label for="statusFilter">Filter by Status:</label>
        <select id="statusFilter" onchange="updateChart()">
            <option value="all">All Statuses</option>
            @foreach ($datasets as $dataset)
        <option value="{{ $dataset['label'] }}">{{ $dataset['label'] }}</option>
    @endforeach
        </select>

        <canvas id="healthChart"></canvas>
    </div>

    <script>
        // Get data from the PHP variables passed to the view
        var timestamps = <?php echo json_encode($timestamps); ?>;
        var datasets = <?php echo json_encode($datasets); ?>;

   // Create the initial line chart
   var ctx = document.getElementById('healthChart').getContext('2d');
    var healthChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: timestamps,
            datasets: datasets,
        },
        options: {
            responsive: true,
            maintainAspectRatio: true,
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
// Function to update the chart based on the selected filters
// Function to update the chart based on the selected filters
function updateChart() {
    var dateFilter = document.getElementById('dateFilter').value;
    var statusFilter = document.getElementById('statusFilter').value;

    // Filter timestamps
    var filteredTimestamps = timestamps.filter(function (timestamp, index) {
        return dateFilter === 'all' || timestamp === dateFilter;
    });

    // Filter datasets based on the selected options
    var filteredDatasets = datasets.map(function (dataset) {
        return {
            label: dataset.label,
            data: dataset.data.filter(function (_, index) {
                return (dateFilter === 'all' || timestamps[index] === dateFilter) &&
                    (statusFilter === 'all' || dataset.label === statusFilter);
            }),
            fill: false,
        };
    });

    // Update the existing chart with the filtered data and options
    healthChart.data.labels = filteredTimestamps;
    healthChart.data.datasets = filteredDatasets;
    healthChart.options.scales.x.labels = filteredTimestamps;
    healthChart.update();
}



    </script>
</body>
</html>
