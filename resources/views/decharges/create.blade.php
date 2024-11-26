<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Créer une Décharge</title>
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
        .bg-success-custom {
            background-color: #28a745;
        }
    </style>
</head>
<body>
    <div class="bg-success py-3">
        <h3 class="text-white text-center">Créer une Décharge</h3>
    </div>
    <div class="container">
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header">
                        <h3>Formulaire de Création</h3>
                    </div>
                    <div class="card-body">
                        <!-- Form for creating a decharge -->
                        <form action="{{ route('decharges.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="nom_complet" class="form-label">Nom Complet</label>
                                <input type="text" class="form-control" id="nom_complet" name="nom_complet" required>
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                            <div class="mb-3">
                                <label for="etat" class="form-label">État</label>
                                <input type="text" class="form-control" id="etat" name="etat" required>
                            </div>
                            <div class="mb-3">
                                <label for="ville" class="form-label">Ville</label>
                                <input type="text" class="form-control" id="ville" name="ville" required>
                            </div>
                            <div class="mb-3">
                                <label for="image_scan" class="form-label">Image Scan</label>
                                <input type="file" class="form-control" id="image_scan" name="image_scan">
                            </div>
                            <div class="d-flex justify-content-between">
                                <a href="{{ route('decharges.index') }}" class="btn btn-secondary">Annuler</a>
                                <button type="submit" class="btn btn-primary">Enregistrer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
