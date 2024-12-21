@extends('layouts.master')
@section('title')
    @lang('translation.mail')
@endsection
@section('css')
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">@lang("translation.mail-list")</h4>
                </div><!-- end card header -->
                <div class="card-body border border-dashed border-end-0 border-start-0">
                    <form action="{{ url('/mail-filter') }}" method="POST" >
                        @csrf
                        @method("POST")
                        <div class="row g-3">
                            <div class="col-xxl-3 col-sm-4">
                                <div class="input-light">
                                    <select class="form-control" 
                                        name="type" id="typeSelect">
                                        <option value="all" selected>@lang('translation.type')</option>
                                        <option {{ ($sType ?? null) && $sType == "SORTANT" ? 'selected' : "" }} value="SORTANT">@lang('translation.SORTANT')</option>
                                        <option {{ ($sType ?? null) && $sType == "ENTRANT" ? 'selected' : "" }} value="ENTRANT">@lang('translation.ENTRANT')</option>
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-3 col-sm-4">
                                <div class="input-light">
                                    <select class="form-control"
                                        name="year" id="yearSelect" name='year'>
                                        <option value="all" selected>@lang('translation.year')</option>
                                        @foreach(range(date('Y'), date('Y') - 9) as $year)
                                            <option {{ ($sYear ?? null) && $sYear == $year ? 'selected' : "" }} value="{{ $year }}">{{ $year }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <!--end col-->
                            <div class="col-xxl-1 col-sm-4">
                                <button type="submit" class="btn btn-primary w-100"> <i
                                        class="ri-equalizer-fill me-1 align-bottom"></i>
                                    Filters
                                </button>
                            </div>
                            <!--end col-->
                        </div>
                        <!--end row-->
                    </form>
                </div>
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ url('/mail/create') }}">
                                        <button class="btn btn-primary add-btn"  id="create-btn" >
                                            <i class="ri-add-line align-bottom me-1"></i>
                                            @lang("translation.addMail")
                                        </button>
                                    </a>
                                    <button class="btn btn-soft-danger" onClick="deleteMultiple()"><i
                                            class="ri-delete-bin-2-line"></i></button>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control search" placeholder="Search...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="table-responsive table-card mt-3 mb-1">
                            <table class="table align-middle table-nowrap" id="customerTable">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll"
                                                    value="option">
                                            </div>
                                        </th>
                                        <th class="sort px-2" data-sort="id">ID</th>
                                        <th class="sort" data-sort="object">@lang("translation.object")</th>
                                        <th >@lang("translation.reception-jour")</th>
                                        <th class="sort" data-sort="type">@lang("translation.type")</th>
                                        <th >@lang("translation.action")</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach($mails as $mail)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child"
                                                    value="option1">
                                            </div>
                                        </th>
                                        <td class="id px-3"><a href="mail/{{ $mail->id }}"
                                                class="fw-medium link-primary">{{ $mail->id }}</a></td>
                                        <td class="object">{{ $mail->object }}</td>
                                        <td class="reception-jour">{{ $mail->reception_jour }}</td>
                                        <td class="type">
                                            @if($mail->type == "ENTRANT")
                                            <span class="badge bg-success-subtle text-success text-uppercase">@lang("translation.entrant")</span>
                                            @else
                                            <span class="badge bg-danger-subtle text-danger text-uppercase">@lang("translation.sortant")</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="view">
                                                    <a href="{{ url( '/mail'.'/'.$mail->id )}}">
                                                    <button class="btn btn-sm btn-success edit-item-btn">
                                                        <i class='ri-eye-fill align-middle'></i>
                                                    </button>
                                                    </a>
                                                </div>
                                                <div class="edit">
                                                    <a href="{{ url( '/mail'.'/'.$mail->id. '/edit')}}">
                                                    <button class="btn btn-sm btn-primary edit-item-btn">
                                                        <i class="ri-pencil-fill align-bottom"></i>
                                                    </button>
                                                    </a>
                                                </div>
                                                <div class="remove">
                                                    <button class="btn btn-sm btn-danger remove-item-btn"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#deleteRecordModal">
                                                        <i class="ri-delete-bin-5-fill align-bottom"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <div class="noresult" style="display: none">
                                <div class="text-center">
                                    <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop"
                                        colors="primary:#25a0e2,secondary:#00bd9d" style="width:75px;height:75px">
                                    </lord-icon>
                                    <h5 class="mt-2">Sorry! No Result Found</h5>
                                    <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any
                                        orders for you search.</p>
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-end">
                            <div class="pagination-wrap hstack gap-2">
                                <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                    Previous
                                </a>
                                <ul class="pagination listjs-pagination mb-0"></ul>
                                <a class="page-item pagination-next" href="javascript:void(0);">
                                    Next
                                </a>
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


    <!-- Modal -->
    <div class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop"
                            colors="primary:#25a0e2,secondary:#00bd9d" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>@lang("translation.are-you-sure")</h4>
                            <p class="text-muted mx-4 mb-0">@lang("translation.are-you-sure-message")</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">@lang("translation.close")</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-record">@lang("translation.yes-delete-it")</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->
@endsection
@section('script')
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>

    <!-- listjs init -->
    {{-- <script src="{{ URL::asset('build/js/pages/listjs.init.js') }}"></script> --}}

    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/mail-list.js') }}"></script>
    <script>
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        window.translations = {
            yesDeletedIt: "{{ __('translation.yes-delete-it') }}",
        }

        refreshCallbacks();
        
    </script>
@endsection


