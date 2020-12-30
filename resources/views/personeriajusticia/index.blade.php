@extends('layouts.app')
@section('title','Lista de personerías jurídicas')
<style>
    table th {
     
      text-align: center;
    }

    table td {
      text-align: center;
    }
</style>

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-info">
                <div class="card-header">
                    Personerías Jurídicas de secretaría departamental de justicia 
                    <div class="card-tools">
                      <form action="{{route('personeriajusticia.index')}}" method="GET">
                        <div class="input-group input-group-sm" style="width: 500px;">
                          @include('personeriajusticia.search')

                          @can('personeriajusticia.create')
                          <a href="{{ route('personeriajusticia.create') }}"><button type="button" class="btn btn-default" title="Crear reserva de nombre"><i class="fas fa-plus"></i></button></a>
                          @endcan
                        </div>
                      </form>
                    </div>
                </div>

                <div class="body table-responsive ">
                    <table class="table table-hover" style="font-size: 10pt">
                        <thead>                  
                            <tr>
                                <th>Personería Jurídica</th>
                                <th>Representante legal</th>
                                <th>Hoja de ruta</th>
                                <th>Objeto de la Persinería</th>
                                <th>Ambito de Aplicación</th>
                                <th>Fecha entrega</th>
                                <th>Fecha fin trámite</th>
                                <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($personerias as $personeria)
                              <tr>
                                  <td>{{$personeria->reserva}}</td>
                                  <td>{{$personeria->representante}}<br>{{$personeria->CI. ' ' .$personeria->expedicion}}</td>
                                  <td style="width:90px">{{$personeria->hojaRuta}}<br>{{$personeria->fechaIngreso}}</td>
                                  <td>{{$personeria->objeto}}</td>
                                  <td>{{$personeria->ambitoaplicacion}}</td>
                                  <td style="width:90px">{{$personeria->fechaEntrega}}</td>
                                  <td style="width:90px">{{$personeria->fechaConclusiontramite}}</td>
                                  <td style="width:160px">
                                    @can('archivo.secretariajusticia')
                                    <a href="{{asset('/archivos/personeria/'.$personeria->archivo)}}" download="{{$personeria->archivo}}" class="btn btn-info" title="Descargar Documento"><i class="fa fa-download"></i></a>
                                    @endcan

                                    @can('report.fichadatos_secretariajusticia')
                                    <a href="{{route('pdfsecretariajusticia',$personeria->id)}}" target="_blank" class="btn btn-success" title="Imprimir Detalle de Personería"><i class="fa fa-print"></i></a>
                                    @endcan

                                    @can('personeriajusticia.show')
                                    <a href="{{route('personeriajusticia.show',$personeria->id)}}" class="btn btn-warning" title="Detalle de la Personería"><i class="fa fa-eye"></i></a>
                                    @endcan
                                  </td>
                            </tr>
                            @include('personeriajusticia.modal')
                            @empty
                            <p>No hay registros para mostrar.</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    {{ $personerias->links() }}
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection