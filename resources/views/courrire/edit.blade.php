@extends('layouts.master')
@section('title')
    @lang('translation.editCourrire')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/filepond/filepond.min.css') }}" type="text/css" />
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
            @lang("translation.editCourrire")
        @endslot
    @endcomponent

    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 text-capitalize">@lang('translation.editCourrierMessage')</h4>
                </div><!-- end card header -->
                <div class="card-body">
                <form action="{{ url( '/courrire'.'/'.$courrire->id ) }}" method="POST" enctype="multipart/form-data">
                {{-- <form method="POST" enctype="multipart/form-data"> --}}
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="firstNameinput" class="form-label">@lang("translation.object")</label>
                                <input required type="text" 
                                    name="object"
                                    class="form-control @error('object') is-invalid @enderror"  
                                    placeholder="@lang('translation.enter-object')"
                                    id="firstNameinput"
                                    value="{{ $courrire->object }}"
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
                                    <option value="ENTRANT" @if($courrire->type == "ENTRANT") selected @endif>@lang('translation.entrant')</option>
                                    <option value="SORTANT" @if($courrire->type == "SORTANT") selected @endif>@lang('translation.sortant')</option>
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
                        <div class="col-md-12">
                            <div class="mb-4">
                                <label for="VertimeassageInput" class="form-label">@lang('translation.observation')</label>
                                <textarea class="form-control" id="VertimeassageInput" name="observation" rows="4" placeholder="Enter your message">{{$courrire->observation}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row d-flex align-items-center mb-4">
                                <div class="col-md-12">
                                    <label for="choices-single-default" class="form-label ">@lang('translation.emetteur')</label>
                                    <select class="form-control @error('emetteur') is-invalid @enderror" data-choices name="emetteur"
                                        id="selectEmetteur">
                                        @foreach($emetteurs as $emt)
                                            <option value="{{ $emt->id }}" @if($emt->id == $courrire->emetteur_id) selected @endif>{{ $emt->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('emetteur')
                                        <span class='invalid-feedback' role='alert'>
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                {{-- <div class="col-md-4">
                                    <button class="btn m-md-3 p-2 btn-sm btn-primary edit-item-btn" type='button'
                                        data-bs-toggle="modal" data-bs-target="#showModal">@lang("translation.add-emetteur")</button>
                                </div> --}}
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="choices-single-no-search" class="form-label ">
                                    @lang('translation.division')
                                </label>
                                <select class="form-control" id="choices-single-no-search" name="division" data-choices data-choices-search-false  data-choices-removeItema>
                                    <option value="Administration" @if($courrire->division == "Administration") selected @endif>@lang('translation.administration')</option>
                                    <option value="Ressource Humains"@if($courrire->division == "Ressource Humains") selected @endif>@lang('translation.rh')</option>
                                    <option value="Gestion"@if($courrire->division == "Gestion") selected @endif>@lang('translation.gestion')</option>
                                </select>
                                @error('emetteur')
                                    <span class='invalid-feedback' role='alert'>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                                                <input required type="date" class="form-control" name="reception_jour" data-provider="flatpickr" value="{{$courrire->reception_jour}}" id="dateInput">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="dateInput" class="form-label">@lang('translation.time')</label>
                                                <input type="time" class="form-control" data-provider="timepickr"
                                                    value="{{$courrire->reception_heure}}"
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
                                    <input type="file"  id='filepond' class="filepond filepond-input-multiple" multiple name="docs"
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
    {{-- <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="close-modal"></button>
                </div>
                <form class="tablelist-form" id='addEmtteur' method="POST">
                    @csrf
                    @method("POST")
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="customername-field" class="form-label">@lang("translation.nom")</label>
                            <input type="text" id="customername-field" name="nom" class="form-control" placeholder="@lang('translation.enter-nom')"
                                required />
                        </div>

                        <div class="col-12 mb-3">
                            <label for="inputAddress" class="form-label">@lang("translation.adresse")</label>
                            <input type="text" required name='adresse' class="form-control" id="inputAddress" placeholder="1234 Main St">
                        </div>
                        <div class="col-12 mb-3">
                            <label for="phonenumberInput" class="form-label">@lang('translation.phone')</label>
                            <input type="tel" name="phone" class="form-control" placeholder="+(245) 451 45123"
                                id="phonenumberInput">
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="inputCity" class="form-label">@lang('translation.city')</label>
                                <input type="text" name="city" class="form-control" id="inputCity" placeholder="Enter your city">
                            </div>
                            <div class="col-md-4">
                                <label for="inputZip" class="form-label">@lang('translation.zipCode')</label>
                                <input type="text" name="zip" class="form-control" id="inputZip" placeholder="Zin code">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="hstack gap-2 justify-content-end">
                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">@lang('translation.close')</button>
                            <button type="submit" class="btn btn-success" id="addEmtteur">@lang('translation.submit')</button>
                            <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div> --}}
@endsection
@section('script')
    <script>
        window.translations = {
            dragAndDrop: "{{ __('translation.dragAndDrop') }}",
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
    {{-- <script>
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        $('#addEmtteur').on('submit', function(e){
            e.preventDefault()
            console.log(e.target)
            const form = e.target;
            const data = {
                nom : form.elements['nom'].value,
                city : form.elements['city'].value,
                phone : form.elements['phone'].value,
                adresse : form.elements['adresse'].value,
                zip : form.elements['zip'].value,
            }
            $.ajax({
                url: "/emetteur",
                type: "POST",
                data,
                headers:{
                    'X-CSRF-TOKEN' : token,
                },
                beforeSend: ()=>{
                    $('button#addEmtteur').html(`
                        <div style='width:1rem; height:1rem;' class="spinner-border text-white" role="status">
                            <span class="sr-only">Loading...</span>
                        </div>
                    `);
                },
                complete: ()=>{
                    $('button#addEmtteur').html("@lang('translation.submit')");

                },
                success: (res) => {
                    toastr.success(res.message)
                    console.log(clientSelect)
                    let elements = clientSelect.config.choices
                    elements.push({value: res.data.id , label: res.data.nom, selected: true, disabled: false, placeholder: false})
                    clientSelect.clearStore(); 
                    clientSelect.setChoices(elements, 'value', 'label', false);
                    clearFileds()
                    $('#close-modal').click()
                },
                error: (e) =>{
                    const errorMessage = e.responseJSON.message
                    toastr.error('Something Wrong :( ', errorMessage);

                }
            })
            function clearFileds(){
                form.elements['nom'].value = ""
                form.elements['city'].value = ""
                form.elements['adresse'].value = ""
                form.elements['zip'].value = ""
                form.elements['phone'].value = ""
            }
        })

    </script> --}}

    
@endsection
