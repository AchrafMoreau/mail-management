<?php

namespace App\Http\Controllers;

use App\Models\Expediteur;
use Illuminate\Http\Request;

class ExpediteurController extends Controller
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
        // dd($request);
        
        $req->validate([
            "nom" => "required",
            "ville" => "required"
        ]);

        $em = Expediteur::create([
            "nom" => $req->nom,
            "adresse" => $req->adresse,
            "phone" => $req->phone,
            "ville_id" => $req->ville,
            "email" => $req->email
        ]);


        $notification = array(
            'message' => 'Expediteur Created successfully',
            'alert-type' => 'success',
            "data" => $em->load('ville')
        );
        return response()->json($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Expediteur $expediteur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Expediteur $expediteur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Expediteur $expediteur)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Expediteur $expediteur)
    {
        //
    }
}
