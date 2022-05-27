<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Reservajusticia;
use App\Personeriajusticia;
use DB;

class PersoneriajusticiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:personeriajusticia.create')->only(['create','store']);
        $this->middleware('can:personeriajusticia.index')->only('index');
        $this->middleware('can:personeriajusticia.edit')->only(['edit','update']);
        $this->middleware('can:personeriajusticia.show')->only('show');
        $this->middleware('can:personeriajusticia.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
      
        $search = $request->query('search');
        $sentencia = $search ? "(
                        reservajusticias.nombre like '%$search%' or
                        objetos.nombre like '%$search%' or
                        ambitoaplicacions.nombre like '%$search%' or
                        pj.hojaRuta like '%$search%' or
                        pj.representante like '%$search%' or
                        pj.fechaEntrega like '%$search%' or
                        pj.fechaConclusiontramite like '%$search%'
                        )" : 1;

        $personerias = DB::table('personeriajusticias as pj')
                    ->join('reservajusticias','reservajusticias.id','=','pj.reservajusticia_id')
                    ->join('expedicions','expedicions.id','=','pj.expedicion_id')
                    ->join('objetos','objetos.id','=','pj.objeto_id')
                    ->join('ambitoaplicacions','ambitoaplicacions.id','=','pj.ambitoaplicacion_id')
                    ->select('pj.id','reservajusticias.nombre as reserva','expedicions.nombre as expedicion','objetos.nombre as objeto','ambitoaplicacions.nombre as ambitoaplicacion','pj.fechaIngreso','pj.hojaRuta','pj.representante','pj.CI','pj.fechaEntrega','pj.archivo','pj.fechaConclusiontramite')
                    ->whereRaw($sentencia)
                    ->orderBy('pj.id', 'desc')
                    ->paginate();

        return view('personeriajusticia.index', compact('personerias','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservas=DB::table('reservajusticias')
        ->join('estadotramites','estadotramites.id','=','reservajusticias.estadotramite_id')
        ->select('reservajusticias.id','reservajusticias.nombre as reserva','estadotramites.nombre as estadotramite')
        ->where('reservajusticias.condicionPersoneria','=','1')
        ->where('estadotramites.nombre','=','FINALIZADO')
        ->orderBy('reservajusticias.nombre', 'asc')->get();

        $expedicions=DB::table('expedicions')->orderBy('nombre', 'asc')->get();
        $ambitoaplicacions=DB::table('ambitoaplicacions')->where('nombre','!=','ORGANIZACIONES SOCIALES')->get();
        $objetos=DB::table('objetos')->orderBy('nombre', 'asc')->get();

        return view("personeriajusticia.create", compact(['reservas', 'expedicions', 'ambitoaplicacions', 'objetos']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $clientIP =\Request::ip ();

        try{
            DB::beginTransaction();

                $personeria = new Personeriajusticia;
                $personeria->fechaIngreso = $request->fechaIngreso;
                $personeria->hojaRuta = $request->hojaRuta;
                $personeria->representante = $request->representante;
                $personeria->expedicion_id = $request->expedicion_id;
                $personeria->CI = $request->CI;
                $personeria->costoPersoneria = $request->costoPersoneria;
                $personeria->costoValoragregado = $request->costoValoragregado;
                $personeria->reservajusticia_id = $request->reservajusticia_id;
                $personeria->objeto_id = $request->objeto_id;
                $personeria->ambitoaplicacion_id = $request->ambitoaplicacion_id;
                $personeria->numeroResolucion = $request->numeroResolucion;
                $personeria->fechaResolucion = $request->fechaResolucion;
                $personeria->caratulaNotarial = $request->caratulaNotarial;
                $personeria->caratulaExpediente = $request->caratulaExpediente;
                $personeria->folderExpediente = $request->folderExpediente;
                $personeria->numeroTestimonio = $request->numeroTestimonio;
                $personeria->fechaConclusiontramite = $request->fechaConclusiontramite;
                $personeria->fechaEntrega = $request->fechaEntrega;
                $personeria->registro_clientIP = $clientIP;
                $personeria->registro_clientIP_update = $clientIP;
                $personeria->user_id = Auth::user()->id;

                if(Input::hasFile('archivo'))
                {
                    $file=Input::file('archivo');
                    $file->move(public_path().'/archivos/personeria/',$file->getClientOriginalName());
                    $personeria->archivo=$file->getClientOriginalName();
                }
                //dd($personeria);
                $personeria->save();

            //cambia estado condicion a la tabla reservas->condicionPersoneria=0
            $reservas = Reservajusticia::findOrFail($personeria->reservajusticia_id);
            $reservas->condicionPersoneria = '0';
            $reservas->update();

        DB::commit();

            }catch(\Exception $e){
                 DB::rollback();
            }

        toast('Personería registrada con éxito!','success');
        return redirect()->route('personeriajusticia.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personerias = DB::table('personeriajusticias as pj')
                    ->join('reservajusticias','reservajusticias.id','=','pj.reservajusticia_id')
                    ->join('expedicions','expedicions.id','=','pj.expedicion_id')
                    ->join('objetos','objetos.id','=','pj.objeto_id')
                    ->join('ambitoaplicacions','ambitoaplicacions.id','=','pj.ambitoaplicacion_id')
                    ->select('pj.id','reservajusticias.nombre as reserva','expedicions.nombre as expedicion','objetos.nombre as objeto','ambitoaplicacions.nombre as ambitoaplicacion','pj.fechaIngreso','pj.hojaRuta','pj.representante','pj.CI','pj.costoPersoneria','pj.costoValoragregado','pj.caratulaNotarial','pj.caratulaExpediente','pj.folderExpediente','pj.numeroTestimonio','pj.numeroResolucion','pj.fechaResolucion','pj.fechaEntrega','pj.fechaConclusiontramite')
                    ->where('pj.id',$id)
                    ->first();

        return view('personeriajusticia.show', compact('personerias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
