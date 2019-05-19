function resultcharts() {

    'use strict';

    if ($("#chart-widget-01").length) {
        var options = {
            colors: [colors[0]],
            chart: {
                height: 200,
                animations: {
                    enabled: false,
                },
                sparkline: {
                    enabled: true
                },
                type: 'bar',
            },
            plotOptions: {
                bar: {
                    horizontal: false,
                    endingShape: 'rounded',
                    columnWidth: '35%',
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
            series: [{
                name: 'Last Month',
                data: [10, 30, 45, 50, 61, 55, 45, 35, 10]
            },
                // {
                //     name: 'Last Month',
                //     data: [10 , 61, 55, 45, 30, 45, 50, 35, 10]
                // }
            ],
            xaxis: {
                categories: ['Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct'],
            },

            fill: {
                opacity: 1

            },
            // legend: {
            //     floating: true
            // },
            tooltip: {
                y: {
                    formatter: function (val) {
                        return "$ " + val + " thousands"
                    }
                }
            }
        }

        var chart = new ApexCharts(
            document.querySelector("#chart-widget-01"),
            options
        );

        chart.render();
    }
    if ($("#chart-widget-02").length) {
        var options = {
            colors: colors[0],
            chart: {
                height: 350,
                type: 'radialBar',
            },
            plotOptions: {
                radialBar: {
                    startAngle: -135,
                    endAngle: 135,
                    dataLabels: {
                        name: {
                            fontSize: '16px',
                            color: undefined,
                            offsetY: 120
                        },
                        value: {
                            offsetY: 76,
                            fontSize: '22px',
                            color: undefined,
                            formatter: function (val) {
                                return val + "%";
                            }
                        }
                    }
                }
            },
            fill: {
                gradient: {
                    enabled: true,
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
            series: [67],
            labels: ['Funded'],

        }

        var chart = new ApexCharts(
            document.querySelector("#chart-widget-02"),
            options
        );

        chart.render();

    }
}
window.onload = resultcharts;