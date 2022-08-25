<?php

namespace App\Http\Controllers\API;

use App\Models\Pairs;
use App\Models\Currency;

use Illuminate\Support\Facades\Storage;
use App\Http\Controllers\Controller;
use App\Http\Controllers\API\AdminCurrencyController;

use Illuminate\Http\Request;

class AdminPairsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pairs = Pairs::All();
        $currency = Currency::All();

        $response_pairs = response()->json($pairs);
        $tab = [];

        foreach ($pairs as $key => $valuePairs) {

            foreach ($currency as $key => $valueCurrency) {
                if($valuePairs->currency_init == $valueCurrency->id ){
                    $name_currency_init = $valueCurrency->name;
                }
                if($valuePairs->currency_dest == $valueCurrency->id){
                    $name_currency_dest = $valueCurrency->name;
                }

            }
            array_push($tab,"$valuePairs->id, $name_currency_init => $name_currency_dest => $valuePairs->rate");
        }


        return $tab;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $pair = new Pairs;
        $pair->currency_init = $request->currency_init;
        $pair->currency_dest = $request->currency_dest;
        $pair->rate = $request->rate;
        $pair->save();

        return response()->json($pair->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $pair = Pairs::findOrFail($id);
        return response()->json($pair);
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
        $pair = Pairs::findOrFail($id);
        $pair->currency_init = $request->currency_init;
        $pair->currency_dest = $request->currency_dest;
        $pair->rate = $request->rate;
        $pair->save();
        return response()->json($request);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pair = Pairs::find($id)->delete();
        return response()->json($pair);
    }
}
