@extends('layouts.app')
@section('title','Detalle de personería')
<style>
    table th {

      text-align: center;
    }

    table td {
      text-align: center;
    }
</style>

@section('content')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card card-info">
                <div class="card-header">
                  Detalle de Personería Jurídica: Dir. Coordinación Municipal.
                </div>
            {{-- === --}}
              <div class="card-body">
                <strong>Personería Jurídica:</strong>  {{$personerias->reserva}}<br>
                <strong>Objeto de la Personería Jurídica:</strong> {{$personerias->objeto}}<br>
                <strong>Ambito de Aplicación Personería Jurídica:</strong> {{$personerias->ambitoaplicacion}}<br>
                <strong>Tipo de Organización:</strong> {{$personerias->tipoorg}}<br>
                <strong>Hoja de Ruta:</strong> {{$personerias->hojaRuta}} ({{\Carbon\Carbon::parse($personerias->fechaIngreso)->format('d/m/Y')}})<br>
                <strong>Representante Legal:</strong> {{$personerias->representante}} - {{$personerias->CI}} {{$personerias->expedicion}}<br>
                <strong>Número de Certificado (Dir. Coordinación Municipal):</strong> {{$personerias->numeroCertificado}}<br>
                <strong>Número de Resolución:</strong> {{$personerias->numeroResolucion}} ({{\Carbon\Carbon::parse($personerias->fechaResolucion)->format('d/m/Y')}})<br>
                <strong>Carátula Notarial:</strong> {{$personerias->caratulaNotarial}}<br>
                <strong>Carátula Expediente:</strong> {{$personerias->caratulaExpediente}}<br>
                <strong>Foldefr Expediente:</strong> {{$personerias->folderExpediente}}<br>
                <strong>Número de Testimonio:</strong> {{$personerias->numeroTestimonio}}<br>
                <strong>Documento Municipal:</strong> {{$personerias->documentoMunicipal}}<br>
                <strong>Número de Documento Municipal:</strong> {{$personerias->numeroDocumento}} ({{\Carbon\Carbon::parse($personerias->fechaNumerodocumento)->format('d/m/Y')}})<br>
                <strong>Fecha Conclusión del Trámite:</strong> {{$personerias->fechaConclusiontramite}}<br>
                <strong>Fecha de Entrega del Trámite:</strong> {{$personerias->fechaEntrega}}
              </div>
              <div class="card-footer">
                <a href="{{route('personeriacoordinacionmunicipal.index')}}" class="btn btn-outline-info"><i class="fas fa-history"></i> Volver a la Lista</a>
              </div>
            {{-- === --}}
            </div>

        </div>
    </div>
</div>
@endsection
@endsection