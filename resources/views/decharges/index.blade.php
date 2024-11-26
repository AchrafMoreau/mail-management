<!doctype html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des Décharges</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background-image: url('{{ asset('images/background.jpg') }}');
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            background-color: #f8f9fa; /* Fallback color */
        }
        table {
            border-collapse: collapse;
            width: 100%;
            border: 2px solid #ccc;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
        th.custom-header {
            background-color: darkgray;
        }
        .custom-card {
            width: 100%; /* Adjusted width to take up more space */
            /* max-width: 1200px; Optional: Increase max-width */
            margin: 0 auto;
        }
        .table th:nth-child(5) {
            width: 150px; /* Width for image column */
        }
        .card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .search-form {
            display: flex;
            align-items: center;
            margin-bottom: 0;
        }
        .search-input {
            width: 200px;
            margin-left: 10px;
        }
        .month-select {
            margin-left: 10px;
        }
        .btn-group {
            display: flex;
            justify-content: center;
        }
        .btn-group .btn {
            margin-right: 5px;
        }
        .btn-group .btn:last-child {
            margin-right: 0;
        }
    </style>
</head>
<body>
    <div class="bg-success py-3">
        <h3 class="text-white text-center">Liste des Décharges</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg my-4 custom-card">
                    <div class="card-header">
                        <h3>Décharges</h3>
                        <form action="{{ route('decharges.search') }}" method="POST" class="search-form">
                            @csrf
                            <input type="text" name="query" placeholder="Rechercher par Nom Complet, Ville, ou État..." class="search-input" value="{{ request('query') }}">
                            <select name="month" class="form-select month-select" aria-label="Sélectionner le mois">
                                <option value="">Sélectionner le mois</option>
                                @php
                                    $mois = [
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
                                @foreach ($mois as $numero => $nom)
                                    <option value="{{ $numero }}" {{ request('month') == $numero ? 'selected' : '' }}>
                                        {{ $nom }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-primary">Rechercher</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('decharges.create') }}" class="btn btn-success">Créer une Décharge</a>
                        </div>

                        <!-- Décharges Table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="custom-header">Nom Complet</th>
                                    <th class="custom-header">Date</th>
                                    <th class="custom-header">État</th>
                                    <th class="custom-header">Ville</th>
                                    <th class="custom-header">Image</th>
                                    <th class="custom-header">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($decharges->isEmpty())
                                    <tr>
                                        <td colspan="6" class="text-center">Aucune décharge trouvée</td>
                                    </tr>
                                @else
                                    @foreach($decharges as $decharge)
                                        <tr>
                                            <td>{{ $decharge->nom_complet }}</td>
                                            <td>{{ $decharge->date }}</td>
                                            <td>{{ $decharge->etat }}</td>
                                            <td>{{ $decharge->ville }}</td>
                                            <td>
                                                @if ($decharge->image_scan)
                                                    <a href="#" onclick="showImage('{{ asset('storage/uploads/decharges/' . $decharge->image_scan) }}')" class="btn btn-outline-secondary" title="Voir l'image">
                                                        <i class="bi bi-eye"></i>
                                                    </a>
                                                @else
                                                    Pas d'image
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('decharges.show', $decharge->id) }}" class="btn btn-info" title="Voir les détails"><i class="bi bi-eye"></i></a>
                                                    <a href="{{ route('decharges.edit', $decharge->id) }}" class="btn btn-dark" title="Éditer la décharge"><i class="bi bi-pencil"></i></a>
                                                    <form action="{{ route('decharges.destroy', $decharge->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette décharge ?')" title="Supprimer la décharge"><i class="bi bi-trash"></i></button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        <!-- Pagination Links -->
                        <div class="d-flex justify-content-center mt-3">
                            {{ $decharges->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Modal for Image Preview -->
    <div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="imageModalLabel">Aperçu de l'image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <img id="modalImage" src="" alt="Image" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function showImage(src) {
            const modalImage = document.getElementById('modalImage');
            modalImage.src = src;
            const imageModal = new bootstrap.Modal(document.getElementById('imageModal'));
            imageModal.show();
        }
    </script>
</body>
</html>
