@extends('layouts.app')

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
        <div class="col-md-10">
            <div class="card card-info">
                <div class="card-header">
                    Personerías Jurídicas Antiguas: Datos de Consultas 2015 - 2019.
                    <div class="card-tools">
                      <form action="{{route('consultadato.index')}}" method="GET">
                        <div class="input-group input-group-sm" style="width: 500px;">
                          @include('consultadato.search')
                        </div>
                      </form>
                    </div>
                </div>

                <div class="body table-responsive">
                    <table class="table table-hover" style="font-size: 10pt">
                        <thead>                  
                            <tr>
                              <th>Número de resolución</th>
                              <th>Razón social</th>
                              <th>Provincia</th>
                              <th>Municipio</th>
                              <th>Localidad</th>
                              <th>Objeto</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($consultadatos as $consultadato)
                            <tr>
                              <td>{{$consultadato->numeroResolucion}}<br>{{$consultadato->fechaResolucion}}</td>
                              <td>{{$consultadato->razonSocial}}</td>
                              <td>{{$consultadato->provincia}}</td>
                              <td>{{$consultadato->municipio}}</td>
                              <td>{{$consultadato->localidad}}</td>
                              <td>{{$consultadato->objeto}}</td>
                            </tr>
                            @empty
                            <p>No hay registros para mostrar.</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    {{ $consultadatos->links() }}
                  </ul>
                  @if(count($consultadatos) > 0)
                    <p>Mostrando {{ $consultadatos->firstItem() }} al {{ $consultadatos->lastItem() }} de {{ $consultadatos->total() }} Registros</p>
                  @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection