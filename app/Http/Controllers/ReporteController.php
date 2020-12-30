<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Objeto;
use App\Ambitoaplicacion;
use DB;

class ReporteController extends Controller
{
    public function pdfcoordinacionmunicipal($id)
    {
        $personerias = DB::table('personeriacoormunicipals as pcm')
                    ->join('reservacoormunicipals as rcm','rcm.id','=','pcm.reservacoormunicipal_id')
                    ->join('provincias','provincias.id','=','rcm.provincia_id')
                    ->join('municipios','municipios.id','=','rcm.municipio_id')
                    ->join('expedicions','expedicions.id','=','pcm.expedicion_id')
                    ->join('objetos','objetos.id','=','pcm.objeto_id')
                    ->join('ambitoaplicacions','ambitoaplicacions.id','=','pcm.ambitoaplicacion_id')
                    ->join('tipoorganizacions','tipoorganizacions.id','=','pcm.tipoorganizacion_id')
                    ->select('pcm.id','rcm.nombre as nombrepersoneria','provincias.nombre as provincia','municipios.municipio','rcm.localidad','rcm.nombreSolicitante','rcm.numeroRecibo','rcm.costoReserva','rcm.fechainicio','rcm.fechafin','objetos.nombre as objeto','ambitoaplicacions.nombre as ambitoaplicacion','tipoorganizacions.nombre as tipoorganizacion','pcm.representante','pcm.CI','pcm.hojaRuta','pcm.fechaIngreso','expedicions.nombre as expedicion','pcm.numeroCertificado','pcm.numeroResolucion','pcm.fechaResolucion','pcm.documentoMunicipal','pcm.numeroDocumento','pcm.fechaNumerodocumento','pcm.caratulaNotarial','pcm.caratulaExpediente','pcm.folderExpediente','pcm.numeroTestimonio')
                    ->where('pcm.id','=', $id)->get();

        $pdf = \PDF::loadview('pdf.pdf_coordinacionmunicipal', compact('personerias'));  
        return $pdf->stream('PERSONERIA DIRECCION COORDINACION MUNICIPAL.pdf'); 
    }

    public function pdfsecretariajusticia($id)
    {
        $personerias = DB::table('personeriajusticias as pjust')
                    ->join('reservajusticias as rjust','rjust.id','=','pjust.reservajusticia_id')
                    ->join('provincias','provincias.id','=','rjust.provincia_id')
                    ->join('municipios','municipios.id','=','rjust.municipio_id')
                    ->join('expedicions','expedicions.id','=','pjust.expedicion_id')
                    ->join('objetos','objetos.id','=','pjust.objeto_id')
                    ->join('ambitoaplicacions','ambitoaplicacions.id','=','pjust.ambitoaplicacion_id')
                    ->select('pjust.id','rjust.nombre as nombrepersoneria','provincias.nombre as provincia','municipios.municipio','rjust.localidad','rjust.nombreSolicitante','rjust.numeroRecibo','rjust.costoReserva','rjust.fechainicio','rjust.fechafin','objetos.nombre as objeto','ambitoaplicacions.nombre as ambitoaplicacion','pjust.representante','pjust.CI','pjust.numeroResolucion','pjust.fechaResolucion','pjust.costoPersoneria','pjust.costoValoragregado','pjust.hojaRuta','pjust.fechaIngreso','pjust.caratulaNotarial','pjust.caratulaExpediente','pjust.folderExpediente','pjust.numeroTestimonio','expedicions.nombre as expedicion')
                    ->where('pjust.id','=', $id)->get(); 

        $pdf = \PDF::loadview('pdf.pdf_secretariajusticia', compact('personerias'));  
        return $pdf->stream('PERSONERIA SECRETARIA JUSTICIA.pdf'); 
    }

    //REPORTE FORTALECIMINETO MUNICIPAL: RESERVA DE NOMBRE
    public function reporte_rncoordinacionmunicipal(Request $request)
    {
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $reservanombres = DB::table('reservacoormunicipals as rncm')
                        ->join('provincias','provincias.id','=','rncm.provincia_id')
                        ->join('municipios','municipios.id','=','rncm.municipio_id')
                        ->select('provincias.nombre as provincia','municipios.municipio','rncm.nombreSolicitante','rncm.nombre as nombre_reserva','rncm.localidad','rncm.numeroRecibo','rncm.costoReserva','rncm.fechainicio','rncm.fechafin')
                        ->whereBetween('rncm.fechainicio',array($fechainicio,$fechafin))
                        ->get();

        $pdf = \PDF::loadview('reportes.reporte_rncoordinacionmunicipal', compact('reservanombres'))->setPaper('A4','landscape'); 
        return $pdf->download('RESERVA NOMBRE DIRECCION COORDINACION MUNICIPAL.pdf');
    }

