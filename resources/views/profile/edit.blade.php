@extends('layouts.master')
@section('title')
    @lang('translation.settings')
@endsection
@section('content')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--  maybe not today mybe not tommorow but some day  -->

    <div class="row mt-5">
        
        <div class="col-xxl-12">
            <div class="card mt-xxl-n5">
                <div class="card-header">
                    <ul class="nav nav-tabs-custom rounded card-header-tabs border-bottom-0" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-bs-toggle="tab" href="#personalDetails" role="tab">
                                <i class="fas fa-home"></i>
                                @lang('translation.personalDetails')
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" data-bs-toggle="tab" href="#changePassword" role="tab">
                                <i class="far fa-user"></i>
                                @lang('translation.changePassword')
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="card-body p-4">
                    <div class="tab-content">
                        <div class="tab-pane active" id="personalDetails" role="tabpanel">
                            <form  method="POST" action="{{ route('profile.update') }}">
                                @csrf
                                @method('patch')
                                <div class="row">
                                    <div class="col-lg-6 my-2">
                                        <div class="mb-3">
                                            <label for="firstnameInput" class="form-label">@lang('translation.fullName')</label>
                                            <input type="text" class="form-control" id="firstnameInput"
                                                placeholder="@lang('translation.enterFullName')" name='name' required value="{{ Auth::user()->name }}">
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-6 my-2">
                                        <div class="mb-3">
                                            <label for="emailInput" class="form-label">@lang('translation.email')</label>
                                            <input type="email" class="form-control" id="emailInput" required  name='email'
                                                placeholder="@lang('translation.enterEmail')" value="{{ Auth::user()->email }}">
                                        </div>
                                    </div>
                                    <div class="col-lg-12 my-2">
                                        <div class="hstack gap-2 justify-content-end">
                                            <button type="submit" class="btn btn-secondary">@lang('translation.edit')</button>
                                            <!-- <button type="button" class="btn btn-soft-danger">@lang('translation.close')</button> -->
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <div class="tab-pane" id="changePassword" role="tabpanel">
                             <form method="POST"  id='updatePassword' class="mt-6 space-y-6">
                                <div class="row g-2 ">
                                    <div class="col-lg-4 my-2">
                                        <div>
                                            <label for="oldpasswordInput" class="form-label">@lang('translation.oldPassword')*</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" name='current_password' class="form-control password-input" id="oldpasswordInput"
                                                    placeholder="@lang('translation.enterOldPass')">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                <span class="invalid-feedback" role="alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 my-2">
                                        <div>
                                            <label for="newpasswordInput" class="form-label">@lang('translation.newPassword')*</label>

                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" name='password' class="form-control password-input" id="newpasswordInput"
                                                    placeholder="@lang('translation.enterNewPass')">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                <span class="invalid-feedback" role="alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    <div class="col-lg-4 my-2">
                                        <div>
                                            <label for="confirmpasswordInput" class="form-label">@lang('translation.confirmPassword')*</label>
                                            <div class="position-relative auth-pass-inputgroup mb-3">
                                                <input type="password" name='password_confirmation' class="form-control password-input" id="confirmpasswordInput"
                                                    placeholder="@lang('translation.confirmPass')">
                                                <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted password-addon" type="button" id="password-addon"><i class="ri-eye-fill align-middle"></i></button>
                                                <span class="invalid-feedback" role="alert"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <!--end col-->
                                    
                                    <!--end col-->
                                    <div class="col-lg-12 my-2">
                                        <div class="text-end">
                                            <button type="submit" id="update-btn" class="btn btn-secondary">@lang('translation.changePassword')</button>
                                        </div>
                                    </div>
                                    <!--end col-->
                                </div>
                                <!--end row-->
                            </form>
                        </div>
                        <!--end tab-pane-->
                        <!--end tab-pane-->
                    </div>
                </div>
            </div>
        </div>
        <!--end col-->
    </div>
    <!--end row-->
@endsection
@section('script')
    <script>
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        $("#updatePassword").on('submit', function(e){
            e.preventDefault()
            console.log("yes")
            const form = e.target;
            let curPass = form.elements['current_password'].value
            let newPass = form.elements['password'].value
            let confirm = form.elements['password_confirmation'].value
            console.log(curPass, newPass, confirm)

            if(curPass === "" || newPass === "" || confirm === ""){
                toastr['error']("@lang('translation.fillAllField')")
            }else{
                if(newPass !== confirm){
                    $('#newpasswordInput').addClass('is-invalid')
                    $('.invalid-feedback').html(`<strong>@lang('translation.passwordDoesntMatch')</strong>`);
                    $('#confirmpasswordInput').val('')
                }else{
                    const inputs = {
                        current_password : curPass,
                        password: newPass,
                        password_confirmation: confirm
                    }
                    $.ajax({
                        url: '{{ route("password.update") }}',
                        method: "PUT",
                        headers:{
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': token
                        },
                        beforeSend: ()=>{
                            $('button#update-btn').html(`<div class="spinner-border text-white" style='width:1rem; height:1rem;' role="status" ><span class="sr-only">loading...</span></div>`)
                        },
                        complete: ()=>{
                            $('button#update-btn').html(``)
                            $('button#update-btn').text("{{ __('translation.updatePassword') }}")
                        },
                        data: JSON.stringify(inputs),
                        success: (res)=>{
                            toastr[res['alert-type']](res.message)
                            $('#confirmpasswordInput').val('')
                            $('#confirmpasswordInput').removeClass('is-invalid')
                            $('#newpasswordInput').val('')
                            $('#newpasswordInput').removeClass('is-invalid')
                            $('#oldpasswordInput').val('')
                            $('#oldpasswordInput').removeClass('is-invalid')
                            $('.invalid-feedback').html(``);
                        },
                        error: (xhr, status, error)=>{
                            const err = xhr.responseJSON.errors

                            for(const key in err){
                                console.log(key)
                                const input = form.elements[key] 
                                if(key == 'current_password'){
                                    input.classList.add('is-invalid');
                                    $(input).next().next('.invalid-feedback').html(`<strong>@lang('translation.incorecctPass')</strong>`);
                                }else if(key === 'password'){
                                    input.classList.add('is-invalid');
                                    $(input).next().next('.invalid-feedback').html(`<strong>@lang('translation.minPass')</strong>`);
                                }else{
                                    input.classList.add('is-invalid');
                                    console.log(input)
                                    $(input).next().next('.invalid-feedback').html(`<strong>${err[key]}</strong>`);
                                }
                            }

                            // $('newpasswordInput').addClass('is-invalid')
                            // $('.invalid-feedback').html(`<strong>passwod does't match</strong>`);
                            // $('newpasswordInput').val('')
                            // $('confirmpasswordInput').val('')
                        }
                    })
                }

            }

        })
    </script>
    <script src="{{ URL::asset('build/js/pages/profile-setting.init.js') }}"></script>
    <script src="{{ URL::asset('build/js/app.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/password-addon.init.js') }}"></script>
@endsection
