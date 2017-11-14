var crypt;
var prices = [];
// var pointStartInput = new Date($("#pointStart").val()).toISOString();
// var selectedDate = moment(pointStartInput).format("YYYY-MM-DD HH:mm:ssZ")
$(document).ready(function () {

    $.ajax({
        url: $("#historicalData").val(),
        dataType: "json",
        type: 'POST',
        success: function (data) {
            createGraph(parseFloatPrices(data));
        }
    });
    $('#button').click(function () {
        chart.exportChart();
    });

});

function createGraph(data) {
    var chart = Highcharts.stockChart('container', {

        rangeSelector: {
            selected: 1,
            inputBoxStyle: {
                right: '80px'
            }
        },

        series: [{
            name: 'Price (USD)',
            data: data,
            pointStart: Date.UTC(2017, 10, 10, 12, 15, 30, 0),
            pointInterval: 3600 * 500
        }],

        exporting: {
            chartOptions: {
                chart: {
                    width: 1024,
                    height: 768
                }
            }
        },
        plotOptions: {
            series: {
                label: {
                    connectorAllowed: false
                },
                pointStart: 2010
            }
        },
        xAxis: {
            type: 'datetime'
        },
        lineWidth: 2,
        allowPointSelect: false,
        showCheckbox: false,
        animation: {
            duration: 1000
        },
        events: {},
        marker: {
            lineWidth: 0,
            lineColor: '#ffffff',
            radius: 4,
            states: {
                hover: {
                    animation: {
                        duration: 50
                    },
                    enabled: true,
                    radiusPlus: 2,
                    lineWidthPlus: 1
                },
                select: {
                    fillColor: '#cccccc',
                    lineColor: '#000000',
                    lineWidth: 2
                }
            }
        },
        point: {
            events: {}
        },
        dataLabels: {
            align: 'center',
            formatter: function() {
                return this.y === null ? '' : H.numberFormat(this.y, -1);
            },
            style: {
                fontSize: '11px',
                fontWeight: 'bold',
                color: 'contrast',
                textOutline: '1px contrast'
            },
            verticalAlign: 'bottom',
            x: 0,
            y: 0,
            padding: 5
        },
        cropThreshold: 300,
        pointRange: 0,
        softThreshold: true,
        states: {
            hover: {
                animation: {
                    duration: 50
                },
                lineWidthPlus: 1,
                marker: {},
                halo: {
                    size: 10,
                    opacity: 0.25
                }
            },
            select: {
                marker: {}
            }
        },
        stickyTracking: true,
        turboThreshold: 1000,
        findNearestPointBy: 'x'
    });
}

function parseFloatPrices(data) {
    var temp = [];
    $.each(data, function (counter, item) {
        temp.push(parseFloat(item));
    });
    return temp;
}