@extends('layouts.app')
@section('title','Crear personería jurídica')

<style>
  input[type=text] {
    background-color: #F9F8A6;
  }

  input[type=number] {
    background-color: #F9F8A6;
  }
</style>

@section('content')
<form action="{{route('personeriacoordinacionmunicipal.store')}}" method="POST" enctype="multipart/form-data">
	@csrf
<div class="container">
	<div class="row justify-content-center">

	<!-- 1er contenedor -->
	<!-- === -->
	<div class="col-md-6">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">Datos generales de personerias juridicas (Dir. Coordinación Municipal)</h3>
			</div>
			<div class="card-body">
				<h5 style="color:#adb5bd">Recepción de Documentos Externos(R.D.E.)</h5>
				<hr>
				<!-- === -->
				<div class="form-group">
					<label for="fechaIngreso">Fecha Ingreso Personería (R.D.E)</label>
					<input type="date" class="form-control" required value="{{old('fechaIngreso')}}" name="fechaIngreso" style="width: 50%;">
				</div>
				<!-- === -->
				<div class="form-group">
					<label for="hojaRuta">Hoja de Ruta (R.D.E.)</label>
					<input type="text" class="form-control form-control-sm" value="{{old('hojaRuta')}}" name="hojaRuta" placeholder="Hoja de Ruta del Documento" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
				</div>
					<!-- === -->
					
					<h5 style="color:#adb5bd">Datos del representante legal (Personería Juridica)</h5>
					<hr>
					<!-- === -->
				<div class="form-group">
					<label for="representante">Nombre Representante Legal</label>
					<input type="text" class="form-control form-control-sm" value="{{old('representante')}}" name="representante" placeholder="Nombre completo de representante legal" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
				</div>
				<!-- === -->
				<div class="form-group">
		          <label>Seleccionar Lugar de Expedicion</label>
		          <select required name="expedicion_id"  class="form-control form-control-sm select2bs4" style="width: 70%;">
		            @foreach ($expedicions as $exp)
		              <option value="{{$exp->id}}">{{$exp->nombre}}</option>
		            @endforeach
		          </select>
		        </div>
				<!-- === -->
				<div class="form-group">
					<label for="CI">Número de Carnet de Identidad</label>
					<input type="text" class="form-control form-control-sm" value="{{old('CI')}}" name="CI" placeholder="Número de Carnet de Identidad" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
				</div>
					<!-- === -->
					<h5 style="color:#adb5bd">Documentos municipales (Alcaldías)</h5>
					<hr>
					<!-- === -->
				<div class="form-group">
		            <label>Documentación Municipal:</label>
		            <div class="controls">
		              <select required name="documentoMunicipal" class="select2bs4" style="width: 50%;">
		                <option>CERTIFICACION</option>
		                <option>INFORME TECNICO</option>
		                <option>LEY</option>
		                <option>RESOLUCION MUNICIPAL</option>
		              </select>
		            </div>
		        </div>
		        <!-- === -->
				<div class="form-group">
					<label for="numeroDocumento">Número de: Certificado - Informe - Ley - Resolución Municipal</label>
					<input type="text" class="form-control form-control-sm" value="{{old('numeroDocumento')}}" name="numeroDocumento" placeholder="Ingresar Número según el caso" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
				</div>
					<!-- === -->
					<div class="form-group">
					<label for="fechaNumerodocumento">Fecha de: Certificado - Informe - Ley - Resolución Municipal</label>
					<input type="date" class="form-control" value="{{old('fechaNumerodocumento')}}" name="fechaNumerodocumento" style="width: 50%;">
				</div>
				<!-- === -->
			</div>
		</div>
	</div>
	<!-- 2do contenedor -->
	<!-- === -->
	<div class="col-md-6">
		<div class="card card-info">
			<div class="card-header">
				<h3 class="card-title">Datos Personería Jurídica (Dir. Coordinación Municipal)</h3>
			</div>
			<div class="card-body">
				<!-- === -->
				<div class="form-group">
		          <label>Personería Jurídica</label>
		            <select name="reservacoormunicipal_id" required class="form-control form-control-sm select2bs4" style="width: 100%;">
		              @foreach ($reservas as $reserva)
		              <option value="{{$reserva->id}}">{{$reserva->reserva}}</option>
		              @endforeach
		            </select> 
		        </div>
		        <!-- === -->
		        <div class="form-group">
		          <label>Objeto de la Personería Jurídica</label>
		            <select name="objeto_id" required class="form-control form-control-sm select2bs4" style="width: 100%;">
		              @foreach ($objetos as $obj)
		              <option value="{{$obj->id}}">{{$obj->nombre}}</option>
		              @endforeach
		            </select> 
		        </div>
		        <!-- === -->
		        <div class="form-group">
		          <label>Ambito de Aplicación</label>
		              <select name="ambitoaplicacion_id" required class="form-control form-control-sm select2bs4" style="width: 100%;">
		                @foreach ($ambitoaplicacions as $ambapli)
		                <option value="{{$ambapli->id}}">{{$ambapli->nombre}}</option>
		                @endforeach
		              </select> 
		        </div>
		        <!-- === -->
		        <div class="form-group">
		            <label>Tipo de Organización</label>
		              <select name="tipoorganizacion_id" required class="form-control form-control-sm select2bs4" style="width: 100%;">
		                @foreach ($tipoorganizacions as $tipo)
		                <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
		                @endforeach
		              </select> 
		        </div>
		        <!-- === -->
				<div class="form-group">
					<label for="numeroCertificado">Número de Certificado</label>
					<input type="number" class="form-control form-control-sm" value="{{old('numeroCertificado')}}" name="numeroCertificado" placeholder="Número de certificado (Dir. Coordinación Municipal)" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
				</div>
				<!-- === -->
				<div class="form-group">
					<label for="numeroResolucion">Número de Resolución Gobernación</label>
					<input type="text" class="form-control form-control-sm" name="numeroResolucion" value="{{old('numeroResolucion')}}" placeholder="Número de resolución de gobernación" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
				</div>
				<!-- === -->
				<div class="form-group">
					<label for="fechaResolucion">Fecha de Resolución Gobernación</label>
					<input type="date" class="form-control" value="{{old('fechaResolucion')}}" name="fechaResolucion" style="width: 50%;">
				</div>
				<!-- === -->
				<div class="form-group">
					<label for="caratulaNotarial">Carátula Notarial</label>
					<input type="number" class="form-control form-control-sm" value="{{old('caratulaNotarial')}}" name="caratulaNotarial" placeholder="Número de caratula notarial" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
				</div>
				<div class="form-group">
					<label for="caratulaExpediente">Carátula de Expediente</label>
					<input type="number" class="form-control form-control-sm" value="{{old('caratulaExpediente')}}" name="caratulaExpediente" placeholder="Número caratula de expediente" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
				</div>
					<!-- === -->
					<div class="form-group">
					<label for="folderExpediente">Folder de Expediente</label>
					<input type="number" class="form-control form-control-sm" value="{{old('folderExpediente')}}" name="folderExpediente" placeholder="Número de folder de expediente" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
				</div>
					<!-- === -->
					<div class="form-group">
					<label for="numeroTestimonio">Número de Testimonio</label>
					<input type="number" class="form-control form-control-sm" value="{{old('numeroTestimonio')}}" name="numeroTestimonio" placeholder="Número de Testimonio" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
				</div>
					<!-- === -->
					<div class="form-group">
					<label for="fechaConclusiontramite">Fecha Conclusión de Trámite</label>
					<input type="date" class="form-control" required value="{{old('fechaConclusiontramite')}}" name="fechaConclusiontramite" style="width: 50%;">
				</div>
				<!-- === -->
				<div class="form-group">
					<label for="fechaEntrega">Fecha Entrega de Personería Jurídica</label>
					<input type="date" class="form-control" required value="{{old('fechaEntrega')}}" name="fechaEntrega" style="width: 50%;">
				</div>
				<!-- === -->
				<div class="control-group">
		          <label class="control-label">Archivo Adjunto:</label>
		          <div class="controls">
		            <input type="file" id="archivoInput" onchange="return validarArchivo()" name="archivo">
		          </div>
		        </div>
			
			</div>
			<div class="card-footer">
				@include('personeriacoordinacionmunicipal.partials.actions')
			</div>
		</div>
	</div>
	<!-- === -->
	</div>
</div>
</form>
@endsection

@push ('styles')
	<!-- Select2 -->
    <link rel="stylesheet" href="{{asset('theme/plugins/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('theme/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css')}}">
@endpush

@push ('script')
	<!-- Select2 -->
    <script src="{{asset('theme/plugins/select2/js/select2.full.min.js')}}"></script>

	<script>
		$(function () {
		    //Inicializa Select2 Elements
		    $('.select2bs4').select2({
		      theme: 'bootstrap4'
		    })
	  	})

		function validarArchivo()
		{
		    var archivoInput = document.getElementById('archivoInput');
		    var archivoRuta = archivoInput.value;
		    var extPermitidas = /(.pdf)$/i;
		    if(!extPermitidas.exec(archivoRuta)){
		        alert('Asegurese de haber seleccionado un archivo .PDF');
		        archivoInput.value = '';
		        return false;
		    }
		}

	</script>
@endpush