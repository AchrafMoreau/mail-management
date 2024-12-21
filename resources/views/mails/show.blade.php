@extends('layouts.master')
@section('title')
    @lang('translation.showMail')
@endsection
@section('content')
    @component('components.breadcrumb')
        @slot('li_1')
        <a href="{{ url("/mail") }}">
            @lang("translation.mail")
        </a>
        @endslot
        @slot('title')
            @lang("translation.showMail")
        @endslot
    @endcomponent
    <div class="row mb-5">
        <div class="col-lg-12">
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-4 card">
                        <div class="card-header">
                            <h4 class="card-title mb-0 flex-grow-1 text-capitalize">
                                @lang("translation.object")
                            </h4>
                        </div>
                        <div class="card-body">
                            {{ $mail->object }}
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
                            <h5 class="badge p-2 m-0 @if($mail->type == 'ENTRANT') badge-gradient-primary @else badge-gradient-danger @endif">{{ $mail->type }}</h5>
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
                            {{$mail->observation}}
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-4 card">
                        <div class="card-header">
                            <h4 class="card-title mb-0 flex-grow-1 text-capitalize">
                                @if($mail->destination)
                                    @lang('translation.destinations')
                                @else
                                    @lang('translation.expediteur')
                                @endif
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
                                    {{$mail->destination ? $mail->destination->nom : $mail->expediteur->nom }}
                                </div>
                                <div class="col-md-6 mb-4">
                                    <h6 class="text-bold">
                                        @lang("translation.ville")
                                    </h6>
                                </div>
                                <div class="col-md-6">
                                    {{$mail->destination ? $mail->destination->ville->ville : $mail->expediteur->ville->ville }}
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
                                            @lang('translation.date') : <span class="fw-normal">{{ $mail->reception_jour }}</span>
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <p class="fw-bold">
                                            <i class="ri-time-line"></i>
                                            @lang('translation.time') : <span class="fw-normal">{{ $mail->reception_heure  }}</span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end col-->
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class='card-title mb-0'>@lang("translation.documents")</h4>
                        </div>
                        <iframe src="{{ asset('storage/'.$mail->document) }}" height="600" type="application/pdf"></iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
