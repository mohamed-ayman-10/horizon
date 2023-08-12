<!-- JQUERY JS -->
{{--<script src="{{asset('assets/js/jquery.min.js')}}"></script>--}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"
        integrity="sha512-3gJwYpMe3QewGELv8k/BX9vcqhryRdzRMxVfq6ngyWXwo03GFEzjsUm8Q7RZcHPHksttq7/GFoxjCVUjkjvPdw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

<!-- BOOTSTRAP JS -->
<script src="{{asset('assets')}}/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{asset('assets')}}/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- SPARKLINE JS-->
<script src="{{asset('assets')}}/js/jquery.sparkline.min.js"></script>

<!-- Sticky js -->
<script src="{{asset('assets')}}/js/sticky.js"></script>

<!-- CHART-CIRCLE JS-->
<script src="{{asset('assets')}}/js/circle-progress.min.js"></script>

<!-- PIETY CHART JS-->
<script src="{{asset('assets')}}/plugins/peitychart/jquery.peity.min.js"></script>
<script src="{{asset('assets')}}/plugins/peitychart/peitychart.init.js"></script>

<!-- SIDEBAR JS -->
<script src="{{asset('assets')}}/plugins/sidebar/sidebar.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="{{asset('assets')}}/plugins/p-scroll/perfect-scrollbar.js"></script>
<script src="{{asset('assets')}}/plugins/p-scroll/pscroll.js"></script>
<script src="{{asset('assets')}}/plugins/p-scroll/pscroll-1.js"></script>

<!-- INTERNAL CHARTJS CHART JS-->
<script src="{{asset('assets')}}/plugins/chart/Chart.bundle.js"></script>
<script src="{{asset('assets')}}/plugins/chart/utils.js"></script>

<!-- INTERNAL SELECT2 JS -->
<script src="{{asset('assets')}}/plugins/select2/select2.full.min.js"></script>

<!-- INTERNAL Data tables js-->
<script src="{{asset('assets')}}/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{asset('assets')}}/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="{{asset('assets')}}/plugins/datatable/dataTables.responsive.min.js"></script>

<!-- INTERNAL APEXCHART JS -->
<script src="{{asset('assets')}}/js/apexcharts.js"></script>
<script src="{{asset('assets')}}/plugins/apexchart/irregular-data-series.js"></script>

<!-- INTERNAL Flot JS -->
<script src="{{asset('assets')}}/plugins/flot/jquery.flot.js"></script>
<script src="{{asset('assets')}}/plugins/flot/jquery.flot.fillbetween.js"></script>
<script src="{{asset('assets')}}/plugins/flot/chart.flot.sampledata.js"></script>
<script src="{{asset('assets')}}/plugins/flot/dashboard.sampledata.js"></script>

<!-- INTERNAL Vector js -->
<script src="{{asset('assets')}}/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="{{asset('assets')}}/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- SIDE-MENU JS-->
<script src="{{asset('assets')}}/plugins/sidemenu/sidemenu.js"></script>

<!-- TypeHead js -->
<script src="{{asset('assets')}}/plugins/bootstrap5-typehead/autocomplete.js"></script>
<script src="{{asset('assets')}}/js/typehead.js"></script>

<!-- INTERNAL INDEX JS -->
<script src="{{asset('assets')}}/js/index1.js"></script>

<!-- Color Theme js -->
<script src="{{asset('assets')}}/js/themeColors.js"></script>

<!-- CUSTOM JS -->
<script src="{{asset('assets')}}/js/custom.js"></script>

<!-- Custom-switcher -->
<script src="{{asset('assets')}}/js/custom-swicher.js"></script>

<!-- Switcher js -->
<script src="{{asset('assets')}}/switcher/js/switcher.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"
        integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

@if(Session::has('success'))
    <script>
        toastr.options = {
            "progressBar": true,
            "closeButton": true,
        }
        toastr.success("{{Session::get('success')}}", "Success!", {timeOut: 4000})
    </script>
@endif
@if($errors->any())
    @foreach($errors->all() as $error)
        <script>
            toastr.options = {
                "progressBar": true,
                "closeButton": true,
            }
            toastr.error("{{$error}}")
        </script>
    @endforeach
@endif

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
@yield('scripts')
