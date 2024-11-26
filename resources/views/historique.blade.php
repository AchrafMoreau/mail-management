<!DOCTYPE html>
<html>
<head>
    <title>Historique</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background: linear-gradient(to bottom, #e0f2f1, #ffffff, #b0b0b0); /* Dégradé du vert très clair au blanc, puis au gris */
            background-size: cover; /* Assure que l'arrière-plan couvre toute la zone */
            background-position: center; /* Centre l'arrière-plan */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh; /* Utilise toute la hauteur de la vue */
        }
        .container {
            display: flex; /* Affiche les cartes en ligne */
            justify-content: center;
            align-items: center;
            gap: 20px; /* Espace entre les cartes */
        }
        .card {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            background-color: #ffffff; /* Fond blanc pour les cartes */
            color: #00796b; /* Couleur du texte vert */
            border: 2px solid #00796b; /* Bordure verte pour les cartes */
            border-radius: 10px;
            padding: 20px;
            width: 250px;
            text-align: center;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
            transition: transform 0.3s, box-shadow 0.3s, background-color 0.3s, color 0.3s; /* Transition pour effet d'agrandissement, ombre, couleur du fond, et couleur du texte */
            margin: 10px; /* Ajoute un espace autour des cartes */
            text-decoration: none; /* Retire le soulignement du lien */
        }
        .card:hover {
            transform: scale(1.05); /* Effet d'agrandissement au survol */
            box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
            background-color: #00796b; /* Fond vert au survol */
            color: #ffffff; /* Texte blanc au survol */
        }
        .card h2 {
            margin: 0;
            font-size: 2em; /* Réduit la taille de la police du titre */
        }
        .card p {
            margin: 10px 0;
            font-size: 1em; /* Réduit la taille de la police du texte */
        }
        .card a {
            color: inherit; /* Hérite de la couleur du texte de la carte */
            text-decoration: none; /* Retire le soulignement des liens */
        }
    </style>
</head>
<body>

    <div class="container">
        <a href="{{ route('historique_courriers') }}" class="card">
            <h2>Historique des Courriers</h2>
           
        </a>
        <a href="{{ route('historique_decharges') }}" class="card">
            <h2>Historique des Décharges</h2>
            
        </a>
    </div>
</body>
</html>
