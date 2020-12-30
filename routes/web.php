<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');

//Grupo de rutas que comprueba usuario logeado
Route::middleware(['auth'])->group(function () {
	//Roles
	Route::post('roles/store', 'RoleController@store')->name('roles.store')->middleware('can:roles.store');
	Route::get('roles', 'RoleController@index')->name('roles.index')->middleware('can:roles.index');
	Route::get('roles/create', 'RoleController@create')->name('roles.create')->middleware('can:roles.create');
	Route::put('roles/{role}', 'RoleController@update')->name('roles.update')->middleware('can:roles.update');
	Route::get('roles/{role}', 'RoleController@show')->name('roles.show')->middleware('can:roles.show');
	Route::delete('roles/{role}', 'RoleController@destroy')->name('roles.destroy')->middleware('can:roles.destroy');
	Route::get('roles/{role}/edit', 'RoleController@edit')->name('roles.edit')->middleware('can:roles.edit');
	//Users
	Route::get('users', 'UserController@index')->name('users.index')->middleware('can:users.index');
	Route::put('users/{user}', 'UserController@update')->name('users.update')->middleware('can:users.update');
	Route::get('users/{user}', 'UserController@show')->name('users.show')->middleware('can:users.show');
	Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy')->middleware('can:users.destroy');
	Route::get('users/{user}/edit', 'UserController@edit')->name('users.edit')->middleware('can:users.edit');
	//Sucursales
	Route::resource('sucursales','SucursalController');
	//Sucursales_Usuarios (Asignacion de sucursales)
	Route::resource('sucursal_usuario','Sucursal_usuarioController');
	//Reserva de nombre coordinacion municipal
	Route::resource('reservacoordinacionmunicipal','ReservacoordinacionmunicipalController');
	//Personeria de coordinacion municipal
	Route::resource('personeriacoordinacionmunicipal','Personeriacoordinacionmunicipal');
	Route::get('pdfcoordinacionmunicipal/{id}', 'ReporteController@pdfcoordinacionmunicipal')->name('pdfcoordinacionmunicipal');
	//Reserva de nombre secretaria de justicia
	Route::resource('reservajusticia','ReservajusticiaController');
	//Personeria de secretaria de justicia
	Route::resource('personeriajusticia','PersoneriajusticiaController');
	Route::get('pdfsecretariajusticia/{id}', 'ReporteController@pdfsecretariajusticia')->name('pdfsecretariajusticia');
	//Trae los datos heredados de provincias(Select Heredado)
	Route::get('municipio','HomeController@municipio');

	//Reportes Direccion coordinacion municipal
	//REPORTE COORDINACION MUNICIPAL: POR FECHA
	Route::get('reportes/coordinacionmunicipal_pj', 'VistareporteController@pjcoordinacionmunicipal_por_fecha')->name('pjcoordinacionmunicipal_por_fecha');
	Route::post('reportes/reporte_coordinacionmunicipal','ReporteController@reporte_coordinacionmunicipal')->name('reporte_coordinacionmunicipal');

	//REPORTE COORDINACION MUNICIPAL: RESERVA DE NOMBRE
	Route::get('reportes/coordinacionmunicipal_rn', 'VistareporteController@rncoordinacionmunicipal_por_fecha')->name('rncoordinacionmunicipal_por_fecha');
	Route::post('reportes/reporte_rncoordinacionmunicipal','ReporteController@reporte_rncoordinacionmunicipal')->name('reporte_rncoordinacionmunicipal');

	//REPORTE COORDINACION MUNICIPAL: POR OBJETO
	Route::get('reportes/coordinacionmunicipal_pj/objeto', 'VistareporteController@coordinacionmunicipal_objeto')->name('coordinacionmunicipal_objeto');

	Route::post('reportes/report_coordinacionmunicipal_objeto','ReporteController@report_coordinacionmunicipal_objeto')->name('report_coordinacionmunicipal_objeto');

	//REPORTE COORDINACION MUNICIPAL: POR TIPO DE ORGANIZACION
	Route::get('reportes/coordinacionmunicipal_pj/tipoorganizacion', 'VistareporteController@coordinacionmunicipal_tipoorganizacion')->name('coordinacionmunicipal_tipoorganizacion');

	Route::post('reportes/report_coordinacionmunicipal_tipoorganizacion','ReporteController@report_coordinacionmunicipal_tipoorganizacion')->name('report_coordinacionmunicipal_tipoorganizacion');

	//Reportes Secretaria de justicia
	//REPORTE SECRETARIA DE JUSTICIA: POR FECHA
	Route::get('reportes/justicia_pj', 'VistareporteController@pjsecretariajusticia')->name('pjsecretariajusticia');
	Route::post('reportes/reporte_secretariajusticia','ReporteController@reporte_secretariajusticia')->name('reporte_secretariajusticia');

	//REPORTE JUSTICIA: RESERVA DE NOMBRE
	Route::get('reportes/justicia_rn', 'VistareporteController@rnsecretariajusticia')->name('rnsecretariajusticia');
	Route::post('reportes/reporte_rnjusticia','ReporteController@reporte_rnjusticia')->name('reporte_rnjusticia');

	//REPORTE SECRETARIA DE JUSTICIA: POR OBJETO
	Route::get('reportes/justicia_pj/objeto', 'VistareporteController@secretariajusticia_objeto')->name('secretariajusticia_objeto');
	Route::post('reportes/report_secretariajusticia_objeto','ReporteController@report_secretariajusticia_objeto')->name('report_secretariajusticia_objeto');

	//REPORTE SECRETARIA DE JUSTICIA: POR AMBITO DE APLICACION
	Route::get('reportes/justicia_pj/ambitoaplicacion', 'VistareporteController@secretariajusticia_ambitoaplicacion')->name('secretariajusticia_ambitoaplicacion');
	Route::post('reportes/report_secretaria_ambitoaplicacion','ReporteController@report_secretaria_ambitoaplicacion')->name('report_secretaria_ambitoaplicacion');
	
	//Datos de consultas personerías jurídicas antiguas
	Route::get('consultadato','ConsultadatoController@index')->name('consultadato.index')->middleware('can:datosantiguos.personerias');

	/*
      * Rutas para la busqueda de preventivos
    */
    Route::get('consultas','Api\SearchController@index')->name('consultas');
    Route::get('/search', 'Api\SearchController@search')->name('documentos_json');

});
