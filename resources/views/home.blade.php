<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <style>
       body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    margin: 0;
    padding: 0;
    background: linear-gradient(to bottom, #e0f2f1, #ffffff, #b0b0b0);
    background-size: cover;
    background-position: center;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    height: 100vh;
    box-sizing: border-box;
}

h1 {
    text-align: center;
    color: #00796b;
    margin-top: 0;
    margin-bottom: 30px;
    font-size: 2.5em;
}

.container {
    display: grid;
    grid-template-columns: repeat(2, 1fr); /* Deux colonnes de largeur égale */
    grid-template-rows: repeat(2, auto); /* Deux lignes pour les cartes */
    gap: 20px; /* Espacement entre les cartes */
    max-width: 600px; /* Largeur maximale de la grille */
    width: 100%; /* Largeur à 100% pour s'adapter à l'espace disponible */
}

.card {
    background-color: #ffffff;
    border: 2px solid #00796b;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
    padding: 20px;
    text-align: center;
    transition: transform 0.3s, box-shadow 0.3s, color 0.3s, background-color 0.3s;
}

.card:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
    background-color: #00796b;
    color: #ffffff;
}

.card h2 {
    margin: 0;
    font-size: 2.5em;
    color: #00796b;
}

.card p {
    margin: 10px 0;
    font-size: 1.2em;
    color: #333333;
}

.card:hover h2,
.card:hover p {
    color: #ffffff;
}
</style>
</head>
<body>
    <div class="content">
        <h1>Statistiques de l'année {{ date('Y') }}</h1>
        <div class="container">
            <div class="card">
                <h2>{{ $courriersCount }}</h2>
                <p>Totale Courriers</p>
            </div>
            <div class="card">
                <h2>{{ $dechargesCount }}</h2>
                <p>Décharges</p>
            </div>
            <div class="card">
                <h2>{{ $courrierEntrantCount }}</h2>
                <p>Courriers Entrants</p>
            </div>
            <div class="card">
                <h2>{{ $courrierSortantCount }}</h2>
                <p>Courriers Sortants</p>
            </div>
        </div>
    </div>
</body>
</html>