    //REPORTE FORTALECIMINETO MUNICIPAL :PERSONERIAS :POR FECHA
    public function reporte_coordinacionmunicipal(Request $request)
    {
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

    	$personerias = DB::table('personeriacoormunicipals as pcm')
                    ->join('reservacoormunicipals as rcm','rcm.id','=','pcm.reservacoormunicipal_id')
                    ->join('provincias','provincias.id','=','rcm.provincia_id')
                    ->join('municipios','municipios.id','=','rcm.municipio_id')
                    ->join('expedicions','expedicions.id','=','pcm.expedicion_id')
                    ->join('objetos','objetos.id','=','pcm.objeto_id')
                    ->join('ambitoaplicacions','ambitoaplicacions.id','=','pcm.ambitoaplicacion_id')
                    ->join('tipoorganizacions','tipoorganizacions.id','=','pcm.tipoorganizacion_id')
                    ->select('pcm.id','pcm.fechaEntrega','pcm.hojaRuta','pcm.fechaIngreso','rcm.nombre as nombrepersoneria','pcm.representante','pcm.CI','expedicions.nombre as expedicion','objetos.nombre as objeto','ambitoaplicacions.nombre as ambitoaplicacion','tipoorganizacions.nombre as tipoorganizacion','pcm.numeroResolucion','pcm.fechaResolucion','pcm.numeroCertificado','pcm.numeroDocumento','pcm.documentoMunicipal','pcm.fechaNumerodocumento')
                    ->whereBetween('pcm.fechaEntrega',array($fechainicio,$fechafin))->get();

        $pdf = \PDF::loadview('reportes.reporte_coordinacionmunicipal',compact('personerias'))->setPaper('A4','landscape'); 
        return $pdf->download('PERSONERIAS DIRECCION COORDINACION MUNICIPAL.pdf');
    }

    //REPORTE FORTALECIMINETO MUNICIPAL: POR OBJETO
    public function report_coordinacionmunicipal_objeto(Request $request)
    {
        $objeto_id = $request->objeto_id;
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $personerias = DB::table('personeriacoormunicipals as pcm')
                    ->join('reservacoormunicipals as rcm','rcm.id','=','pcm.reservacoormunicipal_id')
                    ->join('provincias','provincias.id','=','rcm.provincia_id')
                    ->join('municipios','municipios.id','=','rcm.municipio_id')
                    ->join('expedicions','expedicions.id','=','pcm.expedicion_id')
                    ->join('objetos','objetos.id','=','pcm.objeto_id')
                    ->join('ambitoaplicacions','ambitoaplicacions.id','=','pcm.ambitoaplicacion_id')
                    ->join('tipoorganizacions','tipoorganizacions.id','=','pcm.tipoorganizacion_id')
                    ->select('pcm.id','rcm.nombre as nombrepersoneria','provincias.nombre as provincia','municipios.municipio','rcm.localidad','rcm.nombreSolicitante','rcm.numeroRecibo','rcm.costoReserva','rcm.fechainicio','rcm.fechafin','objetos.nombre as objeto','ambitoaplicacions.nombre as ambitoaplicacion','tipoorganizacions.nombre as tipoorganizacion','pcm.representante','pcm.CI','pcm.hojaRuta','pcm.fechaIngreso','pcm.fechaEntrega','expedicions.nombre as expedicion','pcm.numeroCertificado','pcm.numeroResolucion','pcm.fechaResolucion','pcm.documentoMunicipal','pcm.numeroDocumento','pcm.fechaNumerodocumento')
                    ->where('objetos.id',$objeto_id)
                    ->whereBetween('pcm.fechaEntrega',array($fechainicio,$fechafin))->get();
        
        $pdf = \PDF::loadview('reportes.reporte_coordinacionmunicipal', compact('personerias'))->setPaper('A4','landscape'); 
        return $pdf->download('OBJETO DIRECCION COORDINACION MUNICIPAL.pdf');
    }

