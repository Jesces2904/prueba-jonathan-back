<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mesa;
use App\Models\TipoForma;
use App\Models\TipoMaterial;

class MesaController extends Controller
{
    public function mesas()
    {
        $data = Mesa::getAll();
        return json_encode(array("success" => "Ok", "data" => $data));
    }

    public function mesa(Request $request)
    {
        $data = Mesa::where('id', $request->id)->first();
        $dataTipoForma = TipoForma::all();
        $dataTipoMaterial = TipoMaterial::all();
        return json_encode(array("success" => "Ok", "data" => $data, "dataTipoForma" => $dataTipoForma, "dataTipoMaterial" => $dataTipoMaterial));

    }

    public function mesaUpdate(Request $request)
    {
        $dataUpdate = json_decode($request->getContent());
        $data = Mesa::where('id', $dataUpdate->id)->update([
            'id_tipo_material' => $dataUpdate->id_tipo_material,
            'id_tipo_forma' => $dataUpdate->id_tipo_forma,
            'ancho' => $dataUpdate->ancho,
            'alto' => $dataUpdate->alto,
            'largo' => $dataUpdate->largo
        ]);
        
        return json_encode($data);
    }

    public function mesaCreate(Request $request)
    {
        $dataCreate = json_decode($request->getContent());
        $mesa = new Mesa;

        $mesa->id_tipo_forma = $dataCreate->id_tipo_forma;
        $mesa->id_tipo_material = $dataCreate->id_tipo_material;
        $mesa->ancho = $dataCreate->ancho;
        $mesa->alto = $dataCreate->alto;
        $mesa->largo = $dataCreate->largo;

        $mesa->save();
        return json_encode($dataCreate);
    }

    public function mesaDelete(Request $request)
    {
        $data = Mesa::where('id', $request->id)->delete();
        return json_encode($data);
    }

    public function tipos()
    {
        $dataTipoForma = TipoForma::all();
        $dataTipoMaterial = TipoMaterial::all();
        return json_encode(array("success" => "Ok", "dataTipoForma" => $dataTipoForma, "dataTipoMaterial" => $dataTipoMaterial));
    }
}
