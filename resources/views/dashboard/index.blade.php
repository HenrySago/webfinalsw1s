@extends('layout.panel')
@push('links')
<link href="{{asset('css/Chart.css')}}" rel="stylesheet">
<link rel="stylesheet" href="assets/global/css/theme.css">
  <style>
.page-content-wrapper .page-content {
    margin-left: 235px;
    margin-top: 0;
    min-height: 600px;
    padding: 0px 0px 0px;
}

.page-content-wrapper .page-content {
  background-color: #ffffff;
  align-items: center;
  justify-content: center;
  animation: 4s linear 0s infinite backAnim;
}

.widget p{
  display: inline-block;
  line-height: 1em;
}
.fecha{
  text-align: center;
  font-size: 1.5em;
  margin-bottom: 0.3125rem;
  background: #4f646a;
  padding: 20px;
  width: 100%;
}
.count{
  text-align: center;
  font-size: 1em;
  margin-bottom: 0.3125rem;
  background: #4f646a;
  padding: 28px;
  width: 100%;
}
.count h5{
  color: white;
  font-size: 14px;
  font-weight: 500;
}
.counting{
  color: white;
}
.fecha p{
  color: white;
}
.reloj{
  width: 100%;
  padding: 20px;
  font-size: 4em;
  text-align: center;
  background: #4f646a;
}
.reloj p{
  color: white;
}
.reloj .caja-segundos{
  display: inline-block;
}
.reloj .segundos,
.reloj .ampm{
  font-size: 2rem;
  display: block;
}
.reloj hr, p {
    margin: 0px 0px;
}
.stats {
  text-align: center;
  font-size: 35px;
  font-weight: 700;
  font-family: 'Montserrat', sans-serif;
}

.stats .fa {
  color: #008080;
  font-size: 60px;
}
  </style>
@endpush

@section('content')

<div class="full-height-content full-height-content-scrollable">
    <div class="full-height-content-body">
        <div class="row col-md-12" style="padding-top: 10px;">
          <div class="col-md-4">
            <div class="wrap">
              <div class="widget">
                <div class="fecha">
                  <p id="diaSemana" class="diaSemana"></p>
                  <p id="dia" class="dia"></p>
                  <p>de</p>
                  <p id="mes" class="mes"></p>
                  <p>del</p>
                  <p id="year" class="year"></p>
                </div>
                <div class="reloj">
                  <p id="horas" class="horas"></p>
                  <p>:</p>
                  <p id="minutos" class="minutos"></p>
                  <p>:</p>
                  <div class="caja-segundos">
                    <p id="ampm" class="ampm"></p>
                    <p id="segundos" class="segundos"></p>
                  </div>
                </div>
              </div>
            </div>       
          </div>

          <div class="col-md-2 stats" style="margin-top: 1px;">
            <div class="wrap">
                <div class="widget">
                  <div class="count">
                  <i class="fa fa-user" aria-hidden="true"></i>
                  <div class="counting" data-count="{{ $nro_colaboradores }}">0</div>
                  <h5>Tecnicos</h5>
                </div>
              </div>
            </div>
          </div>

            <div class="col-md-2 stats" style="margin-top: 1px;">
            <div class="wrap">
                <div class="widget">
                  <div class="count">
                  <i class="fa fa-user-circle" aria-hidden="true"></i>
                  <div class="counting" data-count="{{ $nro_clientes }}">0</div>
                  <h5>Cliente</h5>
                </div>
              </div>
            </div>
          </div>

            <div class="col-md-2 stats" style="margin-top: 1px;">
            <div class="wrap">
                <div class="widget">
                  <div class="count">
                  <i class="fa fa-print" aria-hidden="true"></i>
                  <div class="counting" data-count="{{ $nro_facturas }}">0</div>
                  <h5>Facturas</h5>
                </div>
              </div>
            </div>
          </div>

            <div class="col-md-2 stats" style="margin-top: 1px;">
            <div class="wrap">
                <div class="widget">
                  <div class="count">
                  <i class="fa fa-laptop" aria-hidden="true"></i>
                  <div class="counting" data-count="{{ $nro_mediciones }}">0</div>
                  <h5>Mediciones</h5>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row col-md-12" style="padding-top: 10px;">
          <div class="col-md-6">
                <div class="portlet light bordered" style="background-color: #4f646a;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-green-haze"></i>
                            <span class="caption-subject bold uppercase font-green-haze"> Colaboradores con mas asignaciones</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <canvas id="pie" height="150"></canvas>
                    </div>
                </div>
          </div>
          <div class="col-md-6">
                <div class="portlet light bordered" style="background-color: #4f646a;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-bar-chart font-green-haze"></i>
                            <span class="caption-subject bold uppercase font-green-haze"> Total Bs por mensualidad</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <canvas id="myChart" height="150"></canvas>
                    </div>
                </div>
          </div>
        </div>
    </div>

    
</div>
<footer>
<a href="#">visitas : {{ $visitas }}</a>
</footer>
@endsection
@push('scripts')     
<script src="{{asset('js/Chart.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/highcharts/js/highcharts.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/highcharts/js/highcharts-3d.js')}}" type="text/javascript"></script>
<script src="{{asset('assets/global/plugins/highcharts/js/highcharts-more.js')}}" type="text/javascript"></script>
<script>

$('#navDashboard').addClass('active open');
$('#navDashboard span.arrow').addClass('open');
$('#itemDashboard').addClass('active open');

