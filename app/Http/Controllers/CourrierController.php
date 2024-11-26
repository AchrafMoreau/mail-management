<?php

namespace App\Http\Controllers;

use App\Models\Courrier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CourrierController extends Controller
{
    public function historique(Request $request)
    {
        $courriers = Courrier::query()
            ->when($request->input('year'), function ($query, $year) {
                return $query->whereYear('date', $year);
            })
            ->when($request->input('month'), function ($query, $month) {
                return $query->whereMonth('date', $month);
            })
            ->paginate(10);

        return view('historique_courriers', compact('courriers'));
    }

    public function create()
    {
        return view('courriers.create');
    }

    public function store(Request $request)
    {
        $rules = [
            'type' => 'required|in:entrant,sortant',
            'objet' => 'required|string',
            'date' => 'required|date',
            'emetteur' => 'required|string',
            'division' => 'required',
            'adresse_emetteur' => 'required|string',
            'observation' => 'nullable|string',
            'image_scan' => 'nullable|image|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('courriers.create')->withInput()->withErrors($validator);
        }

        $courrier = new Courrier();
        $courrier->type = $request->type;
        $courrier->division = $request->division;
        $courrier->objet = $request->objet;
        $courrier->date = $request->date;
        $courrier->emetteur = $request->emetteur;
        $courrier->adresse_emetteur = $request->adresse_emetteur;
        $courrier->observation = $request->observation;

        if ($request->hasFile('image_scan')) {
            $imagePath = $request->file('image_scan')->store('uploads/courriers', 'public');
            $courrier->image_scan = basename($imagePath);
        }

        $courrier->save();

        return redirect()->route('gestion_courrier')->with('success', 'Courrier ajouté.');
    }

    public function index()
    {
        $courriers = Courrier::paginate(10); // Utilisez paginate() pour la pagination
       
        return view('gestion_courrier', compact('courriers'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $month = $request->input('month');


        $courriers = Courrier::query()
            ->when($query, function($q) use ($query) {
                $q->where('objet', 'LIKE', "%{$query}%")
                  ->orWhere('type', 'LIKE', "%{$query}%")
                  ->orWhere('emetteur', 'LIKE', "%{$query}%")
                  ->orWhere('adresse_emetteur', 'LIKE', "%{$query}%")
                  ->orWhere('observation', 'LIKE', "%{$query}%");
            })
            ->when($month, function($q) use ($month) {
                $q->whereMonth('date', $month);
            })
            ->paginate(10);
        
        

        return view('courriers.index', compact('courriers'));
    }

    public function edit($id)
    {
        $courrier = Courrier::findOrFail($id);
        return view('courriers.edit', ['courrier' => $courrier]);
    }

    public function update(Request $request, $id)
    {
        $courrier = Courrier::findOrFail($id);

        $rules = [
            'type' => 'required|in:entrant,sortant',
            'objet' => 'required|string',
            'date' => 'required|date',
            'emetteur' => 'required|string',
            'division' => 'required',
            'adresse_emetteur' => 'required|string',
            'observation' => 'nullable|string',
            'image_scan' => 'nullable|image|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect()->route('courriers.edit', $id)->withInput()->withErrors($validator);
        }

        $courrier->type = $request->type;
        $courrier->division = $request->division;
        $courrier->objet = $request->objet;
        $courrier->date = $request->date;
        $courrier->emetteur = $request->emetteur;
        $courrier->adresse_emetteur = $request->adresse_emetteur;
        $courrier->observation = $request->observation;

        if ($request->hasFile('image_scan')) {
            // Delete old image if it exists
            if ($courrier->image_scan) {
                Storage::disk('public')->delete('uploads/courriers/' . $courrier->image_scan);
            }

            // Store new image
            $imagePath = $request->file('image_scan')->store('uploads/courriers', 'public');
            $courrier->image_scan = basename($imagePath);
        }

        $courrier->save();

        return redirect()->route('gestion_courrier')->with('success', 'Courrier modifié.');
    }

    public function destroy($id)
    {
        $courrier = Courrier::findOrFail($id);
        
        // Delete the image file if it exists
        if ($courrier->image_scan) {
            Storage::disk('public')->delete('uploads/courriers/' . $courrier->image_scan);
        }
    
        $courrier->delete();
    
        return redirect()->route('gestion_courrier')->with('success', 'Courrier supprimé avec succès.');
    }

    public function show($id)
    {
        $courrier = Courrier::findOrFail($id);
        return view('courriers.show', compact('courrier'));
    }
}
