</div>
</div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
      <div class="pull-right hidden-xs">
        <b>Version</b> 2.4.0
      </div>
      <strong>Copyright &copy; 2026</strong> - Sistem Informasi Inventory Gudang PT LJP
    </footer>
  </div>
  <!-- ./wrapper -->


  <script src="../assets/bower_components/jquery/dist/jquery.min.js"></script>

  <script src="../assets/bower_components/jquery-ui/jquery-ui.min.js"></script>

  <script>
    $.widget.bridge('uibutton', $.ui.button);
  </script>

  <script src="../assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <script src="../assets/bower_components/raphael/raphael.min.js"></script>
  <script src="../assets/bower_components/morris.js/morris.min.js"></script>

  <script src="../assets/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>


  <script src="../assets/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
  <script src="../assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

  <script src="../assets/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
  <script src="../assets/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

  <script src="../assets/bower_components/jquery-knob/dist/jquery.knob.min.js"></script>

  <script src="../assets/bower_components/moment/min/moment.min.js"></script>
  <script src="../assets/bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>

  <script src="../assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>

  <script src="../assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>

  <script src="../assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

  <script src="../assets/bower_components/fastclick/lib/fastclick.js"></script>

  <script src="../assets/dist/js/adminlte.min.js"></script>

  <script src="../assets/dist/js/pages/dashboard.js"></script>

  <script src="../assets/dist/js/demo.js"></script>
  <script src="../assets/bower_components/ckeditor/ckeditor.js"></script>

  <script>
$(document).ready(function(){

  if ($('#table-datatable').length > 0) {
    $('#table-datatable').DataTable({
      paging      : true,
      lengthChange: true,
      searching   : true,
      ordering    : true,
      info        : true,
      autoWidth   : true,
      scrollX     : false,
      responsive  : true,
      pageLength  : 10,
      order       : [[ 3, "desc" ]],
      language: {
        search: 'Pencarian:',
        lengthMenu: 'Tampilkan _MENU_ data per halaman',
        zeroRecords: 'Data tidak ditemukan',
        info: 'Menampilkan halaman _PAGE_ dari _PAGES_',
        infoEmpty: 'Tidak ada data',
        paginate: {
          first: 'Pertama',
          last: 'Terakhir',
          next: 'Selanjutnya',
          previous: 'Sebelumnya'
        }
      }
    });
  }

});
</script>
  </body>
  </html>
