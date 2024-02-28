<script src="{{ asset('/storage/vendors/base/vendor.bundle.base.js') }}"></script>
<script src="{{ asset('/storage/js/template.js') }}"></script>
<script src="{{ asset('/storage/vendors/chart.js/Chart.min.js') }}"></script>
<script src="{{ asset('/storage/vendors/progressbar.js/progressbar.min.js') }}"></script>
<script src="{{ asset('/storage/vendors/chartjs-plugin-datalabels/chartjs-plugin-datalabels.js') }}"></script>
<script src="{{ asset('/storage/vendors/justgage/raphael-2.1.4.min.js') }}"></script>
<script src="{{ asset('/storage/vendors/justgage/justgage.js') }}"></script>
<script src="{{ asset('/storage/js/jquery.cookie.js') }}" type="text/javascript"></script>
<script src="{{ asset('/storage/js/dashboard.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<script>
    @if(Session::has('message'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.success("{{ session('message') }}");
    @endif

    @if(Session::has('error'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.error("{{ session('error') }}");
    @endif

    @if(Session::has('info'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.info("{{ session('info') }}");
    @endif

    @if(Session::has('warning'))
    toastr.options =
    {
        "closeButton" : true,
        "progressBar" : true
    }
            toastr.warning("{{ session('warning') }}");
    @endif
  </script>
  <script>
    $(function () {
      $('[data-toggle="tooltip"]').tooltip()
    })
  </script>
@stack('admin-scripts')
