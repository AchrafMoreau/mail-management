<?php

namespace App\Http\Controllers;

use App\Models\Emetteur;
use App\Models\Ville;
use Illuminate\Http\Request;

class EmetteurController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $villes = Ville::all();
        return view('emetteur.index', ['villes' => $villes]);
    }

    public function json()
    {
        $emetteur = Emetteur::with('ville')->get();
        return response()->json($emetteur);
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
        // dd($req);
        $req->validate([
            "nom" => "required",
            "adresse" => "required",
            "ville_id" => "required"
        ]);

        $em = Emetteur::create([
            "nom" => $req->nom,
            "adresse" => $req->adresse,
            "phone" => $req->phone,
            "ville_id" => $req->ville_id,
            "zip" => $req->zip
        ]);


        $notification = array(
            'message' => 'Emetteur Created successfully',
            'alert-type' => 'success',
            "data" => $em->load('ville')
        );
        return response()->json($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Emetteur $emetteur)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Emetteur $emetteur)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Emetteur $emetteur)
    {
        //
        $req->validate([
            "nom" => "required",
            "adresse" => "required",
            "ville_id" => "required"
        ]);

        $emetteur->nom = $req->nom;
        $emetteur->adresse = $req->adresse;
        $emetteur->ville_id = $req->ville_id;
        $emetteur->zip = $req->zip;
        $emetteur->phone = $req->phone;
        $emetteur->save();

        
        $notification = array(
            'message' => 'Emetteur Updated successfully',
            'alert-type' => 'success',
            "data" => $emetteur->load('ville')
        );
        return response()->json($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Emetteur $emetteur)
    {
        //
        Emetteur::where('id', $emetteur->id)->delete();
        $notification = array(
            'message' => 'Emetteur Deleted successfully',
            'alert-type' => 'success',
        );
        return response()->json($notification);
    }

    public function deleteMany(Request $req)
    {
        $req->validate([
            "ids" => "required|array",
        ]);


        Emetteur::whereIn('id', $req->ids)->delete();

        $notification = array(
            'message' => 'Many Emetteur Deleted Successfully',
            'alert-type' => 'success'
        );
        return response()->json($notification);
    }
}
