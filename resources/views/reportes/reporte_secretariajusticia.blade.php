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

	<h5 align="center">GOBIERNO AUTONOMO DEPARTAMENTAL DEL BENI<br>SECRETARIA DEPARTAMENTAL DE JUSTICIA<br>DATOS GENERALES DE PERSONERIAS JURIDICAS</h5>

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
          <th>Carátula<br> Notarial</th> 
          <th>Carátula<br> Expediente</th>
          <th>Folder<br> Expediente</th>
          <th>Número<br> Testimonio</th>
          <th>Número<br>Resolución</th>
          <th>Costo Servicio<br>Personerías Jurídicas</th>
          <th>Valorados</th>
      </tr>
      <?php $sumaPersoneria = 0; $sumaValoragregado = 0; $sumaTotal = 0; $numeroitems = 0; ?>
      @foreach($personerias as $per)
      <?php $numeroitems++ ?>
      <?php $sumaPersoneria += $per->costoPersoneria; ?>
      <?php $sumaValoragregado += $per->costoValoragregado; ?>
      <?php $sumaTotal += $per->costoValoragregado+$per->costoPersoneria; ?>

      <tr>
          <td style="width:15px;">{{$numeroitems}}</td>
          <td style="width:50px;">{{\Carbon\Carbon::parse($per->fechaEntrega)->format('d/m/Y')}}</td>
          <td>{{$per->hojaRuta}}<br>{{\Carbon\Carbon::parse($per->fechaIngreso)->format('d/m/Y')}}</td>
    			<td>{{$per->nombrepersoneria}}</td>
          <td>{{$per->representante}}<br>{{$per->CI. ' '.$per->expedicion}}</td>
    			<td>{{$per->objeto}}</td>
   			  <td>{{$per->ambitoaplicacion}}</td>
   			  <td>{{$per->caratulaNotarial}}</td>
          <td>{{$per->caratulaExpediente}}</td>
          <td>{{$per->folderExpediente}}</td>
          <td>{{$per->numeroTestimonio}}</td>
     			<td>{{$per->numeroResolucion}}<br>{{\Carbon\Carbon::parse($per->fechaResolucion)->format('d/m/Y')}} </td>
          <td>{{$per->costoPersoneria}} Bs.</td>
          <td>{{$per->costoValoragregado}} Bs.</td>
      </tr>
      @endforeach
    </table>
  </div>

  <div class="row">
    <table width="100%" align="center" style="font-size: 7pt">
      <tr>
        <th class="col-md-12"style="text-align: right">Totales Personerías Jurídicas<br>Costo Servicio (Personerías): {{NumerosEnLetras::convertir($sumaPersoneria,'Bolivianos',true)}}<br>Valorados: {{NumerosEnLetras::convertir($sumaValoragregado,'Bolivianos',true)}}<br>Total: {{NumerosEnLetras::convertir($sumaTotal,'Bolivianos',true)}}</th>
      </tr>
    </table>
  </div>
  
</body>
</html>