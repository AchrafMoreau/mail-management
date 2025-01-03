<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Courrire;
use Illuminate\Support\Facades\Storage;
use App\Models\Destination;
use App\Models\Ville;
use App\Models\Expediteur;
use App\Models\TempFile;
use Illuminate\Http\Request;

class CourrireController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $courrires = Courrire::orderBy('id', 'desc')->get();
        return view("courrire.index", ["courrire" => $courrires]);
    }

    public function sortantCourrire()
    {
        $courrires = Courrire::where("type", "SORTANT")->orderBy('id', 'desc')->get();
        return view("courrire.index", ["courrire" => $courrires]);
    }

    public function entantCourrire()
    {
        $courrires = Courrire::where("type", "ENTRANT")->orderBy('id', 'desc')->get();
        return view("courrire.index", ["courrire" => $courrires]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $des = Destination::all();
        $villes = Ville::all();
        $exp = Expediteur::all();
        return view("courrire.store", ["destination" => $des, "expediteur" => $exp, 'villes' => $villes]);
        // return view("courrire.store", ["emetteurs" => $emetteurs]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        //

        $rules = [
            "object" => "required",
            "type" => 'required',
            "reception_jour" => "required",
        ];

        $validation = Validator::make($req->all(), $rules);
        if($validation->fails()){
            
            $notification = array(
                'message' => __('translation.thosFieldRequired') . " :<br>
                    -   "  . __('translation.object') . "<br>
                    -   "  . __('translation.reception_jour') . "<br>
                    -   "  . __('translation.type'),
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }


        if($req->docs){
            $doc = TempFile::where("folder", $req->docs)->first();
            $sourcePath = storage_path('app/private/docs/temp/' . $doc->folder . '/' . $doc->filename);
            Storage::disk('public')->put($doc->filename, file_get_contents($sourcePath));

            // dd($doc->filename, $req->reception_time);
            Courrire::create([
                "object" => $req->object,
                "type" => $req->type,
                "destination_id" => $req->destination ?? null,
                "expediteur_id" => $req->expediteur ?? null,
                "observation" => $req->observation,
                "reception_jour" => $req->reception_jour,
                "reception_heure" => $req->reception_time,
                "document" => $doc->filename, 
            ]);


            $notification = array(
                'message' => 'Courrire Created successfully',
                'alert-type' => 'success',
            );
            // return redirect()->back()->with($notification);
            return redirect('/courrire')->with($notification);
        }

        $courrire = Courrire::create([
            "object" => $req->object,
            "type" => $req->type,
            "destination_id" => $req->destination ?? null,
            "expediteur_id" => $req->expediteur ?? null,
            "observation" => $req->observation,
            "reception_jour" => $req->reception_jour,
            "reception_heure" => $req->reception_time,
        ]);

        $notification = array(
            'message' => 'Courrire Created successfully',
            'alert-type' => 'success'
        );
        return redirect('/courrire')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Courrire $courrire)
    {
        //
        // $courrires = Courrire::with('emetteur')->where('id', $courrire->id)->get();
        $courrire->load('destination', 'expediteur');
        return view('courrire.show', ["courrire" => $courrire]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Courrire $courrire)
    {
        //
        $des = Destination::all();
        $villes = Ville::all();
        $exp = Expediteur::all();
        return view("courrire.edit", ["courrire" => $courrire->load('destination', 'expediteur'), "destination" => $des, "expediteur" => $exp, 'villes' => $villes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Courrire $courrire)
    {
        //
        $rules = [
            "object" => "required",
            "type" => 'required',
            "reception_jour" => "required",
        ];

        $validation = Validator::make($req->all(), $rules);
        if($validation->fails()){
            
            $notification = array(
                'message' => __('translation.thosFieldRequired') . " :<br>
                    -   "  . __('translation.object') . "<br>
                    -   "  . __('translation.reception_jour') . "<br>
                    -   "  . __('translation.type'),
                'alert-type' => 'error',
            );
            return redirect()->back()->with($notification);
        }

        $courrire->object = $req->object;
        $courrire->type = $req->type;
        $courrire->observation = $req->observation;
        $courrire->destination_id = $req->destination ?? null;
        $courrire->expediteur_id = $req->expediteur ?? null;
        $courrire->reception_jour = $req->reception_jour;
        $courrire->reception_heure = $req->reception_time;

        if($req->docs){
            $doc = TempFile::where("folder", $req->docs)->first();
            $sourcePath = storage_path('app/private/docs/temp/' . $doc->folder . '/' . $doc->filename);
            Storage::disk('public')->put($doc->filename, file_get_contents($sourcePath));
            $courrire->document = $doc->filename;
        }

        $courrire->save();

        $notification = array(
            'message' => 'Courrire Updated successfully',
            'alert-type' => 'success'
        );
        return redirect('/courrire')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Courrire $courrire)
    {
        //
        Courrire::where('id', $courrire->id)->delete();
        $notification = array(
            'message' => 'Courrire Deleted successfully',
            'alert-type' => 'success'
        );
        return response()->json($notification);

    }

    public function deleteMany(Request $req)
    {
        $req->validate([
            "ids" => "required|array",
        ]);

        Courrire::whereIn('id', $req->ids)->delete();

        $notification = array(
            'message' => 'Many Courrire Deleted Successfully',
            'alert-type' => 'success'
        );
        return response()->json($notification);
    }


    public function getSortantMailPersentage()
    {
        $currentMonths = Carbon::now()->month;
        $lastMonths = Carbon::now()->subMonth()->month;

        $mailSendCurrentMonths = Courrire::whereMonth("reception_jour", $currentMonths)->where("type", "SORTANT")->count();
        $mailSendLastMonths = Courrire::whereMonth("reception_jour", $lastMonths)->where("type", "SORTANT")->count();
        $sortnatMails = Courrire::where("type", "SORTANT")->count();

        $sortantPersentage = 0;
        if($mailSendLastMonths > 0){
            $sortantPersentage = (($mailSendCurrentMonths - $mailSendLastMonths) / $mailSendLastMonths ) * 100;
        }

        return response()->json(["totalPersentage" => number_format($sortantPersentage, 2), "total" => $sortnatMails]);
    }

    public function getEntrantMailPersentage()
    {
        $currentMonths = Carbon::now()->month;
        $lastMonths = Carbon::now()->subMonth()->month;

        $mailSendCurrentMonths = Courrire::whereMonth("reception_jour", $currentMonths)->where("type", "ENTRANT")->count();
        $mailSendLastMonths = Courrire::whereMonth("reception_jour", $lastMonths)->where("type", "ENTRANT")->count();
        $entrantMails = Courrire::where("type", "ENTRANT")->count();

        $entrantPersentage = 0;
        if($mailSendLastMonths > 0){
            $entrantPersentage = (($mailSendCurrentMonths - $mailSendLastMonths) / $mailSendLastMonths ) * 100;
        }

        return response()->json(["totalPersentage" => number_format($entrantPersentage, 2), "total" => $entrantMails]);
    }

    public function courrieFilter(Request $req)
    {
        if($req->type == "all" && $req->year == "all"){
            $courrires = Courrire::orderBy('id', "desc")->get();
            return view("courrire.index", ["courrire" => $courrires, "sType" => $req->type, "count" => $courrires->count(), "sYear" => $req->year ]);
        }
        if($req->type == "all" && $req->year != "all"){
            $courrires = Courrire::whereRaw("YEAR(reception_jour) = ?", [$req->year])->orderBy('id', "desc")->get();
            return view("courrire.index", ["courrire" => $courrires, "sType" => $req->type, "count" => $courrires->count(), "sYear" => $req->year ]);
        }
        if($req->type != "all" && $req->year == "all"){
            $courrires = Courrire::where('type', $req->type)->orderBy('id', "desc")->get();
            return view("courrire.index", ["courrire" => $courrires ,"sType" => $req->type, "count" => $courrires->count(), "sYear" => $req->year ]);
        }

        $courrires = Courrire::where('type', $req->type)->whereRaw("YEAR(reception_jour) = ?" , [$req->year])->orderBy('id', "desc")->get();
        return view("courrire.index", ["courrire" => $courrires, "sType" => $req->type, "count" => $courrires->count(), "sYear" => $req->year ]);
    }
}
