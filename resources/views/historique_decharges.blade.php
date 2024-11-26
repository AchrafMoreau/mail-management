@extends('layouts.no-links')

@section('content')
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f4f8;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .page-title {
            font-size: 2em;
            margin-bottom: 20px;
            color: #00796b;
        }

        .search-form {
            margin-bottom: 20px;
            display: flex;
            justify-content: flex-end;
            align-items: center;
        }

        .search-form .form-group {
            margin-left: 10px;
            display: flex;
            flex-direction: column;
        }

        .search-form label {
            font-weight: bold;
            margin-bottom: 2px; /* Réduisez la marge inférieure */
            display: block;
        }

        .search-form select {
            padding: 10px;
            border-radius: 5px;
            border: 1px solid #ddd;
            width: 100%;
            margin-top: 2px; /* Réduisez la marge supérieure */
            max-width: 600px; /* Augmentez la largeur maximale si nécessaire */
        }

        .search-form .search-icon {
            background-color: #00796b;
            border: none;
            border-radius: 5px;
            color: white;
            cursor: pointer;
            padding: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background-image: url('{{ asset('images/icone_recherch.webp') }}');
            background-size: cover;
            background-position: center;
            margin-left: 10px;
            margin-top: 30px;
        }

        .search-form .search-icon:hover {
            background-color: #004d40;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #00796b;
            color: #ffffff;
        }

        tr:hover {
            background-color: #f1f1f1;
        }

        .date {
            font-style: italic;
        }

        /* Style pour la modal d'image */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0,0,0,0.8);
        }

        .modal-content {
            margin: 15% auto;
            display: block;
            width: 80%;
            max-width: 700px;
        }

        .close {
            position: absolute;
            top: 10px;
            right: 25px;
            color: #fff;
            font-size: 35px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #bbb;
            text-decoration: none;
            cursor: pointer;
        }

        .icon {
            cursor: pointer;
        }

        .no-results {
            text-align: center;
            font-size: 1.2em;
            color: #ff5722;
        }

        .pagination {
            margin-top: 20px;
            text-align: center;
        }
    </style>

    <div class="container">
        <h1 class="page-title">Historique des Décharges</h1>
        <form class="search-form" action="{{ route('historique_decharges') }}" method="GET">
            <div class="form-group">
                <label for="year">Année:</label>
                <select id="year" name="year" style="width: 140px;">
                    @for ($i = date('Y'); $i >= 2000; $i--)
                        <option value="{{ $i }}" {{ request('year') == $i ? 'selected' : '' }}>{{ $i }}</option>
                    @endfor
                </select>
            </div>
            <div class="form-group">
                <label for="month">Mois:</label>
                @php
                    $months = [
                        1 => 'Janvier',
                        2 => 'Février',
                        3 => 'Mars',
                        4 => 'Avril',
                        5 => 'Mai',
                        6 => 'Juin',
                        7 => 'Juillet',
                        8 => 'Août',
                        9 => 'Septembre',
                        10 => 'Octobre',
                        11 => 'Novembre',
                        12 => 'Décembre',
                    ];
                @endphp
                <select id="month" name="month">
                    @foreach ($months as $number => $name)
                        <option value="{{ $number }}" {{ request('month') == $number ? 'selected' : '' }}>
                            {{ $name }}
                        </option>
                    @endforeach
                </select>
            </div>
            <button type="submit" class="search-icon" aria-label="Rechercher"></button>
        </form>

        @if ($decharges->isEmpty())
            <p class="no-results">Aucune décharge trouvée pour les critères sélectionnés.</p>
        @else
            <table>
                <thead>
                    <tr>
                        <th>Nom Complet</th>
                        <th>Date</th>
                        <th>État</th>
                        <th>Ville</th>
                        <th>Image</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($decharges as $decharge)
                        <tr>
                            <td>{{ $decharge->nom_complet }}</td>
                            <td class="date">{{ $decharge->date }}</td>
                            <td>{{ $decharge->etat }}</td>
                            <td>{{ $decharge->ville }}</td>
                            <td>
                                @if ($decharge->image_scan)
                                    <span class="icon" onclick="openModal('{{ asset('storage/uploads/decharges/' . $decharge->image_scan) }}')">
                                        <img src="{{ asset('images/oeil.png') }}" alt="Voir Image" width="30">
                                    </span>
                                @else
                                    Aucun
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Liens de pagination -->
            <div class="pagination">
                {{ $decharges->links() }}
            </div>
        @endif
    </div>

    <!-- Modal pour l'image -->
    <div id="myModal" class="modal">
        <span class="close" onclick="closeModal()">&times;</span>
        <img class="modal-content" id="img01">
    </div>

    <script>
        function openModal(imgSrc) {
            var modal = document.getElementById("myModal");
            var modalImg = document.getElementById("img01");
            modal.style.display = "block";
            modalImg.src = imgSrc;
        }

        function closeModal() {
            var modal = document.getElementById("myModal");
            modal.style.display = "none";
        }
    </script>
@endsection
