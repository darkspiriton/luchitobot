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

use Illuminate\Support\Facades\DB;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/distrito/{distrito}', function ($distrito) {
    $datas = [1, 2, 3, 4, 5];
    $distrito = strtoupper($distrito);
    $candidatos = DB::connection('excel')->table('candidatos')->where('TXDISTRITOPOSTULA', $distrito)
        ->get(['TXAPELLIDOPATERNO', 'TXAPELLIDOMATERNO', 'TXNOMBRECOMPLETO', 'TXORGANIZACIONPOLITICA', 'TXDOCUMENTOIDENTIDAD', 'TXCARGOELECCION', 'TXORGANIZACIONPOLITICA']);
    // ->map(function ($candidato) {
    //     $name['text'] = "$candidato->TXNOMBRECOMPLETO $candidato->TXAPELLIDOMATERNO $candidato->TXAPELLIDOPATERNO";
    //     return $name;
    // });

    return view('distrito', ["datas" => $candidatos]);
});
