@extends('templates.admin-layout')

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0">Dashboard</h1>
                    </div><!-- /.col -->
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Admin</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @if (session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>Success!</strong> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error!</strong> {{ $errors->first() }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                <h3>{{ $stokBarang }}</h3>

                                <h5>Stok Barang</h5>
                            </div>
                            <div class="icon">
                                <i class="fas fa-box"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>{{ count($kategoriBarang) }}</h3>

                                <h5>Kategori</h5>
                            </div>
                            <div class="icon">
                                <i class="fas fa-cubes"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                <h3>{{ count($dataPermintaan) }}</h3>

                                <h5>Permintaan</h5>
                            </div>
                            <div class="icon">
                                <i class="fas fa-users"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-6">
                        <!-- small box -->
                        <div class="small-box bg-danger">
                            <div class="inner">
                                <h3>{{ count($dataPenerimaan) }}</h3>

                                <h5>Penerimaan</h5>
                            </div>
                            <div class="icon">
                                <i class="fas fa-user"></i>
                            </div>
                            <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
                <!-- Main row -->
                <div class="row">
                    <!-- Left col -->
                    <section class="col-lg-7 connectedSortable">
                        <!-- Custom tabs (Charts with tabs)-->
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">
                                    <i class="fas fa-chart-line mr-1"></i>
                                    Grafik Permintaan dan Penerimaan Barang
                                </h3>
                            </div><!-- /.card-header -->
                            <div class="card-body">
                                <div class="tab-content p-0">
                                    <!-- Morris chart - Sales -->
                                    <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;">
                                        <canvas id="revenue-chart-canvas" height="300" style="height: 300px;"></canvas>
                                    </div>
                                </div>
                            </div><!-- /.card-body -->
                        </div>
                        <!-- /.card -->

                    </section>
                    <!-- /.Left col -->
                    <!-- right col (We are only adding the ID to make the widgets sortable)-->
                    <section class="col-lg-5 connectedSortable">



                        <!-- Calendar -->
                        <div class="card bg-gradient-success">
                            <div class="card-header border-0">

                                <h3 class="card-title">
                                    <i class="far fa-calendar-alt"></i>
                                    Calendar
                                </h3>
                                <!-- tools card -->
                                <div class="card-tools">
                                    <!-- button with a dropdown -->
                                    <div class="btn-group">
                                        <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown" data-offset="-52">
                                            <i class="fas fa-bars"></i>
                                        </button>
                                        <div class="dropdown-menu" role="menu">
                                            <a href="#" class="dropdown-item">Add new event</a>
                                            <a href="#" class="dropdown-item">Clear events</a>
                                            <div class="dropdown-divider"></div>
                                            <a href="#" class="dropdown-item">View calendar</a>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="collapse">
                                        <i class="fas fa-minus"></i>
                                    </button>
                                    <button type="button" class="btn btn-success btn-sm" data-card-widget="remove">
                                        <i class="fas fa-times"></i>
                                    </button>
                                </div>
                                <!-- /. tools -->
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body pt-0">
                                <!--The calendar -->
                                <div id="calendar" style="width: 100%"></div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </section>
                    <!-- right col -->
                </div>
                <!-- /.row (main row) -->
            </div><!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <!-- /.content-wrapper -->
@endsection

@push('scripts')
    <script>
        /*
         * Author: Abdullah A Almsaeed
         * Date: 4 Jan 2014
         * Description:
         *      This is a demo file used only for the main dashboard (index.html)
         **/

        /* global moment:false, Chart:false, Sparkline:false */

        $(document).ready(function() {
            'use strict'

            // Make the dashboard widgets sortable Using jquery UI
            $('.connectedSortable').sortable({
                placeholder: 'sort-highlight',
                connectWith: '.connectedSortable',
                handle: '.card-header, .nav-tabs',
                forcePlaceholderSize: true,
                zIndex: 999999
            })
            $('.connectedSortable .card-header').css('cursor', 'move')

            // jQuery UI sortable for the todo list
            $('.todo-list').sortable({
                placeholder: 'sort-highlight',
                handle: '.handle',
                forcePlaceholderSize: true,
                zIndex: 999999
            })

            // bootstrap WYSIHTML5 - text editor
            $('.textarea').summernote()

            $('.daterange').daterangepicker({
                ranges: {
                    Today: [moment(), moment()],
                    Yesterday: [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
                    'Last 7 Days': [moment().subtract(6, 'days'), moment()],
                    'Last 30 Days': [moment().subtract(29, 'days'), moment()],
                    'This Month': [moment().startOf('month'), moment().endOf('month')],
                    'Last Month': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
                },
                startDate: moment().subtract(29, 'days'),
                endDate: moment()
            }, function(start, end) {
                // eslint-disable-next-line no-alert
                alert('You chose: ' + start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'))
            })

            /* jQueryKnob */
            $('.knob').knob()
            // The Calender
            $('#calendar').datetimepicker({
                format: 'L',
                inline: true
            })

            // SLIMSCROLL FOR CHAT WIDGET
            $('#chat-box').overlayScrollbars({
                height: '250px'
            })

            /* Chart.js Charts */
            // Sales chart
            var salesChartCanvas = document.getElementById('revenue-chart-canvas').getContext('2d')
            // $('#revenue-chart').get(0).getContext('2d');

            // --- DATA DARI LARAVEL COLLECTION ---
            // Data ini akan di-inject oleh Blade.
            // Pastikan Anda mengirim 'dataPermintaan' dari controller ke view.
            // Contoh di controller: return view('admin.dashboard', ['dataPermintaan' => Permintaan::all()]);
            const permintaanData = @json($dataPermintaan);
            const penerimaanData = @json($dataPenerimaan);

            // --- FUNCTION TO COUNT DATA PER MONTH ---
            // This function now accepts 'dateColumnName' to make it reusable.
            function hitungDataPerBulan(data, tahun, dateColumnName) {
                // Initialize an array to store data counts per month (0-11 for Jan-Dec)
                const counts = new Array(12).fill(0);

                data.forEach(item => {
                    // Use the provided 'dateColumnName' to access the date property
                    const date = new Date(item[dateColumnName]);
                    // Ensure the date is valid and falls within the desired year
                    if (!isNaN(date.getTime()) && date.getFullYear() === tahun) {
                        const month = date.getMonth(); // 0 = January, 11 = December
                        counts[month]++;
                    }
                });
                return counts;
            }

            // Determine the year you want to display data for
            // Using the year from the first item of permintaanData as an example, or it can be the current year
            const tahunSaatIni = permintaanData.length > 0 ? new Date(permintaanData[0].tanggal_permintaan).getFullYear() : new Date().getFullYear();
            // Or if you always want the current year:
            // const tahunSaatIni = new Date().getFullYear();

            // Calculate monthly data for Permintaan
            const dataPermintaanBulanan = hitungDataPerBulan(permintaanData, tahunSaatIni, 'tanggal_permintaan');

            // Calculate monthly data for Penerimaan
            const dataPenerimaanBulanan = hitungDataPerBulan(penerimaanData, tahunSaatIni, 'tanggal_penerimaan');

            var salesChartData = {
                labels: ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'],
                datasets: [{
                        label: 'Permintaan',
                        backgroundColor: 'rgba(60,141,188,0.9)',
                        borderColor: 'rgba(60,141,188,0.8)',
                        pointRadius: false,
                        pointColor: '#3b8bba',
                        pointStrokeColor: 'rgba(60,141,188,1)',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(60,141,188,1)',
                        data: dataPermintaanBulanan,
                    },
                    {
                        label: 'Penerimaan',
                        backgroundColor: 'rgba(210, 214, 222, 1)',
                        borderColor: 'rgba(210, 214, 222, 1)',
                        pointRadius: false,
                        pointColor: 'rgba(210, 214, 222, 1)',
                        pointStrokeColor: '#c1c7d1',
                        pointHighlightFill: '#fff',
                        pointHighlightStroke: 'rgba(220,220,220,1)',
                        data: dataPenerimaanBulanan
                    }
                ]
            }

            var salesChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: true
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            display: false
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            // eslint-disable-next-line no-unused-vars
            var salesChart = new Chart(salesChartCanvas, { // lgtm[js/unused-local-variable]
                type: 'line',
                data: salesChartData,
                options: salesChartOptions
            })

            // Donut Chart
            var pieChartCanvas = $('#sales-chart-canvas').get(0).getContext('2d')
            var pieData = {
                labels: [
                    'Instore Sales',
                    'Download Sales',
                    'Mail-Order Sales'
                ],
                datasets: [{
                    data: [30, 12, 20],
                    backgroundColor: ['#f56954', '#00a65a', '#f39c12']
                }]
            }
            var pieOptions = {
                legend: {
                    display: false
                },
                maintainAspectRatio: false,
                responsive: true
            }
            // Create pie or douhnut chart
            // You can switch between pie and douhnut using the method below.
            // eslint-disable-next-line no-unused-vars
            var pieChart = new Chart(pieChartCanvas, { // lgtm[js/unused-local-variable]
                type: 'doughnut',
                data: pieData,
                options: pieOptions
            })

            // Sales graph chart
            var salesGraphChartCanvas = $('#line-chart').get(0).getContext('2d')
            // $('#revenue-chart').get(0).getContext('2d');

            var salesGraphChartData = {
                labels: ['2011 Q1', '2011 Q2', '2011 Q3', '2011 Q4', '2012 Q1', '2012 Q2', '2012 Q3', '2012 Q4', '2013 Q1', '2013 Q2'],
                datasets: [{
                    label: 'Digital Goods',
                    fill: false,
                    borderWidth: 2,
                    lineTension: 0,
                    spanGaps: true,
                    borderColor: '#efefef',
                    pointRadius: 3,
                    pointHoverRadius: 7,
                    pointColor: '#efefef',
                    pointBackgroundColor: '#efefef',
                    data: [2666, 2778, 4912, 3767, 6810, 5670, 4820, 15073, 10687, 8432]
                }]
            }

            var salesGraphChartOptions = {
                maintainAspectRatio: false,
                responsive: true,
                legend: {
                    display: false
                },
                scales: {
                    xAxes: [{
                        ticks: {
                            fontColor: '#efefef'
                        },
                        gridLines: {
                            display: false,
                            color: '#efefef',
                            drawBorder: false
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            stepSize: 5000,
                            fontColor: '#efefef'
                        },
                        gridLines: {
                            display: true,
                            color: '#efefef',
                            drawBorder: false
                        }
                    }]
                }
            }

            // This will get the first returned node in the jQuery collection.
            // eslint-disable-next-line no-unused-vars
            var salesGraphChart = new Chart(salesGraphChartCanvas, { // lgtm[js/unused-local-variable]
                type: 'line',
                data: salesGraphChartData,
                options: salesGraphChartOptions
            })
        })
    </script>
@endpush
