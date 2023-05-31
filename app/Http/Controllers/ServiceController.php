<?php

namespace App\Http\Controllers;

use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $services = Service::all();

        return response()->json([
            'message' => 'All good!',
            'data' => $services,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $ser = new Service();
        $ser->name = $request->name;
        $ser->price = $request->price;
        $ser->description = $request->description;
        $ser->save();

        return response()->json([
            'message' => 'Service created succesfully!',
            'data' => $ser,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {

        if (!$id) {
            return response()->json([
                'message' => 'All bad!',
            ]);
        }

        $serv = Service::all()->where('id', $id)->last();
        return response()->json([
            'message' => 'All good!',
            'data' => $serv
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Service $service)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Service $ser)
    {
        Service::updateOrInsert(
            ['name' => $request->name],
            ['name' => $request->name, 'price' => $request->price, 'description' => $request->description]
        );

        $service = Service::all()->where('name', $request->name)->last();

        return response()->json([
            'message' => 'Service updated succesfully!',
            'data' => $service,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Service $service)
    {
        $service->delete();
        return response()->json([
            'message' => 'Service deleted succesfully!',
            'data' => $service,
        ]);
    }
    public function showClients(Service $service)
    {
        return response()->json([
            'message' => 'Service ' . $service->name . ' clients',
            'data' => $service->clients
        ]);
    }
}