    //REPORTE FORTALECIMINETO MUNICIPAL: POR TIPO DE ORGANIZACION
    public function report_coordinacionmunicipal_tipoorganizacion(Request $request)
    {
        $tipoorganizacion_id = $request->tipoorganizacion_id;
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $personerias = DB::table('personeriacoormunicipals as pcm')
                    ->join('reservacoormunicipals as rcm','rcm.id','=','pcm.reservacoormunicipal_id')
                    ->join('provincias','provincias.id','=','rcm.provincia_id')
                    ->join('municipios','municipios.id','=','rcm.municipio_id')
                    ->join('expedicions','expedicions.id','=','pcm.expedicion_id')
                    ->join('objetos','objetos.id','=','pcm.objeto_id')
                    ->join('ambitoaplicacions','ambitoaplicacions.id','=','pcm.ambitoaplicacion_id')
                    ->join('tipoorganizacions','tipoorganizacions.id','=','pcm.tipoorganizacion_id')
                    ->select('pcm.id','rcm.nombre as nombrepersoneria','provincias.nombre as provincia','municipios.municipio','rcm.localidad','rcm.nombreSolicitante','rcm.numeroRecibo','rcm.costoReserva','rcm.fechainicio','rcm.fechafin','objetos.nombre as objeto','ambitoaplicacions.nombre as ambitoaplicacion','tipoorganizacions.nombre as tipoorganizacion','pcm.representante','pcm.CI','pcm.hojaRuta','pcm.fechaIngreso','pcm.fechaEntrega','expedicions.nombre as expedicion','pcm.numeroCertificado','pcm.numeroResolucion','pcm.fechaResolucion','pcm.documentoMunicipal','pcm.numeroDocumento','pcm.fechaNumerodocumento')
                    ->where('tipoorganizacions.id',$tipoorganizacion_id)
                    ->whereBetween('pcm.fechaEntrega',array($fechainicio,$fechafin))->get();
        
        $pdf = \PDF::loadview('reportes.reporte_coordinacionmunicipal', compact('personerias'))->setPaper('A4','landscape'); 
        return $pdf->download('TIPO ORGANIZACION DIRECCION COORDINACION MUNICIPAL.pdf');
    }

    //REPORTE JUSTICIA: RESERVA DE NOMBRE
    public function reporte_rnjusticia(Request $request)
    {
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $reservanombres = DB::table('reservajusticias as rnjust')
                        ->join('provincias','provincias.id','=','rnjust.provincia_id')
                        ->join('municipios','municipios.id','=','rnjust.municipio_id')
                        ->join('estadotramites','estadotramites.id','=','rnjust.estadotramite_id')
                        ->select('provincias.nombre as provincia','municipios.municipio','estadotramites.nombre as estadotramite','rnjust.nombreSolicitante','rnjust.nombre as nombre_reserva','rnjust.localidad','rnjust.numeroRecibo','rnjust.costoReserva','rnjust.fechainicio','rnjust.fechafin')
                        ->whereBetween('rnjust.fechainicio',array($fechainicio,$fechafin))
                        ->get();

        $pdf = \PDF::loadview('reportes.reporte_rnombre_justicia', compact('reservanombres'))->setPaper('A4','landscape'); 
        return $pdf->download('RESERVA NOMBRE SECRETARIA DE JUSTICIA.pdf');
    }

    //REPORTE SECRETARIA DE JUSTICIA: POR FECHA
    public function reporte_secretariajusticia(Request $request)
    {
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $personerias = DB::table('personeriajusticias as psj')
                    ->join('reservajusticias as rjust','rjust.id','=','psj.reservajusticia_id')
                    ->join('provincias','provincias.id','=','rjust.provincia_id')
                    ->join('municipios','municipios.id','=','rjust.municipio_id')
                    ->join('expedicions','expedicions.id','=','psj.expedicion_id')
                    ->join('objetos','objetos.id','=','psj.objeto_id')
                    ->join('ambitoaplicacions','ambitoaplicacions.id','=','psj.ambitoaplicacion_id')
                    ->select('psj.id','rjust.nombre as nombrepersoneria','provincias.nombre as provincia','municipios.municipio','rjust.localidad','rjust.nombreSolicitante','rjust.numeroRecibo','objetos.nombre as objeto','ambitoaplicacions.nombre as ambitoaplicacion','psj.representante','psj.CI','expedicions.nombre as expedicion','psj.hojaRuta','psj.fechaIngreso','psj.costoPersoneria','psj.costoValoragregado','psj.fechaEntrega','psj.caratulaNotarial','psj.caratulaExpediente','psj.folderExpediente','psj.numeroTestimonio','psj.numeroResolucion','psj.fechaResolucion')
                    ->whereBetween('psj.fechaEntrega',array($fechainicio,$fechafin))->get();

        $pdf = \PDF::loadview('reportes.reporte_secretariajusticia', compact('personerias'))->setPaper('A4','landscape');
        return $pdf->download('PERSONERIA SECRETARIA JUSTICIA.pdf');
        //return view('reportes.reporte_secretariajusticia',["personerias"=>$personerias]);
    }

