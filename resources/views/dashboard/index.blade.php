@extends('layouts.master')
@section('title','dashboard')
@section('parentPageTitle', 'index')
@section('content')
    <!-- Start row -->
    <div class="row">
        <!-- Start col -->
        <div class="col-lg-12 col-xl-8">
           <!-- Start row -->
            <div class="row">
                <!-- Start col -->
                {{-- <div class="col-lg-12 col-xl-4">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-7">
                                    <h4>{{formatPrice($this_earning)}}</h4>
                                    <p class="font-14 mb-0">@translate(This Month Revenue)</p>
                                </div>
                                <div class="col-5 text-right">
                                    <div id="apex-area3-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-xl-4">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-7">
                                    <h4>{{formatPrice($prev_earning)}}</h4>
                                    <p class="font-14 mb-0">@translate(Last Month Revenue)</p>
                                </div>
                                <div class="col-5 text-right">
                                    <div id="apex-area2-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-xl-4">
                    <div class="card m-b-30">
                        <div class="card-body">
                            <div class="row align-items-center">
                                <div class="col-7">
                                    <h4>{{formatPrice($total_earning)}}</h4>
                                    <p class="font-14 mb-0">@translate(Total) <br> @translate(Revenue) </p>
                                </div>
                                <div class="col-5 text-right">
                                    <div id="apex-area1-chart"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <!-- End col -->
                
                <div class="col-lg-12 col-xl-12">
                    <div class="card m-b-30">
                        <div class="card-header">
                            <div class="row align-items-center">
                                <div class="col-9">
                                    <h5 class="card-title mb-0">@translate(Status)</h5>
                                </div>
                            </div>
                        </div>
                        <div class="card-body crm-tab-widget">
                            <div class="row align-items-center">
                                <div class="col-12 col-sm-5 p-0">
                                    <div class="nav flex-column nav-pills" id="v-pills-ticket-tab" role="tablist"
                                         aria-orientation="vertical">
                                        <a class="nav-link active" id="v-pills-support-tab" data-toggle="pill"
                                           href="#v-pills-support" role="tab" aria-controls="v-pills-support"
                                           aria-selected="true"><i
                                                class="feather icon-circle font-12 mr-1">

                                            </i>@translate(Courses)<span
                                                class="float-right font-14 text-muted">{{$total_course}}</span></a>
                                        <a class="nav-link" id="v-pills-sales-tab" data-toggle="pill"
                                           href="#v-pills-sales" role="tab" aria-controls="v-pills-sales"
                                           aria-selected="false">
                                            <i class="feather icon-circle font-12 mr-1"></i>@translate(Enrollments)<span
                                                class="float-right font-14 text-muted">{{$total_enrollments}}</span></a>
                                        <a class="nav-link" id="v-pills-product-tab" data-toggle="pill"
                                           href="#v-pills-product" role="tab" aria-controls="v-pills-product"
                                           aria-selected="false">
                                            <i class="feather icon-circle font-12 mr-1"></i>@translate(Instructors)<span
                                                class="float-right font-14 text-muted">{{$total_instructor}}</span></a>
                                        <a class="nav-link" id="v-pills-hiring-tab" data-toggle="pill"
                                           href="#v-pills-hiring" role="tab" aria-controls="v-pills-hiring"
                                           aria-selected="false">
                                            <i class="feather icon-circle font-12 mr-1"></i>@translate(Students)<span
                                                class="float-right font-14 text-muted">{{$total_students}}</span></a>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-7 p-0">
                                    <div class="tab-content" id="v-pills-ticket-tabContent">
                                        <div class="tab-pane fade show active" id="v-pills-support" role="tabpanel"
                                             aria-labelledby="v-pills-support-tab">
                                            <div id="apex-operation-course-chart"></div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-sales" role="tabpanel"
                                             aria-labelledby="v-pills-sales-tab">
                                            <div id="apex-operation-enrollment-chart"></div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-product" role="tabpanel"
                                             aria-labelledby="v-pills-product-tab">
                                            <div id="apex-operation-instructor-chart"></div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-hiring" role="tabpanel"
                                             aria-labelledby="v-pills-hiring-tab">
                                            <div id="apex-operation-student-chart"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End col -->
            </div>
        </div>

        <div class="col-lg-12 col-xl-4 mb-2">
            <div class="card p-2and5">
                <div class="card-header">
                    <div class="row align-items-center">
                        <div class="col-9">
                            <h5 class="card-title mb-0">@translate(Top Instructor)</h5>
                        </div>
                    </div>
                </div>
                <div class="user-slider">
                    @forelse($top_instructor as $item)
                        <div class="user-slider-item">
                            <div class="card-body text-center">
                                <div class="m-4">
                                    <img src="{{filePath($item->image)}}"
                                         class="img-center rounded-circle avatar-xl">
                                </div>
                                <a href="{{route('instructors.show',$item->user_id)}}">
                                    <h5>{{$item->name}}</h5>
                                    <p>{{$item->email}}</p>
                                    <p><span class="badge badge-primary-inverse">@translate(Details)</span></p></a>
                            </div>
                            <div class="card-footer text-center">
                                <div class="row">
                                    <div class="col-6 border-right">
                                        @php
                                            $total_student = 0;
                                        @endphp
                                        @foreach(\App\Model\Course::where('user_id',$item->user_id)->get() as $c)
                                            <input type="hidden"
                                                   value="{{$total_student += App\Model\Enrollment::where('course_id' , $c->id)->count()}}"/>
                                        @endforeach
                                        <h4>{{\App\Model\Course::where('user_id',$item->user_id)->count()}}</h4>
                                        <p class="my-2">@translate(Courses)</p>
                                    </div>
                                    <div class="col-6">
                                        <h4>{{$total_student}}</h4>
                                        <p class="my-2">@translate(Students)</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                            <h3 class="text-center mt-3">@translate(No top instructor)</h3>
                        @endforelse
                </div>
            </div>
        </div>
        <!-- End col -->
    </div>
    <!-- End row -->

        <div class="card m-b-30">
            <div class="card-header">
                <div class="row align-items-center">
                    <div class="col-9">
                        <h5 class="card-title mb-0">@translate(This Year Revenue)</h5>
                    </div>
                </div>
            </div>
            <div class="card-body pl-0 py-0">
                <div id="apexs-bar-chart"></div>
            </div>
        </div>

@endsection

@section('page-script')
    <script>
        "use strict"

        var options = {
            chart: {
                height: 300,
                type: 'bar',
                toolbar: {
                    show: false
                }
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    columnWidth: '25%',
                    endingShape: 'rounded'
                },
            },
            dataLabels: {
                enabled: false
            },
            stroke: {
                show: true,
                width: 2,
                colors: ['transparent']
            },
            colors: ['#506fe4', '#43d187','#8B0000'],
            series: [{
                name: 'Total Earning',
                data: [@foreach($t_earning as $i)
                    '{{$i}}',
                    @endforeach]
            }, {
                name: 'Instructor Earning',
                data: [@foreach($instructor_earning as $m)'{{$m}}', @endforeach]
            },{
                name: 'Admin Earning',
                data: [@foreach($admin_earning as $a)'{{$a}}', @endforeach]
            }],
            legend: {
                show: false,
            },
            xaxis: {
                categories: [@foreach($months as $m)'{{$m}}', @endforeach],
                axisBorder: {
                    show: true,
                    color: 'rgba(0,0,0,0.05)'
                },
                axisTicks: {
                    show: true,
                    color: 'rgba(0,0,0,0.05)'
                }
            },
            grid: {
                row: {
                    colors: ['transparent', 'transparent'], opacity: .2
                },
                borderColor: 'rgba(0,0,0,0.05)'
            },
            fill: {
                opacity: 1,
            },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "$ " + val
                    }
                }
            }
        }
        var chart = new ApexCharts(
            document.querySelector("#apexs-bar-chart"),
            options
        );
        chart.render();

        /* ----- Apex Operation Status1 Chart ----- */
        var options = {
            chart: {
                height: 260,
                type: 'radialBar',
                offsetY: -10
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    dataLabels: {
                        name: {
                            fontSize: '18px',
                            fontFamily: 'Mukta Vaani',
                            color: '#8A98AC',
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '24px',
                            fontFamily: 'Mukta Vaani',
                            color: '#141d46',
                            formatter: function (val) {
                                return val;
                            }
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
            },
            stroke: {
                dashArray: 4
            },
            colors:["#506fe4"],
            series: [{{$total_course}}],
            labels: ['@translate(Total Courses)'],
        }
        var chart = new ApexCharts(
            document.querySelector("#apex-operation-course-chart"),
            options
        );
        chart.render();

        /* ----- Apex Operation Status2 Chart ----- */
        var options = {
            chart: {
                height: 260,
                type: 'radialBar',
                offsetY: -10
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    dataLabels: {
                        name: {
                            fontSize: '18px',
                            fontFamily: 'Mukta Vaani',
                            color: '#8A98AC',
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '24px',
                            fontFamily: 'Mukta Vaani',
                            color: '#141d46',
                            formatter: function (val) {
                                return val ;
                            }
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
            },
            stroke: {
                dashArray: 4
            },
            colors:["#506fe4"],
            series: [{{$total_enrollments}}],
            labels: ['@translate(Total Enrollments)'],
        }
        var chart = new ApexCharts(
            document.querySelector("#apex-operation-enrollment-chart"),
            options
        );
        chart.render();

        /* ----- Apex Operation Status3 Chart ----- */
        var options = {
            chart: {
                height: 260,
                type: 'radialBar',
                offsetY: -10
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    dataLabels: {
                        name: {
                            fontSize: '18px',
                            fontFamily: 'Mukta Vaani',
                            color: '#8A98AC',
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '24px',
                            fontFamily: 'Mukta Vaani',
                            color: '#141d46',
                            formatter: function (val) {
                                return val;
                            }
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
            },
            stroke: {
                dashArray: 4
            },
            colors:["#506fe4"],
            series: [{{$total_instructor}}],
            labels: ['@translate(Total Instructor)'],
        }
        var chart = new ApexCharts(
            document.querySelector("#apex-operation-instructor-chart"),
            options
        );
        chart.render();

        /* ----- Apex Operation Status4 Chart ----- */
        var options = {
            chart: {
                height: 260,
                type: 'radialBar',
                offsetY: -10
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    dataLabels: {
                        name: {
                            fontSize: '18px',
                            fontFamily: 'Mukta Vaani',
                            color: '#8A98AC',
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '24px',
                            fontFamily: 'Mukta Vaani',
                            color: '#141d46',
                            formatter: function (val) {
                                return val;
                            }
                        }
                    }
                }
            },
            fill: {
                type: 'gradient',
                gradient: {
                    shade: 'dark',
                    shadeIntensity: 0.15,
                    inverseColors: false,
                    opacityFrom: 1,
                    opacityTo: 1,
                    stops: [0, 50, 65, 91]
                },
            },
            stroke: {
                dashArray: 4
            },
            colors:["#506fe4"],
            series: [{{$total_students}}],
            labels: ['@translate(Total Student)'],
        }
        var chart = new ApexCharts(
            document.querySelector("#apex-operation-student-chart"),
            options
        );
        chart.render();
    </script>
    @endsection
