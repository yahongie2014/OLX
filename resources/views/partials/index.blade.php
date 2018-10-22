@section('content')
@parent
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body row pa-0">
                    <div class="sm-data-box">
                        <div class="container-fluid">
                            <div class="row" >
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center  pl-0 pr-0 data-wrap-right">
                                    <span class="weight-500 uppercase-font block"><h5 class="text-success">{{__("general.totalOrdersCount")}}</h5></span>
                                    <span class="txt-dark block counter"><span class="counter-anim" id="totalOrders">0</span></span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center  pl-0 pr-0 data-wrap-right">
                                    <span class="weight-500 uppercase-font block"><h5 class="text-success">{{__("general.totalDayOrdersCount")}}</h5></span>
                                    <span class="txt-dark block counter"><span class="counter-anim" id="totalDayOrders">0</span></span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center  pl-0 pr-0 data-wrap-right">
                                    <span class="weight-500 uppercase-font block"><h5 class="text-success">{{__("general.totalMonthOrdersCount")}}</h5></span>
                                    <span class="txt-dark block counter"><span class="counter-anim" id="totalMonthOrders">0</span></span>
                                </div>
                                <div class="col-lg-3  col-md-3 col-sm-3 col-xs-12 text-center  pl-0 pr-0 data-wrap-right">
                                    <span class="weight-500 uppercase-font block"><h5 class="text-success">{{__("general.totalYearOrdersCount")}}</h5></span>
                                    <span class="txt-dark block counter"><span class="counter-anim" id="totalYearOrders">0</span></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <div class="panel card-view">

            <div class="panel-wrapper collapse in">
                <div class="panel-body row pa-0">
                    <div class="sm-data-box">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center  pl-0 pr-0 data-wrap-right">
                                    <span class="weight-500 uppercase-font block"><h5 class="text-primary">{{__("general.totalAchievementRate")}}</h5></span>
                                    <span class="txt-dark block counter"><span class="counter-anim" id="totalAchievementRate">0</span> {{__('general.minute')}}</span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center  pl-0 pr-0 data-wrap-right">
                                    <span class="weight-500 uppercase-font block"><h5 class="text-primary">{{__("general.totalDayAchievementRate")}}</h5></span>
                                    <span class="txt-dark block counter"><span class="counter-anim" id="totalDayAchievementRate">0</span> {{__('general.minute')}}</span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center  pl-0 pr-0 data-wrap-right">
                                    <span class="weight-500 uppercase-font block"><h5 class="text-primary">{{__("general.totalMonthAchievementRate")}}</h5></span>
                                    <span class="txt-dark block counter"><span class="counter-anim" id="totalMonthAchievementRate">0</span> {{__('general.minute')}}</span>
                                </div>
                                <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 text-center  pl-0 pr-0 data-wrap-right">
                                    <span class="weight-500 uppercase-font block"><h5 class="text-primary">{{__("general.totalYearAchievementRate")}}</h5></span>
                                    <span class="txt-dark block counter"><span class="counter-anim" id="totalYearAchievementRate">0</span> {{__('general.minute')}}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box">
                        <div class="container-fluid">
                            <div class="row" style="background-color: green;">
                                <a href="{{url($userRoute . '/orders?order_location=' . USER_UPDATED_ORDER)}}">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter"><span class="counter-anim" id="orderWithLocation-1" >0</span></span>
                                        <span class="weight-500 uppercase-font block">{{__("general.ordersWithLocation")}}</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="icon-layers data-right-rep-icon txt-light-grey"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box">
                        <div class="container-fluid">
                            <div class="row" style="background-color: red;">
                                <a href="{{url($userRoute . '/orders?order_location=' . USER_NOT_UPDATED_ORDER)}}">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter"><span class="counter-anim" id="orderWithLocation-0">0</span></span>
                                        <span class="weight-500 uppercase-font block">{{__("general.ordersWithOutLocation")}}</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="icon-layers data-right-rep-icon txt-light-grey"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row" >
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view panel-refresh">
            <div class="refresh-container">
                <div class="la-anim-1"></div>
            </div>

            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <canvas id="chart_7" height="330"></canvas>
                </div>
            </div>
        </div>
    </div>

    @foreach($orderStatuses as $k => $orderStatus)
    <div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
        <div class="panel panel-default card-view pa-0">
            <div class="panel-wrapper collapse in">
                <div class="panel-body pa-0">
                    <div class="sm-data-box">
                        <div class="container-fluid">
                            <div class="row" style="background-color: #F4F4F4;">
                                <a href="{{url($userRoute . '/orders?order_status[]=' . $k)}}">
                                    <div class="col-xs-6 text-center pl-0 pr-0 data-wrap-left">
                                        <span class="txt-dark block counter"><span class="counter-anim" id="orderStatus-{{$k}}">0</span></span>
                                        <span class="weight-500 uppercase-font block">{{__("general." . $orderStatus)}}</span>
                                    </div>
                                    <div class="col-xs-6 text-center  pl-0 pr-0 data-wrap-right">
                                        <i class="icon-layers data-right-rep-icon txt-light-grey"></i>
                                    </div>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default card-view">
            <div class="panel-wrapper collapse in">
                <div class="panel-body">
                    <canvas id="chart_1" height="100"></canvas>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('footer')
