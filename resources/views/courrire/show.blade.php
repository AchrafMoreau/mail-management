@extends('layouts.master')
@section('title')
    @lang('translation.showCourrire')
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
            @lang("translation.showCourrire")
        @endslot
    @endcomponent

    <div class="row mb-5">
        <div class="col-lg-12">
            {{-- <div class="card">
                <div class="card-header align-items-center d-flex">
                    <h4 class="card-title mb-0 flex-grow-1 text-capitalize">@lang('translation.showCourrierMessage')</h4>
                </div><!-- end card header --> --}}
                {{-- <div class="card-body"> --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-4 card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0 flex-grow-1 text-capitalize">
                                        @lang("translation.object")
                                    </h4>
                                </div>
                                <div class="card-body">
                                    {{ $courrire->object }}
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-md-6">
                            <div class="mb-4 card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0 flex-grow-1 text-capitalize">
                                        @lang('translation.type')
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <h5 class="badge p-2 m-0 @if($courrire->type == 'ENTRANT') badge-gradient-primary @else badge-gradient-danger @endif">{{ $courrire->type }}</h5>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                      
                        <!--end col-->
                        <div class="col-md-12">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h4 class="card-title mb-0 flex-grow-1 text-capitalize">
                                        @lang('translation.observation')
                                    </h4>
                                </div>
                                <div class="card-body">
                                    {{$courrire->observation}}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-4 card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0 flex-grow-1 text-capitalize">
                                        @lang('translation.emetteur')
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <h6 class="text-bold">
                                                @lang("translation.nom")
                                            </h6>
                                        </div>
                                        <div class="col-md-6">
                                            {{$courrire->emetteur->nom}}
                                        </div>
                                        <div class="col-md-6 mb-4">
                                            <h6 class="text-bold">
                                                @lang("translation.adresse")
                                            </h6>
                                        </div>
                                        <div class="col-md-6">
                                            {{$courrire->emetteur->adresse}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-md-6">
                            <div class="mb-4 card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0 flex-grow-1 text-capitalize">
                                        @lang('translation.division')
                                    </h4>
                                </div>
                                <div class="card-body">
                                    {{$courrire->division}}
                                </div>
                            </div>
                        </div>
                        <!--end col-->
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0 flex-grow-1 text-capitalize">
                                        @lang('translation.reception_jour')
                                    </h4>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <p class="fw-bold">
                                                    <i class=" ri-calendar-check-line"></i>
                                                    @lang('translation.date') : <span class="fw-normal">{{ $courrire->reception_jour }}</span></p>
                                                {{-- <label for="dateInput" class="form-label">@lang('translation.date')</label>
                                                <div>{{ $courrire->reception_jour }}</div> --}}
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="mb-4">
                                                <p class="fw-bold">
                                                    <i class="ri-time-line"></i>
                                                    @lang('translation.time') : <span class="fw-normal">{{ $courrire->reception_heure  }}</span></p>
                                                {{-- <label for="dateInput" class="form-label">@lang('translation.time')</label>
                                                <div>
                                                    {{ $courrire->reception_heure }}
                                                </div> --}}
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
                                <iframe src="{{ asset('storage/'.$courrire->document) }}" height="600" type="application/pdf"></iframe>
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
                {{-- </div> --}}
            {{-- </div> --}}
        </div>
    </div>

@endsection
@section('script')
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

    <script>
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

    </script>

@endsection
