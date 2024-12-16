@extends('layouts.master')
@section('title')
    @lang('translation.emetteur')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                @lang('translation.settings')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i>
                                @lang('translation.themeSetting')
                            </a>
                        </li>
                    </ul>
                </div><!-- end card header -->

                <div class="card-body ">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <div class="sm-w-[50%] p-0">
                                <form action="{{ url("setting/". Auth::id() ) }}" method="POST">
                                    @csrf
                                    @method("PUT")
                                    <div class="p-4">
                                        <label for="name-field" class="form-label">@lang("translation.nom")</label>
                                        <input type="text" id="nom-field" name="name" class="form-control" value="{{ $settings->name }}" placeholder="@lang('translation.enter-nom')"
                                            required />
                                    </div>
                                    <div class="p-4">
                                        <label for="region-field" class="form-label">@lang("translation.region")</label>
                                        <select class="form-control" data-trigger name="region" id="region-field" >
                                            {{-- <option value="">@lang('translation.select-region')</option> --}}
                                            @foreach($regions  as $region)
                                                @if($region->id == $settings->region_id)
                                                    <option value="{{ $region->id }}" selected>{{ $region->region }}</option>
                                                @else
                                                    <option value="{{ $region->id }}" >{{ $region->region }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="offcanvas-footer border-top p-3 text-center">
                                        <div class="row">
                                            <div class="col-6">
                                                <button type="button" class="btn btn-light w-100" id="reset-layout">@lang("translation.reset")</button>
                                            </div>
                                            <div class="col-6">
                                                <button type="submit" class="btn btn-primary w-100">@lang("translation.submit")</button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="tab-pane " id="changePassword" role="tabpanel">
                            <form action="{{ url("setting/". Auth::id() ) }}" method="POST" class="sm-w-[50%] p-0">
                                @csrf
                                @method("PUT")
                                <div data-simplebar class="h-100">
                                    <div class="p-4">
                                        <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Color Scheme</h6>
                                        <p class="text-muted">Choose Light or Dark Scheme.</p>
                                        <div class="colorscheme-cardradio">
                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-check card-radio">
                                                        <input class="form-check-input" type="radio" name="data-bs-theme"
                                                            id="layout-mode-light" value="light">
                                                        <label class="form-check-label p-0 avatar-md w-100" for="layout-mode-light">
                                                            <span class="d-flex gap-1 h-100">
                                                                <span class="flex-shrink-0">
                                                                    <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                                        <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                                    </span>
                                                                </span>
                                                                <span class="flex-grow-1">
                                                                    <span class="d-flex h-100 flex-column">
                                                                        <span class="bg-light d-block p-1"></span>
                                                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <h5 class="fs-13 text-center mt-2">Light</h5>
                                                </div>

                                                <div class="col-4">
                                                    <div class="form-check card-radio dark">
                                                        <input class="form-check-input" type="radio" name="data-bs-theme"
                                                            id="layout-mode-dark" value="dark">
                                                        <label class="form-check-label p-0 avatar-md w-100 bg-dark" for="layout-mode-dark">
                                                            <span class="d-flex gap-1 h-100">
                                                                <span class="flex-shrink-0">
                                                                    <span class="bg-white bg-opacity-10 d-flex h-100 flex-column gap-1 p-1">
                                                                        <span
                                                                            class="d-block p-1 px-2 bg-white bg-opacity-10 rounded mb-2"></span>
                                                                        <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                                        <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                                        <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                                    </span>
                                                                </span>
                                                                <span class="flex-grow-1">
                                                                    <span class="d-flex h-100 flex-column">
                                                                        <span class="bg-white bg-opacity-10 d-block p-1"></span>
                                                                        <span class="bg-white bg-opacity-10 d-block p-1 mt-auto"></span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <h5 class="fs-13 text-center mt-2">Dark</h5>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="layout-position">
                                            <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Layout Position</h6>
                                            <p class="text-muted">Choose Fixed or Scrollable Layout Position.</p>

                                            <div class="btn-group radio" role="group">
                                                <input type="radio" class="btn-check" name="data-layout-position"
                                                    id="layout-position-fixed" value="fixed">
                                                <label class="btn btn-light w-sm" for="layout-position-fixed">Fixed</label>

                                                <input type="radio" class="btn-check" name="data-layout-position"
                                                    id="layout-position-scrollable" value="scrollable">
                                                <label class="btn btn-light w-sm ms-0" for="layout-position-scrollable">Scrollable</label>
                                            </div>
                                        </div>
                                        <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Topbar Color</h6>
                                        <p class="text-muted">Choose Light or Dark Topbar Color.</p>

                                        <div class="row">
                                            <div class="col-4">
                                                <div class="form-check card-radio">
                                                    <input class="form-check-input" type="radio" name="data-topbar"
                                                        id="topbar-color-light" value="light">
                                                    <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-light">
                                                        <span class="d-flex gap-1 h-100">
                                                            <span class="flex-shrink-0">
                                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                                    <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                                    <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                                    <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                                    <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                                </span>
                                                            </span>
                                                            <span class="flex-grow-1">
                                                                <span class="d-flex h-100 flex-column">
                                                                    <span class="bg-light d-block p-1"></span>
                                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <h5 class="fs-13 text-center mt-2">Light</h5>
                                            </div>
                                            <div class="col-4">
                                                <div class="form-check card-radio">
                                                    <input class="form-check-input" type="radio" name="data-topbar" id="topbar-color-dark"
                                                        value="dark">
                                                    <label class="form-check-label p-0 avatar-md w-100" for="topbar-color-dark">
                                                        <span class="d-flex gap-1 h-100">
                                                            <span class="flex-shrink-0">
                                                                <span class="bg-light d-flex h-100 flex-column gap-1 p-1">
                                                                    <span class="d-block p-1 px-2 bg-white bg-opacity-10 rounded mb-2"></span>
                                                                    <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                                    <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                                    <span class="d-block p-1 px-2 pb-0 bg-white bg-opacity-10"></span>
                                                                </span>
                                                            </span>
                                                            <span class="flex-grow-1">
                                                                <span class="d-flex h-100 flex-column">
                                                                    <span class="bg-primary d-block p-1"></span>
                                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </label>
                                                </div>
                                                <h5 class="fs-13 text-center mt-2">Dark</h5>
                                            </div>
                                        </div>


                                        <div id="sidebar-color">
                                            <h6 class="mt-4 mb-0 fw-semibold text-uppercase">Sidebar Color</h6>
                                            <p class="text-muted">Choose a color of Sidebar.</p>

                                            <div class="row">
                                                <div class="col-4">
                                                    <div class="form-check sidebar-setting card-radio" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseBgGradient.show">
                                                        <input class="form-check-input" type="radio" name="data-sidebar"
                                                            id="sidebar-color-light" value="light">
                                                        <label class="form-check-label p-0 avatar-md w-100" for="sidebar-color-light">
                                                            <span class="d-flex gap-1 h-100">
                                                                <span class="flex-shrink-0">
                                                                    <span class="bg-white border-end d-flex h-100 flex-column gap-1 p-1">
                                                                        <span class="d-block p-1 px-2 bg-primary-subtle rounded mb-2"></span>
                                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                                        <span class="d-block p-1 px-2 pb-0 bg-primary-subtle"></span>
                                                                    </span>
                                                                </span>
                                                                <span class="flex-grow-1">
                                                                    <span class="d-flex h-100 flex-column">
                                                                        <span class="bg-light d-block p-1"></span>
                                                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <h5 class="fs-13 text-center mt-2">Light</h5>
                                                </div>
                                                <div class="col-4">
                                                    <div class="form-check sidebar-setting card-radio" data-bs-toggle="collapse"
                                                        data-bs-target="#collapseBgGradient.show">
                                                        <input class="form-check-input" type="radio" name="data-sidebar"
                                                            id="sidebar-color-dark" value="dark">
                                                        <label class="form-check-label p-0 avatar-md w-100" for="sidebar-color-dark">
                                                            <span class="d-flex gap-1 h-100">
                                                                <span class="flex-shrink-0">
                                                                    <span class="bg-primary d-flex h-100 flex-column gap-1 p-1">
                                                                        <span class="d-block p-1 px-2 bg-light-subtle rounded mb-2"></span>
                                                                        <span class="d-block p-1 px-2 pb-0 bg-light-subtle"></span>
                                                                        <span class="d-block p-1 px-2 pb-0 bg-light-subtle"></span>
                                                                        <span class="d-block p-1 px-2 pb-0 bg-light-subtle"></span>
                                                                    </span>
                                                                </span>
                                                                <span class="flex-grow-1">
                                                                    <span class="d-flex h-100 flex-column">
                                                                        <span class="bg-light d-block p-1"></span>
                                                                        <span class="bg-light d-block p-1 mt-auto"></span>
                                                                    </span>
                                                                </span>
                                                            </span>
                                                        </label>
                                                    </div>
                                                    <h5 class="fs-13 text-center mt-2">Dark</h5>
                                                </div>
                                                <div class="col-4">
                                                    <button class="btn btn-link avatar-md w-100 p-0 overflow-hidden border collapsed"
                                                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseBgGradient"
                                                        aria-expanded="false" aria-controls="collapseBgGradient">
                                                        <span class="d-flex gap-1 h-100">
                                                            <span class="flex-shrink-0">
                                                                <span class="bg-vertical-gradient d-flex h-100 flex-column gap-1 p-1">
                                                                    <span class="d-block p-1 px-2 bg-light-subtle rounded mb-2"></span>
                                                                    <span class="d-block p-1 px-2 pb-0 bg-light-subtle"></span>
                                                                    <span class="d-block p-1 px-2 pb-0 bg-light-subtle"></span>
                                                                    <span class="d-block p-1 px-2 pb-0 bg-light-subtle"></span>
                                                                </span>
                                                            </span>
                                                            <span class="flex-grow-1">
                                                                <span class="d-flex h-100 flex-column">
                                                                    <span class="bg-light d-block p-1"></span>
                                                                    <span class="bg-light d-block p-1 mt-auto"></span>
                                                                </span>
                                                            </span>
                                                        </span>
                                                    </button>
                                                    <h5 class="fs-13 text-center mt-2">Gradient</h5>
                                                </div>
                                            </div>
                                            <!-- end row -->

                                            <div class="collapse" id="collapseBgGradient">
                                                <div class="d-flex gap-2 flex-wrap img-switch p-2 px-3 bg-light rounded">

                                                    <div class="form-check sidebar-setting card-radio">
                                                        <input class="form-check-input" type="radio" name="data-sidebar"
                                                            id="sidebar-color-gradient" value="gradient">
                                                        <label class="form-check-label p-0 avatar-xs rounded-circle"
                                                            for="sidebar-color-gradient">
                                                            <span class="avatar-title rounded-circle bg-vertical-gradient"></span>
                                                        </label>
                                                    </div>
                                                    <div class="form-check sidebar-setting card-radio">
                                                        <input class="form-check-input" type="radio" name="data-sidebar"
                                                            id="sidebar-color-gradient-2" value="gradient-2">
                                                        <label class="form-check-label p-0 avatar-xs rounded-circle"
                                                            for="sidebar-color-gradient-2">
                                                            <span class="avatar-title rounded-circle bg-vertical-gradient-2"></span>
                                                        </label>
                                                    </div>
                                                    <div class="form-check sidebar-setting card-radio">
                                                        <input class="form-check-input" type="radio" name="data-sidebar"
                                                            id="sidebar-color-gradient-3" value="gradient-3">
                                                        <label class="form-check-label p-0 avatar-xs rounded-circle"
                                                            for="sidebar-color-gradient-3">
                                                            <span class="avatar-title rounded-circle bg-vertical-gradient-3"></span>
                                                        </label>
                                                    </div>
                                                    <div class="form-check sidebar-setting card-radio">
                                                        <input class="form-check-input" type="radio" name="data-sidebar"
                                                            id="sidebar-color-gradient-4" value="gradient-4">
                                                        <label class="form-check-label p-0 avatar-xs rounded-circle"
                                                            for="sidebar-color-gradient-4">
                                                            <span class="avatar-title rounded-circle bg-vertical-gradient-4"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="offcanvas-footer border-top p-3 text-center">
                                    <div class="row">
                                        <div class="col-6">
                                            <button type="button" class="btn btn-light w-100" id="reset-layout">@lang("translation.reset")</button>
                                        </div>
                                        <div class="col-6">
                                            <button type="submit" class="btn btn-primary w-100">@lang("translation.submit")</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                
                        </div>
                       
                    </div>
                </div><!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->

@endsection
@section('script')
    <script>
        window.translations = {
            dragAndDrop: "{{ __('translation.dragAndDrop') }}",
            yesDeletedIt: "{{ __('translation.yes-delete-it') }}",
            addEmetteur: "{{ __('translation.addEmetteur') }}",
            editEmetteur: "{{ __('translation.editEmetteur') }}",
            selectRegion: "{{ __('translation.selectRegion') }}",
            selectVille: "{{ __('translation.selectVille') }}",
            selectDate: "{{ __('translation.selectDate') }}",
            yes: "{{ __('translation.yes') }}",
            close: "{{ __('translation.close') }}",
            thisFieldRequired: "{{ __('translation.this-field-required') }}"
        }
    </script>

    <script>
        const regionsSelect = document.getElementById("region-field");
        const regionVal = new Choices(regionsSelect);
    </script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
@endsection
