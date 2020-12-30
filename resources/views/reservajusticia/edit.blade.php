@extends('layouts.app')
@section('title','Editar reserva de nombre')
@section('content')
<div class="container">
	<div class="row justify-content-center">
		<div class="col-md-8">
			<div class="card card-info">
				<div class="card-header">
					<h3 class="card-title">Editar Reserva de Nombre: Secretaría Departamental de Justicia</h3>
				</div>

			<form action="{{route('reservajusticia.update',$reserva->id)}}" method="POST">
				@csrf @method('PATCH')
				<div class="card-body">
					<!-- === -->
					<div class="form-group">
						<label for="nombre">Nombre de Reserva</label>
						<input type="text" class="form-control form-control-sm" readonly value="{{$reserva->nombre}}">
					</div>
					<!-- === -->
					<div class="form-group">
	                  <label>Seleccionar Provincia</label>
	                  <select id="provincia_id" disabled class="form-control form-control-sm select2bs4" style="width: 70%;">
	                    @foreach ($provincias as $prov)
		                  <option value="{{$prov->id}}" {{(collect($reserva->provincia_id)->contains($prov->id)) ? 'selected':''}}>{{$prov->nombre}}</option>
		                @endforeach
	                  </select>
	                </div>
	                <!-- === -->
	                <div class="form-group">
	                  <label>Seleccionar Municipio</label>
	                  <div class="controls" id="select-municipio"></div>
	                </div>
          			<!-- === -->
					<div class="form-group">
						<label for="localidad">Localidad</label>
						<input type="text" class="form-control form-control-sm" readonly value="{{$reserva->localidad}}">
					</div>
					<!-- === -->
					<div class="form-group">
						<label for="nombreSolicitante">Nombre Solicitante</label>
						<input type="text" class="form-control form-control-sm" readonly value="{{$reserva->nombreSolicitante}}">
					</div>
					<!-- === -->
					<div class="form-group">
						<label for="numeroRecibo">Número de Recibo Oficial</label>
						<input type="number" class="form-control form-control-sm" readonly value="{{$reserva->numeroRecibo}}">
					</div>
					<!-- === -->
					<div class="form-group">
						<label for="costoReserva">Costo de Reserva de nombre</label>
						<input type="number" class="form-control form-control-sm" readonly value="{{$reserva->costoReserva}}">
					</div>
					<!-- === -->
					<div class="form-group">
						<label for="fechainicio">Fecha Reserva de Nombre (Inicio de trámite)</label>
						<input type="date" class="form-control" readonly value="{{$reserva->fechainicio}}" style="width: 50%;">
					</div>
					<!-- === -->
					<div class="form-group">
						<label for="fechafin">Fecha Reserva de Nombre (Inicio final de trámite)</label>
						<input type="date" class="form-control" readonly value="{{$reserva->fechafin}}" style="width: 50%;">
					</div>
					<!-- === -->
					<div class="form-group">
	                  <label>Seleccionar Estado de Trámite</label>
	                  <select id="estadotramite_id" required name="estadotramite_id" class="form-control form-control-sm select2bs4" style="width: 70%;">
	                    <option disabled selected value="">Seleccionar Estado de Trámite</option>
	                    @foreach ($estadotramites as $estadotramite)
		                  <option value="{{$estadotramite->id}}">{{$estadotramite->nombre}}</option>
		                @endforeach
	                  </select>
	                </div>
					<!-- === -->
				</div>

				<div class="card-footer">
					@include('reservajusticia.partials.actions')
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

		    //Initialize Select2 Elements
		    $('.select2bs4').select2({
		      theme: 'bootstrap4'
		    })
	  	})

	  	//Combo heredado dependencia del combo padre
		$(document).ready(function()
		{
			//Inicializa combo heredado
		  	$('#provincia_id').on('change',function(e){
			  var dep_id  = e.target.value;

			  $.get('/sidepej/public/municipio?dep_id=' + dep_id, function(data){

			    $('#municipio_id').empty();
			    $('#municipio_id').append('<option value="0" disabled="true" selected="true">Seleccione Municipio</option>');

			    $.each(data, function(index, dependenciasObj){
			      $('#municipio_id').append('<option value="'+ dependenciasObj.id +'">'+ dependenciasObj.municipio +'</option>');
			    })
			  });
			});

		  	// edit de registro
		    let dep_id = $('#provincia_id').val();
		    $.get('/sidepej/public/municipio?dep_id=' + dep_id, function(data)
		    {

		      let options = '';
		      $.each(data, function(index, dependenciasObj)
		      {
		        options += '<option selected value="'+ dependenciasObj.id +'">'+ dependenciasObj.municipio +'</option>';
		      });

		      $('#select-municipio').html('<select name="municipio_id" style="width: 70%;" disabled id="municipio_id" class="form-control form-control-sm select2bs4">'+options+'</select>');

		      $('#municipio_id').val('{{ $reserva->municipio_id }}');

		    });
		});
	</script>
@endpush