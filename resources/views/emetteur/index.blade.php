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
                    <h4 class="card-title mb-0">@lang("translation.emetteur-list")</h4>
                </div><!-- end card header -->

                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-auto">
                                <div>
                                    <button type="button" class="btn btn-primary add-btn" data-bs-toggle="modal"
                                        id="create-btn" data-bs-target="#showModal"><i
                                            class="ri-add-line align-bottom me-1"></i>@lang("translation.addEmetteur")</button>
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
                                        <th class="sort" data-sort="nom">@lang('translation.nom')</th>
                                        <th class="sort" data-sort="ville">@lang('translation.ville')</th>
                                        <th class="sort" data-sort="adresse">@lang('translation.adresse')</th>
                                        <th data-sort="phone">@lang('translation.phone')</th>
                                        <th  data-sort="zip">@lang('translation.zip')</th>
                                        <th data-sort="action">@lang('translation.action')</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child"
                                                    value="option1">
                                            </div>
                                        </th>
                                        <td class="id" style="display:none;"><a href="javascript:void(0);"
                                                class="fw-medium link-primary">#VZ2101</a></td>
                                        <td class="nom">...</td>
                                        <td class="ville">...</td>
                                        <td class="adresse">....</td>
                                        <td class="phone">...</td>
                                        <td class="zip">...</td>
                                        <td>
                                            <div class="d-flex gap-2">
                                                <div class="edit">
                                                    <button class="btn btn-sm btn-primary edit-item-btn"
                                                        data-bs-toggle="modal" data-bs-target="#showModal">
                                                        <i class="ri-pencil-fill align-bottom"></i>
                                                    </button>
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


    <!-- end row -->

    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <div class="mb-3" id="modal-id" style="display: none;">
                            <label for="id-field" class="form-label">ID</label>
                            <input type="text" id="id-field" class="form-control" placeholder="ID" readonly />
                        </div>

                        <div class="mb-3">
                            <label for="customername-field" class="form-label">@lang("translation.nom")</label>
                            <input type="text" id="nom-field" name="nom" class="form-control" placeholder="@lang('translation.enter-nom')"
                                required />
                            <span class="invalid-feedback" role="alert">
                            </span>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="inputAddress" class="form-label">@lang("translation.adresse")</label>
                            <input type="text" required name='adresse' class="form-control" id="adresse-field" placeholder="1234 Main St">
                            <span class="invalid-feedback" role="alert">
                            </span>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="phonenumberInput" class="form-label">@lang('translation.phone')</label>
                            <input type="tel" name="phone"  class="form-control" placeholder="+(245) 451 45123"
                                id="phone-field">
                            <span class="invalid-feedback" role="alert">
                            </span>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-8">
                                <label for="ville-field" class="form-label">@lang("translation.ville")</label>
                                <select class="form-control" data-trigger name="ville" id="ville-field" >
                                    <option value="">@lang('translation.select-ville')</option>
                                    @foreach($villes  as $ville)
                                        <option value="{{ $ville->id }}" >{{ $ville->ville }}</option>
                                    @endforeach
                                </select>
                                <span class="invalid-feedback" role="alert">
                                </span>
                            </div>
                            <div class="col-md-4">
                                <label for="inputZip" class="form-label">@lang('translation.zipCode')</label>
                                <input type="text" name="zip" class="form-control" id="zip-field" placeholder="Zin code">
                                <span class="invalid-feedback" role="alert">
                                </span>
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
    </div>

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
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">@lang('translation.close')</button>
                        <button type="button" class="btn w-sm btn-danger" id="delete-record">@lang('translation.yes-delete-it')</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade zoomIn modal-lg" width="700px" id="documentModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="documentModalTitle">@lang('translation.document')</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"
                        id="clear-src"></button>
                </div>
                <div class="modal-body">
                    <iframe src="" id="iframModal" width="100%" height="500px" frameborder="0" ></iframe>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->
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
        const storagePath = "{{ asset('/storage')}}"
    </script>
    <script src="{{ URL::asset('build/libs/prismjs/prism.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.js/list.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/list.pagination.js/list.pagination.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}"></script>
    <script src="{{ URL::asset('build/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/form-file-upload.init.js') }}"></script>

    <!-- listjs init -->
    <script src="{{ URL::asset('build/js/pages/emetteur-list.init.js') }}"></script>

    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>

@endsection
