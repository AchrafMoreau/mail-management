<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Liste des Courriers</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
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
        .table th:nth-child(9) {
            width: 150px;
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
        .image-display {
            text-align: center;
            margin-top: 20px;
        }
        .image-display img {
            max-width: 500px; /* Adjust the max-width as needed */
            height: auto;
            border: 1px solid #ccc;
            padding: 10px;
            background-color: #fff;
        }
    </style>
</head>
<body>
    <div class="bg-success py-3">
        <h3 class="text-white text-center">Liste des Courriers</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-12">
                <div class="card border-0 shadow-lg my-4 custom-card">
                    <div class="card-header">
                        <h3>Courriers</h3>
                        <form action="{{ route('courriers.search') }}" method="GET" class="search-form">
                            <input type="text" name="query" class="form-control search-input" placeholder="Rechercher des courriers..." value="{{ request('query') }}">
                            <select name="month" class="form-select month-select">
                                <option value="">Sélectionner le mois</option>
                                @php
                                    // Array of French month names
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
                                        12 => 'Décembre'
                                    ];
                                @endphp
                                @foreach($months as $monthNumber => $monthName)
                                    <option value="{{ $monthNumber }}" {{ request('month') == $monthNumber ? 'selected' : '' }}>
                                        {{ $monthName }}
                                    </option>
                                @endforeach
                            </select>
                            <button type="submit" class="btn btn-warning ms-2">Rechercher</button>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <a href="{{ route('courriers.create') }}" class="btn btn-success">Créer un Courrier</a>
                        </div>

                        <!-- Courriers Table -->
                        <table class="table">
                            <thead>
                                <tr>
                                    <th class="custom-header">Objet</th>
                                    <th class="custom-header">Type</th>
                                    <th class="custom-header">Date</th>
                                    <th class="custom-header">Division</th>
                                    <th class="custom-header">Emetteur</th>
                                    <th class="custom-header">Adresse Emetteur</th>
                                    <th class="custom-header">Observation</th>
                                    <th class="custom-header">Image</th>
                                    <th class="custom-header">Date de création</th>
                                    <th class="custom-header">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if($courriers->isEmpty())
                                    <tr>
                                        <td colspan="9" class="text-center">Aucun courrier trouvé</td>
                                    </tr>
                                @else
                                    @foreach($courriers as $courrier)
                                        <tr>
                                            <td>{{ $courrier->objet }}</td>
                                            <td>{{ $courrier->type }}</td>
                                            <td>{{ $courrier->date }}</td>
                                            <td>{{ $courrier->division === "Rh" ? "Ressources Humaines" : $courrier->division }}</td>
                                            <td>{{ $courrier->emetteur }}</td>
                                            <td>{{ $courrier->adresse_emetteur }}</td>
                                            <td>{{ $courrier->observation }}</td>
                                            <td>
                                                @if ($courrier->image_scan)
                                                    <a href="#" onclick="showImage('{{ asset('storage/uploads/courriers/' . $courrier->image_scan) }}')" class="btn btn-outline-secondary" title="Voir l'image">
                                                        <i class="far fa-eye"></i>
                                                    </a>
                                                @else
                                                    No image
                                                @endif
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($courrier->created_at)->format('d M, Y') }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ route('courriers.show', $courrier->id) }}" class="btn btn-info" title="Voir les détails">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                    <a href="{{ route('courriers.edit', $courrier->id) }}" class="btn btn-dark" title="Éditer le courrier">
                                                        <i class="fas fa-edit"></i>
                                                    </a>
                                                    <form action="{{ route('courriers.destroy', $courrier->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-danger" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce courrier ?')" title="Supprimer le courrier">
                                                            <i class="fas fa-trash-alt"></i>
                                                        </button>
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
                            {{ $courriers->appends(request()->query())->links('vendor.pagination.bootstrap-4') }}
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
                    <h5 class="modal-title" id="imageModalLabel">Image Preview</h5>
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
