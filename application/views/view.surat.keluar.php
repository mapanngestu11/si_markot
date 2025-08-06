<!DOCTYPE html>
<html lang="en">
<?php include 'layouts/head.php';?>
<body class="hold-transition sidebar-mini">
  <div class="wrapper">
    <!-- Navbar -->
    <?php include 'layouts/navbar.php';?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?php include 'layouts/aside.php';?>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Buat Surat Keluar</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Surat Keluar</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card card-outline card-info">
              <div class="card-header">
                <h3 class="card-title">
                  Buat Surat Keluar
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                 <form action="#" method="" enctype="multipart/form-data">
                   <?php foreach ($sk->result_array() as $data_sk): ?>
                    <div class="row">
                      <div class="col-md-4">
                        <label>Tanggal Surat keluar</label>
                        <input type="date" name="tgl_surat_keluar" class="form-control" value="<?php echo $data_sk['tgl_surat_keluar'];?>" readonly>
                      </div>
                      <div class="col-md-3">
                        <?php
                        $no = 0;
                        foreach ($keluar->result_array() as $row) :

                          $no++;
                          $id_surat_keluar           = $row['id_surat_keluar'];
                          $id_kode           = $row['id_kode'];
                          $tgl_surat_keluar                = $row['tgl_surat_keluar'];
                          $perihal                = $row['perihal'];
                          $nip_pegawai = $row['nip_pegawai'];
                          $kepada      = $row['kepada'];
                          $bulan = $row['bulan'];
                          $nama = $row['nama'];
                          $bulan_romawi = [
                            'Januari'   => 'I',
                            'Februari'  => 'II',
                            'Maret'     => 'III',
                            'April'     => 'IV',
                            'Mei'       => 'V',
                            'Juni'      => 'VI',
                            'Juli'      => 'VII',
                            'Agustus'   => 'VIII',
                            'September' => 'IX',
                            'Oktober'   => 'X',
                            'November'  => 'XI',
                            'Desember'  => 'XII'
                          ];
                          $tahun = $row['tahun'];
                          $status = $row['status'];


                          ?>
                          <label>Nomor Surat</label>
                          <input type="text" name="no_surat" class="form-control" value="<?php echo $row['no_surat'];?>/<?php echo $row['kode_surat'];?>/<?php echo $bulan_romawi[$bulan];?>/<?php echo $tahun;?>" id="no_surat" readonly="">
                        <?php endforeach;?>
                      </div>
                      <?php foreach ($skid->result_array() as $kode_sk) : ?>
                        <div class="col-md-5">
                          <label>Kode Surat</label>

                        </div>
                      </div>
                    <?php endforeach;?>
                    <div class="row mt-2">
                      <div class="col-md-6">
                        <label>Bulan</label>
                        <input type="text" name="" class="form-control" value="<?php echo$data_sk['bulan'];?>" readonly="">
                      </div>
                      <div class="col-md-6">
                        <label>Tahun</label>
                        <input type="text" name="" class="form-control" value="<?php echo$data_sk['tahun'];?>" readonly="">
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-12">
                        <label>Download File Surat</label><br>
                        <embed type="application/pdf" src="<?php echo base_url()."assets/upload/"; ?><?= $data_sk['lampiran'];?>" width="100%" height="400"></embed>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-6">
                        <label>Perihal</label>
                        <input type="text" name="perihal" class="form-control" value="<?php echo$data_sk['perihal'];?>" readonly>
                      </div>
                      <div class="col-md-6">
                        <label>Kepada / Tujuan</label>
                        <input type="text" name="kepada" class="form-control" value="<?php echo$data_sk['kepada'];?>" readonly>
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-12">
                        <label>Isi Surat</label>
                        <div class="card card-outline card-info">
                          <div class="card-header">
                            <h3 class="card-title">
                              Tuliskan informasi
                            </h3>
                          </div>
                          <!-- /.card-header -->
                          <div class="card-body">
                           <div class="form-control" style="background-color: #f8f9fa; border: 1px solid #ced4da;">
                            <?php echo $data_sk['isi_surat']; ?>
                          </div>

                        </div>
                      </div>
                    </div>
                  </div>

                </div>
                <hr>
              <?php endforeach;?>
              <a href="<?php echo base_url('surat/keluar') ?>" class="btn btn-secondary">Kembali</a>

            </div>
          </form>
        </div>
      </div>
      <!-- /.col-->
    </div>
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->


<?php include 'layouts/footer.php';?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include 'layouts/js.php';?>
<script>
  $('#cek_kode').change(function() {
    let kode = $(this).val();
    if (kode !== '') {
      $.ajax({
        url: '<?= base_url("surat/cek_nomor_surat"); ?>', 
        method: 'POST',
        data: { id_kode: kode },
        dataType: 'json',
        success: function(res) {
          $('#no_surat').val(res.nomor_surat);
        }
      });
    } else {
      $('#no_surat').val('');
    }
  });

</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>

<script>
  document.getElementById('lampiran').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const output = document.getElementById('jumlah_halaman');

    if (file && file.type === 'application/pdf') {
      const reader = new FileReader();

      reader.onload = function(event) {
        const typedarray = new Uint8Array(event.target.result);

        pdfjsLib.getDocument(typedarray).promise.then(function(pdf) {
          output.textContent = `Jumlah halaman: ${pdf.numPages}`;
        }).catch(function(err) {
          output.textContent = 'Gagal membaca file PDF';
          console.error(err);
        });
      };

      reader.readAsArrayBuffer(file);
    } else {
      output.textContent = 'File bukan PDF';
    }
  });
</script>
</body>
</html>
