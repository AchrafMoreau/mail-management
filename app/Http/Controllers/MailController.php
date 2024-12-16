<?php

namespace App\Http\Controllers;

use App\Models\Mail;
use Illuminate\Http\Request;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mails = Mail::orderBy('created_at', 'desc')->get();
        return view("mails.index", ["mails" => $mails]);
    }

    public function sortantMail()
    {
        $mails = Mail::where("type", "SORTANT")->with('emetteur')->orderBy('created_at', 'desc')->get();
        return view("mails.index", ["mails" => $mails]);
    }

    public function entantMail()
    {
        $mails = Mail::where("type", "ENTRANT")->with('emetteur')->orderBy('created_at', 'desc')->get();
        return view("mails.index", ["mails" => $mails]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $des = Destination::all();
        $exp = Expediteur::all();
        return view("mails.store", ["destination" => $des, "expediteur" => $exp]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $req)
    {
        //
        $req->validate([
            "object" => "required",
            "type" => 'required',
            "division" => "required",
            "reception_jour" => "required",
        ]);

        if($req->docs){
            $doc = TempFile::where("folder", $req->docs)->first();
            $sourcePath = storage_path('app/private/docs/temp/' . $doc->folder . '/' . $doc->filename);
            Storage::disk('public')->put($doc->filename, file_get_contents($sourcePath));

            // dd($doc->filename, $req->reception_time);
            Mail::create([
                "object" => $req->object,
                "emetteur_id" => $req->emetteur,
                "division" => $req->division,
                "observation" => $req->observation,
                "reception_jour" => $req->reception_jour,
                "reception_heure" => $req->reception_time,
                "document" => $doc->filename, 
            ]);


            $notification = array(
                'message' => 'Mail Created successfully',
                'alert-type' => 'success',
            );
            // return redirect()->back()->with($notification);
            return redirect('/courrire')->with($notification);
        }

        $courrire = Mail::create([
            "object" => $req->object,
            "emetteur_id" => $req->emetteur,
            "division" => $req->division,
            "observation" => $req->observation,
            "reception_jour" => $req->reception_jour,
            "reception_heure" => $req->reception_time,
        ]);

        $notification = array(
            'message' => 'Mail Created successfully',
            'alert-type' => 'success'
        );
        return redirect('/courrire')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mail $courrire)
    {
        //
        // $courrires = Mail::with('emetteur')->where('id', $courrire->id)->get();
        $courrire->load('emetteur');
        return view('courrire.show', ["courrire" => $courrire]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mail $courrire)
    {
        //
        $emetteurs = Emetteur::all();
        return view("courrire.edit", ["courrire" => $courrire, "emetteurs" => $emetteurs]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Mail $courrire)
    {
        //
        $req->validate([
            "object" => "required",
            "type" => 'required',
            "emetteur" => "required",
            "division" => "required",
            "reception_jour" => "required",
        ]);

        $courrire->object = $req->object;
        $courrire->type = $req->type;
        $courrire->emetteur_id = $req->emetteur;
        $courrire->division = $req->division;
        $courrire->observation = $req->observation;
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
            'message' => 'Mail Updated successfully',
            'alert-type' => 'success'
        );
        return redirect('/courrire')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mail $courrire)
    {
        //
        Mail::where('id', $courrire->id)->delete();
        $notification = array(
            'message' => 'Mail Deleted successfully',
            'alert-type' => 'success'
        );
        return response()->json($notification);

    }

    public function deleteMany(Request $req)
    {
        $req->validate([
            "ids" => "required|array",
        ]);

        Mail::whereIn('id', $req->ids)->delete();

        $notification = array(
            'message' => 'Many Mail Deleted Successfully',
            'alert-type' => 'success'
        );
        return response()->json($notification);
    }

    public function getTotalMailPersentage()
    {
        $currentMonths = Carbon::now()->month;
        $lastMonths = Carbon::now()->subMonth()->month;

        $mailSendCurrentMonths = Mail::whereMonth("reception_jour", $currentMonths)->count();
        $mailSendLastMonths = Mail::whereMonth("reception_jour", $lastMonths)->count();
        $allMails = Mail::all()->count();

        $totalPersentage = 0;
        if($mailSendLastMonths > 0){
            $totalPersentage = (($mailSendCurrentMonths - $mailSendLastMonths) / $mailSendLastMonths ) * 100;
        }

        return response()->json(["totalPersentage" => number_format($totalPersentage, 2), "total" => $allMails]);
    }

    public function getSortantMailPersentage()
    {
        $currentMonths = Carbon::now()->month;
        $lastMonths = Carbon::now()->subMonth()->month;

        $mailSendCurrentMonths = Mail::whereMonth("reception_jour", $currentMonths)->where("type", "SORTANT")->count();
        $mailSendLastMonths = Mail::whereMonth("reception_jour", $lastMonths)->where("type", "SORTANT")->count();
        $sortnatMails = Mail::where("type", "SORTANT")->count();

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

        $mailSendCurrentMonths = Mail::whereMonth("reception_jour", $currentMonths)->where("type", "ENTRANT")->count();
        $mailSendLastMonths = Mail::whereMonth("reception_jour", $lastMonths)->where("type", "ENTRANT")->count();
        $entrantMails = Mail::where("type", "ENTRANT")->count();

        $entrantPersentage = 0;
        if($mailSendLastMonths > 0){
            $entrantPersentage = (($mailSendCurrentMonths - $mailSendLastMonths) / $mailSendLastMonths ) * 100;
        }

        return response()->json(["totalPersentage" => number_format($entrantPersentage, 2), "total" => $entrantMails]);
    }

}
