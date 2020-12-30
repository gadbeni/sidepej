@extends('admin.admin')
@section('content')
<div class="row-fluid"> 
  <div class="span12">
    <div class="loader">
      <h4>Sin resultados, redireccionando... <img src="{{asset('/img/loader.gif')}}" width="80px"></h4>
    </div> 
  </div>
</div>
@endsection
<style type="text/css">
  .loader{
    text-align: center;
    color:#ff6e4a;
  }
</style>

@push ('script')
<script type="text/javascript">
  setTimeout(function(){
    window.location='justicia/por_fecha_reservanombre'
  }, 3000);
</script>
@endpush