<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Courrier</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body>
<div class="bg-success py-3">
    <h3 class="text-white text-center">Courriers</h3>
</div>
<div class="container">
    <div class="row justify-content-center mt-4">
        <div class="col-md-10 d-flex justify-content-end">
            <a href="{{ route('courriers.index') }}" class="btn btn-dark">Back</a>
        </div>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card border-0 shadow-lg my-4">
                <div class="card-header">
                    <h3>Edit Courrier</h3>
                </div>
                <form action="{{ route('courriers.update', $courrier->id) }}" method="post" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="type" class="form-label">Type</label>
                            <select class="form-control" id="type" name="type">
                                <option value="entrant" {{ $courrier->type == 'entrant' ? 'selected' : '' }}>Entrant</option>
                                <option value="sortant" {{ $courrier->type == 'sortant' ? 'selected' : '' }}>Sortant</option>
                            </select>
                            @error('type')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="objet" class="form-label">Objet</label>
                            <input value="{{ old('objet', $courrier->objet) }}" type="text" class="form-control @error('objet') is-invalid @enderror" id="objet" name="objet" placeholder="Objet">
                            @error('objet')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="date" class="form-label">Date</label>
                            <input value="{{ old('date', $courrier->date) }}" type="date" class="form-control @error('date') is-invalid @enderror" id="date" name="date">
                            @error('date')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Division</label>
                            <select class="form-control" id="division" name="division">
                                <option value="gestion" {{ $courrier->division == 'gestion' ? 'selected' : '' }}>Gestion</option>
                                <option value="administration" {{ $courrier->division == 'administration' ? 'selected' : '' }}>Administration</option>
                                <option value="Rh" {{ $courrier->division == 'Rh' ? 'selected' : '' }}>Ressources Humaines</option>
                            </select>
                            @error('division')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="emetteur" class="form-label">Émetteur</label>
                            <input value="{{ old('emetteur', $courrier->emetteur) }}" type="text" class="form-control @error('emetteur') is-invalid @enderror" id="emetteur" name="emetteur" placeholder="Émetteur">
                            @error('emetteur')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="adresse_emetteur" class="form-label">Adresse Émetteur</label>
                            <input value="{{ old('adresse_emetteur', $courrier->adresse_emetteur) }}" type="text" class="form-control @error('adresse_emetteur') is-invalid @enderror" id="adresse_emetteur" name="adresse_emetteur" placeholder="Adresse Émetteur">
                            @error('adresse_emetteur')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="observation" class="form-label">Observation</label>
                            <textarea class="form-control" id="observation" name="observation" rows="3">{{ old('observation', $courrier->observation) }}</textarea>
                            @error('observation')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="image_scan" class="form-label">Image Scan</label>
                            <div class="input-group">
                                <input type="file" class="form-control-file @error('image_scan') is-invalid @enderror" id="image_scan" name="image_scan">
                                @if ($courrier->image_scan)
                                <a href="{{ asset('storage/uploads/courriers/' . $courrier->image_scan) }}" target="_blank" class="btn btn-outline-secondary" title="View Image">
                                    <i class="bi bi-eye"></i>
                                </a>
                                @endif
                            </div>
                            @error('image_scan')
                            <p class="invalid-feedback">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
