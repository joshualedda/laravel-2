<div>
    <style>
        .link {
            color: black;
            text-decoration: none;
        }

        .link:hover {
            color: blue;
            text-decoration: underline;
        }

        .card-body {
            max-width: 25rem;
            height: 15rem;
        }
    </style>
    <div class="pagetitle">
        <h1>Dashboard</h1>

    </div>
    {{-- message --}}

    <div id="message" class="alert alert-success" style="display: none; width:50%; margin-top:10px;">
        {{ session('message') }}
    </div>

    <section class="section dashboard">
        <div class="row">
            <!-- Government Scholarships -->
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                    <div class="card-body">
                        <h2 class="font-weight-normal mb-3">
                            <i class="fas fa-graduation-cap fa-2x"></i>
                        </h2>
                        <h4 class="mb-3 mt-4 d-flex align-items-start">
                            <a class="link" href="{{ url('scholarView?scholarship_type=0') }}">
                                <small class="mb-0">Government</small>
                                <span class="option ml-2">Scholarships</span>
                            </a>
                        </h4>
                        <h5 class="card-text fs-4">{{ $government }}</h5>
                    </div>
                </div>
            </div>

            <!-- Private Scholarships -->
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                    <div class="card-body">
                        <h2 class="font-weight-normal mb-3">
                            <i class="fas fa-university fa-2x"></i>
                        </h2>

                        <h4 class="mb-3 mt-4 d-flex align-items-start">
                            <a class="link" href="{{ url('scholarView?scholarship_type=1') }}">
                                <small class="mb-0">Private</small>
                                <span class="option ml-2"> Scholarships</span>
                            </a>
                        </h4>
                        <h5 class="card-text fs-4">{{ $private }}</h5>

                    </div>
                </div>
            </div>

            <!-- Active Scholarship -->
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                    <div class="card-body">
                        <h2 class="font-weight-normal mb-3">
                            <i class="fas fa-check-circle fa-2x"></i>
                        </h2>
                        {{-- {{ url('/admin/settings/addScholar/government') }} --}}
                        <h4 class="mb-3 mt-4 d-flex align-items-start">
                            <a class="link" href="{{ url('scholarView?scholarship_type=0&status=0') }}">
                                <small class="mb-0">Active</small>
                                <span class="option ml-1">
                                    Government Scholarships
                                </span>
                            </a>
                        </h4>
                        <h5 class="card-text fs-4">{{ $governmentActive }}</h5>
                    </div>
                </div>
            </div>

            <!-- Inactive Scholarship -->
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                    <!-- Use an appropriate icon for inactive scholarships -->
                    <div class="card-body">
                        <h2 class="font-weight-normal mb-3">
                            <i class="fas fa-times-circle fa-2x"></i>
                        </h2>

                        <h4 class="mb-3 mt-4 d-flex align-items-start">
                            <a class="link" href="{{ url('scholarView?scholarship_type=1&status=0') }}">
                                <small class="mb-0">Active</small>
                                <span class="option ml-2">Private Scholarships</span>
                            </a>
                        </h4>
                        <h5 class="card-text fs-4">{{ $privateActive }}</h5>
                    </div>
                </div>
            </div>

        </div>

        <div class="row">
            <!-- Government Grantees -->
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                    <div class="card-body">
                        <h2 class="font-weight-normal mb-3">
                            <i class="fas fa-user-graduate fa-2x"></i>
                        </h2>
                        <h4 class="mb-3 mt-4 d-flex align-items-start">
                            <a class="link" href="{{url('viewGrantee?scholarship_type=0')}}">
                                <span class="option"> Government Grantees</span>
                            </a>
                        </h4>
                        <h5 class="card-text fs-4">{{ $governmentStudent }}</h5>
                    </div>
                </div>
            </div>

            <!-- Private Grantees -->
            <div class="col-md-3 stretch-card grid-margin">
                <div class="card bg-gradient-light card-img-holder text-dark shadow-lg">
                    <div class="card-body">
                        <h2 class="font-weight-normal mb-3">
                            <i class="fas fa-users fa-2x"></i>
                        </h2>
                        <h4 class="mb-3 mt-4 d-flex align-items-start">
                            <a class="link" href="{{url('viewGrantee?scholarship_type=1')}}">
                                <span class="option ml-2">Private Grantees</span>
                            </a>
                        </h4>
                        <h5 class="card-text fs-4">{{ $privateStudent }}</h5>
                    </div>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-start">
                <div class="col-md-3">
                    <label for="selectedSources" class="form-label">Recipient</label>
                    <select id="selectedSources" name="selectedSources" wire:model="selectedSources"
                        class="form-select form-select-sm mb-3">
                        <option selected>Select below...</option>
                        @foreach($fundSources as $source)
                        <option value="{{ $source->id }}">{{ $source->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="selectedYear" class="form-label">Select Year</label>
                    <select id="selectedYear" name="selectedYear" wire:model="selectedYear"
                        class="form-select form-select">
                        <option selected>Select below...</option>
                        @foreach($years as $year)
                        <option value="{{ $year }}">{{ $year }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-3">
                    <label for="applyFilters" class="form-label">Filter</label>
                    <button id="applyFilters" class="btn btn-sm btn-primary form-control"
                        wire:click="filterScholarship">Apply
                        Filters</button>
                </div>
            </div>

            {{-- line chart --}}
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <canvas id="myChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>


            <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
            <script>
                document.addEventListener('livewire:init', function () {
        Livewire.on('renderChart', function (data) {
        const ctx = document.getElementById('myChart').getContext('2d');

        const labels = data.labels; // Use directly for labels
        const studentCounts = data.data.map(item => item.student_count);

        const myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels,
                datasets: [{
                    label: 'Student',
                    data: studentCounts,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 205, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(201, 203, 207, 0.2)'
                        ],
                        borderColor: [
                            'rgb(255, 99, 132)',
                            'rgb(255, 159, 64)',
                            'rgb(255, 205, 86)',
                            'rgb(75, 192, 192)',
                            'rgb(54, 162, 235)',
                            'rgb(153, 102, 255)',
                            'rgb(201, 203, 207)'
                        ],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });
        });
    });
            </script>

        </div>
    </section>
</div>
