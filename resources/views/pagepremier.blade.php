<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Pages</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    display: flex;
}

.menu {
    width: 16rem;
    background-color: #ffffff;
    border-right: 1px solid #ddd;
    padding: 1rem;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    height: 100vh;
    position: fixed;
    display: flex;
    flex-direction: column;
}

.logo {
    text-align: center;
    margin-bottom: 2rem;
}

.logo img {
    width: 100%;
    max-width: 230px; /* Ajustez la largeur maximale du logo si nécessaire */
    height: auto;
}

.menu ul {
    list-style: none; /* Supprimer les points des éléments de liste */
    padding: 0; /* Enlever le padding par défaut */
    margin: 0; /* Enlever la marge par défaut */
}

.menu a {
    display: flex;
    align-items: center;
    padding: 0.75rem 1.25rem; /* Ajuster le padding pour une meilleure apparence */
    text-decoration: none;
    color: #333;
    border-radius: 0.5rem; /* Coins arrondis plus prononcés */
    margin-bottom: 0.5rem;
    transition: background-color 0.3s, color 0.3s; /* Transition douce pour l'effet de survol */
    font-weight: 500; /* Texte en gras */
}

.menu a:hover {
    background-color: #f5f5f5; /* Couleur de survol douce */
    color: #00796b; /* Couleur du texte au survol */
}

.menu svg {
    width: 1.75rem; /* Augmenter légèrement la taille des icônes */
    height: 1.75rem;
    margin-right: 1rem; /* Espace plus large entre l'icône et le texte */
    color: #00796b; /* Couleur des icônes */
}

.menu button {
    border: none; /* Supprimer la bordure */
    outline: none; /* Supprimer le contour */
    background: none; /* Supprimer le fond */
    padding: 0.75rem 1.25rem; /* Ajuster le padding pour une meilleure apparence */
    text-align: left; /* Aligner le texte à gauche */
    display: flex;
    align-items: center;
    width: 100%;
    cursor: pointer; /* Changer le curseur pour indiquer que c'est cliquable */
    border-radius: 0.5rem; /* Coins arrondis plus prononcés */
    transition: background-color 0.3s, color 0.3s; /* Transition douce pour l'effet de survol */
    font-weight: 500; /* Texte en gras */
}

.menu button:hover {
    background-color: #f5f5f5; /* Couleur de survol douce */
    color: #00796b; /* Couleur du texte au survol */
}

.content-container {
    margin-left: 16rem;
    padding: 1rem;
    width: calc(100% - 16rem); /* Ajuste la largeur en fonction de la sidebar */
}

iframe {
    width: 100%;
    height: 100vh;
    border: none;
}

    </style>
</head>
<body onload="setDefaultPage()">
    <aside class="menu">
        <!-- Logo -->
        <div class="logo">
            <img src="{{ asset('images/logo.png') }}" alt="Logo">
        </div>
        
        <div class="p-4">
            <ul class="space-y-2 font-medium">
                <!-- Accueil -->
                <li>
                    <a href="#" onclick="loadContent('{{ route('home') }}'); return false;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75V19.5a.75.75 0 0 0 .75.75h6.75v-5.25a.75.75 0 0 1 .75-.75h2.25a.75.75 0 0 1 .75.75v5.25H20.25a.75.75 0 0 0 .75-.75V9.75a.75.75 0 0 0-.348-.624l-8.25-5.25a.75.75 0 0 0-.804 0l-8.25 5.25A.75.75 0 0 0 3 9.75Z" />
                        </svg>
                        <span>Accueil</span>
                    </a>
                </li>
                <!-- Gestion des courriers -->
                <li>
                    <a href="#" onclick="loadContent('{{ route('gestion_courrier') }}'); return false;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M21.75 9v.906a2.25 2.25 0 0 1-1.183 1.981l-6.478 3.488M2.25 9v.906a2.25 2.25 0 0 0 1.183 1.981l6.478 3.488m8.839 2.51-4.66-2.51m0 0-1.023-.55a2.25 2.25 0 0 0-2.134 0l-1.022.55m0 0-4.661 2.51m16.5 1.615a2.25 2.25 0 0 1-2.25 2.25h-15a2.25 2.25 0 0 1-2.25-2.25V8.844a2.25 2.25 0 0 1 1.183-1.981l7.5-4.039a2.25 2.25 0 0 1 2.134 0l7.5 4.039a2.25 2.25 0 0 1 1.183 1.98V19.5Z" />
                        </svg>
                        <span>Gestion des courriers</span>
                    </a>
                </li>
                <!-- Gestion des décharges -->
                <li>
                    <a href="#" onclick="loadContent('{{ route('gestion_decharges') }}'); return false;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11.35 3.836c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m8.9-4.414c.376.023.75.05 1.124.08 1.131.094 1.976 1.057 1.976 2.192V16.5A2.25 2.25 0 0 1 18 18.75h-2.25m-7.5-10.5H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V18.75m-7.5-10.5h6.375c.621 0 1.125.504 1.125 1.125v9.375m-8.25-3 1.5 1.5 3-3.75" />
                        </svg>
                        <span>Gestion des décharges</span>
                    </a>
                </li>
                <!-- Historique -->
                <li>
                    <a href="#" onclick="loadContent('{{ route('historique') }}'); return false;">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                        <span>Historique</span>
                    </a>
                </li>
                <!-- Logout -->
                <li>
                    <form action="{{ url('/logout') }}" method="POST">
                        @csrf
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M8.25 9V5.25A2.25 2.25 0 0 1 10.5 3h6a2.25 2.25 0 0 1 2.25 2.25v13.5A2.25 2.25 0 0 1 16.5 21h-6a2.25 2.25 0 0 1-2.25-2.25V15m-3 0-3-3m0 0 3-3m-3 3H15" />
                            </svg>
                            <span class="w-full flex justify-start ml-3 whitespace-nowrap">Déconnexion</span>
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </aside>

    <!-- Content -->
    <div class="content-container">
        <iframe id="page2" src="{{ route('home') }}"></iframe>
    </div>
    
    <script>
        function loadContent(url) {
            console.log("Loading URL: " + url); // Vérifiez l'URL dans la console
            var iframe = document.getElementById('page2');
            if (iframe) {
                iframe.src = url;
            } else {
                console.error("L'iframe avec l'ID 'page2' est introuvable.");
            }
        }

        function setDefaultPage() {
            // Charger la page d'accueil par défaut dans l'iframe
            loadContent('{{ route('home') }}');
        }
    </script>
</body>
</html>