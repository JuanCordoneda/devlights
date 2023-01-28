<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DealsController extends Controller
{
    public function index(Request $request)
    {
        $strJsonFileContents = file_get_contents("\laragon\www\code\mi-proyecto-laravel\app\Http\Controllers\deals.json", true);  //obtiene el documento
        $array = json_decode($strJsonFileContents, FILE_USE_INCLUDE_PATH);  //lo convierte en array

        // los 2 tipos de retorno
        $array2 = [];       
        $answer = [];

        for ($x = 0; $x < count($array); $x++) {    //array para aplicar filtros
            $array2[] = array(
                'title' => $array[$x]['title'],
                'thumb' => $array[$x]['thumb'],
                'steamRatingPercent' => $array[$x]['steamRatingPercent'],
                'savings' => round($array[$x]['savings']),
                'normalPrice' => $array[$x]['normalPrice'],
                'salePrice' => (float)$array[$x]['salePrice'],
            );
        }

        if ($request->q) {
            $req = explode(",", $request->q); //separa las distintas querys del request en un array 

            for ($x = 0; $x < count($array2); $x++) {
                $title = $array2[$x]['title'];

                for ($i = 0; $i < count($req); $i++) {    //itera array de parámetros de query

                    //si existe parámetro 'title:' y hay coincidencia o similitud de búsqueda, se agrega en el array $answer
                    if (strpos($req[$i], 'title:') > -1 && (strpos(strtolower($title), strtolower(substr($req[$i], 6))) > -1) || strtolower($title) == strtolower(substr($req[$i], 6))) {
                        $answer[] = $array2[$x];
                    }

                    //si existe parámetro 'title=' y hay similitud de búsqueda, se agrega en el array $answer
                    elseif (strpos($req[$i], 'title=') > -1 && $title == substr($req[$i], 6)) {
                        $answer[] = $array2[$x];
                    }

                    //si NO existe parámetro 'title:' y hay coincidencia o similitud de búsqueda, se agrega en el array $answer
                    elseif (strpos(strtolower($title), strtolower($req[$i])) > -1 || strtolower($title) == strtolower($req[$i])) {
                        $answer[] = $array2[$x];
                    } 
                    
                    else {
                        continue;
                    }
                }
            }

            // si no se aplicaron filtros de búsqueda por título...
            if (count($answer) == 0) {
                $req = explode(",", $request->q); //separa las distintas querys del request

                for ($w = 0; $w < count($req); $w++) {    //recorre parametros de query
                    $num = sizeof($array2);  //longitud fija de array
                    sort($array2);  //ordena array

                    //si existe parámetro 'salePrice>' y hay similitud de búsqueda, se quitan los campso del array (array2[]) que no son compatibles
                    if ((strpos($req[$w], 'salePrice>') > -1)) { 
                        for ($a = 0; $a < $num; $a++) {                                 //iterador de array2[]
                            if ($array2[$a]['salePrice'] < substr($req[$w], 10)) {
                                unset($array2[$a]);                                     //se quitan campos incompatibles
                            }
                        }
                    }

                    //si existe parámetro 'salePrice<' y hay similitud de búsqueda, se quitan los campso del array (array2[]) que no son compatibles
                     elseif ((strpos($req[$w], 'salePrice<') > -1)) { //si es salePrice<
                        for ($b = 0; $b < $num; $b++) {                                 //iterador de array2[]
                            if ($array2[$b]['salePrice'] > substr($req[$w], 10)) {
                                unset($array2[$b]);                                     //se quitan campos incompatibles
                            }
                        }
                    } else {
                        continue;
                    }
                }
                // return $array2;  
                return view('welcome', [
                    'games' => json_decode(json_encode($array2))
                ]);

            // si se aplicaron filtros de búsqueda por título...
            } else {    
                $req = explode(",", $request->q); //separa las distintas querys del request

                for ($z = 0; $z < count($req); $z++) {    //recorre parametros de query
                    $num = sizeof($answer);
                    sort($answer);

                    //si existe parámetro 'salePrice>' y hay similitud de búsqueda, se quitan los campso del array (array2[]) que no son compatibles
                    if ((strpos($req[$z], 'salePrice>') > -1)) { 
                        for ($c = 0; $c < $num; $c++) {
                            if ($answer[$c]['salePrice'] < substr($req[$z], 10)) {
                                unset($answer[$c]);
                            }
                        }
                    
                    //si existe parámetro 'salePrice<' y hay similitud de búsqueda, se quitan los campos del array (array2[]) que no son compatibles
                    } elseif ((strpos($req[$z], 'salePrice<') > -1)) { //si es salePrice<
                        for ($d = 0; $d < $num; $d++) {
                            if ($answer[$d]['salePrice'] > substr($req[$z], 10)) {
                                unset($answer[$d]);   //elimina el índice 2
                            }
                        }
                    } else {
                        continue;
                    }
                }
                // return $answer;
                return view('welcome', [
                    'games' => json_decode(json_encode($answer))
                ]);
            }
        } else {
            return view('welcome', [
                'games' => json_decode(json_encode($array2))
            ]);
        }
    }
}
