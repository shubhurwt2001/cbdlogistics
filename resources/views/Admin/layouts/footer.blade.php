 <!-- /.content-wrapper -->
 <footer class="main-footer">
     <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong>
     All rights reserved.
     <div class="float-right d-none d-sm-inline-block">
         <b>Version</b> 3.2.0
     </div>
 </footer>

 </div>
 <!-- ./wrapper -->

 <!-- jQuery -->
 <script src="{{asset('public/admin/plugins/jquery/jquery.min.js')}}"></script>
 <!-- jQuery UI 1.11.4 -->
 <script src="{{asset('public/admin/plugins/jquery-ui/jquery-ui.min.js')}}"></script>
 <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
 <script>
     $.widget.bridge('uibutton', $.ui.button)
 </script>
 <!-- Bootstrap 4 -->
 <script src="{{asset('public/admin/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
 <!-- ChartJS -->
 <script src="{{asset('public/admin/plugins/chart.js/Chart.min.js')}}"></script>
 <!-- Sparkline -->
 <script src="{{asset('public/admin/plugins/sparklines/sparkline.js')}}"></script>
 <!-- daterangepicker -->
 <script src="{{asset('public/admin/plugins/moment/moment.min.js')}}"></script>
 <script src="{{asset('public/admin/plugins/daterangepicker/daterangepicker.js')}}"></script>
 <!-- Tempusdominus Bootstrap 4 -->
 <script src="{{asset('public/admin/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js')}}"></script>
 <!-- Summernote -->
 <script src="{{asset('public/admin/plugins/summernote/summernote-bs4.min.js')}}"></script>
 <!-- overlayScrollbars -->
 <script src="{{asset('public/admin/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
 <!-- AdminLTE App -->
 <script src="{{asset('public/admin/dist/js/adminlte.js')}}"></script>


 <script src="{{asset('public/admin/plugins/datatables/jquery.dataTables.min.js')}}"></script>
 <script src="{{asset('public/admin/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js')}}"></script>
 <script src="{{asset('public/admin/plugins/datatables-responsive/js/dataTables.responsive.min.js')}}"></script>
 <script src="{{asset('public/admin/plugins/datatables-responsive/js/responsive.bootstrap4.min.js')}}"></script>
 <script src="{{asset('public/admin/plugins/select2/js/select2.full.min.js')}}"></script>
 <script src="{{asset('public/admin/plugins/jquery-validation/jquery.validate.min.js')}}"></script>
 <script src="{{asset('public/admin/plugins/jquery-validation/additional-methods.min.js')}}"></script>

 <script>
     $(".table").DataTable({
         "responsive": true,
         "lengthChange": false,
         "autoWidth": false,
     });

     $('.summernote').summernote()
     $('.select2').select2()


     function reinitializeTable() {
         $(".table").DataTable({
             "responsive": true,
             "lengthChange": false,
             "autoWidth": false,
         });
     }
 </script>
 </body>

 </html>