@extends('layouts.master')
@section('title')
    @lang('translation.editMail')
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/libs/filepond/filepond.min.css') }}" type="text/css" />
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet"
        href="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        <a href="{{ url("/mail") }}">
            @lang("translation.mail")
        </a>
        @endslot
        @slot('title')
            @lang("translation.editMail")
        @endslot
    @endcomponent

    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 text-capitalize">@lang('translation.editMailMessage')</h4>
                </div>
                <div class="card-body">
                <form action="{{ url( '/mail'.'/'.$mail->id ) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4">
                                <label for="firstNameinput" class="form-label">@lang("translation.object")</label>
                                <input required type="text" 
                                    name="object"
                                    value="{{ $mail->object }}"
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
                                    <option value="ENTRANT" {{ $mail->type == "ENTRANT" ? 'selected' : "" }}>@lang('translation.entrant')</option>
                                    <option value="SORTANT" {{ $mail->type == "SORTANT" ? 'selected' : "" }}>@lang('translation.sortant')</option>
                                </select>
                                @error('type')
                                    <span class='invalid-feedback' role='alert'>
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
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
                                            <option {{ $mail->expediteur && $emt->id == $mail->expediteur->id ? 'selected' : "" }} value="{{ $emt->id }}">{{ $emt->nom }}</option>
                                        @endforeach
                                    </select>
                                    @error('expediteur') <span class='invalid-feedback' role='alert'>
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
                                            <option {{ $mail->destination && $emt->id == $mail->destination->id ? 'selected' : "" }} value="{{ $emt->id }}">{{ $emt->nom }}</option>
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
                                <textarea class="form-control" id="VertimeassageInput" name="observation" rows="4" placeholder="Enter your message">{{ $mail->observation }}</textarea>
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
                                                <input value="{{ $mail->reception_jour }}" required type="date" class="form-control" name="reception_jour" data-provider="flatpickr" id="dateInput">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <label for="dateInput" class="form-label">@lang('translation.time')</label>
                                                <input type="time" class="form-control" data-provider="timepickr"
                                                    data-time-basic="true" value="{{ $mail->reception_heure }}" name="reception_time" id="timeInput">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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

    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/courrire-store.js') }}"></script>
    
@endsection
