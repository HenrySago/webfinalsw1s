<html>
<title>Lector Medidor</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="{{ public_path('css/w3.css') }}">
<style>
    @page { margin: 100px 40px; }
    header { position: fixed; top: -80px; left: 0px; right: 0px;  height: 10px; }
    footer { position: fixed; bottom: -60px; left: 0px; right: 0px;  height: 50px; }
    table {
        border-collapse: collapse;
        width: 100%;
        padding-left: 0%;
        border: 1px solid #e0e0e0;
    }
    p.saltodepagina
    {
        page-break-after: always;
    }

    td {
        padding: 7px;
        text-align: left;
    }
    tr:nth-child(even) {background-color: #f2f2f2;}
    th {
        background-color: #aaaaaa;
        color: white;
        text-align: center;
        padding: 7px;
    }
    body {
        font-family:Helvetica,Futura,Arial,Verdana,sans-serif;
    }
</style>
<body>

<div class="w3-container">

    <header>
        <div class="w3-row" style="margin-top: 1em;">
          <div class="w3-half" style="text-align: left;">
           <img src="{{public_path('images/logo.png')}}" style="height: 50px;width: auto;margin-left: 1em;"> 
          </div>
          <div class="w3-half" style="text-align: right;">
            <p style="font-size: 10px;margin-top: 3em;margin-left: 1em;vertical-align:middle;">Reporte generado: {{\Carbon\Carbon::now()}}</p>
          </div>
        </div>
    </header>

        
    <div style="width: 100%; text-align: center;">
        <div class="w3-container">
            <strong style="font-size: 17px;color: #006FA4;">Reporte general</strong>
        </div>
        <p style="font-size: 12px;margin-top: 1em;">Reporte generado por <strong>{{ auth()->user()->name }} </strong></p>
    </div>


    <table class="w3-table-all w3-centered"  style="font-size:12px;margin-top: 2em; " >
        <thead>
            <tr>
                <th> # </th>
                <th> Mensualidad </th>
                <th> Cliente </th>
                <th> Colaborador </th>
                <th> Administrador </th>
                <th> Estado </th>
                <th> Pagado </th>
                <th> Consumo lecturado (m3) </th>
                <th> Consumo real (m3) </th>
                <th> Total (bs) </th>
            </tr>
        </thead>
        <tbody>
                @foreach($mediciones as $item)
                <tr >
                    <td style="vertical-align: middle;">  {{$item->id}} </td>
                    <td style="vertical-align: middle;"> {{$item->mensualidad->nombre}} {{$item->mensualidad->gestion->nombre}} </td>
                    <td style="vertical-align: middle;"> {{$item->cliente->nombres}} {{$item->cliente->apellidos}}</td>
                    <td style="vertical-align: middle;"> {{$item->colaborador->nombres}} {{$item->colaborador->apellidos}} </td>
                    <td style="vertical-align: middle;"> {{$item->administrador->name}} </td>
                    <td style="vertical-align: middle;"> 
                        @if($item->estado==1)
                        <span style="width: 100%;padding: 3px;background-color: green;color: white">Medido</span>
                        @else
                        <span style="width: 100%;padding: 3px;background-color: red;color: white">Sin medir</span>
                        @endif  
                    </td>
                    <td style="vertical-align: middle;">
                        @if($item->factura!=null)
                            @if($item->factura->pagado==1)
                            <span style="width: 100%;padding: 3px;background-color: green;color: white">Pagado</span>
                            @else
                            <span style="width: 100%;padding: 3px;background-color: red;color: white">No pagado</span>
                            @endif  
                        @endif 
                    </td>
                    <td style="vertical-align: middle;"> {{$item->consumo}}</td>
                    <td style="vertical-align: middle;"> {{$item->consumoReal}}</td>
                    <td style="vertical-align: middle;"> {{$item->total}}</td>
                </tr>
                @endforeach
        </tbody>

    </table>


    <footer>
        <div class="w3-row" style="margin-top: 1em;text-align: left;">
            <p style="font-size: 10px;margin-left: 1em;vertical-align:middle;color: #888888;">Lector Medidor <strong></strong> by <strong>2022 © UAGRM</strong></p>
        </div>
    </footer>

</div>

</body>
</html>
