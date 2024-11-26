<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Courrier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container mt-4">
        <div class="bg-success py-3">
            <h3 class="text-white text-center">Créer un Courrier</h3>
        </div>
        <div class="row justify-content-center mt-4">
            <div class="col-md-8">
                <div class="card border-0 shadow-lg my-4">
                    <div class="card-header">
                        <h3>Ajouter un courrier</h3>
                    </div>
                    <form action="{{ route('courriers.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="mb-3">
                                <label for="type" class="form-label">Type</label>
                                <select name="type" id="type" class="form-control form-control-lg">
                                    <option value="entrant">Entrant</option>
                                    <option value="sortant">Sortant</option>
                                </select>
                                @error('type')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="objet" class="form-label">Objet</label>
                                <input type="text" class="form-control form-control-lg @error('objet') is-invalid @enderror" id="objet" name="objet" value="{{ old('objet') }}">
                                @error('objet')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="date" class="form-label">Date</label>
                                <input type="date" class="form-control form-control-lg @error('date') is-invalid @enderror" id="date" name="date" value="{{ old('date') }}">
                                @error('date')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="type" class="form-label">Division</label>
                                <select class="form-control" id="division" name="division">
                                    <option value="gestion">Gestion</option>
                                    <option value="administration" >Administration</option>
                                    <option value="Rh">Ressources Humaines</option>
                                </select>
                                @error('division')
                                <p class="invalid-feedback">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="emetteur" class="form-label">Émetteur</label>
                                <input type="text" class="form-control form-control-lg @error('emetteur') is-invalid @enderror" id="emetteur" name="emetteur" value="{{ old('emetteur') }}">
                                @error('emetteur')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="adresse_emetteur" class="form-label">Adresse Émetteur</label>
                                <input type="text" class="form-control form-control-lg @error('adresse_emetteur') is-invalid @enderror" id="adresse_emetteur" name="adresse_emetteur" value="{{ old('adresse_emetteur') }}">
                                @error('adresse_emetteur')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="observation" class="form-label">Observation</label>
                                <textarea class="form-control @error('observation') is-invalid @enderror" id="observation" name="observation" rows="5">{{ old('observation') }}</textarea>
                                @error('observation')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="mb-3">
                                <label for="image_scan" class="form-label">Image</label>
                                <input type="file" class="form-control form-control-lg @error('image_scan') is-invalid @enderror" id="image_scan" name="image_scan">
                                @error('image_scan')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="d-grid">
                                <button class="btn btn-lg btn-primary">Enregistrer</button>
                            </div>
                        </div>
                    </form>
                </div>
                <a href="{{ route('courriers.index') }}" class="btn btn-secondary">Retour</a>
            </div>
        </div>
    </div>
</body>
</html>
