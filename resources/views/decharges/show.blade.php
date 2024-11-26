<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Show Decharge</title>
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
    </style>
</head>
<body>
<div class="bg-success py-3">
    <h3 class="text-white text-center">Décharge</h3>
</div>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('decharges.index') }}" class="btn btn-dark">Back</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg my-4">
                <div class="card-header">
                    <h3>Détails de Décharge</h3>
                </div>
                <div class="card-body">
                    <p><strong>Nom Complet:</strong> {{ $decharge->nom_complet }}</p>
                    <p><strong>Date:</strong> {{ $decharge->date }}</p>
                    <p><strong>État:</strong> {{ $decharge->etat }}</p>
                    <p><strong>Ville:</strong> {{ $decharge->ville }}</p>
                    @if ($decharge->image_scan)
                        <div class="mb-3">
                            <img src="{{ asset('storage/uploads/decharges/' . $decharge->image_scan) }}" alt="Decharge Image" class="img-fluid" style="max-width: 100%; height: auto;">
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
