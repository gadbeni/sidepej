<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\VueTables\EloquentVueTables;
use App\Consultadato;
use App\Sucursal;
class SearchController extends Controller
{
    public function index(){
     return view('consultadato.nombres');
    }

    public function search () {
    	if (request()->ajax()) {
    		$VueTables = new EloquentVueTables;
    		$data = $VueTables->get(new Consultadato, ['id','numeroResolucion','fechaResolucion','razonSocial','provincia','municipio','localidad','sucursal_id'],['sucursal']);
    		return response()->json($data);
    	}
     return abort(401);
    }

    public function sucursales(){
        $sucursales = Sucursal::all();
        return response()->json($sucursales);
    }
}