@parent
<script>
    function createOrderStatusPieChart(ordersCountByStatus){
        if ($('#chart_7').length > 0) {
            var ctx7 = document.getElementById("chart_7").getContext("2d");
            var data7 = {
                labels: ordersCountByStatus.status.filter(function (item) {
                    return item !== undefined;
                }),
                datasets: [
                    {
                        data: ordersCountByStatus.data.filter(function (item) {
                            return item !== undefined;
                        }),
                        backgroundColor: [
                            "rgba(240,197,65,.6)",
                            "rgba(46,205,153,.6)",
                            "rgba(78,157,230,.6)",
                            "rgba(78,157,100,.6)"
                        ],
                        hoverBackgroundColor: [
                            "rgba(240,197,65,.6)",
                            "rgba(46,205,153,.6)",
                            "rgba(78,157,230,.6)"
                        ]
                    }]
            };

            var doughnutChart = new Chart(ctx7, {
                type: 'doughnut',
                data: data7,
                options: {
                    animation: {
                        duration: 2000
                    },
                    responsive: true,
                    maintainAspectRatio: false,
                    legend: {
                        labels: {
                            fontFamily: "Poppins",
                            fontColor: "#878787"
                        }
                    },
                    elements: {
                        arc: {
                            borderWidth: 0
                        }
                    },
                    tooltip: {
                        backgroundColor: 'rgba(33,33,33,1)',
                        cornerRadius: 0,
                        footerFontFamily: "'Poppins'"
                    }
                }
            });
        }
    };

    function createOrderStatusPanels($ordersCountByStatus){
        $.each($ordersCountByStatus.dataStatus,function ($k,$value) {
            $("#orderStatus-" + $k).text($value);
        });
    }

    function createOrderDateCount($ordersCount){
        $("#totalOrders").text($ordersCount.all);
        $("#totalDayOrders").text($ordersCount.day);
        $("#totalMonthOrders").text($ordersCount.month);
        $("#totalYearOrders").text($ordersCount.year);

    }

    function createAchievementRate(orderAchievement,$ordersCount){
        if($ordersCount.all != 0)
            $("#totalAchievementRate").text((parseInt(orderAchievement.total) / parseInt($ordersCount.all)).toFixed(2));

        if($ordersCount.day != 0)
            $("#totalDayAchievementRate").text((parseInt(orderAchievement.day) / parseInt($ordersCount.day)).toFixed(2));

        if($ordersCount.month != 0)
            $("#totalMonthAchievementRate").text((parseInt(orderAchievement.month) / parseInt($ordersCount.month)).toFixed(2));

        if($ordersCount.year != 0)
            $("#totalYearAchievementRate").text((parseInt(orderAchievement.year) / parseInt($ordersCount.year)).toFixed(2));
    }

    function createOrderCountByLocation(orderLocationCount){
console.log(orderLocationCount);
        $.each(orderLocationCount,function ($k,$value) {
            $("#orderWithLocation-" + $value.user_updated).text($value.orders_count);
        });
    }

    function createLineChart($ordersCountPerMonth){
        console.log($ordersCountPerMonth);
        if( $('#chart_1').length > 0 ){
            var ctx1 = document.getElementById("chart_1").getContext("2d");
            var data1 = {
                labels: $ordersCountPerMonth.yearMonths,
                datasets: [
                    {
                        label: "fir",
                        backgroundColor: "rgba(46,205,153,.6)",
                        borderColor: "rgba(46,205,153,.6)",
                        pointBorderColor: "rgba(46,205,153,.6)",
                        pointHighlightStroke: "rgba(46,205,153,.6)",
                        data: $ordersCountPerMonth.data
                    }
                ]
            };

            var areaChart = new Chart(ctx1, {
                type:"line",
                data:data1,

                options: {
                    tooltips: {
                        mode:"label"
                    },
                    elements:{
                        point: {
                            hitRadius:90
                        }
                    },

                    scales: {
                        yAxes: [{
                            stacked: true,
                            gridLines: {
                                color: "rgba(135,135,135,0)",
                            },
                            ticks: {
                                fontFamily: "Poppins",
                                fontColor:"#878787"
                            }
                        }],
                        xAxes: [{
                            stacked: true,
                            gridLines: {
                                color: "rgba(135,135,135,0)",
                            },
                            ticks: {
                                fontFamily: "Poppins",
                                fontColor:"#878787"
                            }
                        }]
                    },
                    animation: {
                        duration:	3000
                    },
                    responsive: true,
                    legend: {
                        display: false,
                    },
                    tooltip: {
                        backgroundColor:'rgba(33,33,33,1)',
                        cornerRadius:0,
                        footerFontFamily:"'Poppins'"
                    }

                }
            });
        }
    }
    function Animator(){
        /*Counter Animation*/
        var counterAnim = $('.counter-anim');
        if( counterAnim.length > 0 ){
            counterAnim.counterUp({ delay: 10,
                time: 1000});
        }
    }
    $(document).ready(function() {

        var postData = {_token: "{{ csrf_token() }}"}
        $.ajax({
            url: '{{url("/user/orders/statistics")}}',
            type: 'GET',
            data: postData,
            dataType: 'JSON',
            success: function (data) {
                console.log(data);
                if(data.success) {
                    console.log(data.result.orderStatusCount);
                    createOrderStatusPieChart(data.result.orderStatusCount);
                    createOrderStatusPanels(data.result.orderStatusCount);
                    createOrderDateCount(data.result.ordersCounts);
                    createAchievementRate(data.result.orderAchievement,data.result.ordersCounts);
                    createLineChart(data.result.ordersPerMonth);
                    createOrderCountByLocation(data.result.ordersWithLocationCount)
                    Animator()
                }
            }
        });


    });
</script>

@endsection