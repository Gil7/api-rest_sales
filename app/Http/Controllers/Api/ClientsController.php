<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Client;
class ClientsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clients = Client::all();
        return response()->json($clients);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newClient = new  Client();
        $newClient->name = $request->input('name');
        $newClient->lastname = $request->input('lastname');
        $newClient->phone = $request->input('phone');
        $newClient->email = $request->input('email');
        $newClient->address = $request->input('address');
        $newClient->save();
        return response()->json($newClient,200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $client = Client::find($id);
        $client->sales;
        return response()->json($client,200);

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
        $anyFieldChanged = false;
        $client = Client::find($id);
        if($request->has('name')){
          $client->name = $request->input('name');
          $anyFieldChanged = true;
        }
        if($request->has('lastname')){
          $client->lastname = $request->input('lastname');
          $anyFieldChanged = true;
        }
        if($request->has('address')){
          $client->address = $request->input('address');
          $anyFieldChanged = true;
        }
        if($request->has('phone')){
          $client->phone = $request->input('phone');
          $anyFieldChanged = true;
        }
        if($request->has('email')){
          $client->email = $request->input('email');
          $anyFieldChanged = true;
        }
        if($anyFieldChanged){
          $client->save();
          return response()->json($client,200);
        }
        return response()->json('nothing to do',200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        $client->delete();
        return response()->json('client deleted', 200);
    }
}
