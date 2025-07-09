<!-- jQuery -->
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
	$.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?php echo base_url()."assets/"; ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="<?php echo base_url()."assets/"; ?>plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="<?php echo base_url()."assets/"; ?>plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="<?php echo base_url()."assets/"; ?>plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="<?php echo base_url()."assets/"; ?>plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="<?php echo base_url()."assets/"; ?>plugins/moment/moment.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="<?php echo base_url()."assets/"; ?>plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="<?php echo base_url()."assets/"; ?>plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="<?php echo base_url()."assets/"; ?>plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo base_url()."assets/"; ?>dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo base_url()."assets/"; ?>dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo base_url()."assets/"; ?>dist/js/pages/dashboard.js"></script>


<!-- CodeMirror -->
<script src="<?php echo base_url()."assets/"; ?>plugins/codemirror/codemirror.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/codemirror/mode/css/css.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/codemirror/mode/xml/xml.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/codemirror/mode/htmlmixed/htmlmixed.js"></script>
<!-- Select2 -->
<script src="<?php echo base_url()."assets/"; ?>plugins/select2/js/select2.full.min.js"></script>

<!-- DataTables  & Plugins -->
<script src="<?php echo base_url()."assets/"; ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo base_url()."assets/"; ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- Toastr -->
<script src="<?php echo base_url()."assets/"; ?>plugins/toastr/toastr.min.js"></script>
<!-- bs-custom-file-input -->
<script src="<?php echo base_url()."assets/"; ?>plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- SweetAlert2 -->
<script src="<?php echo base_url()."assets/"; ?>plugins/sweetalert2/sweetalert2.min.js"></script>
<script>
	$(function () {
		$('.select2').select2()
    // Summernote dengan tinggi 300px
    $('#summernote').summernote({
      height: 300 // atur tinggi di sini (dalam px)
  });

    // CodeMirror
    CodeMirror.fromTextArea(document.getElementById("codeMirrorDemo"), {
    	mode: "htmlmixed",
    	theme: "monokai"
    });
});
</script>

<script>
	$(function () {
		bsCustomFileInput.init();
	});
</script>

<script>
	$(function () {
		$("#example1").DataTable({
			"responsive": false,
			"lengthChange": false,
			"autoWidth": false,
			"scrollX": true,
			"buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
		}).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
	});
</script>


<script>
	const Toast = Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 2000,
		timerProgressBar: true
	});
</script>


<?php if ($this->session->flashdata('toast')): ?>
	<script>
		$(function () {


			var toast = <?= $this->session->flashdata('toast') ?>;
			Toast.fire({
				icon: toast.icon,     
				title: toast.title
			});
		});
	</script>
<?php endif; ?>

