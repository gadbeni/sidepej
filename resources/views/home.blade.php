@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header">Hola!</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    Bienvenido al sistema SIDEPEJ
                    <hr>
      
                    <!-- Info boxes -->
                    <div class="row">
                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box">
                            <span class="info-box-icon bg-info elevation-1"><i class="fas fa-info-circle"></i></span>

                                <div class="info-box-content">
                                <span class="info-box-text">Reserva Nombre: Dir. Coordinación Municipal.</span>
                                <span class="info-box-number">
                                    <?php $sum_rncoordinacion = DB::table('reservacoormunicipals')
                                      ->where('condicion','=','1')
                                      ->select(DB::raw('count(*) as Total_rn'))
                                      ->first(); 
                                    echo $sum_rncoordinacion->Total_rn; ?>
                                    <small>registros.</small>
                                </span>
                                </div>
                            <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-danger elevation-1"><i class="fas fa-info-circle"></i></span>

                                <div class="info-box-content">
                                <span class="info-box-text">Reserva Nombre: Sec. Departamental Justicia.</span>
                                <span class="info-box-number">
                                    <?php $sum_rnjusticia = DB::table('reservajusticias')
                                      ->where('condicion','=','1')
                                      ->select(DB::raw('count(*) as Total_rnj'))
                                      ->first(); 
                                    echo $sum_rnjusticia->Total_rnj; ?>
                                <small>registros.</small>
                                </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-success elevation-1"><i class="fas fa-info-circle"></i></span>

                                <div class="info-box-content">
                                <span class="info-box-text">Personerías: Dir. Coordinación Municipal.</span>
                                <span class="info-box-number">
                                    <?php $sum_pjcoordinacion = DB::table('personeriacoormunicipals')
                                      ->where('condicion','=','1')
                                      ->select(DB::raw('count(*) as Total_pjcoordinacion'))
                                      ->first(); 
                                    echo $sum_pjcoordinacion->Total_pjcoordinacion; ?>
                                <small>registros.</small>
                                </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->

                        <div class="col-12 col-sm-6 col-md-6">
                            <div class="info-box mb-3">
                                <span class="info-box-icon bg-warning elevation-1"><i class="fas fa-info-circle"></i></span>

                                <div class="info-box-content">
                                <span class="info-box-text">Personerías: Sec. Departamental Justicia.</span>
                                <span class="info-box-number">
                                    <?php $sum_pjjusticia = DB::table('personeriajusticias')
                                      ->where('condicion','=','1')
                                      ->select(DB::raw('count(*) as Total_pjjusticia'))
                                      ->first(); 
                                    echo $sum_pjjusticia->Total_pjjusticia; ?>
                                <small>registros.</small>
                                </span>
                                </div>
                                <!-- /.info-box-content -->
                            </div>
                            <!-- /.info-box -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
