@extends('admin/core/main')
@extends('admin/core/navbar')
@extends('admin/core/footer')

@section('title', 'Dashboard - Dashboard MOOC')
@section('page-title', 'Dashboard')
@section('page-subtitle', $nama_course)

@section('css')
<!--===============================================================================================-->
    <link rel="stylesheet" href="{{ url('assets/admin/css/app.css') }}">
    <link href="{{ asset('/vendors/datatables/jquery.dataTables.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="https://cdn.datatables.net/buttons/1.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
<!--===============================================================================================-->
@endsection

@section('konten')

    <div class="row mb-3">
        <div class="col-12 col-md-4">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3 d-flex justify-content-between'>
                            <h3 class='card-title'>TOTAL TEACHER</h3>
                            <div class="card-right d-flex align-items-center">
                                <p>{{ $jumlah['teacher']['unair'] + $jumlah['teacher']['luar'] }}</p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="canvas2" style="height:100px !important"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3 d-flex justify-content-between'>
                            <h3 class='card-title'>TOTAL STUDENT</h3>
                            <div class="card-right d-flex align-items-center">
                                <p>{{ $jumlah['student']['unair'] + $jumlah['student']['luar'] }}</p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="canvas3" style="height:100px !important"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-4">
            <div class="card card-statistic">
                <div class="card-body p-0">
                    <div class="d-flex flex-column">
                        <div class='px-3 py-3 d-flex justify-content-between'>
                            <h3 class='card-title'>TOTAL ACTIVITY</h3>
                            <div class="card-right d-flex align-items-center">
                                <p>{{ $jumlah['views']['guest'] + $jumlah['views']['participant'] }}</p>
                            </div>
                        </div>
                        <div class="chart-wrapper">
                            <canvas id="canvas4" style="height:100px !important"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row mb-4">
        <div class="col-md-7">
            <div class="card">
                <div class="card-header">
                    <h3 class='card-heading p-1 pl-3'>Log Aktifitas {{date('Y')}}</h3>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="pl-3">
                                <h3 class='mt-5'>Total</h3>
                                <h4 class='pb-4'>{{$total_views_bulanan}}</h4>
                                <p class='text-xs'>
                                    @if ($persentase_views_bulanan >= 0)
                                        <span class="text-green"><i data-feather="bar-chart" width="15">
                                    @else     
                                        <span class="text-red"><i data-feather="bar-chart-2" width="15">
                                    @endif
                                    </i> {{ $persentase_views_bulanan }}%</span> than last month</p>
                                <div class="legends">
                                    <div class="legend d-flex flex-row align-items-center">
                                        <div class='w-3 h-3 rounded-full bg-info mr-2'></div><span class='text-xs'>Last Month</span>
                                    </div>
                                    <div class="legend d-flex flex-row align-items-center">
                                        <div class='w-3 h-3 rounded-full bg-blue mr-2'></div><span class='text-xs'>Current Month</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8 col-12">
                            <canvas id="bar"></canvas>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Aktifitas Terbanyak</h4>
                    <div class="d-flex ">
                    </div>
                </div>
                <div class="card-body px-3 pb-3">
                    <div class="table-responsive">
                      <table id='tabel_aktifitas' width='100%' border="1" class='table table-striped' style='border-collapse: collapse;'>
                        <thead>
                          <tr>
                            <th scope="col">Nama</th>
                            <th scope="col">Jumlah Aktifitas</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Log Aktifitas</h4>
                    <div class="d-flex ">
                    </div>
                </div>
                <div class="card-body px-3 pb-3">
                    <div class="table-responsive">
                      <table id='tabel_logs' width='100%' border="1" class='table table-striped' style='border-collapse: collapse;'>
                        <thead>
                          <tr>
                            <th scope="col">Time</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Aktifitas</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Log Progress</h4>
                    <div class="d-flex ">
                    </div>
                </div>
                <div class="card-body px-3 pb-3">
                    <div class="table-responsive">
                      <table id='tabel_progress' width='100%' border="1" class='table table-striped' style='border-collapse: collapse;'>
                        <thead>
                          <tr>
                            <th scope="col">Time</th>
                            <th scope="col">Nama</th>
                            <th scope="col">Materi</th>
                            <th scope="col">Progress</th>
                          </tr>
                        </thead>
                      </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card ">
                <div class="card-header">
                    <h4>Keaktifan</h4>
                </div>
                <div class="card-body">
                    <div id="radialBars"></div>
                </div>
                <div class="card-body px-0 py-1">
                    <table class='table table-borderless'>
                        <tr>
                            <td class='col-3'>Teacher</td>
                            <td class='col-6'>
                                <div class="progress progress-success mt-4">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $persentase_keaktifan_teacher }}%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="text-center">{{ 
                                  $keaktifan['teacher']['aktif']." / ".
                                  ($keaktifan['teacher']['aktif']+$keaktifan['teacher']['nonaktif'])
                                }}</div>
                            </td>
                            <td class='col-3 text-center'>{{ round($persentase_keaktifan_teacher, 2) }}%</td>
                        </tr>
                        <tr>
                            <td class='col-3'>Student</td>
                            <td class='col-6'>
                                <div class="progress progress-warning mt-4">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $persentase_keaktifan_student }}%" aria-valuenow="0"
                                        aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                <div class="text-center">{{ 
                                  $keaktifan['student']['aktif']." / ".
                                  ($keaktifan['student']['aktif']+$keaktifan['student']['nonaktif'])
                                }}</div>
                            </td>
                            <td class='col-3 text-center'>{{ round($persentase_keaktifan_student, 2) }}%</td>
                        </tr>
                    </table>
                </div>
            </div>
            <div class="card ">
              <div class="card-header">
                  <h4>Teacher</h4>
              </div>
              <div class="card-body  px-3 pb-3">
                <table id='tabel_teacher' width='100%' border="1" class='table table-striped' style='border-collapse: collapse;'>
                  <thead>
                    <tr>
                      <th scope="col">Nama</th>
                      <th scope="col">Universitas</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
            <div class="card ">
              <div class="card-header">
                  <h4>Student</h4>
              </div>
              <div class="card-body  px-3 pb-3">
                <table id='tabel_student' width='100%' border="1" class='table table-striped' style='border-collapse: collapse;'>
                  <thead>
                    <tr>
                      <th scope="col">Nama</th>
                      <th scope="col">Universitas</th>
                      <th scope="col">Status</th>
                    </tr>
                  </thead>
                </table>
              </div>
            </div>
        </div>
    </div>

