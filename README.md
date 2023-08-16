<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains over 2000 video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the Laravel [Patreon page](https://patreon.com/taylorotwell).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Cubet Techno Labs](https://cubettech.com)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[Many](https://www.many.co.uk)**
- **[Webdock, Fast VPS Hosting](https://www.webdock.io/en)**
- **[DevSquad](https://devsquad.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[OP.GG](https://op.gg)**
- **[WebReinvent](https://webreinvent.com/?utm_source=laravel&utm_medium=github&utm_campaign=patreon-sponsors)**
- **[Lendio](https://lendio.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).



-------------------------------------------------------------------------------------
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @include('head')
</head>

<body>

    @include('menu')

    <main role="main">
        <div style="margin-top: 1%;" class="container">

            <div class="card">
                <div class="card-header">
                    Dashboard
                </div>
                <div class="card-body">

                    @if ($person == null)
                        <div class="row">
                            <div class="form-group row">
                                <div class="col-md-5">
                                    <label for="ddlIeTable">Institución</label>
                                    <select id="ddlIeTable" class="form-control form-control-sm" required="">
                                        @foreach ($entidad as $item)
                                            <option value='{{ $item->id }}'> {{ $item->nombre }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <label for="ddlGradoTable">Grado</label>
                                    <select id="ddlGradoTable" class="form-control form-control-sm" required="">
                                        @for ($i = 1; $i < 12; $i++)
                                            <option value='{{ $i }}'> {{ $i }} </option>
                                        @endfor
                                    </select>
                                </div>

                                <div class="col-md-3">
                                    <label for="ddlGrupoTable">Grupo</label>
                                    <select id="ddlGrupoTable" class="form-control form-control-sm" required="">
                                        @foreach ($grupo as $item)
                                            <option value='{{ $item->id }}'> {{ $item->nombre }} </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-2">
                                    <button onclick="getData()" style="top: 50%; position: relative;" id="btnGuardar"
                                        type="button" class="btn btn-primary btn-sm">Consultar</button>
                                </div>

                            </div>
                        </div>
                    @endif

                    <div class="row">

                        <div class="col-md-12 text-center">
                            <h4>
                                {{ $person->nombres }} {{ $person->apellidos }}
                            </h4>
                        </div>


                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <canvas id="myChart">
                            </canvas>
                        </div>
                    </div>

                </div>
            </div>



        </div>

        <input id="hddDocumento" type="hidden" value="{{ $person->documento }}">
    </main>

    <script>
        objGrafica = {
            "label": "",
            "data": Array(),
            "borderColor": "",
            "backgroundColor": ""
        };

        getData();

        const DATA_COUNT = 12;
        const labels = [];
        const datapoints = [0, 20, 20, 60, 60, 120, NaN, 180, 120, 125, 105, 110, 170];
        for (let i = 0; i < DATA_COUNT; ++i) {
            labels.push(i.toString());
        }
        const data = [{
            label: 'Cubic interpolation (monotone)',
            data: datapoints,
            borderColor: 'rgba(255, 99, 132, 1)',
            fill: false,
            cubicInterpolationMode: 'monotone',
            tension: 0.4
        }, {
            label: 'Cubic interpolation',
            data: datapoints,
            borderColor: 'rgba(255, 99, 132, 1)',
            fill: false,
            tension: 0.4
        }, {
            label: 'Linear interpolation (default)',
            data: datapoints,
            borderColor: 'rgba(255, 99, 132, 1)',
            fill: false
        }]

        //garfica('myChart', 'line', labels, data, 'IMC');

        function getData() {
            $.ajax({
                url: '{{ env('APP_URL_API') . '/getPersonaMedida' }}',
                type: 'POST',
                contentType: "application/json; charset=utf-8",
                data: JSON.stringify({
                    'documento': $("#hddDocumento").val(),
                    'entidad': $("#ddlIeTable").val(),
                    'grado': $("#ddlGradoTable").val(),
                    'grupo': $("#ddlGrupoTable").val(),
                }),
                dataType: 'json',
                success: function(data) {
                    console.log(data);
                    IMC(data.data);
                }
            });

        }

        function IMC(data) {

            let arrayData = [];
            let peso = [];
            let altura = [];
            let imc = [];
            let label = [];
            let i = 0;
            normal = [];
            sobrepeso = [];
            bajopeso = [];

            data.IMC.forEach(element => {
                peso.push(element.peso);
                altura.push(element.altura);
                imc.push(element.IMC);
                label.push(`${i++} día`);

            });
            arrayData.push({
                label: "Peso",
                data: peso,
                borderColor: 'rgba(54, 162, 235, 1)',
                fill: false,
                yAxisID: 'y',
            });

            arrayData.push({
                label: "Altura",
                data: altura,
                borderColor: "rgba(255, 206, 86, 1)",
                backgroundColor: "",
                fill: false,
                cubicInterpolationMode: 'monotone',
            });

            arrayData.push({
                label: "IMC",
                data: imc,
                borderColor: "rgba(82, 192, 75, 1)",
                fill: false,
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15,
                yAxisID: 'y1',
            });

            var options = {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                stacked: false,
                scales: {
                    yAxes: [{
                        id: 'y',
                        type: 'linear',
                        position: 'left',
                        ticks: {
                            beginAtZero: true
                        }
                    }, {
                        id: 'y1',
                        type: 'linear',
                        position: 'left',
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                },
                plugins: {
                    title: {
                        display: true,
                        text: (ctx) => 'Point Style: ' + ctx.chart.data.datasets[0].pointStyle,
                    }
                }
            }

            garfica('myChart', 'line', label, arrayData, 'IMC', options);


        }

        function garfica(element, tipoGrafica, label, dataSet, titulo, option) {

            var ctx = document.getElementById(element).getContext('2d');
            var myChart = new Chart(ctx, {
                type: tipoGrafica,
                data: {
                    labels: label,
                    datasets: dataSet
                },
                options: option,

                /*{
                            scales: {
                                yAxes: [{
                                    ticks: {
                                        beginAtZero: true
                                    }
                                }]
                            },

                            title: {
                                display: true,
                                text: titulo
                            },

                        plugins: {
                            title: {
                                display: true,
                                text: (ctx) => 'Point Style: ' + ctx.chart.data.datasets[0].pointStyle,
                            }
                        }

                    }*/
            });

        }
    </script>

</body>

</html>
