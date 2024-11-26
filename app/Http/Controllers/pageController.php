<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Courrier;
use App\Models\Decharge;
class PageController extends Controller
{
    public function gestionCourriers(Request $request)
    {
        $courriers = Courrier::paginate(10);
        return view('gestion_courrier', compact('courriers'));
    }
    

    public function gestionDecharges()
{
    $decharges = Decharge::paginate(10); // Assurez-vous que Decharge est le nom du modèle approprié
    return view('gestion_decharges', compact('decharges'));
}


    public function historique()
    {
        return view('historique');
    }

    
}
