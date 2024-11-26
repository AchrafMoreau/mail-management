<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Decharge;
use Illuminate\Support\Facades\Storage;

class DechargeController extends Controller
{
    public function historique(Request $request)
    {
        $decharges = Decharge::query()
            ->when($request->input('year'), function ($query, $year) {
                return $query->whereYear('date', $year);
            })
            ->when($request->input('month'), function ($query, $month) {
                return $query->whereMonth('date', $month);
            })
            ->paginate(10); // Pagination avec 10 décharges par page

        return view('historique_decharges', compact('decharges'));
    }
    public function index(Request $request)
    {
        $month = $request->input('month');
        $query = Decharge::query();
    
        if ($month) {
            $query->whereMonth('date', $month);
        }
    
        $decharges = $query->paginate(10); // Adjust as needed
    
        return view('decharges.index', compact('decharges'));
    }
    public function gestionDecharges()
{
    $decharges = Decharge::paginate(10); // Assurez-vous que Decharge est le nom du modèle approprié
    return view('gestion_decharges', compact('decharges'));
}
    public function show($id)
    {
        $decharge = Decharge::findOrFail($id);
        return view('decharges.show', compact('decharge'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');
        $month = $request->input('month');
    
        $decharges = Decharge::query()
            ->when($query, function ($queryBuilder) use ($query) {
                return $queryBuilder->where(function ($queryBuilder) use ($query) {
                    $queryBuilder->where('nom_complet', 'LIKE', '%' . $query . '%')
                        ->orWhere('ville', 'LIKE', '%' . $query . '%')
                        ->orWhere('etat', 'LIKE', '%' . $query . '%');
                });
            })
            ->when($month, function ($queryBuilder) use ($month) {
                return $queryBuilder->whereMonth('date', $month);
            })
            ->paginate(10);
    
        return view('decharges.index', compact('decharges'));
    }


    public function create()
    {
        return view('decharges.create');
    }

    public function store(Request $request)
{
    // Validate the request data
    $validatedData = $request->validate([
        'nom_complet' => 'required|string|max:255',
        'date' => 'required|date',
        'etat' => 'required|string',
        'ville' => 'required|string',
        'image_scan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
    ]);

    // Handle file upload
    if ($request->hasFile('image_scan')) {
        $imagePath = $request->file('image_scan')->store('uploads/decharges', 'public');
        $validatedData['image_scan'] = basename($imagePath);
    }

    // Create the decharge
    Decharge::create($validatedData);

    // Redirect with a success message
    return redirect()->route('decharges.index')->with('success', 'Décharge créée avec succès.');
}
    
    public function edit($id)
    {
        $decharge = Decharge::findOrFail($id);
        return view('decharges.edit', compact('decharge'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom_complet' => 'required|string',
            'date' => 'required|date',
            'etat' => 'nullable|string',
            'ville' => 'nullable|string',
            'image_scan' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $decharge = Decharge::findOrFail($id);
        $decharge->nom_complet = $request->input('nom_complet');
        $decharge->date = $request->input('date');
        $decharge->etat = $request->input('etat');
        $decharge->ville = $request->input('ville');

        // Gestion du fichier image
        if ($request->hasFile('image_scan')) {
            // Supprimer l'image précédente si elle existe
            if ($decharge->image_scan && Storage::exists('public/' . $decharge->image_scan)) {
                Storage::delete('public/' . $decharge->image_scan);
            }
            $imagePath = $request->file('image_scan')->store('decharges', 'public');
            $decharge->image_scan = $imagePath;
        }

        $decharge->save();

        return redirect()->route('decharges.index')->with('success', 'Décharge mise à jour avec succès!');
    }

    public function destroy($id)
    {
        // Trouve la décharge ou renvoie une erreur 404 si non trouvée
        $decharge = Decharge::findOrFail($id);

        // Supprime l'image si elle existe
        if ($decharge->image_scan && Storage::exists('public/' . $decharge->image_scan)) {
            Storage::delete('public/' . $decharge->image_scan);
        }

        // Supprime la décharge
        $decharge->delete();
        return redirect()->route('decharges.index')->with('success', 'Décharge supprimée avec succès!');
    }
}
