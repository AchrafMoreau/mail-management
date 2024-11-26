<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Détails du Courrier</title>
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
        .card {
            margin: 20px auto;
            max-width: 800px;
        }
    </style>
</head>
<body>
    <div class="bg-success py-3">
        <h3 class="text-white text-center">Détails du Courrier</h3>
    </div>
    <div class="container">
        <div class="card border-0 shadow-lg my-4">
            <div class="card-header">
                <h4>{{ $courrier->objet }}</h4>
            </div>
            <div class="card-body">
                <dl class="row">
                    <dt class="col-sm-3">Type</dt>
                    <dd class="col-sm-9">{{ $courrier->type }}</dd>

                    <dt class="col-sm-3">Date</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($courrier->date)->format('d M, Y') }}</dd>

                    <dt class="col-sm-3">Division</dt>
                    <dd class="col-sm-9">{{ $courrier->division }}</dd>

                    <dt class="col-sm-3">Émetteur</dt>
                    <dd class="col-sm-9">{{ $courrier->emetteur }}</dd>

                    <dt class="col-sm-3">Adresse de l'Émetteur</dt>
                    <dd class="col-sm-9">{{ $courrier->adresse_emetteur }}</dd>

                    <dt class="col-sm-3">Observation</dt>
                    <dd class="col-sm-9">{{ $courrier->observation }}</dd>

                    <dt class="col-sm-3">Image</dt>
                    <dd class="col-sm-9">
                        @if ($courrier->image_scan)
                            <img src="{{ asset('storage/uploads/courriers/' . $courrier->image_scan) }}" class="img-fluid" alt="Image du Courrier">
                        @else
                            Pas d'image disponible
                        @endif
                    </dd>

                    <dt class="col-sm-3">Date de Création</dt>
                    <dd class="col-sm-9">{{ \Carbon\Carbon::parse($courrier->created_at)->format('d M, Y') }}</dd>
                </dl>

                <a href="{{ route('courriers.index') }}" class="btn btn-primary">Retour à la Liste</a>
            </div>
        </div>
    </div>
</body>
</html>
