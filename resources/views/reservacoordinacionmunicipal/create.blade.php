@extends('layouts.app')
@section('title','Crear reserva de nombre')
<style>
  input[type=text] {
    background-color: #F9F8A6;
  }

  input[type=number] {
    background-color: #F9F8A6;
  }
</style>

@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card card-info">
				<div class="card-header">
					<h3 class="card-title">Registrar Reserva de Nombre: Dirección de Coordinación Municipal</h3>
				</div>

			<form action="{{route('reservacoordinacionmunicipal.store')}}" method="POST">
				@csrf
				<div class="card-body">
					<!-- === -->
					<div class="form-group">
	                  <label>Sucursal del Usuario (Usuario del Sistema)</label>
	                  <select required name="sucursal_id" class="form-control form-control-sm" style="width: 70%;">
	                    @foreach ($sucursales as $sucursal)
		                  <option value="{{$sucursal->id}}">{{$sucursal->sucursal}}</option>
		                @endforeach
	                  </select>
	                </div>
					<!-- === -->
					<div class="form-group">
						<label for="nombre">Nombre de Reserva</label>
						<input type="text" class="form-control form-control-sm" required name="nombre" placeholder="Nombre de Reserva (Personería)" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
						@if(Session::has('notice'))
			            	<p style="color:#FF0000";> <strong> {{ Session::get('notice') }} </strong> <i class="icon-warning-sign"></i> </p>
			            @endif
					</div>
					<!-- === -->
					<div class="form-group">
	                  <label>Seleccionar Provincia</label>
	                  <select id="provincia_id" required name="provincia_id" class="form-control form-control-sm select2bs4" style="width: 70%;">
	                    <option disabled selected value="">Seleccionar Provincia</option>
	                    @foreach ($provincias as $prov)
		                  <option value="{{$prov->id}}">{{$prov->nombre}}</option>
		                @endforeach
	                  </select>
	                </div>
	                <!-- === -->
	                <div class="form-group">
	                  <label>Seleccionar Municipio</label>
	                  <select id="municipio_id" required name="municipio_id" class="form-control form-control-sm select2bs4" style="width: 70%;">
	                   	<option value="">{{__("Seleccionar Municipio")}}</option>
	                  </select>
	                </div>
          			<!-- === -->
					<div class="form-group">
						<label for="localidad">Localidad</label>
						<input type="text" class="form-control form-control-sm" required value="{{ Session::get('old_localidad') ?? '' }}" name="localidad" placeholder="Localidad" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
					</div>
					<!-- === -->
					<div class="form-group">
						<label for="nombreSolicitante">Nombre Solicitante</label>
						<input type="text" class="form-control form-control-sm" required value="{{ Session::get('old_nombreSolicitante') ?? '' }}" name="nombreSolicitante" placeholder="Nombre completo del solicitante" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
					</div>
					<!-- === -->
					<div class="form-group">
						<label for="numeroRecibo">Número de Recibo Oficial</label>
						<input type="number" class="form-control form-control-sm" required value="{{ Session::get('old_numeroRecibo') ?? '' }}" name="numeroRecibo" placeholder="Número de recibo oficial" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
					</div>
					<!-- === -->
					<div class="form-group">
						<label for="costoReserva">Costo de Reserva de nombre</label>
						<input type="number" class="form-control form-control-sm" required value="{{ Session::get('old_costoReserva') ?? '' }}" name="costoReserva" placeholder="Costo de reserva de nombre" autocomplete="off" style="text-transform:uppercase;" onkeyup ="this.value=this.value.toUpperCase()">
					</div>
					<!-- === -->
					<div class="form-group">
						<label for="fechainicio">Fecha Reserva de Nombre (Inicio de trámite)</label>
						<input type="date" class="form-control" required value="{{ Session::get('old_fechainicio') ?? '' }}" name="fechainicio" style="width: 50%;">
					</div>
					<!-- === -->
				</div>

				<div class="card-footer">
					@include('reservacoordinacionmunicipal.partials.actions')
				</div>
			</form>
			</div>
		</div>
	</div>
</div>
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

			//Inicializa combo heredado
		  	$('#provincia_id').on('change',function(e){
			  var dep_id  = e.target.value;

			  $.get('/municipio?dep_id=' + dep_id, function(data){

			    $('#municipio_id').empty();
			    $('#municipio_id').append('<option value="0" disabled="true" selected="true">Seleccione Municipio</option>');

			    $.each(data, function(index, dependenciasObj){
			      $('#municipio_id').append('<option value="'+ dependenciasObj.id +'">'+ dependenciasObj.municipio +'</option>');
			    })
			  });
			});

			//Captura id del combo heredado
			$('#municipio_id').on('change',function(e){
			  let dep_id  = e.target.value;
			  console.log(dep_id);
			});
	</script>
@endpush