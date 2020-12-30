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

	<h5 align="center">GOBIERNO AUTONOMO DEPARTAMENTAL DEL BENI<br>DIRECCION DE COORDINACION MUNICIPAL<br>DATOS GENERALES DE PERSONERIAS JURIDICAS</h5>

	<div class="row">
    <table cellspacing="0" width="100%" align="center" border="1" style="font-size: 7pt">

      <tr>
          <th>Nro.</th>
          <th>Fecha Entrega</th>
          <th>Hoja<br>Ruta</th>
          <th>Personería Jurídica</th>
          <th>Representante<br>legal</th>
          <th>Objeto de la<br>Personería</th>
          <th>Ambito<br>Aplicación</th>
          <th>Tipo<br>Organización</th>
          <th>Número<br>Resolución</th>
          <th>Número<br>Certificado</th> 
          <th>Documento<br>Municipal</th>
          <th>Número<br>Doc. Municipal</th>
      </tr>
      <?php $numeroitems = 0; $totalitems = 0; ?>
      @foreach($personerias as $per)
      <?php $numeroitems++ ?>
      <?php $totalitems+= count($per); ?>
      <tr>
          <td style="width:15px;">{{$numeroitems}}</td>
          <td style="width:50px;">{{\Carbon\Carbon::parse($per->fechaEntrega)->format('d/m/Y')}}</td>
          <td style="width:50px;">{{$per->hojaRuta}}<br>{{\Carbon\Carbon::parse($per->fechaIngreso)->format('d/m/Y')}}</td>
    			<td>{{$per->nombrepersoneria}}</td>
          <td>{{$per->representante}}<br>{{$per->CI. ' '.$per->expedicion}}</td>
    			<td>{{$per->objeto}}</td>
   			  <td>{{$per->ambitoaplicacion}}</td>
   			  <td>{{$per->tipoorganizacion}}</td>
     			<td style="width:50px;">{{$per->numeroResolucion}}<br> {{\Carbon\Carbon::parse($per->fechaResolucion)->format('d/m/Y')}}</td>
          <td style="width:30px;">{{$per->numeroCertificado}}</td>
          <td>{{$per->documentoMunicipal}}</td>
          <td style="width:50px;">{{$per->numeroDocumento}}<br>{{$per->fechaNumerodocumento}}</td>
      </tr>
      @endforeach
    </table>
  </div> 
</body>
</html>