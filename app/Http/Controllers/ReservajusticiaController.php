<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use App\Reservajusticia;
use App\Estadotramite;
use DB;


class ReservajusticiaController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:reservajusticia.create')->only(['create','store']);
        $this->middleware('can:reservajusticia.index')->only('index');
        $this->middleware('can:reservajusticia.edit')->only(['edit','update']);
        $this->middleware('can:reservajusticia.show')->only('show');
        $this->middleware('can:reservajusticia.destroy')->only('destroy');
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
                        rj.nombre like '%$search%' or
                        rj.nombreSolicitante like '%$search%' or
                        rj.localidad like '%$search%' or
                        rj.fechainicio like '%$search%' or
                        rj.fechafin like '%$search%' or
                        provincias.nombre like '%$search%' or
                        municipios.municipio like '%$search%' or
                        rj.numeroRecibo like '%$search%'
                        )" : 1;

        $reservas = DB::table('reservajusticias as rj')
                ->join('provincias','provincias.id','=','rj.provincia_id')
                ->join('municipios','municipios.id','=','rj.municipio_id')
                ->join('estadotramites','estadotramites.id','=','rj.estadotramite_id')
                ->join('users','users.id','=','rj.user_id')
                ->select('rj.id','rj.nombre','rj.nombreSolicitante','rj.costoReserva','rj.localidad','rj.fechainicio','rj.fechafin','rj.condicion','provincias.nombre as provincia','municipios.municipio','estadotramites.nombre as estadotramite','estadotramites.id as estadotramite_id','rj.numeroRecibo')
                ->whereRaw($sentencia)
                ->orderBy('rj.id', 'desc')
                ->paginate();

        return view("reservajusticia.index", compact('reservas','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (auth()->user()->hasRole('Admin')) {
            $sucursales = \App\Sucursal::all();
        } else {
           $sucursales = Auth::user()->sucursales;
        }

        $provincias=DB::table('provincias')->orderBy('nombre', 'asc')->get();
        return view("reservajusticia.create", compact('provincias','sucursales'));
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
        //captura el nombre
        $vn = $request->nombre;

        //captura el municipio
        $vm = $request->municipio_id;

        //VALIDACION DE NOMBRE REPETIDO DE PER. JUR.
        $vn_vm = DB::table('reservajusticias')
        ->select('nombre','municipio_id')
        ->where('nombre',$vn)
        ->where('municipio_id',$vm)->first();

        if ($vn_vm) {
            return redirect()->route('reservajusticia.create')->with(['notice' => 'El nombre de personería a reservar ya ha sido registrado en este municipio.','old_nombreSolicitante' => $request->nombreSolicitante,'old_costoReserva' => $request->costoReserva,'old_numeroRecibo' => $request->numeroRecibo,'old_localidad' => $request->localidad,'old_fechainicio' => $request->fechainicio]);
        }

        $fechainicio = $request->fechainicio;
        $dias_a_sumar = '45';
        $fecha_sumada = date('Y-m-d', strtotime($fechainicio.' + '.$dias_a_sumar.' days'));

        //WILL BE CONSTANT
        $estadotramites=Estadotramite::where('nombre','RESERVADO')->first();

        $reserva = new Reservajusticia;
        $reserva->provincia_id = $request->provincia_id;
        $reserva->municipio_id = $request->municipio_id;
        $reserva->estadotramite_id = $estadotramites->id;
        $reserva->nombre = $request->nombre;
        $reserva->nombreSolicitante = $request->nombreSolicitante;
        $reserva->costoReserva = $request->costoReserva;
        $reserva->numeroRecibo = $request->numeroRecibo;
        $reserva->localidad = $request->localidad;
        $reserva->fechainicio = $request->fechainicio;
        $reserva->registro_clientIP = $clientIP;
        $reserva->registro_clientIP_update = $clientIP;
        $reserva->fechafin = $fecha_sumada;
        $reserva->user_id = Auth::user()->id;
        $reserva->sucursal_id = $request->sucursal_id;
        $reserva->save();

        toast('Reserva de nombre registrada con éxito!','success');
        return redirect()->route('reservajusticia.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reserva = Reservajusticia::findOrFail($id);

        $estadotramites=DB::table('estadotramites')
        ->where('nombre','=','PROCESO')
        ->orwhere('nombre','=','FINALIZADO')
        ->get();

        $provincias=DB::table('provincias')->orderBy('nombre', 'asc')->get();

        return view("reservajusticia.edit",compact(['reserva','estadotramites','provincias']));
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
        $clientIP =\Request::ip ();

        $reserva = Reservajusticia::findOrFail($id);
        $reserva->estadotramite_id = $request->estadotramite_id;
        $reserva->registro_clientIP_update = $clientIP;
        $reserva->update();

        toast('Reserva de nombre actualizada con éxito!','success');
        return redirect()->route('reservajusticia.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reserva=Reservajusticia::findOrFail($id);
        $reserva->delete();

        toast('Eliminado correctamente!','warning');
        return redirect()->route('reservajusticia.index');
    }
}