@endsection

@section('js_asset')
    <!-- Datatable -->
    <script src="{{ asset('/vendors/datatables/jquery.dataTables.min.js') }}"></script>
    
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/2.5.0/jszip.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/pdfmake.min.js"></script>
    <script src="https://cdn.rawgit.com/bpampuch/pdfmake/0.1.18/build/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.2.2/js/buttons.print.min.js"></script>
    <script>
      $(document).ready(function(){
        $('#tabel_aktifitas').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('course/data/get_course_topactivity/'.$id_course) }}",
            columns: [
                { data: 'nama' },
                { data: 'countviews' },
            ],
            order: [[ 1, 'desc' ]],
            dom: 'Bfrtip',
            lengthMenu: [
                [ 5, 25, 50, 100 ],
                [ '5 rows', '25 rows', '50 rows', '100 rows' ]
            ],
            buttons: [
                'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
        $('#tabel_logs').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('course/data/get_course_logs/'.$id_course) }}",
            columns: [
                { data: 'time' },
                { data: 'nama' },
                { data: 'aktifitas' },
            ],
            order: [[ 0, 'desc' ]],
            dom: 'Bfrtip',
            lengthMenu: [
                [ 5, 25, 50, 100 ],
                [ '5 rows', '25 rows', '50 rows', '100 rows' ]
            ],
            buttons: [
                'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
        $('#tabel_progress').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('course/data/get_course_progress/'.$id_course) }}",
            columns: [
                { data: 'time' },
                { data: 'nama' },
                { data: 'activity_name' },
                { data: 'progress' },
            ],
            order: [[ 0, 'desc' ]],
            dom: 'Bfrtip',
            lengthMenu: [
                [ 5, 25, 50, 100 ],
                [ '5 rows', '25 rows', '50 rows', '100 rows' ]
            ],
            buttons: [
                'pageLength','copy', 'csv', 'excel', 'pdf', 'print'
            ],
        });
        $('#tabel_teacher').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{ url('teacher/data/listpercourse/'.$id_course) }}",
         columns: [
            { data: 'nama' },
            { data: 'univ' },
            { data: 'status' },
         ],
         dom: 'Bfrtip',
         lengthMenu: [
            [ 10, 25, 50, 100 , -1],
            [ '10 rows', '25 rows', '50 rows', '100 rows', 'all']
         ],
         buttons: [
            'pageLength','csv', 'excel', 'pdf', 'print'
         ],
        });
        $('#tabel_student').DataTable({
         processing: true,
         serverSide: true,
         ajax: "{{ url('student/data/listpercourse/'.$id_course) }}",
         columns: [
            { data: 'nama' },
            { data: 'univ' },
            { data: 'status' },
         ],
         dom: 'Bfrtip',
         lengthMenu: [
            [ 10, 25, 50, 100 , -1],
            [ '10 rows', '25 rows', '50 rows', '100 rows', 'all']
         ],
         buttons: [
            'pageLength','csv', 'excel', 'pdf', 'print'
         ],
        });
    });
    </script>
