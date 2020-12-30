@extends('layouts.app')
@section('content')
<div id="app" class="container-fluid">
      <nombres
        :labels="{{json_encode([
         'numeroResolucion' => __("N° Resolucion"),
         'fechaResolucion' => __("Fecha de Resolucion"),
         'razonSocial' => __("Razon Social"),
         'provincia' => __("Provincia"),
         'municipio' => __("Municipio"),
         'localidad' => __("Localidad"),
         'sucursal_id' => __("Sucursal")
        ])}}"
        route="{{ route('documentos_json')}}"
        >
        </nombres>
</div>
@endsection
@push('script')
<!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
@endpush