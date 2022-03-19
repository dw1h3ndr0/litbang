@extends('layouts.main')

@section('title')
  Dashboard &mdash; {{$data['setting']->site_title}}
@endsection

@section('favicon')
  <!-- ICONS -->  
  <link rel="icon" type="image" href="{{ asset('storage/'.$data['setting']->site_favicon) }}">
@endsection

@section('content')
	<section class="section">
          <div class="section-header">
            <h1>Dashboard</h1>
          </div>

          <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-info">
                  <i class="far fa-newspaper"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Riset</h4>
                  </div>
                  <div class="card-body">
                    {{$data['totalRiset']}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-danger">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Riset Tahun Ini</h4>
                  </div>
                  <div class="card-body">
                    {{$data['yearRiset']}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-warning">
                  <i class="far fa-file"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Riset Bulan Ini</h4>
                  </div>
                  <div class="card-body">
                    {{$data['monthRiset']}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 col-12">
              <div class="card card-statistic-1">
                <div class="card-icon bg-success">
                  <i class="fas fa-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Riset Minggu Ini</h4>
                  </div>
                  <div class="card-body">
                    {{$data['weekRiset']}}
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-lg-8 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Statistics</h4>
                  <div class="card-header-action">
                    <div class="btn-group">
                      <a id="yearStat" href="#" class="btn btn-primary">Year</a>
                      <a id="monthStat" href="#" class="btn">Month</a>
                      <a id="weekStat" href="#" class="btn ">Week</a>
                    </div>
                  </div>
                </div>
                <div class="card-body">
                  <canvas id="yearChart" height="190" ></canvas>
                  <canvas id="monthChart" height="190"></canvas>
                  <canvas id="weekChart" height="190"></canvas>
              	</div>
              </div>
            </div>
            <div class="col-lg-4 col-md-12 col-12 col-sm-12">
              <div class="card">
                <div class="card-header">
                  <h4>Last Login</h4>
                </div>
                <div class="card-body">
                  <ul class="list-unstyled list-unstyled-border">
                  	@foreach($data['users'] as $user)

                  	@if($loop->index == 5)
	                  	@break
                  	@endif
                    <li class="media">
                	  <a href="{{ asset(route('user.show', $user->username)) }}">                	  	
                      	<img class="avatar mr-4 avatar-lg" width="50" src="{{asset('storage/'.$user->photo)}}" alt="avatar">
                	  </a>
                      <div class="media-body">
                        <div class="float-right text-primary">
                        	@if(Cache::has('is_online' . $user->id))
                                <span class="text-success">Now</span>
                            @else
                                <span class="text-secondary">{{ \Carbon\Carbon::parse($user->last_login)->diffForHumans() }}</span>
                            @endif                        	
                        </div>
                        <div class="media-title" style="color:DodgerBlue;">                        	
                        	{{-- <a style="color:DodgerBlue;" href="{{ asset(route('user.show', $user->username)) }}"> --}}{{ $user->name }}{{-- </a> --}}
                        </div>
                        <span class="text-small text-muted">{{ $user->role->display_name }}</span>
                      </div>
                    </li>                   
                    @endforeach 
                  </ul>
                  {{-- <div class="text-center pt-1 pb-1">
                    <a href="#" class="btn btn-primary btn-sm btn-round">
                      View All
                    </a>
                  </div> --}}
                </div>
              </div>
            </div>
          </div>
          <div class="row">          	
            <!-- Area Chart -->
            <div class="col-xl-8 col-lg-7">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Penyelenggara</h6>                 
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="PenyelenggaraChart" height="350"></canvas>
                  </div>
                </div>
              </div>
            </div>

            <!-- Pie Chart -->
            <div class="col-xl-4 col-lg-3">
              <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Sumber Dana</h6>                   
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-pie pt-4 pb-2">
                    <canvas id="SumberDanaPieChart" height="280"></canvas>
                  </div>
                  <div class="mt-4 text-center small">
                    <span class="mr-2">
                      <i class="fas fa-circle text-info"></i> Dalam Negeri
                    </span>
                    <span class="mr-2">
                      <i class="fas fa-circle text-primary"></i> Luar Negeri
                    </span>
                  </div>
                </div>
              </div>
            </div>
		  </div>

		  <div class="row">      	
            <!-- Area Chart -->
		  	<div class="col-xl-12 col-lg-12">
		  		<div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">Kategori</h6>                 
                </div>
                <!-- Card Body -->
                <div class="card-body">
                  <div class="chart-area">
                    <canvas id="KategoriChart" height="500"></canvas>
                  </div>
                </div>
              </div>
		  	</div>
		  </div>

	</section>
@endsection

@push('scripts')
  <script>

	var cData = JSON.parse(`<?php echo $dashboard; ?>`);

	var ctx = document.getElementById("yearChart");

  	var elementYear = document.getElementById("yearStat");
  	var elementMonth = document.getElementById("monthStat");
  	var elementWeek = document.getElementById("weekStat");

	$('#monthChart').hide();
	$('#weekChart').hide();

  	var myRisetChart = new Chart(ctx, {
	      type: 'line',
	      data: {
	        labels: cData.labelYear,
	        datasets: [{
	          label: "Jumlah riset",
	          data: cData.dataYear,
	          borderWidth: 5,
		      borderColor: '#6777ef',
		      backgroundColor: 'transparent',
		      pointBackgroundColor: '#fff',
		      pointBorderColor: '#6777ef',
		      pointRadius: 4
	        }],
	      },
	      options: {
	        // maintainAspectRatio: false,
	        layout: {
	          padding: {
	            left: 10,
	            right: 25,
	            top: 25,
	            bottom: 0
	          }
	        },
	        scales: {
	          xAxes: [{         
	            gridLines: {
	              display: false,
	              drawBorder: false
	            },
	            ticks: {
	              maxTicksLimit: 7
	            }
	          }],
	          yAxes: [{
	            ticks: {
	              maxTicksLimit: 5,
	              padding: 10,
	              
	            },
	            gridLines: {
	              color: "rgb(234, 236, 244)",
	              zeroLineColor: "rgb(234, 236, 244)",
	              drawBorder: false,
	              borderDash: [2],
	              zeroLineBorderDash: [2]
	            }
	          }],
	        },
	        legend: {
	          display: false
	        },
	        tooltips: {
	          backgroundColor: "rgb(255,255,255)",
	          bodyFontColor: "#858796",
	          titleMarginBottom: 10,
	          titleFontColor: '#6e707e',
	          titleFontSize: 14,
	          borderColor: '#dddfeb',
	          borderWidth: 1,
	          xPadding: 15,
	          yPadding: 15,
	          displayColors: true,
	          intersect: false,
	          mode: 'index',
	          caretPadding: 10,
	        }
	      }
	    });

  	document.getElementById("yearStat").onclick = function() {
  		elementYear.classList.add("btn-primary");
  		elementMonth.classList.remove("btn-primary");
  		elementWeek.classList.remove("btn-primary");

  		$('#yearChart').show();
  		$('#monthChart').hide();
  		$('#weekChart').hide();

		var ctx = document.getElementById("yearChart");

	    var myRisetChart = new Chart(ctx, {
	      type: 'line',
	      data: {
	        labels: cData.labelYear,
	        datasets: [{
	          label: "Jumlah riset",
	          data: cData.dataYear,
	          borderWidth: 5,
		      borderColor: '#6777ef',
		      backgroundColor: 'transparent',
		      pointBackgroundColor: '#fff',
		      pointBorderColor: '#6777ef',
		      pointRadius: 4
	        }],
	      },
	      options: {
	        // maintainAspectRatio: false,
	        layout: {
	          padding: {
	            left: 10,
	            right: 25,
	            top: 25,
	            bottom: 0
	          }
	        },
	        scales: {
	          xAxes: [{         
	            gridLines: {
	              display: false,
	              drawBorder: false
	            },
	            ticks: {
	              maxTicksLimit: 7
	            }
	          }],
	          yAxes: [{
	            ticks: {
	              maxTicksLimit: 5,
	              padding: 10,
	              
	            },
	            gridLines: {
	              color: "rgb(234, 236, 244)",
	              zeroLineColor: "rgb(234, 236, 244)",
	              drawBorder: false,
	              borderDash: [2],
	              zeroLineBorderDash: [2]
	            }
	          }],
	        },
	        legend: {
	          display: false
	        },
	        tooltips: {
	          backgroundColor: "rgb(255,255,255)",
	          bodyFontColor: "#858796",
	          titleMarginBottom: 10,
	          titleFontColor: '#6e707e',
	          titleFontSize: 14,
	          borderColor: '#dddfeb',
	          borderWidth: 1,
	          xPadding: 15,
	          yPadding: 15,
	          displayColors: true,
	          intersect: false,
	          mode: 'index',
	          caretPadding: 10,
	        }
	      }
	    });
  	};

  	document.getElementById("monthStat").onclick = function() {
  		elementYear.classList.remove("btn-primary");
  		elementMonth.classList.add("btn-primary");
  		elementWeek.classList.remove("btn-primary");
  		
  		$('#yearChart').hide();
  		$('#monthChart').show();
  		$('#weekChart').hide();

		var ctx = document.getElementById("monthChart");

	    var myLineChart = new Chart(ctx, {
	      type: 'line',
	      data: {
	        labels: cData.labelMonth,
	        datasets: [{
	          label: "Jumlah riset",
	          data: cData.dataMonth,
		      borderColor: '#6777ef',
		      backgroundColor: 'transparent',
		      pointBackgroundColor: '#fff',
		      pointBorderColor: '#6777ef',
	          pointHoverBackgroundColor: "rgba(78, 115, 223, 1)",
	          pointHoverBorderColor: "rgba(78, 115, 223, 1)",
	          pointHoverRadius: 3,
	          pointRadius: 3,
	          lineTension: 0.3,
	          pointHitRadius: 10,
	          pointBorderWidth: 2,

	        }],
	      },
	      options: {
	        // maintainAspectRatio: false,
	        layout: {
	          padding: {
	            left: 10,
	            right: 25,
	            top: 25,
	            bottom: 0
	          }
	        },
	        scales: {
	          xAxes: [{         
	            gridLines: {
	              display: false,
	              drawBorder: false
	            },
	            ticks: {
	              maxTicksLimit: 7
	            }
	          }],
	          yAxes: [{
	            ticks: {
	              maxTicksLimit: 5,
	              padding: 10,
	              
	            },
	            gridLines: {
	              color: "rgb(234, 236, 244)",
	              zeroLineColor: "rgb(234, 236, 244)",
	              drawBorder: false,
	              borderDash: [2],
	              zeroLineBorderDash: [2]
	            }
	          }],
	        },
	        legend: {
	          display: false
	        },
	        tooltips: {
	          backgroundColor: "rgb(255,255,255)",
	          bodyFontColor: "#858796",
	          titleMarginBottom: 10,
	          titleFontColor: '#6e707e',
	          titleFontSize: 14,
	          borderColor: '#dddfeb',
	          borderWidth: 1,
	          xPadding: 15,
	          yPadding: 15,
	          displayColors: false,
	          intersect: false,
	          mode: 'index',
	          caretPadding: 10,
	        }
	      }
	    });
  	};

  	document.getElementById("weekStat").onclick = function() {
  		elementYear.classList.remove("btn-primary");
  		elementMonth.classList.remove("btn-primary");
  		elementWeek.classList.add("btn-primary");

  		$('#yearChart').hide();
  		$('#monthChart').hide();
  		$('#weekChart').show();

		var ctx = document.getElementById("weekChart");
	
		var myChart = new Chart(ctx, {
		  type: 'line',
		  data: {
		    labels: ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday", "Sunday"],
		    datasets: [{
		      label: 'Jumlah riset',
		      data: [cData.day1Riset, cData.day2Riset, cData.day3Riset, cData.day4Riset, cData.day5Riset, cData.day6Riset, cData.day7Riset],
		      borderWidth: 5,
		      borderColor: '#6777ef',
		      backgroundColor: 'transparent',
		      pointBackgroundColor: '#fff',
		      pointBorderColor: '#6777ef',
		      pointRadius: 4
		    }]
		  },
		  options: {
		  	layout: {
	          padding: {
	            left: 10,
	            right: 25,
	            top: 25,
	            bottom: 0
	          }
	        },
		    legend: {
		      display: false
		    },
		    scales: {
	          xAxes: [{         
	            gridLines: {
	              display: false,
	              drawBorder: false
	            },
	            ticks: {
	              maxTicksLimit: 7
	            }
	          }],
	          yAxes: [{
	            ticks: {
	              maxTicksLimit: 5,
	              padding: 10,
	              
	            },
	            gridLines: {
	              color: "rgb(234, 236, 244)",
	              zeroLineColor: "rgb(234, 236, 244)",
	              drawBorder: false,
	              borderDash: [2],
	              zeroLineBorderDash: [2]
	            }
	          }],
	        },
	        tooltips: {
	          backgroundColor: "rgb(255,255,255)",
	          bodyFontColor: "#858796",
	          titleMarginBottom: 10,
	          titleFontColor: '#6e707e',
	          titleFontSize: 14,
	          borderColor: '#dddfeb',
	          borderWidth: 1,
	          xPadding: 15,
	          yPadding: 15,
	          displayColors: true,
	          intersect: false,
	          mode: 'index',
	          caretPadding: 10,
	        }
		  },
		});
  	};

	// Bar Chart Penyelenggara
  var ctx = document.getElementById("PenyelenggaraChart");
  // console.log(cData.penyelenggara_individu);
  var myPenyelenggaraChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: cData.penyelenggara_label,
      datasets: [
      {
        label: "Selesai",
        data: cData.penyelenggara_selesai,
        backgroundColor: '#1cc88a',
        hoverBackgroundColor: '#17a673',
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      },
      {
        label: "Proses",
        data: cData.penyelenggara_proses,
        backgroundColor: '#36b9cc',
        hoverBackgroundColor: '#2c9faf',
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      },
      {
        label: "Belum",
        data: cData.penyelenggara_belum,
        backgroundColor: '#4e73df',
        hoverBackgroundColor: '#2e59d9',
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }
      ],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      responsive: true,
      scales: {
	      x: {
	        stacked: true,
	      },
	      y: {
	        stacked: true
	      }
	    },
      legend: {
        display: true
      },
    }
  });

  	// Pie Chart Sumber Dana
    var ctx = document.getElementById("SumberDanaPieChart");
    var myPieChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
        labels: ["Dalam Negeri", "Luar Negeri"],
        datasets: [{
          data: [cData.dalamNegeri, cData.luarNegeri],
          backgroundColor: ['#36b9cc', '#4e73df'],
          hoverBackgroundColor: ['#2c9faf', '#2e59d9'],
          hoverBorderColor: "rgba(234, 236, 244, 1)",
        }],
      },
      options: {
        maintainAspectRatio: false,
        tooltips: {
          backgroundColor: "rgb(255,255,255)",
          bodyFontColor: "#858796",
          borderColor: '#dddfeb',
          borderWidth: 1,
          xPadding: 15,
          yPadding: 15,
          displayColors: false,
          caretPadding: 10,
        },
        legend: {
          display: false
        },
        cutoutPercentage: 50,
      },
    });

    // Bar Chart Kategori
  var ctx = document.getElementById("KategoriChart");
  var myKategoriChart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: cData.kategori_label,
      datasets: [
      {
        label: "Jumlah",
        data: cData.kategori_total,
        backgroundColor: '#36b9cc',
        hoverBackgroundColor: '#2c9faf',
        hoverBorderColor: "rgba(234, 236, 244, 1)",
      }
      ],
    },
    options: {
      maintainAspectRatio: false,
      layout: {
        padding: {
          left: 10,
          right: 25,
          top: 25,
          bottom: 0
        }
      },
      responsive: true,
      scales: {
	      x: {
	        stacked: true,
	      },
	      y: {
	        stacked: true
	      }
	    },
      legend: {
        display: true
      },
    }
  });
    
  </script>
@endpush