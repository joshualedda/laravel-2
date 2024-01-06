@extends('layouts.includes.index')
@section('content')
<div class="pagetitle">
    <h1>Dashboard</h1>
</div>


<section class="section dashboard">
    <div class="row">
        {{-- livewire --}}
        <livewire:dashboard>
            {{-- here --}}
    </div>

    <div class="container">
        <div class="row justify-content-start">
            <div class="col-md-3 mb-3">
                @if (Auth::user()->role === 1 || Auth::user()->role === 0)
                <label for="selectedSources" class="form-label">Recipient</label>
                <select id="selectedSources" name="selectedSources" class="form-select form-select-sm mb-3">
                    <option selected>Select below...</option>
                    @foreach($fundSources as $source)
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
            <div class="col-md-3">
                <label for="selectedYear" class="form-label">Select Year</label>
                <select id="selectedYear" name="selectedYear" class="form-select form-select-sm">
                    <option selected>Select below...</option>
                    @foreach($years as $year)
                    <option value="{{ $year->school_year }}">{{ $year->school_year }}</option>
                    @endforeach
                </select>
            </div>
        </div>


        <div style="width: 800px; height:400px; margin-bottom:30px;">
            <canvas id="myChart"></canvas>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <script>
            // Get the canvas element
            const ctx = document.getElementById('myChart').getContext('2d');

            // Access student count data from PHP
            const studentCountData = @json(studentCountByCampus);

            // Chart data
            const data = {
                labels: studentCountData.map(campus => campus.campus_name),
                datasets: [{
                    label: 'Grantees',
                    data: studentCountData.map(campus => campus.student_count),
                    backgroundColor: [
                        '#D1F7BA', // Green
                        '#F7D3D3', // Red
                        '#BDECFD', // Blue
                        '#FBEFD5', // Orange
                         '#33a02c', // Green
                    ],
                    borderColor: [
                        '#33a02c', // Green
                        '#e31a1c', // Red
                        '#1f78b4', // Blue
                        '#ff7f00', // Orange
                    ],
                    borderWidth: 2,
                }]
            };

            // Chart configuration
            const options = {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            };

            // Create Chart.js bar chart
            const myChart = new Chart(ctx, {
                type: 'bar',
                data: data,
                options: options
            });
        </script>
    </div>



</section>

@endsection