@endsection

@section('js_script')
<script>
        
var chartColors = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  info: '#41B1F9',
  blue: '#3245D1',
  purple: 'rgb(153, 102, 255)',
  grey: '#EBEFF6'
};

var config2 = {
  type: "doughnut",
  data: {
    labels: ["UNAIR", "LUAR UNAIR"],
    datasets: [
      {
        label: "Orders",
        borderColor: "#fff",
        data: [{{ $jumlah['teacher']['unair'].', '.$jumlah['teacher']['luar'] }}],
        fill: false,
        pointBorderWidth: 100,
        pointBorderColor: "transparent",
        backgroundColor: ['#5A8DEE', '#FF5B5C'],
        pointRadius: 3,
        pointBackgroundColor: "transparent",
        pointHoverBackgroundColor: "rgba(63,82,227,1)",
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: -10,
        top: 10,
      },
    },
    legend: {
      display: false,
    },
    title: {
      display: false,
      text: "Chart.js Line Chart",
    },
    tooltips: {
      mode: "index",
      intersect: false,
    },
    hover: {
      mode: "nearest",
      intersect: true,
    },
    scales: {
      xAxes: [
        {
          gridLines: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false,
          },
        },
      ],
      yAxes: [
        {
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            display: false,
          },
        },
      ],
    },
  },
};
var config3 = {
  type: "doughnut",
  data: {
    labels: ["UNAIR", "LUAR UNAIR"],
    datasets: [
      {
        label: "Orders",
        borderColor: "#fff",
        data: [{{ $jumlah['student']['unair'].', '.$jumlah['student']['luar'] }}],
        fill: false,
        pointBorderWidth: 100,
        pointBorderColor: "transparent",
        backgroundColor: ['#5A8DEE', '#FF5B5C'],
        pointRadius: 3,
        pointBackgroundColor: "transparent",
        pointHoverBackgroundColor: "rgba(63,82,227,1)",
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: -10,
        top: 10,
      },
    },
    legend: {
      display: false,
    },
    title: {
      display: false,
      text: "Chart.js Line Chart",
    },
    tooltips: {
      mode: "index",
      intersect: false,
    },
    hover: {
      mode: "nearest",
      intersect: true,
    },
    scales: {
      xAxes: [
        {
          gridLines: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false,
          },
        },
      ],
      yAxes: [
        {
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            display: false,
          },
        },
      ],
    },
  },
};
var config4 = {
  type: "doughnut",
  data: {
    labels: ["PARTICIPANT", "GUEST"],
    datasets: [
      {
        label: "Orders",
        borderColor: "#fff",
        data: [{{ $jumlah['views']['participant'].', '.$jumlah['views']['guest'] }}],
        fill: false,
        pointBorderWidth: 100,
        pointBorderColor: "transparent",
        backgroundColor: ['#5A8DEE', '#FF5B5C'],
        pointRadius: 3,
        pointBackgroundColor: "transparent",
        pointHoverBackgroundColor: "rgba(63,82,227,1)",
      },
    ],
  },
  options: {
    responsive: true,
    maintainAspectRatio: false,
    layout: {
      padding: {
        left: -10,
        top: 10,
      },
    },
    legend: {
      display: false,
    },
    title: {
      display: false,
      text: "Chart.js Line Chart",
    },
    tooltips: {
      mode: "index",
      intersect: false,
    },
    hover: {
      mode: "nearest",
      intersect: true,
    },
    scales: {
      xAxes: [
        {
          gridLines: {
            drawBorder: false,
            display: false,
          },
          ticks: {
            display: false,
          },
        },
      ],
      yAxes: [
        {
          gridLines: {
            display: false,
            drawBorder: false,
          },
          ticks: {
            display: false,
          },
        },
      ],
    },
  },
};

