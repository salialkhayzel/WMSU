<!-- Include Bootstrap CSS  for dashboard -->
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">

<!-- Include Chart.js library  dashboard-->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>


<style>
    .chart-container {
        display: inline-block;
        margin-right: 10px;
    }
</style>

<div>
    <x-loading-indicator/>
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin-dashboard') }}">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div>
        <!-- Insert Section -->
        
        <div class="container">
            <div class="row">
            <div class="col-sm-4">
                <!-- Total CET examinee Chart -->
                <div class="card rounded-4 border-0 shadow text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Total Applicants</h6>
                    </div>
                    <div class="chart-container">
                        <canvas id="cet-chart"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <!-- Total Appointments Chart -->
                <div class="card rounded-4 border-0 shadow text-center rounded p-4">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h6 class="mb-0">Total Appointments</h6>
                    </div>
                    <div class="chart-container">
                        <canvas id="appointments-chart"></canvas>
                    </div>
                </div>
            </div>
        </div>


            <br>

          <!-- Total Test Takers Chart -->
          <div class="row g-4">
              <div class="col-sm-12 col-xl-8">
                  <div class="card rounded-4 border-0 shadow text-center rounded p-4">
                      <div class="d-flex align-items-center justify-content-between mb-4">
                          <h6 class="mb-0">Total Test Takers</h6>
                      </div>
                      <div class="chart-container">
                          <canvas id="test-takers-chart"></canvas>
                      </div>
                  </div>
              </div>
              <div class="col-sm-12 col-xl-4">
                  <div class="card rounded-4 border-0 shadow rounded h-100 p-4">
                      <h6 class="mb-4">Accounts</h6>
                      <div class="chart-container">
                          <canvas id="pie-chart"></canvas>
                      </div>
                  </div>
              </div>
          </div>

          <br>

          <!-- Status of Examinations and Recent Exam Applicants Charts -->
          <div class="row g-4">
              <div class="col-sm-12 col-xl-5">
                  <div class="card rounded-4 border-0 shadow h-100 p-4">
                      <h6 class="mb-4">Status of Examinations</h6>
                      <div class="chart-container">
                          <canvas id="examinations-doughnut-chart"></canvas>
                      </div>
                  </div>
              </div>
              <div class="col-xl-7">
                  <div class="col-sm-12 col-xl-auto pb-3">
                      <div class="card rounded-4 border-0 shadow p-4 w-100">
                          <h6 class="mb-4">Recent Exam Applicants</h6>
                          <!-- Your PHP code for displaying recent exam applicants here -->
                      </div>
                  </div>
                  <div class="col-sm-12 col-xl-auto">
                      <div class="card rounded-4 border-0 shadow p-4 w-100">
                          <div class="d-flex align-items-center justify-content-between mb-4">
                              <h6 class="mb-0">Total Appointments For this Week</h6>
                              <?php if(isset($this->total_appointments_this_week[0])): ?>
                                <span><?php echo e(date_format(date_create($this->total_appointments_this_week[0]->date),"F d, Y ")); ?> - <?php echo e(date_format(date_create($this->total_appointments_this_week[count($this->total_appointments_this_week) - 1]->date),"F d, Y ")); ?></span>
                            <?php endif; ?>

                          </div>
                          <div class="chart-container">
                              <canvas id="appointments-bar-chart"></canvas>
                          </div>
                      </div>
                  </div>
              </div>
          </div>


        <!-- End Inserted Section -->
    </main><!-- End #main -->

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>
</div>

