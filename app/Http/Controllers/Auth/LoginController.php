<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('dashboard'); // Assurez-vous que votre vue est correctement nommée
    }

    public function authenticate(Request $request)
    {
        // Valider les champs email et password
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Définir les identifiants admin
        $adminEmail = 'admin@admin.ma';
        $adminPassword = 'Admin';


        // Vérifier si les identifiants correspondent à admin@admin.ma et Admin
        if ($credentials['email'] == $adminEmail && $credentials['password'] == $adminPassword) {
            // Authentification réussie
            return redirect()->route('pagepremier.post'); // Redirection vers la page 'pagepremier'
        }

        // Authentification échouée
        return redirect()->back()->withErrors([
            'email' => 'Les informations d\'identification incorrecte',
        ])->withInput([
            'email' => $request->email,
        ]);
    }
    public function logout(Request $request)
{
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect('/');
}


    // Autres méthodes de gestion de la connexion, comme la déconnexion
}
