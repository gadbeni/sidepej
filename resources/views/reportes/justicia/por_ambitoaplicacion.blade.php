@extends('layouts.app')
@section('title','Reporte por fechas coordinacion municipal')
<style type="text/css">
  .loader{
    text-align: center;
    color:#ff6e4a;
    display: none
  }
</style>
@section('content')
  <div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="loader">
              <h4>Generando reporte, por favor espere! <img src="{{asset('theme/dist/img/loader.gif')}}" width="100px"> </h4>
            </div>
            <form id="form" action="{{route('report_secretaria_ambitoaplicacion')}}" method="POST">
              @csrf
              <div class="card card-info">
                <div class="card-header">
                    Reporte por Ambito Aplicacion Personería Jurídica: Secretaria Departal de Justicia.
                </div>
                <div class="card-body">
                  <!-- === -->
                  <div class="form-group">
                    <label>Seleccionar Objeto de la Personería Jurídica</label>
                    <select required name="ambitoaplicacion_id"  class="form-control form-control-sm" style="width: 70%;">
                      @foreach ($ambitoaplicacions as $ambitoaplicacion)
                        <option value="{{$ambitoaplicacion->id}}">{{$ambitoaplicacion->nombre}}</option>
                      @endforeach
                    </select>
                  </div>
                  <!-- === -->
                  <div class="form-group">
                    <label for="fechainicio">Fecha Inicio del Reporte</label>
                    <input type="date" class="form-control" required name="fechainicio" style="width: 50%;">
                  </div>
                  <!-- === -->
                  <div class="form-group">
                    <label for="fechafin">Fecha Fin del Reporte</label>
                    <input type="date" class="form-control" required name="fechafin" style="width: 50%;">
                  </div>
                  <!-- === -->
                </div>
                <div class="card-footer">
                  @include('reportes.justicia.partials.actions')
                </div>
            </div>
            </form>
            
        </div>
    </div>
  </div>
@endsection

@push ('script')
<script type="text/javascript">
  $('#form').on('submit', function(e){
    $('.loader').css('display', 'block')
    let datos = $(this).serialize()
    url = "{{route('report_secretariajusticia_objeto')}}"
    $.ajax({
      url: url,
      type: 'post',
      data: datos,
      success: function(data){
        $('.loader').css('display', 'none')
      }
    });
  });
</script>
@endpush