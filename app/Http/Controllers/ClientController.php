<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::all();
        $cliArr = [];
        foreach ($clients as $cli) {
            $cliArr[] = [
                'name' => $cli->name,
                'email' => $cli->email,
                'phone' => $cli->phone,
                'adress' => $cli->adress,
                'services' => $cli->services,
            ];
        }
        return response()->json($cliArr);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $cli = new Client();
        $cli->name = $request->name;
        $cli->email = $request->email;
        $cli->phone = $request->phone;
        $cli->adress = $request->adress;
        $cli->save();

        $data = [
            'message' => 'Client created succesfully!',
            'data' => $cli,
        ];

        return response()->json($data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        if (!$client) {

            return response()->json([
                'message' => 'Client not found!',
            ]);
        }

        $client->services;

        $data = [
            'message' => 'Client found succesfully',
            'client' => $client,
        ];

        return response()->json($data);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $cli)
    {
        Client::updateOrInsert(
            ['email' => $request->name],
            ['name' => $request->name, 'email' => $request->email, 'phone' => $request->phone, 'adress' => $request->adress]
        );

        $client = Client::all()->where('email', $request->email)->last();

        return response()->json([
            'message' => 'Client updated succesfully!',
            'data' => $client,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Client $client)
    {
        $client->delete();
        $data = [
            'message' => 'Client deleted succesfully!',
            'data' => $client,
        ];
        return response()->json($data);
    }

    public function attach(Request $request)
    {
        $client = Client::find($request->client_id);
        $client->services()->attach($request->service_id);

        $data = [
            'message' => 'Client attached succesfully!',
            'data' => $client,
        ];

        return response()->json($data);
    }
    public function detach(Request $request)
    {
        $client = Client::find($request->client_id);
        $client->services()->detach($request->service_id);

        $data = [
            'message' => 'Client dettached succesfully!',
            'data' => $client,
        ];

        return response()->json($data);
    }
}
