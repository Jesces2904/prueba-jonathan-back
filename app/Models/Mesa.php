<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Mesa extends Model
{
    protected $table = 'mesas';

    public static function getAll()
    {
        $data = DB::table('mesas')
            ->join('tipo_material', 'mesas.id_tipo_material', '=', 'tipo_material.id')
            ->join('tipo_forma', 'mesas.id_tipo_forma', '=', 'tipo_forma.id')
            ->select('mesas.*', 'tipo_forma.nombre AS nombre_forma', 'tipo_material.nombre AS nombre_material')
            ->get();

        return $data;
    }
}
