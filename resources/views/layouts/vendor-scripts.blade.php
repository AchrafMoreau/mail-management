{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script> --}}


<script src="{{ URL::asset('build/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/feather-icons/feather.min.js') }}"></script>
<script src="{{ URL::asset('build/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
<script src="{{ URL::asset('build/js/plugins.js') }}"></script>
<script>
    const clientSelectElement = document.querySelector('#selectEmetteur');
    if(clientSelectElement){
        const clientSelect = new Choices(clientSelectElement, {
            searchEnabled: true,
            itemSelectText: '',
        });
    }
</script>

<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}";
        var message = "{{ Session::get('message') }}";
        
        switch (type) {
            case 'info':
                toastr.info(message);
                break;
            case 'success':
                toastr.success(message);
                break;
            case 'warning':
                toastr.warning(message);
                break;
            case 'error':
                toastr.error(message);
                break;
        }
    @endif

</script>
<?php
    Session::forget('alert-type');
?>
@yield('script')
@yield('script-bottom')
