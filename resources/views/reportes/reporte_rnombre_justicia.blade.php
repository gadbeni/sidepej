<!DOCTYPE html>
<html>
<head>
    <title>Reporte Personerías Jurídicas</title>
</head>
<style>
#watermark {
    position: fixed;
    top: 25%;
    width: 100%;
    text-align: center;
    opacity: .15;
    transform-origin: 50% 50%;
    z-index: -1000;
  }

  table th {
    text-align: center;
  }

  table td {
    text-align: center;
  }
</style>
<body>
    <div id="watermark">
        <p style="font-family: impact, serif; font-size:80pt;">
            SIDEPEJ
        </p>
    </div>

    <h5 align="center">GOBIERNO AUTONOMO DEPARTAMENTAL DEL BENI<br>SECRETARIA DEPARTAMENTAL DE JUSTICIA<br>DETALLE DE RESERVAS DE NOMBRES</h5>

    <div class="row">
    <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 7pt">

      <tr>
          <th>Nro.</th>
          <th>Provincia</th>
          <th>Municipio</th>
          <th>Localidad</th>
          <th>Nombre de<br>reserva</th>
          <th>Nombre del<br>solicitante</th>
          <th>Número<br>recibo</th>
          <th>Fecha<br>inicio</th> 
          <th>Fecha<br>finalización</th>
          <th>Costo<br>reserva</th>
      </tr>
      <?php $sumaReservanombre = 0; $numeroitems = 0;?>
      @foreach($reservanombres as $rnfort)
      <?php $numeroitems++ ?>
      <?php $sumaReservanombre += $rnfort->costoReserva; ?>
      <tr>
          <td style="width:15px;">{{$numeroitems}}</td>
          <td>{{$rnfort->provincia}}</td>
          <td>{{$rnfort->municipio}}</td>
          <td>{{$rnfort->localidad}}</td>
          <td>{{$rnfort->nombre_reserva}}</td>
          <td>{{$rnfort->nombreSolicitante}}</td>
          <td>{{$rnfort->numeroRecibo}}</td>
          <td>{{$rnfort->fechainicio}}</td>
          <td>{{$rnfort->fechafin}}</td>
          <td>{{$rnfort->costoReserva}} Bs.</td>
      </tr>
      @endforeach
    </table>
  </div>

  <div class="row">
    <table width="100%" align="center" style="font-size: 7pt">
      <tr>
        <th class="col-md-12"style="text-align: right">Totales Reserva Nombre<br>{{NumerosEnLetras::convertir($sumaReservanombre,'Bolivianos',true)}}</th>
      </tr>
    </table>
  </div>
  
</body>
</html>