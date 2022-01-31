

<!-- jQuery -->
<script src="{{ asset('adminLTE') }}/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('adminLTE') }}/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('adminLTE') }}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Bootstrap 5 -->
<script src="{{ asset('bootstrap') }}/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- ChartJS -->
<script src="{{ asset('adminLTE') }}/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('adminLTE') }}/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('adminLTE') }}/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('adminLTE') }}/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('adminLTE') }}/plugins/moment/moment.min.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('adminLTE') }}/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('adminLTE') }}/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('adminLTE') }}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('adminLTE') }}/dist/js/adminlte.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('adminLTE') }}/dist/js/pages/dashboard.js"></script>
<!-- DataTables  & Plugins -->
<script src="{{ asset('adminLTE') }}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/jszip/jszip.min.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{ asset('adminLTE') }}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Sweet Alert -->
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('sweetalert2') }}/dist/sweetalert2.min.js"></script>
<link rel="stylesheet" href="{{ asset('sweetalert2') }}/dist/sweetalert2.min.css">

@stack('script')
</body>
</html>