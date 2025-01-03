@extends('layouts.master')
@section('title')
    @lang('translation.dashboards')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://kit.fontawesome.com/5fff77269d.js" crossorigin="anonymous"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col">

            <div class="h-100">
                <div class="row mb-3 pb-1">
                    <div class="col-12">
                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                            <div class="flex-grow-1">
                                <h4 class="fs-16 mb-1 text-capitalize">@lang('translation.goodMorning') {{ Auth::user()->name  }} </h4>
                                <p class="text-muted mb-0">@lang('translation.morningMessage')</p>
                            </div>
                        </div><!-- end card header -->
                    </div>
                    <!--end col-->
                </div>
                <!--end row-->

                <div class="row">
                   

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">@lang("translation.entrantCourrier")</p>
                                    </div>
                                    <div class="flex-shrink-0" id="entrantCourrierPersentage">
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-20 fw-semibold ff-secondary mb-4"><span class="counter-value entrant-courrier"
                                                data-target="100">0</span></h4>
                                        <a href="{{ url("/entrant-courrire") }}" class="text-decoration-underline">@lang('translation.viewEntantCourrier')</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-primary-subtle rounded fs-3">
                                            <i class="ri-inbox-archive-line text-primary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div>
                    </div>

                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">@lang('translation.sortantCourrier')</p>
                                    </div>
                                    <div class="flex-shrink-0" id="sortantCourrierPersentage">
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-20 fw-semibold ff-secondary mb-4"><span class="counter-value sortant-courrier"
                                                data-target="100">0</span></h4>
                                        <a href="{{ url("/sortant-courrire") }}" class="text-decoration-underline">@lang('translation.viewSortantCourrier')</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-success-subtle rounded fs-3">
                                            <i class="ri-inbox-unarchive-line text-success"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->

                    <div class="col-xl-3 col-md-6">
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                            @lang('translation.entrantMail')
                                        </p>
                                    </div>
                                    <div class="flex-shrink-0" id="entrantMailPersentage">
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-20 fw-semibold ff-secondary mb-4"><span class="counter-value entrant-mail"
                                                data-target="122">0</span></h4>
                                        <a href="{{ url('/entrant-mail')}}" class="text-decoration-underline">@lang('translation.viewEntrantMail')</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0" >
                                        <span class="avatar-title bg-secondary-subtle rounded fs-3">
                                            <i class="ri-mail-send-line text-secondary"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                    <div class="col-xl-3 col-md-6">
                        <!-- card -->
                        <div class="card card-animate">
                            <div class="card-body">
                                <div class="d-flex align-items-center">
                                    <div class="flex-grow-1 overflow-hidden">
                                        <p class="text-uppercase fw-medium text-muted text-truncate mb-0">@lang("translation.sortantMail")</p>
                                    </div>
                                    <div class="flex-shrink-0" id="sortantMailPersentage">
                                    </div>
                                </div>
                                <div class="d-flex align-items-end justify-content-between mt-4">
                                    <div>
                                        <h4 class="fs-20 fw-semibold ff-secondary mb-4"><span class="counter-value sortant-mail"
                                                data-target="100">0</span></h4>
                                        <a href="{{ url("/sortant-mail") }}" class="text-decoration-underline">@lang("translation.viewSortantMail")</a>
                                    </div>
                                    <div class="avatar-sm flex-shrink-0">
                                        <span class="avatar-title bg-warning-subtle rounded fs-3">
                                            <i class="ri-file-paper-2-line text-warning"></i>
                                        </span>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div> <!-- end row-->
            </div> <!-- end .h-100-->

        </div> <!-- end col -->

    </div>
@endsection
@section('script')
    <!-- apexcharts -->
    <script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <!-- dashboard init -->
    <script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    
    <script>
        $(document).ready(function(){
            $.get('/entrant-courrier-persentage', function(response){
                const card = $("#entrantCourrierPersentage");
                const target = $(".entrant-courrier");
                MarkStatus(card, response.totalPersentage, target, response.total)
            })
            $.get('/sortant-courrier-persentage', function(response){
                const card = $("#sortantCourrierPersentage");
                const target = $(".sortant-courrier");
                MarkStatus(card, response.totalPersentage, target, response.total)
            })
            $.get('/entrant-mail-persentage', function(response){
                const card = $("#entrantMailPersentage");
                const target = $(".entrant-mail");
                MarkStatus(card, response.totalPersentage, target, response.total)
            })
            $.get('/sortant-mail-persentage', function(response){
                const card = $("#sortantMailPersentage");
                const target = $(".sortant-mail");
                MarkStatus(card, response.totalPersentage, target, response.total)
            })
        })

        function MarkStatus(domElement, persentage, targetDom, total){
            const up = `<h5 class="text-success fs-14 mb-0">
                    <i class="ri-arrow-right-up-line fs-13 align-middle"></i> `
            const down = `<h5 class="text-danger fs-14 mb-0">
                    <i class="ri-arrow-right-down-line fs-13 align-middle"></i> `
            const stable = `<h5 class="text-muted fs-14 mb-0"> `
            targetDom.attr("data-target", total)
            if(persentage > 0) {
                domElement.html(up + persentage + " % </h5>") 
            }else if(persentage < 0){
                domElement.html(down + persentage + " % </h5>")
            }else{
                domElement.html(stable + "+ " + persentage + " % </h5>")
            }
        }
    </script>
@endsection