<!-- SCRIPT FOR CHART 1 -->
<script>
        // Data for Total Applicants
        const totalApplicantsData = {
            labels: [ 
        @foreach($total_applicants as $key =>$value)
            @if($loop->last)
                '{{$value->test_type_name}}'
            @else
                '{{$value->test_type_name}}',
            @endif
        @endforeach ],
            datasets: [{
                label: 'Total Applicants',
                data: [
                    @foreach($total_applicants as $key =>$value)
                        @if($loop->last)
                           {{$value->count}}
                        @else
                            {{$value->count}},
                        @endif
                    @endforeach
                ],
                backgroundColor: [
                    @foreach($total_applicants as $key =>$value)
                        @if($loop->last)
                            'rgba({{rand(10,255)}},{{rand(10,255)}}, {{rand(10,255)}},0.7)'
                        @else
                            'rgba({{rand(10,255)}},{{rand(10,255)}}, {{rand(10,255)}},0.7)',
                        @endif
                    @endforeach
                ],
            }]
        };

        // Data for Total Appointments
        const totalAppointmentsData = {
            labels: [
                @foreach($total_appointments as $key =>$value)
                    @if($loop->last)
                        '{{$value->status_details}}'
                    @else
                        '{{$value->status_details}}',
                    @endif
                @endforeach
            ],
            datasets: [{
                label: 'Total Appointments',
                data: [
                    @foreach($total_appointments as $key =>$value)
                        @if($loop->last)
                           {{$value->count}}
                        @else
                            {{$value->count}},
                        @endif
                    @endforeach
                ],
                backgroundColor: [
                    @foreach($total_appointments as $key =>$value)
                        @if($loop->last)
                            'rgba({{rand(10,255)}},{{rand(10,255)}}, {{rand(10,255)}},0.7)'
                        @else
                            'rgba({{rand(10,255)}},{{rand(10,255)}}, {{rand(10,255)}},0.7)',
                        @endif
                    @endforeach
                ],
            }]
        };

        // Create Total Applicants Chart
        const cetChartCanvas = document.getElementById('cet-chart');
        const cetChart = new Chart(cetChartCanvas, {
            type: 'bar',
            data: totalApplicantsData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Create Total Appointments Chart
        const appointmentsChartCanvas = document.getElementById('appointments-chart');
        const appointmentsChart = new Chart(appointmentsChartCanvas, {
            type: 'bar',
            data: totalAppointmentsData,
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>





<script>

// <!-- SCRIPT FOR CHART 2 -->
    var testTakersData = {
        labels: [
            @foreach($total_test_takers as $key =>$value)
                @if($loop->last)
                    '{{$value->test_type_name}}'
                @else
                    '{{$value->test_type_name}}',
                @endif
            @endforeach
        ],
        datasets: [
            {
                label: ["@if(count($total_test_takers)>0){{$total_test_takers[0]->test_type_name}}@endif"],
                data: [
                    @foreach($total_test_takers as $key =>$value)
                        @if($loop->last)
                           {{$value->count}}
                        @else
                            {{$value->count}},
                        @endif
                    @endforeach
                ], // Replace with actual data
                backgroundColor: [
                    @foreach($total_test_takers as $key =>$value)
                        @if($loop->last)
                            'rgba({{rand(10,255)}},{{rand(10,255)}}, {{rand(10,255)}},0.7)'
                        @else
                            'rgba({{rand(10,255)}},{{rand(10,255)}}, {{rand(10,255)}},0.7)',
                        @endif
                    @endforeach
                ],
            },
        ],
    };

    var testTakersChart = new Chart(document.getElementById("test-takers-chart").getContext("2d"), {
        type: "bar",
        data: testTakersData,
    });

    <!-- Accounts Pie Chart data -->
    var accountsData = {
        labels: [
            @foreach($total_accounts as $key =>$value)
                @if($loop->last)
                    '{{$value->count}} - {{$value->user_status_details}}'
                @else
                    '{{$value->count}} - {{$value->user_status_details}}',
                @endif
            @endforeach
        ],
        datasets: [
            {
                data: [
                    @foreach($total_accounts as $key =>$value)
                        @if($loop->last)
                           {{$value->count}}
                        @else
                            {{$value->count}},
                        @endif
                    @endforeach
                ], // Replace with actual data
                backgroundColor: [
                    @foreach($total_accounts as $key =>$value)
                        @if($loop->last)
                            'rgba({{rand(10,255)}},{{rand(10,255)}}, {{rand(10,255)}},0.7)'
                        @else
                            'rgba({{rand(10,255)}},{{rand(10,255)}}, {{rand(10,255)}},0.7)',
                        @endif
                    @endforeach
                ],
            },
        ],
    };

    var pieChart = new Chart(document.getElementById("pie-chart").getContext("2d"), {
        type: "pie",
        data: accountsData,
    });
</script>

<!-- SCRIPT FOR CHART 3 -->
<script>
  var examinationsData = {
    labels: [
        @foreach($status_of_applicants as $key =>$value)
            @if($loop->last)
                '{{$value->count}} - {{$value->test_status_details}}'
            @else
                '{{$value->count}} - {{$value->test_status_details}}',
            @endif
        @endforeach
    ],
    datasets: [
        {
            data: [
                @foreach($status_of_applicants as $key =>$value)
                    @if($loop->last)
                        {{$value->count}}
                    @else
                        {{$value->count}},
                    @endif
                @endforeach
            ], // Replace with actual data
            backgroundColor: [
                @foreach($status_of_applicants as $key =>$value)
                    @if($loop->last)
                        'rgba({{rand(10,255)}},{{rand(10,255)}}, {{rand(10,255)}},0.7)'
                    @else
                        'rgba({{rand(10,255)}},{{rand(10,255)}}, {{rand(10,255)}},0.7)',
                    @endif
                @endforeach
            ],
        },
    ],
  };

  var examinationsDoughnutChart = new Chart(document.getElementById("examinations-doughnut-chart").getContext("2d"), {
      type: "doughnut",
      data: examinationsData,
  });

  <!-- Bar Chart data for Total Appointments -->
  var appointmentsData = {
    labels: [
        @foreach($total_appointments_this_week as $key =>$value)
            @if($loop->last)
                "{{date_format(date_create($value->date),"F d, Y")}}"
            @else
                "{{date_format(date_create($value->date),"F d, Y")}}",
            @endif
        @endforeach
    ],
    datasets: [
        {
            label: ["@if(count($total_appointments_this_week)>0){{date_format(date_create($total_appointments_this_week[0]->date),"F d, Y")}}@endif"],
            data: [
                @foreach($total_appointments_this_week as $key =>$value)
                    @if($loop->last)
                        {{$value->count}}
                    @else
                        {{$value->count}},
                    @endif
                @endforeach
            ], // Replace with actual data
            backgroundColor: [
                @foreach($total_appointments_this_week as $key =>$value)
                    @if($loop->last)
                        'rgba({{rand(10,255)}},{{rand(10,255)}}, {{rand(10,255)}},0.7)'
                    @else
                        'rgba({{rand(10,255)}},{{rand(10,255)}}, {{rand(10,255)}},0.7)',
                    @endif
                @endforeach
            ],
        },
    ],
  };

  var appointmentsBarChart = new Chart(document.getElementById("appointments-bar-chart").getContext("2d"), {
      type: "bar",
      data: appointmentsData,
  });
</script>









