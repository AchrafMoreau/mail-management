<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Décharge</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<div class="bg-success py-3">
    <h3 class="text-white text-center">Décharges</h3>
</div>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('decharges.index') }}" class="btn btn-dark">Retour</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg my-4">
                <div class="card-header">
                    <h3>Éditer la Décharge</h3>
                </div>
                <form action="{{ route('decharges.update', $decharge->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="nom_complet" class="form-label">Nom Complet</label>
                            <input value="{{ old('nom_complet', $decharge->nom_complet) }}" type="text" class="form-control @error('nom_complet') is-invalid @enderror" id="nom_complet" name="nom_complet" placeholder="Nom Complet">
                            @error('nom_complet')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input value="{{ old('date', $decharge->date) }}" type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date">
                            @error('date')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="etat" class="form-label">État</label>
                            <select class="form-control @error('etat') is-invalid @enderror" id="etat" name="etat">
                                <option value="en cours" {{ $decharge->etat == 'en cours' ? 'selected' : '' }}>En cours</option>
                                <option value="remis" {{ $decharge->etat == 'remis' ? 'selected' : '' }}>Remis</option>
                            </select>
                            @error('etat')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="ville" class="form-label">Ville</label>
                            <select class="form-control @error('ville') is-invalid @enderror" id="ville" name="ville">
                                <option value="Ouarzazate" {{ $decharge->ville == 'Ouarzazate' ? 'selected' : '' }}>Ouarzazate</option>
                                <option value="Guelmim" {{ $decharge->ville == 'Guelmim' ? 'selected' : '' }}>Guelmim</option>
                            </select>
                            @error('ville')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image" class="form-label">Image</label>
                            <input type="file" class="form-control-file @error('image') is-invalid @enderror" id="image" name="image">
                            @if ($decharge->image)
                                <div class="mt-2">
                                    <a href="{{ asset('storage/uploads/decharges/' . $decharge->image) }}" target="_blank" class="btn btn-outline-secondary" title="Voir l'image">
                                        <i class="bi bi-eye"></i> Voir l'image actuelle
                                    </a>
                                </div>
                            @endif
                            @error('image')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