$(window).on('load',function(){


  var pie = document.getElementById('pie');
  var ctx = document.getElementById('myChart');


  Chart.defaults.global.defaultFontStyle = 'Bold';
  Chart.defaults.global.defaultFontColor = 'white';
  Chart.defaults.global.defaultFontSize = 16;
  Chart.defaults.global.elements.arc.borderColor = '#fffff';
  Chart.defaults.global.elements.arc.backgroundColor = 'rgba(122, 245, 0, 0.1)';
  Chart.defaults.global.elements.arc.borderAlign = 'center';
  Chart.defaults.global.elements.arc.borderColor = '#fffff';
  Chart.defaults.global.elements.arc.borderWidth = 2;
  Chart.defaults.global.elements.rectangle.backgroundColor ='rgba(122, 245, 0, 0.1)';
  Chart.defaults.global.elements.rectangle.borderWidth = 6;
  Chart.defaults.global.elements.rectangle.borderColor = '#fffff';
  Chart.defaults.global.elements.rectangle.borderSkipped = 'left';

  Chart.defaults.global.gridLines

  var colores = [
  '#FA8258',
  '#04B404',
  '#04B4AE',
  '#0489B1',
  '#7401DF',
  '#B40431',
  '#848484',
  '#07190B',
  '#B45F04'
  ];

  var indexColor = 0;

  var colaboradores = {!! json_encode($colaboradores) !!};
  var mensualidades = {!! json_encode($mensualidades) !!};

  console.log(colaboradores);
  console.log(mensualidades);

  var oilDataLabels = [];
  var oilDataData = [];
  var oilDataBackgroundColor = [];



  for (var i = 0; i < colaboradores.length ; i++) {
      oilDataLabels.push(colaboradores[i].nombres+" "+colaboradores[i].apellidos);
      oilDataData.push(colaboradores[i].mediciones.length);
      if (indexColor==colores.length) {
        indexColor = 0;
      }
      oilDataBackgroundColor.push(colores[indexColor]);
      indexColor++;
  }
  //pie

  var oilData = {
      labels: oilDataLabels,
      datasets: [
          {
              data: oilDataData,
              backgroundColor: oilDataBackgroundColor
          }]
  };

  var pieChart = new Chart(pie, {
    type: 'pie',
    data: oilData
  });




  var barDataLabels = [];
  var barData = [];
  var barDataBackgroundColor = [];
  for (var i = 0; i < mensualidades.length ; i++) {
      barDataLabels.push(mensualidades[i].nombreMensualidad+" "+mensualidades[i].nombreGestion);
      barData.push(mensualidades[i].total);
      if (indexColor==colores.length) {
        indexColor = 0;
      }
      barDataBackgroundColor.push(colores[indexColor]);
      indexColor++;
  }


  //bar
  var myChart = new Chart(ctx, {
      type: 'bar',
      data: {
          labels: barDataLabels,
          datasets: [{
              label: 'Bs ',
              data: barData,
              backgroundColor: barDataBackgroundColor,
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              yAxes: [{
                  ticks: {
                      beginAtZero: true
                  }
              }]
          }
      }
  });




 

});


</script>
<script>
(function(){

  $('.counting').each(function() {
    var $this = $(this),
        countTo = $this.attr('data-count');
    
    $({ countNum: $this.text()}).animate({
      countNum: countTo
    },

    {

      duration: 3000,
      easing:'linear',
      step: function() {
        $this.text(Math.floor(this.countNum));
      },
      complete: function() {
        $this.text(this.countNum);
        //alert('finished');
      }

    });  
    

  });

  var actualizarHora = function(){
    var fecha = new Date(),
        horas = fecha.getHours(),
        ampm,
        minutos = fecha.getMinutes(),
        segundos = fecha.getSeconds(),
        diaSemana = fecha.getDay(),
        dia = fecha.getDate(),
        mes = fecha.getMonth(),
        year = fecha.getFullYear();
    
    var pHoras = document.getElementById("horas"),
         pAMPM = document.getElementById("ampm"),
         pMinutos = document.getElementById("minutos"),
         pSegundos = document.getElementById("segundos"),
         pDiaSemana = document.getElementById("diaSemana"),
         pDia = document.getElementById("dia"),
         pMes = document.getElementById("mes"),
         pYear = document.getElementById("year");
    
    var semana = ['Domingo','Lunes','Martes','Miercoles','Jueves','Viernes','Sabado'];
    pDiaSemana.textContent = semana[diaSemana];
    pDia.textContent = dia;
    
    var meses = ['Enero','Febrero','Marzo','Abril','Mayo','Junio','Julio','Agosto','Septiembre','Octubre','Noviembre','Diciembre'];
    pMes.textContent = meses[mes];
    pYear.textContent = year;
    
    if(horas>=12){
      horas = horas-12;
      ampm = "PM";
    }else{
      ampm = "AM";
    }
    
    if(horas == 0){
      horas = 12;
    }
    
    pHoras.textContent = horas;
    pAMPM.textContent = ampm;
    
    if(minutos<10){
      minutos = "0" + minutos;
    }
    if(segundos<10){
      segundos = "0" + segundos;
    }
    
    pMinutos.textContent = minutos;
    pSegundos.textContent = segundos;
  };

  actualizarHora();
  var intervalo = setInterval(actualizarHora,1000);

}())
</script>
@endpush