var randomScalingFactor = function() {
  return (Math.random() > 0.5 ? 1.0 : 1.0) * Math.round(Math.random() * 100);
};

// draws a rectangle with a rounded top
Chart.helpers.drawRoundedTopRectangle = function(ctx, x, y, width, height, radius) {
  ctx.beginPath();
  ctx.moveTo(x + radius, y);
  // top right corner
  ctx.lineTo(x + width - radius, y);
  ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
  // bottom right	corner
  ctx.lineTo(x + width, y + height);
  // bottom left corner
  ctx.lineTo(x, y + height);
  // top left	
  ctx.lineTo(x, y + radius);
  ctx.quadraticCurveTo(x, y, x + radius, y);
  ctx.closePath();
};

Chart.elements.RoundedTopRectangle = Chart.elements.Rectangle.extend({
  draw: function() {
    var ctx = this._chart.ctx;
    var vm = this._view;
    var left, right, top, bottom, signX, signY, borderSkipped;
    var borderWidth = vm.borderWidth;

    if (!vm.horizontal) {
      // bar
      left = vm.x - vm.width / 2;
      right = vm.x + vm.width / 2;
      top = vm.y;
      bottom = vm.base;
      signX = 1;
      signY = bottom > top? 1: -1;
      borderSkipped = vm.borderSkipped || 'bottom';
    } else {
      // horizontal bar
      left = vm.base;
      right = vm.x;
      top = vm.y - vm.height / 2;
      bottom = vm.y + vm.height / 2;
      signX = right > left? 1: -1;
      signY = 1;
      borderSkipped = vm.borderSkipped || 'left';
    }

    // Canvas doesn't allow us to stroke inside the width so we can
    // adjust the sizes to fit if we're setting a stroke on the line
    if (borderWidth) {
      // borderWidth shold be less than bar width and bar height.
      var barSize = Math.min(Math.abs(left - right), Math.abs(top - bottom));
      borderWidth = borderWidth > barSize? barSize: borderWidth;
      var halfStroke = borderWidth / 2;
      // Adjust borderWidth when bar top position is near vm.base(zero).
      var borderLeft = left + (borderSkipped !== 'left'? halfStroke * signX: 0);
      var borderRight = right + (borderSkipped !== 'right'? -halfStroke * signX: 0);
      var borderTop = top + (borderSkipped !== 'top'? halfStroke * signY: 0);
      var borderBottom = bottom + (borderSkipped !== 'bottom'? -halfStroke * signY: 0);
      // not become a vertical line?
      if (borderLeft !== borderRight) {
        top = borderTop;
        bottom = borderBottom;
      }
      // not become a horizontal line?
      if (borderTop !== borderBottom) {
        left = borderLeft;
        right = borderRight;
      }
    }

    // calculate the bar width and roundess
    var barWidth = Math.abs(left - right);
    var roundness = this._chart.config.options.barRoundness || 0.5;
    var radius = barWidth * roundness * 0.5;
    
    // keep track of the original top of the bar
    var prevTop = top;
    
    // move the top down so there is room to draw the rounded top
    top = prevTop + radius;
    var barRadius = top - prevTop;

    ctx.beginPath();
    ctx.fillStyle = vm.backgroundColor;
    ctx.strokeStyle = vm.borderColor;
    ctx.lineWidth = borderWidth;

    // draw the rounded top rectangle
    Chart.helpers.drawRoundedTopRectangle(ctx, left, (top - barRadius + 1), barWidth, bottom - prevTop, barRadius);

    ctx.fill();
    if (borderWidth) {
      ctx.stroke();
    }

    // restore the original top value so tooltips and scales still work
    top = prevTop;
  },
});

