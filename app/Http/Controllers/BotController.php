<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;

class BotController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $all = $request->all();
        $distrito = strtoupper($request->distrito);
        $candidatos = $this->getDataCandidatos($distrito);


        $data = [
             "messages"=> [
                [
                    "text"=> "Sabias que en " . $distrito . " hay " .count($candidatos) . " candidatos incluyendo regidores ",
                ],
                [
                    "text" => "Para ver la lista de candidatos entra a este link http://36bff7a0.ngrok.io/distrito/$distrito",
                ]
             ]
        ];
        return response()->json($data);
    }

    public function getCompleteName($data)
    {
        return "$data->TXAPELLIDOPATERNO $data->TXAPELLIDOMATERNO $data->TXNOMBRES";
    }

    public function getCompleteNacimiento($data)
    {
        return "$data->TXNACIDEPARTAMENTO $data->TXNACIPROVINCIA $data->TXNACIDISTRITO";
    }

    public function getCompleteDomicilio($data)
    {
        return "$data->TXDOMIDEPARTAMENTO $data->TXDOMIPROVINCIA $data->TXDOMIDISTRITO";
    }

    public function getCompletePostula($data)
    {
        return "$data->TXPOSTULADEPARTAMENTO $data->TXPOSTULAPROVINCIA $data->TXPOSTULADISTRITO";
    }

    public function getDatosPersonales(Request $request)
    {
        $name = strtoupper($request->name);
        $dataPersonal = DB::connection('excel')->table('datos_personales')->where('TXNOMBRES', 'LIKE', "%$name%")->get()->map(function ($data) {
            // return $data;
            $new = [
                [
                    "text" => "Nombre Candidato: ". $this->getCompleteName($data)
                ],
                [
                    "text" => "Sexo: $data->TXSEXO"
                ],
                [
                    "text" => "Fecha de nacimiento: $data->FENACIMIENTO"
                ],
                [
                    "text" => "Lugar de nacimiento: ".$this->getCompleteNacimiento($data)
                ],
                [
                    "text" => "Lugar donde reside: ".$this->getCompleteDomicilio($data)
                ],
                [
                    "text" => "Lugar donde postula: ".$this->getCompletePostula($data)
                ],
                [
                    "text" => "Cargo donde postula: $data->TXCARGOELECCION "
                ],
                [
                    "text" => "Organización politica: ". $data->TXORGANIZACIONPOLITICA
                ],
            ];
            return $new;
        });

        if (count($dataPersonal)>0) {
            $data = [
                "messages" => $dataPersonal[0]
            ];
            return response()->json($data);
        } else {
            return null;
        }


        // EDUCACION
        // Universidad
        // Carrera
        // Titulo

        // EDUCACION TECNICA
        // Institucion tecnica
        // Carera tecnica


        // return DB::connection('excel')->table('datos_personales')->where('TXDISTRITOPOSTULA', $distrito)->get()
    }

    public function getDistrito(Request $request)
    {
        $distrito = strtoupper($request->distrito);
        return $candidatos = $this->getDataCandidatos($distrito);
        $data = [
            "messages" => $candidatos
        ];
        return response()->json($data);
    }

    private function getDataCandidatos($distrito)
    {
        $candidatos = DB::connection('excel')->table('candidatos')->where('TXDISTRITOPOSTULA', $distrito)
        ->get(['TXAPELLIDOPATERNO', 'TXAPELLIDOMATERNO', 'TXNOMBRECOMPLETO', 'TXORGANIZACIONPOLITICA', 'TXDOCUMENTOIDENTIDAD'])
        ->map(function ($candidato) {
            $name['text'] = "$candidato->TXNOMBRECOMPLETO $candidato->TXAPELLIDOMATERNO $candidato->TXAPELLIDOPATERNO";
            return $name;
        });

        return $candidatos;
    }
}
