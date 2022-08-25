<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Pairs;
use App\Models\Currency;
use App\Models\Converts;
class AdminConvertsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $converts = Converts::all();

        // On retourne les informations des utilisateurs en JSON
        return response()->json($converts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $convert = new Converts;
        $convert->id_pair = $request->id_pair;
        $convert->count_conversion = $request->count_conversion;
        $convert->save();
        return response()->json($request);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


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

    public function convert($change, $currencyInit, $currencyDest)
    {
        //return [$change, $currencyInit, $currencyDest];

        $pairs = Pairs::All();
        $currency = Currency::All();
        $convert = Converts::All();

        $idInit = 0;
        $idDest = 0;
        $idPair = 0;
        $ratePair = 0.0;

        //print($pairs[0]->id);

        $response_pairs = response()->json($pairs);
        //print($response_pairs);
        $tab = [];

        foreach ($currency as $key => $valueCurrency) {
            if($valueCurrency->name == $currencyInit){
                $idInit = $valueCurrency->id;

            }else if($valueCurrency->name == $currencyDest){
                $idDest = $valueCurrency->id;
            }
        }

        echo "init ".$idInit;
        echo " => dest ".$idDest;
        echo "<br/>";

        // foreach ($pairs as $pair) {
        //     echo ($pair . "\n");
        //     foreach ($pairs as $key => $valuePair) {
        //         echo $valuePair->id;
        //         echo "<br/>";
        //     }
        // }

        for($i = 0; $i < count($pairs); $i++){
            echo $pairs[$i];
            echo "<br/>";
            echo gettype($pairs[$i]);
            echo "<br/>";
            foreach ((object) array($pairs[$i]) as $pair) {

                if($pair->{'currency_init'} == $idInit && $pair->{'currency_dest'} == $idDest){
                    $idPair = $pair->{'id'};
                    $ratePair = $pair->{'rate'};
                    $convertChange = $ratePair * $change;
                    return "Le change est de ".$convertChange;
                }
                echo "<br/>";
            }
        }

    }
}
