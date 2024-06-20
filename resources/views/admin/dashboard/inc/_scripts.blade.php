<script>

    var colors = ["#178ece"];
    (dataColors = $("#total-revenue").data("colors")) && (colors = dataColors.split(","));
    var radialOptions = {
        series: [{{ round($todayDiffSales, 2) }}],
        chart: { height: 242, type: "radialBar" },
        plotOptions: { radialBar: { hollow: { size: "65%" } } },
        colors: colors,
        labels: ['رشد']
    };
    var radialChart = new ApexCharts(document.querySelector("#total-revenue"), radialOptions);
    radialChart.render();

    function renderLineChart(dailySales, numberOfSales, dateLabels) {
        var lineChart = new ApexCharts(document.querySelector("#sales-analytics"), {
            series: [
                { name: "مقدار فروش", data: dailySales },
                { name: "تعداد فروش", data: numberOfSales }
            ],
            chart: {
                height: 380,
                type: 'area',
                zoom: { enabled: true }
            },

            dataLabels: { enabled: false },
            stroke: { curve: 'straight' },
            grid: {
                row: { colors: ['#f3f3f3', 'transparent'], opacity: 0.3 },
                padding: {
                    left: 30, // or whatever value that works
                    right: 30 // or whatever value that works
                }
            },
            yaxis: { show: true },
            xaxis: { categories: dateLabels,
                tickPlacement: 'on'

            },


        });

        lineChart.render();

        // Update series data if necessary
        lineChart.updateSeries([{
            name: "فروش",
            data: dailySales
        }, {
            name: "تعداد ",
            data: numberOfSales
        }]);



    }

    $(document).ready(function() {

        $.ajax({
            type: 'GET',
            url: '{{ route('get-chart-data') }}' + '?time=' + Date.now(),
            data: { type: 'day' },
            cache: false,
            success: function(response) {
                console.log(response);

                if (!lineChart) {
                    renderLineChart(response.dailySales, response.numberOfSales, response.dateLabels);
                    // Update series data if necessary
                    lineChart.updateSeries([{
                        name: "فروش ",
                        data: dailySales
                    }, {
                        name: "تعداد ",
                        data: numberOfSales
                    }]);
                } else {
                    lineChart.updateSeries([
                        { name: "فروش ", data: response.dailySales },
                        { name: "تعداد ", data: response.numberOfSales }
                    ]);
                }
            },
            error: function(error) {
                swal.fire('اشکال در دریافت اطلاعات','دریافت داده های نمودار با مشکل روبرو شد','warning');
            }
        });



        var lineChart;


        $('.typeBtn').on('click', function() {
            var type = $(this).data('type');

            $.ajax({
                type: 'GET',
                url: '{{ route('get-chart-data') }}' + '?time=' + Date.now(),
                data: { type: type },
                cache: false,
                success: function(response) {
                    console.log(response);

                    if (!lineChart) {
                        renderLineChart(response.dailySales, response.numberOfSales, response.dateLabels);
                        // Update series data if necessary
                        lineChart.updateSeries([{
                            name: "فروش ",
                            data: dailySales
                        }, {
                            name: "تعداد ",
                            data: numberOfSales
                        }]);
                    } else {
                        lineChart.updateSeries([
                            { name: "فروش ", data: response.dailySales },
                            { name: "تعداد ", data: response.numberOfSales }
                        ]);
                    }
                },
                error: function(error) {
                    swal.fire('اشکال در دریافت اطلاعات','دریافت داده های نمودار با مشکل روبرو شد','warning');
                }
            });
        });
    });




</script>
