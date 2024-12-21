@extends('layouts.master')
@section('title')
    @lang('translation.addCourrier')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/filepond/filepond.min.css') }}" type="text/css" />
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet"
        href="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
    <!--  Toaster notification -->
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        <a href="{{ url("/courrire") }}">
            @lang("translation.courrire")
        </a>
        @endslot
        @slot('title')
            @lang("translation.addCourrier")
        @endslot
    @endcomponent

    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 text-capitalize">@lang('translation.addCourrierMessage')</h4>
                </div><!-- end card header -->
                <div class="card-body">
                <form id="addCourrireFrom" action="{{ url('/courrire') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("POST")
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="firstNameinput" class="form-label">@lang("translation.object")</label>
                                <input required type="text" 
                                    name="object"
                                    class="form-control @error('object') is-invalid @enderror"  
                                    placeholder="@lang('translation.enter-object')"
                                    id="firstNameinput"
                                >
                                @error('object')
                                    <span class='invalid-feedback' role='alert'>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="choices-single-no-search" class="form-label">
                                    @lang('translation.type')
                                </label>
                                <select class="form-control @error('type') is-invalid @enderror" id="choices-single-no-search" name="type" data-choices data-choices-search-false  data-choices-removeItema>
                                    <option value="ENTRANT">@lang('translation.entrant')</option>
                                    <option value="SORTANT">@lang('translation.sortant')</option>
                                </select>
                                @error('type')
                                    <span class='invalid-feedback' role='alert'>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <!--end col-->
                      
                        <!--end col-->
                      
                        <div class="col-md-6 mt-4">
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-md-12">
                                    <label for="choices-single-default" class="form-label ">@lang('translation.expediteur')</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control @error('expediteur') is-invalid @enderror" data-choices name="expediteur"
                                        id="selectExpediteur" >
                                        <option value="">@lang("translation.chooseExp")</option>
                                        @foreach($expediteur as $emt)
                                            <option value="{{ $emt->id }}">{{ $emt->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('expediteur')
                                        <span class='invalid-feedback' role='alert'>
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-5 mt-3 mt-md-0 mt-lg-0 mt-xl-0 mt-xxl-0">
                                    <button class="btn  p-2 btn-sm btn-primary edit-item-btn" type='button' id="addExpediteur"
                                        data-bs-toggle="modal"  data-bs-target="#showModal">@lang("translation.add-expediteur")</button>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-md-6 mt-4">
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-md-12">
                                    <label for="choices-single-default" class="form-label ">@lang('translation.destinations')</label>
                                </div>
                                <div class="col-md-7">
                                    <select class="form-control @error('destination') is-invalid @enderror" data-choices name="destination"
                                        id="selectDistination">
                                        <option value="">@lang("translation.chooseDes")</option>
                                        @foreach($destination as $emt)
                                            <option value="{{ $emt->id }}">{{ $emt->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('destination')
                                        <span class='invalid-feedback' role='alert'>
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="col-md-5 mt-3 mt-md-0 mt-lg-0 mt-xl-0 mt-xxl-0">
                                    <button class="btn p-2 btn-sm btn-success edit-item-btn" type='button' id="addDestination"
                                        data-bs-toggle="modal" data-bs-target="#showModal">@lang("translation.add-destination")</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label for="VertimeassageInput" class="form-label">@lang('translation.observation')</label>
                                <textarea class="form-control" id="VertimeassageInput" name="observation" rows="4" placeholder="Enter your message"></textarea>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">
                                        @lang('translation.reception_jour')
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="dateInput" class="form-label">@lang('translation.date')</label>
                                                <input required type="date" class="form-control" name="reception_jour" data-provider="flatpickr" id="dateInput">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="dateInput" class="form-label">@lang('translation.time')</label>
                                                <input type="time" class="form-control" data-provider="timepickr"
                                                    data-time-basic="true" name="reception_time" id="timeInput">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <!--end col-->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class='card-title mb-0'>@lang("translation.documents")</h4>
                                </div>
                                <div class="card-body">
                                    <input type="file" id='filepond' class="filepond filepond-input-multiple" multiple name="docs"
                                        data-allow-reorder="true" data-max-file-size="3MB" data-max-files="3">
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-lg-12">
                            <div class="text-end">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </div>
                        <!--end col-->
                    </div>
                    <!--end row-->
                </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form class="tablelist-form" id='addForm' method="POST">
                    @csrf
                    @method("POST")
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="name-field" class="form-label">@lang("translation.nom")</label>
                            <input type="text" id="name-field" name="nom" class="form-control" placeholder="@lang('translation.enter-nom')"
                                required />
                        </div>
                        <div class="mb-3">
                            <label for="ville-field" class="form-label">@lang("translation.ville")</label>
                            <select class="form-control" data-choices name="ville" id="ville-field" >
                                <option value="">@lang('translation.select-ville')</option>
                                @foreach($villes  as $ville)
                                    <option value="{{ $ville->id }}" >{{ $ville->ville }}</option>
                                @endforeach
                            </select>
                            <span class="invalid-feedback" role="alert">
                            </span>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="inputAddress" class="form-label">@lang("translation.adresse")</label>
                            <input type="text" name='adresse' class="form-control" id="address-field" placeholder="1234 Main St">
                        </div>
                        <div class="row">
                            <div class="col-6 mb-3">
                                <label for="phonenumberInput" class="form-label">@lang('translation.email')</label>
                                <input type="tel" name="email" class="form-control" placeholder="+(245) 451 45123"
                                    id="email-field">
                            </div>
                            <div class="col-6 mb-3">
                                <label for="phonenumberInput" class="form-label">@lang('translation.phone')</label>
                                <input type="tel" name="phone" class="form-control" placeholder="+(245) 451 45123"
                                    id="telephone-field">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('translation.close')</button>
                            <button type="submit" class="btn btn-success" id="submitButton">@lang('translation.submit')</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        window.translations = {
            dragAndDrop: "{{ __('translation.dragAndDrop') }}",
            addExp: "{{ __('translation.add-expediteur') }}",
            addDes: "{{ __('translation.add-destination') }}",
            selectVille: "{{ __('translation.pleaseSelectVille')}}"
        }

    </script>
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('build/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('build/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ URL::asset('build/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>

    <script src="{{ URL::asset('build/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/form-file-upload.init.js') }}"></script>

    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/courrire-store.js') }}"></script>
   

@endsection
