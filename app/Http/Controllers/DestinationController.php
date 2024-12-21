<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;

class DestinationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(Request $req)
    {
        //
        $req->validate([
            "nom" => "required",
            "ville" => "required"
        ]);

        $em = Destination::create([
            "nom" => $req->nom,
            "adresse" => $req->adresse,
            "phone" => $req->phone,
            "ville_id" => $req->ville,
            "email" => $req->email
        ]);


        $notification = array(
            'message' => 'Destination Created successfully',
            'alert-type' => 'success',
            "data" => $em->load('ville')
        );
        return response()->json($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(destination $destination)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(destination $destination)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, destination $destination)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(destination $destination)
    {
        //
    }
}
