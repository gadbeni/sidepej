<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use DB;

class VistareporteController extends Controller
{
    //VISTA DE REPORTES DIRECCION DE COORDINACION MUNICIPAL:
    //genera reporte de reserva de nombres de manera general de coordinacion municipal
    public function rncoordinacionmunicipal_por_fecha()
    {
        return view ('reportes.coordinacionmunicipal.por_fecha_reservanombrecoormunicipal');
    }
    //genera reporte de personerias juridicas de nombres de manera general de coordinacion municipal
	public function pjcoordinacionmunicipal_por_fecha()
    {
    	return view ('reportes.coordinacionmunicipal.por_fecha_personeriascoormunicipal');
    }
    //genera reporte de objeto de la personeria juridica de coordinacion municipal
    public function coordinacionmunicipal_objeto()
    {
    	$objetos=DB::table('objetos')->orderBy('nombre', 'asc')->get();
    	return view ('reportes.coordinacionmunicipal.por_objeto',["objetos"=>$objetos]);
    }
    //genera reporte de tipo de organizacion de coordinacion municipal
    public function coordinacionmunicipal_tipoorganizacion()
    {	
    	$tipoorganizacions=DB::table('tipoorganizacions')->orderBy('nombre', 'asc')->get();
    	return view ('reportes.coordinacionmunicipal.por_tipoorganizacion',["tipoorganizacions"=>$tipoorganizacions]);
    }

    //VISTA DE REPORTES SECRETARIA DE JUSTICIA:
    public function rnsecretariajusticia()
    {
        return view ('reportes.justicia.por_fecha_reservanombrejusticia');
    }

    public function pjsecretariajusticia()
    {
        return view ('reportes.justicia.por_fecha_personeriassecretariajusticia');
    }

    public function secretariajusticia_objeto()
    {
        $objetos=DB::table('objetos')->orderBy('nombre', 'asc')->get();
        return view ('reportes.justicia.por_objeto',["objetos"=>$objetos]);
    }

    public function secretariajusticia_ambitoaplicacion()
    {   
        $ambitoaplicacions=DB::table('ambitoaplicacions')->where('nombre','!=','ORGANIZACIONES SOCIALES')->get();
        return view ('reportes.justicia.por_ambitoaplicacion',["ambitoaplicacions"=>$ambitoaplicacions]);
    }
}