    //REPORTE SECRETARIA DE JUSTICIA: POR OBJETO
    public function report_secretariajusticia_objeto(Request $request)
    {
        $objeto_id = $request->objeto_id;
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $personerias = DB::table('personeriajusticias as psj')
                    ->join('reservajusticias as rjust','rjust.id','=','psj.reservajusticia_id')
                    ->join('provincias','provincias.id','=','rjust.provincia_id')
                    ->join('municipios','municipios.id','=','rjust.municipio_id')
                    ->join('expedicions','expedicions.id','=','psj.expedicion_id')
                    ->join('objetos','objetos.id','=','psj.objeto_id')
                    ->join('ambitoaplicacions','ambitoaplicacions.id','=','psj.ambitoaplicacion_id')
                    ->select('psj.id','rjust.nombre as nombrepersoneria','provincias.nombre as provincia','municipios.municipio','rjust.localidad','rjust.nombreSolicitante','rjust.numeroRecibo','rjust.costoReserva','objetos.nombre as objeto','ambitoaplicacions.nombre as ambitoaplicacion','psj.representante','psj.CI','expedicions.nombre as expedicion','psj.hojaRuta','psj.fechaIngreso','psj.costoPersoneria','psj.costoValoragregado','psj.fechaEntrega','psj.caratulaNotarial','psj.caratulaExpediente','psj.folderExpediente','psj.numeroTestimonio','psj.numeroResolucion','psj.fechaResolucion')
                    ->where('objetos.id',$objeto_id)
                    ->whereBetween('psj.fechaEntrega',array($fechainicio,$fechafin))->get();

        $pdf = \PDF::loadview('reportes.reporte_secretariajusticia', compact('personerias'))->setPaper('A4','landscape'); 
        return $pdf->download('OBJETO SECRETARIA JUSTICIA.pdf');
    }

    //REPORTE SECRETARIA DE JUSTICIA: POR AMBITO DE APLICION
    public function report_secretaria_ambitoaplicacion(Request $request)
    {
        $ambitoaplicacion_id = $request->ambitoaplicacion_id;
        $fechainicio = $request->fechainicio;
        $fechafin = $request->fechafin;

        $personerias = DB::table('personeriajusticias as psj')
                    ->join('reservajusticias as rjust','rjust.id','=','psj.reservajusticia_id')
                    ->join('provincias','provincias.id','=','rjust.provincia_id')
                    ->join('municipios','municipios.id','=','rjust.municipio_id')
                    ->join('expedicions','expedicions.id','=','psj.expedicion_id')
                    ->join('objetos','objetos.id','=','psj.objeto_id')
                    ->join('ambitoaplicacions','ambitoaplicacions.id','=','psj.ambitoaplicacion_id')
                    ->select('psj.id','rjust.nombre as nombrepersoneria','provincias.nombre as provincia','municipios.municipio','rjust.localidad','rjust.nombreSolicitante','rjust.numeroRecibo','rjust.costoReserva','objetos.nombre as objeto','ambitoaplicacions.nombre as ambitoaplicacion','psj.representante','psj.CI','expedicions.nombre as expedicion','psj.hojaRuta','psj.fechaIngreso','psj.costoPersoneria','psj.costoValoragregado','psj.fechaEntrega','psj.caratulaNotarial','psj.caratulaExpediente','psj.folderExpediente','psj.numeroTestimonio','psj.numeroResolucion','psj.fechaResolucion')
                    ->where('ambitoaplicacions.id',$ambitoaplicacion_id)
                    ->whereBetween('psj.fechaEntrega',array($fechainicio,$fechafin))->get();

        $pdf = \PDF::loadview('reportes.reporte_secretariajusticia', compact('personerias'))->setPaper('A4','landscape'); 
        return $pdf->download('AMBITO APLICACION SECRETARIA JUSTICIA.pdf');
    }
}
