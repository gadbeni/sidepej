<?php

use Illuminate\Database\Seeder;
use Caffeinated\Shinobi\Models\Permission;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Users
        Permission::create([
            'name'          => 'Navegar usuarios',
            'slug'          => 'users.index',
            'description'   => 'Lista y navega todos los usuarios del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de usuario',
            'slug'          => 'users.show',
            'description'   => 'Ve en detalle cada usuario del sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de usuarios',
            'slug'          => 'users.edit',
            'description'   => 'Podría editar cualquier dato de un usuario del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar usuario',
            'slug'          => 'users.destroy',
            'description'   => 'Podría eliminar cualquier usuario del sistema',
        ]);

        //Roles
        Permission::create([
            'name'          => 'Navegar roles',
            'slug'          => 'roles.index',
            'description'   => 'Lista y navega todos los roles del sistema',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de un rol',
            'slug'          => 'roles.show',
            'description'   => 'Ve en detalle cada rol del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de roles',
            'slug'          => 'roles.create',
            'description'   => 'Podría crear nuevos roles en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de roles',
            'slug'          => 'roles.edit',
            'description'   => 'Podría editar cualquier dato de un rol del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar roles',
            'slug'          => 'roles.destroy',
            'description'   => 'Podría eliminar cualquier rol del sistema',
        ]);

        //Sucursales
        Permission::create([
            'name'          => 'Navegar sucursales',
            'slug'          => 'sucursales.index',
            'description'   => 'Lista y navega todas las sucursales del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de sucursales',
            'slug'          => 'sucursales.create',
            'description'   => 'Podría crear nuevas sucursales en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de sucursales',
            'slug'          => 'sucursales.edit',
            'description'   => 'Podría editar sucursal del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar sucursales',
            'slug'          => 'sucursales.destroy',
            'description'   => 'Podría eliminar cualquier sucursal del sistema',
        ]);

        //Sucursales_usuarios (Asignacion de sucursales)
        Permission::create([
            'name'          => 'Navegar sucursales asignadas',
            'slug'          => 'sucursal_usuario.index',
            'description'   => 'Lista y navega todas las sucursales asignadas del sistema',
        ]);

        Permission::create([
            'name'          => 'Creación de asignacion de sucursales',
            'slug'          => 'sucursal_usuario.create',
            'description'   => 'Podría crear nueva asignacion sucursales en el sistema',
        ]);

        Permission::create([
            'name'          => 'Edición de asignacion de sucursales',
            'slug'          => 'sucursal_usuario.edit',
            'description'   => 'Podría editar asignacion de sucursal del sistema',
        ]);

        Permission::create([
            'name'          => 'Eliminar asignacion de sucursales',
            'slug'          => 'sucursal_usuario.destroy',
            'description'   => 'Podría eliminar cualquier asignacion de sucursal del sistema',
        ]);

        //DropdownCoordinacionmunicipal
        Permission::create([
            'name'          => 'Navegar dropdown coordinacion municipal',
            'slug'          => 'dropdown.coordinacionmunicipal',
            'description'   => 'navega todas la listas de dropdown de coordinacion municipal',
        ]);

        //Reserva nombre coordinacion municipal
        Permission::create([
            'name'          => 'Navegar reservas coordinacion municipal',
            'slug'          => 'reservacoordinacionmunicipal.index',
            'description'   => 'Lista y navega todas las reservas de coordinacion municipal',
        ]);

        Permission::create([
            'name'          => 'Creación reservas coordinacion municipal',
            'slug'          => 'reservacoordinacionmunicipal.create',
            'description'   => 'Podría crear nueva reserva coordinacion municipal',
        ]);

        Permission::create([
            'name'          => 'Edición reservas coordinacion municipal',
            'slug'          => 'reservacoordinacionmunicipal.edit',
            'description'   => 'Podría editar reserva coordinacion municipal',
        ]);

        Permission::create([
            'name'          => 'Eliminar reservas coordinacion municipal',
            'slug'          => 'reservacoordinacionmunicipal.destroy',
            'description'   => 'Podría eliminar cualquier reserva coordinacion municipal',
        ]);

        //Personeria coordinacion municipal
        Permission::create([
            'name'          => 'Navegar personeria coordinacion municipal',
            'slug'          => 'personeriacoordinacionmunicipal.index',
            'description'   => 'Lista y navega todas las personerias de coordinacion municipal',
        ]);

        Permission::create([
            'name'          => 'Creación personeria coordinacion municipal',
            'slug'          => 'personeriacoordinacionmunicipal.create',
            'description'   => 'Podría crear nueva personeria coordinacion municipal',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de personeria coordinacion municipal',
            'slug'          => 'personeriacoordinacionmunicipal.show',
            'description'   => 'Ve en detalle cada personeria coordinacion municipal',
        ]);

        Permission::create([
            'name'          => 'Edición personeria coordinacion municipal',
            'slug'          => 'personeriacoordinacionmunicipal.edit',
            'description'   => 'Podría editar personeria coordinacion municipal',
        ]);

        Permission::create([
            'name'          => 'Eliminar personeria coordinacion municipal',
            'slug'          => 'personeriacoordinacionmunicipal.destroy',
            'description'   => 'Podría eliminar cualquier personeria coordinacion municipal',
        ]);

        //Ficha de datos de personerias de direccion coordinacion municipal
        Permission::create([
            'name'          => 'Navegar ficha de datos de personeria coordinacion municipal',
            'slug'          => 'report.fichadatos_coordinacionmunicipal',
            'description'   => 'navega ficha de datos de personeria coordinacion municipal',
        ]);

        //Descargar archivo de personeria de direccion coordinacion municipal
        Permission::create([
            'name'          => 'Navegar archivo digital personeria coordinacion municipal',
            'slug'          => 'archivo.coordinacionmunicipal',
            'description'   => 'navega archivo digital de personeria coordinacion municipal',
        ]);

        //REPORTES DIR. COORDINACION MUNICIPAL
        //Navegar reporte por fechas personerias juridicas coordinacion municipal
        Permission::create([
            'name'          => 'Navegar reporte por fecha personeria coordinacion municipal',
            'slug'          => 'report.personeria_coordinacionmunicipal',
            'description'   => 'navega reporte personerias coordinacion municipal',
        ]);

        //Navegar reporte por fechas reserva de nombres coordinacion municipal
        Permission::create([
            'name'          => 'Navegar reporte por fecha reserva de nombres coordinacion municipal',
            'slug'          => 'report.reservanombre_coordinacionmunicipal',
            'description'   => 'navega reporte reserva de nombre coordinacion municipal',
        ]);

        //Navegar reporte por objeto de la personeria coordinacion municipal
        Permission::create([
            'name'          => 'Navegar reporte por objeto de la personeria coordinacion municipal',
            'slug'          => 'report.objeto_coordinacionmunicipal',
            'description'   => 'navega reporte por objeto coordinacion municipal',
        ]);

        //Navegar reporte por tipo de organizacion de la personeria coordinacion municipal
        Permission::create([
            'name'          => 'Navegar reporte por tipo de organizacion de la personeria coordinacion municipal',
            'slug'          => 'report.tipoorganizacion_coordinacionmunicipal',
            'description'   => 'navega reporte por tipo de organizacion coordinacion municipal',
        ]);

        //DropdownJusticia
        Permission::create([
            'name'          => 'Navegar dropdown secretaria de justicia',
            'slug'          => 'dropdown.justicia',
            'description'   => 'navega todas la listas de dropdown de secretaria de justicia',
        ]);

        //Reserva nombre secretaria de justicia
        Permission::create([
            'name'          => 'Navegar reservas justicia',
            'slug'          => 'reservajusticia.index',
            'description'   => 'Lista y navega todas las reservas de secretaria de justicia',
        ]);

        Permission::create([
            'name'          => 'Creación reservas justicia',
            'slug'          => 'reservajusticia.create',
            'description'   => 'Podría crear nueva reserva de secretaria de justicia',
        ]);

        Permission::create([
            'name'          => 'Edición reservas justicia',
            'slug'          => 'reservajusticia.edit',
            'description'   => 'Podría editar reserva de secretaria de justicia',
        ]);

        Permission::create([
            'name'          => 'Eliminar reservas justicia',
            'slug'          => 'reservajusticia.destroy',
            'description'   => 'Podría eliminar cualquier reserva de secretaria de justicia',
        ]);

        //Personeria secretaria de justicia
        Permission::create([
            'name'          => 'Navegar personeria justicia',
            'slug'          => 'personeriajusticia.index',
            'description'   => 'Lista y navega todas las personerias de secretaria de justicia',
        ]);

        Permission::create([
            'name'          => 'Creación personeria justicia',
            'slug'          => 'personeriajusticia.create',
            'description'   => 'Podría crear nueva personeria de secretaria de justicia',
        ]);

        Permission::create([
            'name'          => 'Ver detalle de personeria justicia',
            'slug'          => 'personeriajusticia.show',
            'description'   => 'Ve en detalle cada personeria de secretaria de justicia',
        ]);

        Permission::create([
            'name'          => 'Edición personeria justicia',
            'slug'          => 'personeriajusticia.edit',
            'description'   => 'Podría editar personeria de secretaria de justicia',
        ]);

        Permission::create([
            'name'          => 'Eliminar personeria justicia',
            'slug'          => 'personeriajusticia.destroy',
            'description'   => 'Podría eliminar cualquier personeria de secretaria de justicia',
        ]);

        //Ficha de datos de personerias de secretaria de justicia
        Permission::create([
            'name'          => 'Navegar ficha de datos de personeria secretaria de justicia',
            'slug'          => 'report.fichadatos_secretariajusticia',
            'description'   => 'navega ficha de datos de personeria secretaria justicia',
        ]);

        //Descargar archivo de personeria de secretaria de justicia
        Permission::create([
            'name'          => 'Navegar archivo digital personeria secretaria de justicia',
            'slug'          => 'archivo.secretariajusticia',
            'description'   => 'navega archivo digital de personeria secretaria justicia',
        ]);

        //REPORTES SECRETARIA DE JUSTICIA
        //Navegar reporte por fechas personerias juridicas secretaria justicia
        Permission::create([
            'name'          => 'Navegar reporte por fecha personeria secretaria de justicia',
            'slug'          => 'report.personeria_secretariajusticia',
            'description'   => 'navega reporte personerias secretaria justicia',
        ]);

        //Navegar reporte por fechas reserva de nombres secretaria justicia
        Permission::create([
            'name'          => 'Navegar reporte por fecha reserva de nombres secretaria de justicia',
            'slug'          => 'report.reservanombre_secretariajusticia',
            'description'   => 'navega reporte reserva de nombre secretaria justicia',
        ]);

        //Navegar reporte por objeto de la personeria secretaria justicia
        Permission::create([
            'name'          => 'Navegar reporte por objeto de la personeria secretaria de justicia',
            'slug'          => 'report.objeto_secretariajusticia',
            'description'   => 'navega reporte por objeto secretaria justicia',
        ]);

        //Navegar reporte por ambito de aplicacion de la personeria secretaria justicia
        Permission::create([
            'name'          => 'Navegar reporte por ambito de aplicacion de la personeria secretaria de justicia',
            'slug'          => 'report.ambitoaplicacion_secretariajusticia',
            'description'   => 'navega reporte por ambito de aplicacion secretaria justicia',
        ]);
        
        //Navegar datos antiguos sobre nombres de personerias jurudicas
        Permission::create([
            'name'          => 'Navegar nombres de personerias antiguos',
            'slug'          => 'datosantiguos.personerias',
            'description'   => 'navega datos antiguos de nombres de personerias juridicas',
        ]);
    }
}
