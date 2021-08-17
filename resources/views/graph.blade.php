<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Gráfico</title>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>
    <script src="https://code.highcharts.com/modules/export-data.js"></script>
    <script src="https://code.highcharts.com/modules/accessibility.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/css/bootstrap-datetimepicker.min.css">
</head>

<body>


    <div class="container mt-5" style="max-width: 450px">
        <h2 class="mb-4">Selecione a data de referência</h2>



        <form action="{{route('index')}}" method="get">

            @csrf

            <div class="form-group">
                <div class='input-group date' id='datetimepicker'>
                    <input type='text' class="form-control" id="date-selected" name="date-selected" />
                    <span class="input-group-addon">
                        <span class="glyphicon glyphicon-calendar"></span>
                    </span>
                </div>
                <input class="btn btn-primary" type="submit" value="Consultar">
            </div>
        </form>

    </div>


    <figure class="highcharts-figure">
        <div id="container"></div>
    </figure>


    
    <script>
        var chart = Highcharts.chart('container', {
            chart: {
                type: 'area'
            },
            title: {
                text: 'Valores agregados de Fundos'
            },
            subtitle: {
                text: 'Gráfico de Fundos'
            },
            xAxis: {
                categories: @json($lastSevenDays),
                tickmarkPlacement: 'on',
                title: {
                    enabled: false
                }
            },
            yAxis: {
                title: {
                    text: 'Valores'
                },
                labels: {
                    formatter: function() {
                        return this.value / 1000;
                    }
                }
            },
            tooltip: {
                split: true
            },
            plotOptions: {
                area: {
                    stacking: 'normal',
                    lineColor: '#666666',
                    lineWidth: 1,
                    marker: {
                        lineWidth: 1,
                        lineColor: '#666666'
                    }
                }
            },

        });
    </script>

    @foreach ($fundosArray as $key=>$value)
    <script>
        var arrStr = @json($value);
        var arrStr = arrStr.map((i) => Number(i));
        chart.addSeries({
            name: 'Fundo {{$key}}',
            data: arrStr
        });
    </script>
    @endforeach

</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.15.1/moment.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datetimepicker/4.7.14/js/bootstrap-datetimepicker.min.js"></script>

<script type="text/javascript">
    var dateNow = new Date();
    $(function() {
        $('#datetimepicker').datetimepicker({
            format: 'YYYY-MM-DD',
            defaultDate: dateNow
        });
    });
</script>

</html>