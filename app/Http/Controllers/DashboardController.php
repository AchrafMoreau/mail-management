<?php
namespace App\Http\Controllers;

use App\Models\Courrier;
use App\Models\Decharge;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = $this->getStats();
        return view('dashboard', [
            'courriersCount' => $stats['courrierCount'],
            'dechargesCount' => $stats['dechargeCount'],
            'courrierEntrantCount' => $stats['courrierEntrantCount'],
            'courrierSortantCount' => $stats['courrierSortantCount'],
        ]);
    }

    private function getStats()
    {
        $courriersCount = Courrier::count();
        $dechargesCount = Decharge::count();
        $courrierEntrantCount = Courrier::where('type', 'entrant')->count();
        $courrierSortantCount = Courrier::where('type', 'sortant')->count();

        return [
            'courrierCount' => $courriersCount,
            'dechargeCount' => $dechargesCount,
            'courrierEntrantCount' => $courrierEntrantCount,
            'courrierSortantCount' => $courrierSortantCount,
        ];
    }
}
