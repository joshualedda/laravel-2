@extends('layouts.includes.index')
@section('content')
    <div class="pagetitle">
        <h1>Dashboard</h1>
    </div>


        <div class="row">
            <livewire:dashboard>
        </div>




        <div class="row justify-content-start">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-body">
                        <div class="row justify-content-start">
                            <div class="col-md-4 mb-3">
                                @if (Auth::user()->role === 1 || Auth::user()->role === 0)
                                    <label for="selectedSources" class="form-label">Recipient</label>
                                    <select id="selectedSources" name="selectedSources" class="form-select form-select-sm mb-3">
                                        <option selected value="all">Select below...</option>
                                        @foreach ($fundSources as $source)
                                            <option value="{{ $source->id }}">{{ $source->name }}</option>
                                        @endforeach
                                    </select>
                                @else
                                    <label for="selectedType" class="form-label">Scholarship Type</label>
                                    <select id="selectedType" name="selectedType" class="form-select form-select-sm mb-3">
                                        <option selected>Select below...</option>
                                        <option value="0">Government</option>
                                        <option value="1">Private</option>
                                    </select>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <label for="selectedYear" class="form-label">Select Year</label>
                                <select id="selectedYear" name="selectedYear" class="form-select form-select-sm">
                                    <option selected value="all">Select below...</option>
                                    @foreach ($years as $year)
                                        <option value="{{ $year->school_year }}">{{ $year->school_year }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div >
                            <div class="col-md-10">
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>



















    </section>

<script>

    $(document).ready(function() {
        $('#selectedSources, #selectedYear').change(function() {
            updateChart();
        });

        function updateChart() {
            var selectedSources = $('#selectedSources').val();
            var selectedYear = $('#selectedYear').val();

            // Check if no source is selected, then set selectedSources to an empty string
            if (selectedSources === "") {
                selectedSources = "all"; // Set to some identifier to indicate all sources
            }

            $.ajax({
                url: '/filter-data',
                type: 'GET',
                data: {
                    selectedSources: selectedSources,
                    selectedYear: selectedYear
                },
                dataType: 'json',
                success: function(response) {
                    console.log('Received data:', response);
                    var allLabels = response.labels;
                    var data = response.data ? response.data : [];

                    // Update chart data
                    myChart.data.labels = allLabels;
                    myChart.data.datasets[0].data = data;

                    // Update chart
                    myChart.update();
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error in Ajax request:', textStatus, errorThrown);
                }
            });
        }

        // Initialize the chart with an empty labels array and zero data
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: [], // Initially empty labels array
                datasets: [{
                    label: 'Student Count',
                    data: [], // Initially empty data array
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(255, 159, 64, 0.2)',
                        'rgba(255, 205, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        // ... (more colors if needed)
                    ],
                    borderColor: [
                        'rgb(255, 99, 132)',
                        'rgb(255, 159, 64)',
                        'rgb(255, 205, 86)',
                        'rgb(75, 192, 192)',
                        // ... (more colors if needed)
                    ],
                    borderWidth: 2
                }]
            },
            options: {
                scales: {
                    responsive: true,
                    x: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Trigger change event to update the chart when the page is loaded
        $('#selectedSources').change();
    });
</script>


@endsection
