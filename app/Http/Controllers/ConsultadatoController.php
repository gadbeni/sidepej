<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use App\Consultadato;
use DB;

class ConsultadatoController extends Controller
{	
	public function index(Request $request)
    {   
    	$search = $request->query('search');
        $sentencia = $search ? "(
                        consultadatos.numeroResolucion like '%$search%' or
                        consultadatos.fechaResolucion like '%$search%' or
                        consultadatos.razonSocial like '%$search%' or
                        consultadatos.provincia like '%$search%' or
                        consultadatos.municipio like '%$search%' or
                        consultadatos.localidad like '%$search%' or
                        consultadatos.objeto like '%$search%'
                        )" : 1;

        $consultadatos = DB::table('consultadatos')
        ->select('consultadatos.numeroResolucion','consultadatos.fechaResolucion','consultadatos.razonSocial','consultadatos.provincia','consultadatos.municipio','consultadatos.localidad','consultadatos.objeto')
        ->OrderBy('consultadatos.razonSocial','asc')
        ->whereRaw($sentencia)
        ->paginate();

    	return view ('consultadato.index',compact('consultadatos','search'));
    }
}
