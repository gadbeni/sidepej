<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Reservacoormunicipal;
use App\Personeriacoormunicipal;
use DB;

class Personeriacoordinacionmunicipal extends Controller
{
    public function __construct()
    {
        $this->middleware('can:personeriacoordinacionmunicipal.create')->only(['create','store']);
        $this->middleware('can:personeriacoordinacionmunicipal.index')->only('index');
        $this->middleware('can:personeriacoordinacionmunicipal.edit')->only(['edit','update']);
        $this->middleware('can:personeriacoordinacionmunicipal.show')->only('show');
        $this->middleware('can:personeriacoordinacionmunicipal.destroy')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd($request);
        $search = $request->query('search');
        $sentencia = $search ? "(
                        reservacoormunicipals.nombre like '%$search%' or
                        objetos.nombre like '%$search%' or
                        ambitoaplicacions.nombre like '%$search%' or
                        pcm.hojaRuta like '%$search%' or
                        pcm.representante like '%$search%' or
                        pcm.fechaEntrega like '%$search%' or
                        pcm.fechaConclusiontramite like '%$search%'
                        )" : 1;

        $personerias = DB::table('personeriacoormunicipals as pcm')
                    ->join('reservacoormunicipals','reservacoormunicipals.id','=','pcm.reservacoormunicipal_id')
                    ->join('expedicions','expedicions.id','=','pcm.expedicion_id')
                    ->join('objetos','objetos.id','=','pcm.objeto_id')
                    ->join('tipoorganizacions','tipoorganizacions.id','=','pcm.tipoorganizacion_id')
                    ->join('ambitoaplicacions','ambitoaplicacions.id','=','pcm.ambitoaplicacion_id')
                    ->select('pcm.id','reservacoormunicipals.nombre as reserva','expedicions.nombre as expedicion','objetos.nombre as objeto','ambitoaplicacions.nombre as ambitoaplicacion','pcm.fechaIngreso','pcm.hojaRuta','pcm.representante','pcm.CI','pcm.fechaEntrega','pcm.fechaConclusiontramite','pcm.archivo')
                    ->whereRaw($sentencia)
                    ->orderBy('pcm.id', 'desc')
                    ->paginate();

            //dd($personerias);

            return view('personeriacoordinacionmunicipal.index', compact('personerias','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $reservas=DB::table('reservacoormunicipals as rcm')
                ->join('estadotramites','estadotramites.id','=','rcm.estadotramite_id')
                ->select('rcm.id','rcm.nombre as reserva','estadotramites.nombre as estadotramite')
                ->where('rcm.condicionPersoneria','=','1')
                ->where('estadotramites.nombre','=','FINALIZADO')
                ->orderBy('rcm.nombre', 'asc')->get();

        $expedicions=DB::table('expedicions')->orderBy('nombre', 'asc')->get();
        $ambitoaplicacions=DB::table('ambitoaplicacions')->where('nombre','=','ORGANIZACIONES SOCIALES')->get();
        $objetos=DB::table('objetos')->orderBy('nombre', 'asc')->get();
        $tipoorganizacions=DB::table('tipoorganizacions')->orderBy('nombre', 'asc')->get();

        return view("personeriacoordinacionmunicipal.create", compact(['reservas','expedicions','ambitoaplicacions','objetos','tipoorganizacions']));
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

            $personeria = new Personeriacoormunicipal;
            $personeria->reservacoormunicipal_id = $request->reservacoormunicipal_id;
            $personeria->expedicion_id = $request->expedicion_id;
            $personeria->objeto_id = $request->objeto_id;
            $personeria->ambitoaplicacion_id = $request->ambitoaplicacion_id;
            $personeria->tipoorganizacion_id = $request->tipoorganizacion_id;
            $personeria->fechaIngreso = $request->fechaIngreso;
            $personeria->hojaRuta = $request->hojaRuta;
            $personeria->representante = $request->representante;
            $personeria->CI = $request->CI;
            $personeria->numeroCertificado = $request->numeroCertificado;
            $personeria->numeroResolucion = $request->numeroResolucion;
            $personeria->fechaResolucion = $request->fechaResolucion;
            $personeria->caratulaNotarial = $request->caratulaNotarial;
            $personeria->caratulaExpediente = $request->caratulaExpediente;
            $personeria->folderExpediente = $request->folderExpediente;
            $personeria->numeroTestimonio = $request->numeroTestimonio;

            $personeria->documentoMunicipal = $request->documentoMunicipal;
            $personeria->numeroDocumento = $request->numeroDocumento;
            $personeria->fechaNumerodocumento = $request->fechaNumerodocumento;

            $personeria->registro_clientIP = $clientIP;
            $personeria->registro_clientIP_update = $clientIP;

            $personeria->fechaEntrega = $request->fechaEntrega;
            $personeria->fechaConclusiontramite = $request->fechaConclusiontramite;
            $personeria->user_id = Auth::user()->id;

        if(Input::hasFile('archivo'))
        {
            $file=Input::file('archivo');
            $file->move(public_path().'/archivos/personeria/',$file->getClientOriginalName());
            $personeria->archivo=$file->getClientOriginalName();
        }
        $personeria->save();

            //cambia estado condicion a la tabla reservas->condicionPersoneria=0
            $reservas = Reservacoormunicipal::findOrFail($personeria->reservacoormunicipal_id);
            $reservas->condicionPersoneria = '0';
            $reservas->update();

        DB::commit();

            }catch(\Exception $e){
                 DB::rollback();
            }

        toast('Personería registrada con éxito!','success');
        return redirect()->route('personeriacoordinacionmunicipal.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $personerias = DB::table('personeriacoormunicipals as pcm')
                    ->join('reservacoormunicipals','reservacoormunicipals.id','=','pcm.reservacoormunicipal_id')
                    ->join('expedicions','expedicions.id','=','pcm.expedicion_id')
                    ->join('objetos','objetos.id','=','pcm.objeto_id')
                    ->join('tipoorganizacions','tipoorganizacions.id','=','pcm.tipoorganizacion_id')
                    ->join('ambitoaplicacions','ambitoaplicacions.id','=','pcm.ambitoaplicacion_id')
                    ->select('pcm.id','reservacoormunicipals.nombre as reserva','objetos.nombre as objeto','ambitoaplicacions.nombre as ambitoaplicacion','tipoorganizacions.nombre as tipoorg','pcm.fechaIngreso','pcm.hojaRuta','pcm.representante','pcm.CI','expedicions.nombre as expedicion','pcm.numeroCertificado','pcm.numeroResolucion','pcm.fechaResolucion','pcm.documentoMunicipal','pcm.numeroDocumento','pcm.fechaNumerodocumento','pcm.caratulaNotarial','pcm.caratulaExpediente','pcm.folderExpediente','pcm.numeroTestimonio','pcm.fechaConclusiontramite','pcm.fechaEntrega')
                    ->where('pcm.id',$id)
                    ->first();

        return view('personeriacoordinacionmunicipal.show', compact('personerias'));
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
