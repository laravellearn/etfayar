"use strict";

// Class definition
var KTWidgets = function () {
    // Private properties


    var _initChartsWidget3 = function () {
        var element = document.getElementById("kt_charts_widget_3_chart");

        if (!element) {
            return;
        }

        $.ajax({
            type: 'GET', //THIS NEEDS TO BE GET
            url: '/admin/dashboard/requests',
            dataType: 'json',
            success: function (data) {
                console.log(data);
                var options = {
                    series: [{
                        name: 'تعداد درخواست',
                        data: data.values
                    }],
                    chart: {
                        type: 'area',
                        height: 350,
                        toolbar: {
                            show: false
                        }
                    },
                    plotOptions: {},
                    legend: {
                        show: false
                    },
                    dataLabels: {
                        enabled: true,
                        style: {
                            colors: ['#333']
                        },
                    },
                    fill: {
                        type: 'solid',
                        opacity: 1
                    },
                    stroke: {
                        curve: 'smooth',
                        show: true,
                        width: 3,
                        colors: [KTApp.getSettings()['colors']['theme']['base']['info']]
                    },
                    xaxis: {
                        categories: data.keies,
                        axisBorder: {
                            show: true,
                        },
                        axisTicks: {
                            show: true
                        },
                        labels: {
                            style: {
                                colors: KTApp.getSettings()['colors']['gray']['gray-700'],
                                fontSize: '14px',
                                fontFamily: KTApp.getSettings()['font-family']
                            }
                        },
                        crosshairs: {
                            position: 'front',
                            stroke: {
                                color: KTApp.getSettings()['colors']['theme']['base']['info'],
                                width: 1,
                                dashArray: 3
                            }
                        },
                        tooltip: {
                            enabled: true,
                            formatter: undefined,
                            offsetY: 0,
                            style: {
                                fontSize: '12px',
                                fontFamily: KTApp.getSettings()['font-family']
                            }
                        }
                    },
                    yaxis: {
                        labels: {
                            style: {
                                colors: KTApp.getSettings()['colors']['gray']['gray-500'],
                                fontSize: '12px',
                                fontFamily: KTApp.getSettings()['font-family']
                            }
                        }
                    },
                    states: {
                        normal: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        hover: {
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        },
                        active: {
                            allowMultipleDataPointsSelection: false,
                            filter: {
                                type: 'none',
                                value: 0
                            }
                        }
                    },
                    tooltip: {
                        style: {
                            fontSize: '12px',
                            fontFamily: KTApp.getSettings()['font-family']
                        },
                        y: {
                            formatter: function (val) {
                                return val + " عدد"
                            }
                        }
                    },
                    colors: [KTApp.getSettings()['colors']['theme']['light']['info']],
                    grid: {
                        borderColor: KTApp.getSettings()['colors']['gray']['gray-200'],
                        strokeDashArray: 4,
                        yaxis: {
                            lines: {
                                show: true
                            }
                        }
                    },
                    markers: {
                        //size: 5,
                        //colors: [KTApp.getSettings()['colors']['theme']['light']['danger']],
                        strokeColor: KTApp.getSettings()['colors']['theme']['base']['info'],
                        strokeWidth: 3
                    }
                };

                var chart = new ApexCharts(element, options);
                chart.render();

            }, error: function () {
                console.log(data);
            }
        });


    }


    // Public methods
    return {
        init: function () {
            _initChartsWidget3();
        }
    }
}();

// Webpack support
if (typeof module !== 'undefined') {
    module.exports = KTWidgets;
}

jQuery(document).ready(function () {
    KTWidgets.init();
});
