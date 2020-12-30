<!DOCTYPE html>
<html>
<head>
	<title>Personeria - Dirección Coordinación Municipal</title>
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
</style>
<body>
	<div id="watermark">
        <p style="font-family: impact, serif; font-size:80pt;">
            SIDEPEJ
        </p>
    </div>

    <h5 align="center">GOBIERNO AUTONOMO DEPARTAMENTAL DEL BENI<br>DIRECCION DE COORDINACION MUNICIPAL</h5>

    @foreach($personerias as $per)
    <div class="row">
        <table cellspacing="0" border="1" width="100%" align="center" style="font-size: 9pt">
           <caption><strong>DATOS PERSONERIA JURIDICA</strong> </caption>
			<tr>
				<th>Nombre Personería Jurídica</th>
    			<td colspan="3">{{$per->nombrepersoneria}}</td>
			</tr>
			<tr>
				<th>Provincia</th>
    			<td colspan="3">{{$per->provincia}}</td>
			</tr>
			<tr>
				<th>Municipio</th>
    			<td colspan="3">{{$per->municipio}}</td>
			</tr>
			<tr>
				<th>Localidad</th>
    			<td colspan="3">{{$per->localidad}}</td>
			</tr>
			<tr>
				<th>Representante Legal</th>
    			<td colspan="3">{{$per->representante}} - CI: {{$per->CI. ' ' .$per->expedicion}}</td>
			</tr>
			<tr>
				<th style="text-align: center">Número<br>carátula notarial</th>
				<th style="text-align: center">Número<br>carátula expediente</th>
				<th style="text-align: center">Número<br>folder de expediente</th>
				<th style="text-align: center">Número<br>testimonio</th>
			</tr>
			<tr>
				<td style="text-align: center">{{$per->caratulaNotarial}}</td>
				<td style="text-align: center">{{$per->caratulaExpediente}}</td>
				<td style="text-align: center">{{$per->folderExpediente}}</td>
				<td style="text-align: center">{{$per->numeroTestimonio}}</td>
			</tr>
			<tr>
				<th style="text-align: center">Hoja de ruta (R.D.E.)</th>
				<th style="text-align: center">Objeto<br>personería jurídica</th>
				<th style="text-align: center">Ambito aplicación<br>personería jurídica<</th>
				<th style="text-align: center">Tipo organización</th>
			</tr>
			<tr>
				<td style="text-align: center">{{$per->hojaRuta}}<br>{{\Carbon\Carbon::parse($per->fechaIngreso)->format('d/m/Y')}}</td>
				<td style="text-align: center">{{$per->objeto}}</td>
				<td style="text-align: center">{{$per->ambitoaplicacion}}</td>
				<td style="text-align: center">{{$per->tipoorganizacion}}</td>
			</tr>
			<tr>
				<th style="text-align: center">Número certificado<br>Coordinación municipal</th>
				<th style="text-align: center">Resolución de gobernación</th>
				<th style="text-align: center">Fecha resolución de gobernación</th>
				<th style="text-align: center">Documentación alcaldía</th>
			</tr>
			<tr>
				<td style="text-align: center">{{$per->numeroCertificado}}</td>
				<td style="text-align: center">{{$per->numeroResolucion}}</td>
				<td style="text-align: center">{{\Carbon\Carbon::parse($per->fechaResolucion)->format('d/m/Y')}}</td>
				<td style="text-align: center">{{$per->documentoMunicipal}}<br>NRO: {{$per->numeroDocumento}}<br> FECHA: {{$per->fechaNumerodocumento}}</td>
			</tr>
        </table>
  	</div><br>

  	<div class="row">
        <table cellspacing="0" border="1" width="100%" align="center" style="font-size: 9pt">
           <caption><strong>DATOS ADICIONALES</strong> </caption>
			<tr>
				<th>Nombre Solicitante</th>
    			<td colspan="3">{{$per->nombreSolicitante}}</td>
			</tr>
			
			<tr>
				<th style="text-align: center">Numero de recibo oficial</th>
				<th style="text-align: center">Costo reserva nombre</th>
				<th style="text-align: center">Inicio Trámite</th>
				<th style="text-align: center">Finalizacion de trámite</th>
			</tr>
			<tr>
				<td style="text-align: center">{{$per->numeroRecibo}}</td>
				<td style="text-align: center">{{$per->costoReserva}} Bs.</td>
				<td style="text-align: center">{{\Carbon\Carbon::parse($per->fechainicio)->format('d/m/Y')}}</td>
				<td style="text-align: center">{{\Carbon\Carbon::parse($per->fechafin)->format('d/m/Y')}}</td>
			</tr>
        </table>
  	</div>
  	@endforeach
</body>
</html>