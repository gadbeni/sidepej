@extends('layouts.app')
@section('title','Lista de reservas de nombre')
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
                    Reserva de nombre secretaría departamental de justicia  
                    <div class="card-tools">
                      <form action="{{route('reservajusticia.index')}}" method="GET">
                        <div class="input-group input-group-sm" style="width: 500px;">
                          @include('reservajusticia.search')
                          
                          @can('reservajusticia.create')
                          <a href="{{ route('reservajusticia.create') }}"><button type="button" class="btn btn-default" title="Crear reserva de nombre"><i class="fas fa-plus"></i></button></a>
                          @endcan
                        </div>
                      </form>
                    </div>
                </div>
                
                </div>
                <div class="body table-responsive ">
                    <table class="table table-hover" style="font-size: 10pt">
                        <thead>                  
                            <tr>
                              <th>Nombre reserva (Personería Jurídica)</th>
                              <th>Nombre solicitante</th>
                              <th>Provincia</th>
                              <th>Municipio</th>
                              <th>Localidad</th>
                              <th>Fecha inicio</th>
                              <th>Fecha final</th>
                              <th>Número recibo</th>
                              <th>Costo reserva</th>
                              <th>Estado</th>
                              <th>Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($reservas as $reserva)
                            <tr
                              @if($reserva->fechafin <= date('Y-m-d')) style="background-color:#FDD2CD" @endif>
                              <td>
                                {{$reserva->nombre}}<br>
                                  @if($reserva->estadotramite_id!=2 && $reserva->fechafin > date('Y-m-d'))
                                    <small style="color:#FF0000";>(Tiene 45 días a partir de la fecha de inicio para realizar el trámite)</small>
                                  @endif
                              </td>
                              <td>{{$reserva->nombreSolicitante}}</td>
                              <td>{{$reserva->provincia}}</td>
                              <td>{{$reserva->municipio}}</td>
                              <td>{{$reserva->localidad}}</td>
                              <td>{{\Carbon\Carbon::parse($reserva->fechainicio)->format('d/m/Y')}}</td>
                              <td>{{\Carbon\Carbon::parse($reserva->fechafin)->format('d/m/Y')}}</td>
                              <td>{{$reserva->numeroRecibo}}</td>
                              <td>{{$reserva->costoReserva}}</td>
                              <td>
                                @if ($reserva->estadotramite_id ===3)
                                  <span class="badge bg-warning"><i class="far fa-bell"></i> RESERVA</span>
                                @elseif ($reserva->estadotramite_id === 2)
                                  <span class="badge bg-success"><i class="far fa-bell"></i> FINALIZADO</span>
                                @else ($reserva->estadotramite_id ===1)
                                  <span class="badge bg-danger"><i class="far fa-bell"></i> PROCESO</span>
                                @endif
                              </td>
                              <td style="width:115px">
                                @can('reservajusticia.edit')
                                <a href="{{route('reservajusticia.edit',$reserva->id)}}" class="btn btn-info @if($reserva->estadotramite_id == 2) disabled @endif" title="Editar estado de reserva de nombre"><i class="fas fa-edit"></i>
                                </a>
                                @endcan

                                @can('reservajusticia.destroy')
                                <a data-target="#modal-delete-{{$reserva->id}}" data-toggle="modal"  class="btn btn-danger" title="Eliminar reserva de nombre"><i class="fas fa-trash"></i>
                                </a>
                                @endcan
                              </td>
                            </tr>
                            @include('reservajusticia.modal')
                            @empty
                            <p>No hay registros para mostrar.</p>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer clearfix">
                  <ul class="pagination pagination-sm m-0 float-right">
                    {{ $reservas->links() }}
                  </ul>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection