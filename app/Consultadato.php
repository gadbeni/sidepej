<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Consultadato extends Model
{
	protected $fillable = ['numeroResolucion','fechaResolucion','razonSocial','provincia','municipio','localidad','sucursal_id'];
    public function sucursal () {
    	return $this->belongsTo(Sucursal::class);
    }
}