Chart.defaults.roundedBar = Chart.helpers.clone(Chart.defaults.bar);

Chart.controllers.roundedBar = Chart.controllers.bar.extend({
  dataElementType: Chart.elements.RoundedTopRectangle
});

var ctxBar = document.getElementById("bar").getContext("2d");
var myBar = new Chart(ctxBar, {
  type: 'bar',
  data: {
    labels: ["Jan", "Feb", "Mar", "Apr", "Mei", "Jun", "Jul", 'Ags', 'Sep', 'Okt', 'Nov', 'Des'],
    datasets: [{
      label: 'Akses',
      backgroundColor: [
                @php
                    $i = 1
                @endphp
                @foreach ($views_bulanan as $key => $value)
                    @if ($i == date('m'))
                        chartColors.blue,
                    @elseif ($i+1 == date('m'))
                        chartColors.info,
                    @else
                        chartColors.grey,
                    @endif
                    @php
                        $i++
                    @endphp
                @endforeach
        ],
      data: [
            @foreach ($views_bulanan as $key => $value)
                "{{ $value }}",
            @endforeach 
        ]
    }]
  },
  options: {
    responsive: true,
    barRoundness: 1,
    title: {
      display: false,
      text: "Chart.js - Bar Chart with Rounded Tops (drawRoundedTopRectangle Method)"
    },
    legend: {
      display:false
    },
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true,
          suggestedMax: 40 + 20,
          padding: 10,
        },
        gridLines: {
          drawBorder: false,
        }
      }],
      xAxes: [{
            gridLines: {
                display:false,
                drawBorder: false
            }
        }]
    }
  }
});
var radialBarsOptions = {
  series: [
        {{round($persentase_keaktifan_teacher, 2)}},
        {{round($persentase_keaktifan_student, 2)}}
    ],
  chart: {
    height: 350,
    type: "radialBar",
  },
  backgroundColor: ['#00CFDD', '#5A8DEE'],
  plotOptions: {
    radialBar: {
      dataLabels: {
        name: {
          offsetY: -15,
          fontSize: "22px",
        },
        value: {
          fontSize: "2.5rem",
        },
        total: {
          show: true,
          label: "Keaktifan Course",
          color: "#475F7B",
          fontSize: "16px",
          formatter: function(w) {
            // By default this function returns the average of all series. The below is just an example to show the use of custom formatter function
            return "{{ round($persentase_keaktifan_total, 2) }}%";
          },
        },
      },
    },
  },
  labels: ["Teacher", "Student"],
};
var radialBars = new ApexCharts(document.querySelector("#radialBars"), radialBarsOptions);
radialBars.render();
let ctx2 = document.getElementById("canvas2").getContext("2d");
let ctx3 = document.getElementById("canvas3").getContext("2d");
let ctx4 = document.getElementById("canvas4").getContext("2d");
var lineChart2 = new Chart(ctx2, config2);
var lineChart3 = new Chart(ctx3, config3);
var lineChart4 = new Chart(ctx4, config4);

</script>
@endsection