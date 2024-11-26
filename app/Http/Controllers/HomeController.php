<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function getStats()
    {
        // Exemple de récupération de statistiques
        $courriersCount = DB::table('courriers')->whereYear('date', now()->year)->count();
        $dechargesCount = DB::table('decharges')->whereYear('date', now()->year)->count();
        $courrierEntrantCount = DB::table('courriers')->whereYear('date', now()->year)->where('type', 'entrant')->count();
        $courrierSortantCount = DB::table('courriers')->whereYear('date', now()->year)->where('type', 'sortant')->count();

        return view('home', [
            'courriersCount' => $courriersCount,
            'dechargesCount' => $dechargesCount,
            'courrierEntrantCount' => $courrierEntrantCount,
            'courrierSortantCount' => $courrierSortantCount,
        ]);
    }
}
