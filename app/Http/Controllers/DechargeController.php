<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use App\Models\TempFile;
use Carbon\Carbon;

use App\Models\Decharge;
use App\Models\Ville;
use App\Models\Region;
use Illuminate\Http\Request;

class DechargeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $regoins = Region::all();
        $villes = Ville::all();
        return view('decharge.index', ['regions' => $regoins, 'villes' => $villes]);
    }

    public function json()
    {

        $dech = Decharge::with('ville', 'etat')->get();
        return response()->json($dech);
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
            "reception_jour" => "required",
            "ville_id" => "required",
        ]);

        if($req->docs){
            $doc = TempFile::where("folder", $req->docs)->first();
            $sourcePath = storage_path('app/private/docs/temp/' . $doc->folder . '/' . $doc->filename);
            Storage::disk('public')->put($doc->filename, file_get_contents($sourcePath));

            $decharge = Decharge::create([
                "nom" => $req->nom,
                "reception_jour" => $req->reception_jour,
                "ville_id" => $req->ville_id,
                "etat_id" => $req->etat_id,
                "region_id" => $req->region_id,
                "document" => $doc->filename
            ]);

            $notification = array(
                'message' => 'Decharge Created successfully',
                'alert-type' => 'success',
                "data" => $decharge->load('etat', 'ville')
            );
            return response()->json($notification);
        }

        $decharge = Decharge::create([
            "nom" => $req->nom,
            "reception_jour" => $req->reception_jour,
            "ville_id" => $req->ville_id,
            "etat_id" => $req->etat_id,
            "region_id" => $req->region_id,
        ]);

        $notification = array(
            'message' => 'Decharge Created successfully',
            'alert-type' => 'success',
            "data" => $decharge->load('etat', 'ville')
        );
        return response()->json($notification);
        

    }

    /**
     * Display the specified resource.
     */
    public function show(Decharge $decharge)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Decharge $decharge)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Decharge $decharge)
    {
        //

        $req->validate([
            "nom" => "required",
            "reception_jour" => "required",
            "ville_id" => "required",
        ]);


        if($req->docs){
            $doc = TempFile::where("folder", $req->docs)->first();
            $sourcePath = storage_path('app/private/docs/temp/' . $doc->folder . '/' . $doc->filename);
            Storage::disk('public')->put($doc->filename, file_get_contents($sourcePath));

            $decharge->nom = $req->nom;
            $decharge->reception_jour = $req->reception_jour;
            $decharge->ville_id = $req->ville_id;
            $decharge->etat_id = $req->etat_id;
            $decharge->document = $doc->filename;
            $decharge->save();

            $notification = array(
                'message' => 'Decharge Updated successfully',
                'alert-type' => 'success',
                "data" => $decharge->load('etat', 'ville')
            );
            return response()->json($notification);
        }

        $decharge->nom = $req->nom;
        $decharge->reception_jour = $req->reception_jour;
        $decharge->ville_id = $req->ville_id;
        $decharge->etat_id = $req->etat_id;
        $decharge->save();

        $notification = array(
            'message' => 'Decharge Updated successfully',
            'alert-type' => 'success',
            "data" => $decharge->load('etat', 'ville')
        );
        return response()->json($notification);
        
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Decharge $decharge)
    {
        //
        Decharge::where('id', $decharge->id)->delete();
        $notification = array(
            'message' => 'Decharge Deleted successfully',
            'alert-type' => 'success'
        );
        return response()->json($notification);
    }

    public function deleteMany(Request $req)
    {
        $req->validate([
            "ids" => "required|array",
        ]);


        Decharge::whereIn('id', $req->ids)->delete();

        $notification = array(
            'message' => 'Many Decharge Deleted Successfully',
            'alert-type' => 'success'
        );
        return response()->json($notification);
    }

    public function getTotalDechargePersentage()
    {
        $currentMonths = Carbon::now()->month;
        $lastMonths = Carbon::now()->subMonth()->month;

        $dechargeCurrentMonths = Decharge::whereMonth("reception_jour", $currentMonths)->count();
        $dechargeLastMonths = Decharge::whereMonth("reception_jour", $lastMonths)->count();
        $totalDecharge = Decharge::all()->count();

        $dechargePersentage = 0;
        if($dechargeLastMonths > 0){
            $dechargePersentage = (($dechargeCurrentMonths - $dechargeLastMonths) / $dechargeLastMonths ) * 100;
        }

        return response()->json(["totalPersentage" => number_format($dechargePersentage, 2), "total" => $totalDecharge]);
    }
}
