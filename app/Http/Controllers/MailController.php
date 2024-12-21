<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use App\Models\Mail;
use Illuminate\Http\Request;
use App\Models\Destination;
use App\Models\Ville;
use App\Models\Expediteur;
use App\Models\TempFile;

class MailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $mails = Mail::orderBy('id', 'desc')->get();
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
        $villes = Ville::all();
        $exp = Expediteur::all();
        return view("mails.store", ["destination" => $des, "expediteur" => $exp, 'villes' => $villes]);
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

            Mail::create([
                "object" => $req->object,
                "destination_id" => $req->destination ?? null,
                "expediteur_id" => $req->expediteur ?? null,
                "observation" => $req->observation,
                "reception_jour" => $req->reception_jour,
                "reception_heure" => $req->reception_time,
                "document" => $doc->filename, 
            ]);


            $notification = array(
                'message' => 'Mail Created successfully',
                'alert-type' => 'success',
            );
            return redirect('/mail')->with($notification);
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
        return redirect('/mail')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(Mail $mail)
    {
        //
        $mail->load('destination', 'expediteur');
        return view('mails.show', ["mail" => $mail]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Mail $mail)
    {
        //
        $des = Destination::all();
        $villes = Ville::all();
        $exp = Expediteur::all();
        return view("mails.edit", ["mail" => $mail->load('destination', 'expediteur'), "destination" => $des, "expediteur" => $exp, 'villes' => $villes]);
        // $emetteurs = Emetteur::all();
        // return view("courrire.edit", ["courrire" => $courrire, "emetteurs" => $emetteurs]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $req, Mail $mail)
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


        $mail->object = $req->object;
        $mail->type = $req->type;
        $mail->destination_id = $req->destination ?? null;
        $mail->expediteur_id = $req->expediteur ?? null;
        $mail->observation = $req->observation;
        $mail->reception_jour = $req->reception_jour;
        $mail->reception_heure = $req->reception_time;

        if($req->docs){
            $doc = TempFile::where("folder", $req->docs)->first();
            $sourcePath = storage_path('app/private/docs/temp/' . $doc->folder . '/' . $doc->filename);
            Storage::disk('public')->put($doc->filename, file_get_contents($sourcePath));
            $mail->document = $doc->filename;
        }

        $mail->save();

        $notification = array(
            'message' => 'Mail Updated successfully',
            'alert-type' => 'success'
        );
        return redirect('/mail')->with($notification);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Mail $mail)
    {
        //
        Mail::where('id', $mail->id)->delete();
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

    public function courrieFilter(Request $req)
    {
        if($req->type == "all" && $req->year == "all"){
            $mails = Mail::orderBy('id', "desc")->get();
            return view("mails.index", ["mails" => $mails, "sType" => $req->type, "count" => $mails->count(), "sYear" => $req->year ]);
        }
        if($req->type == "all" && $req->year != "all"){
            $mails = Mail::whereRaw("YEAR(reception_jour) = ?", [$req->year])->orderBy('id', "desc")->get();
            return view("mails.index", ["mails" => $mails, "sType" => $req->type, "count" => $mails->count(), "sYear" => $req->year ]);
        }
        if($req->type != "all" && $req->year == "all"){
            $mails = Mail::where('type', $req->type)->orderBy('id', "desc")->get();
            return view("mails.index", ["mails" => $mails ,"sType" => $req->type, "count" => $mails->count(), "sYear" => $req->year ]);
        }

        $mails = Mail::where('type', $req->type)->whereRaw("YEAR(reception_jour) = ?" , [$req->year])->orderBy('id', "desc")->get();
        return view("mails.index", ["mails" => $mails, "sType" => $req->type, "count" => $mails->count(), "sYear" => $req->year ]);
    }

}
