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
                <div class="card-header bg-default">
                    <h4 style="color: #333;">Detalle de los resultados</h4>
                </div>
                <div class="card-body">
                <a href=" " class="btn btn-success boton" onclick="window.print()">Imprimir</a>
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
                            <img src="/storage/{{ $person->foto }}" alt="Foto Perfil" width="200px" style="padding: 5px; border-radius: 10%; border: 1px solid #bebebe; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 3px, rgba(0, 0, 0, 0.23) 0px 3px 6px;" /><!-- URL PRUEBA-->
                            <!--<img src="http://santanacloud.com:8080/Atenea/public/storage/{{ $person->foto }}" alt="Foto Perfil" width="200px" style="padding: 5px; border-radius: 10%; border: 1px solid #bebebe; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 3px, rgba(0, 0, 0, 0.23) 0px 3px 6px;" />--><!-- URL PRODUCCION-->
                        </div>
                        <div class="col-md-12 text-center mt-3">
                            <h4>
                                {{ $person->nombres }} {{ $person->apellidos }}
                            </h4>
                        </div>
                        <div class="col-md-12">
                            <hr />
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header" style="background-color: #CEECF5;">
                                    <h5 style="color: #086A87;">Diagnosticos del estudiante</h5>
                                </div>
                                <div class="card-body">
                                <div class="row" id="DvDiagnostico"></div>
                                     <!--<div class="row">
                                       @foreach ($entidad as $item)
                                            <div class="col-md-4">
                                                <div class="card">
                                                    <div class="card-body">
                                                        <h5 class="card-title">{{$item->nombre}}</h5>
                                                        <hr />
                                                        <strong>Fecha:</strong>
                                                        <p class="card-text">01/01/1900</P>
                                                        <strong>Comentario:</strong>
                                                        <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>
                                                    </div>
                                                </div> 
                                            </div>
                                        @endforeach
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                Las siguientes tablas muestran el detalle de la información registrada del alumno en el
                                periodo consultado.
                            </center>
                        </div>
                    </div>

                    <hr />
                    <!--Índice de masa corporal-->
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <h4>Índice de masa corporal</h4>
                                <p>
                                    La fórmula para el IMC es el peso en kilogramos dividido por la estatura en metros
                                    cuadrados.
                                </p>
                            </center>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <table class="table table-striped table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Año</th>
                                        <th>Mes</th>
                                        <th>Peso</th>
                                        <th>Altura</th>
                                        <th>IMC</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBodyIMC">

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <canvas id="myChartIMC">
                            </canvas>
                        </div>
                    </div>

                    <!--Frecuencia cardíaca-->
                    <hr />
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <h4>Frecuencia cardíaca</h4>
                            </center>
                            <p>
                                La frecuencia cardíaca​ es el número de contracciones del corazón o de pulsaciones​ por
                                unidad de tiempo. Se mide en condiciones bien determinadas y se expresa en pulsaciones
                                por minuto a nivel de las arterias periféricas y en latidos por minuto a nivel del
                                corazón.
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">

                            <table class="table table-striped table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Fecha Registro</th>
                                        <th>Edad</th>
                                        <th>FC</th>
                                        <th>Estado</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBodyFC">

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <canvas id="myChartFC">
                            </canvas>
                        </div>
                    </div>



                    <!--Presión arteria-->
                    <hr />
                    <div class="row">
                        <div class="col-md-12">
                            <center>
                                <h4>Presión arterial</h4>
                                <p>
                                    La presión arterial se expresa en dos números, como por ejemplo 112/78 mm Hg. El
                                    primer, o más grande, número (llamado presión sistólica), es la presión cuando late
                                    el corazón. El segundo, o más pequeño, número (llamado presión diastólica) es la
                                    presión cuando el corazón descansa entre latidos.
                                </p>
                            </center>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Fecha Registro</th>
                                        <th>Edad</th>
                                        <th>Sistólica</th>
                                        <th>Diastólica</th>
                                        <th>Presión Arterial</th>
                                        <th>Pulso</th>
                                        <th>Clasificación Presión Arterial</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBodyPA">

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <canvas id="myChartPA">
                            </canvas>
                        </div>
                    </div>


                  <!--Talla y peso-->
                  <hr />
                    <div class="row">
                        <div class="col-md-12 text-center">
                            <h4>Talla y peso</h4>
                        </div>
                        <div class="row">
                        <div class="col-md-12">
                            <table class="table table-striped table table-hover">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>Edad</th>
                                        <th>Peso</th>
                                        <th>Talla</th>
                                        <th>Peso Ideal</th>
                                        <th>Talla Ideal</th>
                                    </tr>
                                </thead>
                                <tbody id="tableBodyTallaPeso">

                                </tbody>
                            </table>
                        </div>
                        <div class="col-md-12">
                            <canvas id="myChartTallaPeso">
                            </canvas>
                        </div>

                    </div>

        <input id="hddDocumento" type="hidden" value="{{ $person->documento }}">
    </main>

    <script>
        /*INIT*/
        var objGrafica = {
            "label": "",
            "data": Array(),
            "borderColor": "",
            "backgroundColor": ""
        };

        const meses = {
            "1": "Ene",
            "2": "Feb",
            "3": "Mar",
            "4": "Abr",
            "5": "May",
            "6": "Jun",
            "7": "Jul",
            "8": "Ago",
            "9": "Sep",
            "10": "Oct",
            "11": "Nov",
            "12": "Dic",
        };

        
        getData();

        /*FUCIONES*/

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
                    getDataDiagnostico(data.data)
                    IMC(data.data);
                    FC(data.data);
                    PA(data.data);
                    TallaPeso(data.data);
                }
            });
        }

        function getDataDiagnostico(data) {
            
            if (data.diagnostico.length == 0) {
                $("#DvDiagnostico").append(
                    `<div>Aun no tiene información registrada.</div>`
                );
            }

            data.diagnostico.forEach(element => {

                var fecha = element.created_at;
                var fechaObjeto = new Date(fecha);
                var dia = fechaObjeto.getDate();
                var mes = fechaObjeto.getMonth() + 1;
                var anio = fechaObjeto.getFullYear();
                var fechaFormateada = dia + "/" + mes + "/" + anio;
                
                $("#DvDiagnostico").append(
                   `<div class="col-md-4" style="margin-bottom: 10px;"><div class="card"><div class="card-body"><h5 class="card-title">Periodo ${element.periodo}</h5><hr /><strong>Fecha:</strong><p class="card-text">${fechaFormateada}</P><strong>Comentario:</strong><p class="card-text">${element.DIAG}</p></div></div></div>`
                )
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

            if (data.IMC.length == 0) {
                $("#tableBodyIMC").append(
                    `<tr> <td colspan='6'>Aun no tiene información registrada.</td></tr>`
                );
            }

            data.IMC.forEach(element => {

                peso.push(element.peso);

                altura.push(element.altura);

                imc.push(element.IMC);

                label.push(`${meses[element.mes]}`);

                $("#tableBodyIMC").append(
                    `<tr> <td>${element.anio}</td> <td>${element.mes}</td> <td>${element.peso}</td> <td>${element.altura}</td> <td>${element.IMC}</td> <td>${element.estado}</td>  </tr>`
                )

            });

            arrayData.push({
                label: "Peso",
                data: peso,
                backgroundColor: 'rgba(63,134,203,1)',
                borderColor: 'rgba(63,134,203,1)',
                fill: false,
                order: 2
            });

            arrayData.push({
                label: "Altura",
                data: altura,
                borderColor: "rgba(255, 206, 86, 1)",
                backgroundColor: "",
                fill: false,
                cubicInterpolationMode: 'monotone',
                type: 'line',
                order: 1
            });

            arrayData.push({
                label: "IMC",
                data: imc,
                borderColor: "rgba(82, 192, 75, 1)",
                fill: false,
                pointStyle: 'circle',
                pointRadius: 10,
                pointHoverRadius: 15,
                type: 'line',
                order: 0

            });

            var options = {
                scales: {
                    xAxes: [{
                        gridLines: {
                            color: "black",
                            borderDash: [2, 5],
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Periodo",
                            fontColor: "green"
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "black",
                            borderDash: [2, 5],
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Peso",
                            fontColor: "green"
                        }
                    }]
                },
                /* scales: {
                     yAxes: [{
                         ticks: {
                             beginAtZero: true
                         },
                         scaleLabel: {
                             display: true,
                             labelString: "Peso",
                             fontColor: "black"
                         }
                     }]
                 },*/
                title: {
                    display: true,
                    text: "IMC"
                },

            }

            var chartOptions = {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 80,
                        fontColor: 'black'
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            color: "black"
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Periodo",
                            fontColor: "red"
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "black",
                            borderDash: [2, 5],
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Medida",
                            fontColor: "green"
                        }
                    }]
                }
            };


            garfica('myChartIMC', 'bar', label, arrayData, 'IMC', chartOptions);


        }


        function FC(data) {

            let arrayData = [];
            let label = [];
            let frecuencia = [];
            debugger;
            if (data.FC.length == 0) {
                $("#tableBodyFC").append(
                    `<tr> <td colspan='4'>Aun no tiene información registrada.</td></tr>`
                );
            }
            data.FC.forEach(element => {
                $("#tableBodyFC").append(
                    `<tr> <td>${element.created_at}</td> <td>${element.edad}</td> <td>${element.FC}</td> <td>${element.estado}</td>  </tr>`
                )

                label.push(element.created_at);
                frecuencia.push(element.FC);

            });

            arrayData.push({
                label: "F.C",
                data: frecuencia,
                backgroundColor: 'rgba(63,134,203,1)',
                borderColor: 'rgba(63,134,203,1)',
                fill: false,
                order: 2
            });

            var chartOptions = {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 80,
                        fontColor: 'black'
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            color: "black"
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Periodo",
                            fontColor: "red"
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "black",
                            borderDash: [2, 5],
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Medida",
                            fontColor: "green"
                        }
                    }]
                }
            };

            garfica('myChartFC', 'line', label, arrayData, 'F.C', chartOptions);

        }

        function PA(data) {

            let arrayData = [];
            let label = [];
            let frecuencia = [];


            if (data.PA.length == 0) {
                $("#tableBodyPA").append(
                    `<tr> <td colspan='7'>Aun no tiene información registrada.</td></tr>`
                );
            }
            data.PA.forEach(element => {
                $("#tableBodyPA").append(
                    `<tr> <td>${element.created_at}</td> <td>${element.edad}</td><td>${element.PS}<td>${element.PD}</td><td>${element.PA} (mm Hg)</td><td>${(element.PS - element.PD)} (mm Hg)</td><td>${element.estado}</td></tr>`
                );

                label.push(element.created_at);
                frecuencia.push(element.PA);
            });

            arrayData.push({
                label: "F.C",
                data: frecuencia,
                backgroundColor: 'rgba(63,134,203,1)',
                borderColor: 'rgba(63,134,203,1)',
                fill: false,
                order: 2
            });

            var chartOptions = {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 80,
                        fontColor: 'black'
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            color: "black"
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Periodo",
                            fontColor: "red"
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "black",
                            borderDash: [2, 5],
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Medida",
                            fontColor: "green"
                        }
                    }]
                }
            };


            garfica('myChartPA', 'line', label, arrayData, 'P.A', chartOptions);

        }

        function TallaPeso(data) {

            let arrayData = [];
            let peso = [];
            let altura = [];
            let label = [];
            let i = 0;

            if (data.IMC.length == 0) {
                $("#tableBodyTallaPeso").append(
                    `<tr> <td colspan='3'>Aun no tiene información registrada.</td></tr>`
                );
            }

            data.diagnostico.forEach(element => {

                peso.push(element.peso);

                altura.push(element.altura);

                label.push(element.altura);

                $("#tableBodyTallaPeso").append(
                    `<tr> <td>${element.edad}</td> <td>${Math.round(element.peso)}</td> <td>${parseFloat(element.altura).toFixed(2)}</td> <td>${element.pesoIdeal}</td> <td>${element.tallaIdeal}</td> </tr>`
                )

            });

            arrayData.push({
                label: "Peso",
                data: peso,
                backgroundColor: 'rgba(63,134,203,1)',
                borderColor: 'rgba(63,134,203,1)',
                fill: false,
                order: 2
            });

            arrayData.push({
                label: "Altura",
                data: altura,
                borderColor: "rgba(255, 206, 86, 1)",
                backgroundColor: "transparent",
                fill: false,
                order: 2
            });

            var chartOptions = {
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        boxWidth: 80,
                        fontColor: 'black'
                    }
                },
                scales: {
                    xAxes: [{
                        gridLines: {
                            display: false,
                            color: "black"
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Talla (cm)",
                            fontColor: "red"
                        }
                    }],
                    yAxes: [{
                        gridLines: {
                            color: "black",
                            borderDash: [2, 5],
                        },
                        scaleLabel: {
                            display: true,
                            labelString: "Peso",
                            fontColor: "green"
                        }
                    }]
                }
            };


            garfica('myChartTallaPeso', 'line', label, arrayData, 'Talla y peso', chartOptions);


}




        function garfica(element, tipoGrafica, label, dataSet, titulo, option) {

            var ctx = document.getElementById(element).getContext('2d');
            var myChart = new Chart(ctx, {
                type: tipoGrafica,
                data:

                {
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
