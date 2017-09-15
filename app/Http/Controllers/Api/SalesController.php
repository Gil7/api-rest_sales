<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Sale;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lastSales =  Sale::all();
        return response()->json($lastSales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $validation = Validator::make($request->all(),[
          'client_id' => 'required',
          'products' => 'required'
        ]);
        if ($validation->fails()) {
          return response()->json("The client_id is necessary");
        }
        $sale = new Sale();
        $allProducts = $request->products;
        $sale->client_id = $request->client_id;
        $sale->save();
        foreach($allProducts as $product) {
          $current_id = $product['id'];
          $current_price = $product['price'];
          $current_quantity = $product['quantity'];
          $sale->products()->attach([$current_id => ['price' => $current_price, 'quantity' => $current_quantity]]);
        }
        return response()->json($sale);


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sale = Sale::find($id);
        $amount = 0.0;
        foreach ($sale->products as $item) {
          $amount += $item->pivot->price * $item->pivot->quantity;
        }
        $sale->amount = $amount;
        return response()->json($sale);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
