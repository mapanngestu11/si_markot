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
                 <form action="<?php echo base_url('surat/proses_add_surat_keluar') ?>" method="POST" enctype="multipart/form-data">
                  <div class="row">
                    <div class="col-md-4">
                      <label>Tanggal Surat keluar</label>
                      <input type="date" name="tgl_surat_keluar" class="form-control">
                    </div>
                    <div class="col-md-3">
                      <label>Nomor Surat</label>
                      <input type="text" name="no_surat" class="form-control" id="no_surat" readonly="">
                    </div>
                    <div class="col-md-5">
                      <label>Kode Surat</label>
                      <select class="form-control" name="id_kode" id="cek_kode">
                        <option value=""> Pilih </option>
                        <?php foreach ($kode_surat->result_array() as $ks ):
                          $kode_surat = $ks['kode_surat'];
                          $idks    = $ks['id_kode'];
                          ?> 
                          <option value="<?php echo $idks;?>"><?php echo $kode_surat;?></option>
                        <?php endforeach;?>
                      </select>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-6">
                      <label>Bulan</label>
                      <select class="form-control" name="bulan">
                        <option value=""> Pilih </option>
                        <option value="Januari">Januari</option>
                        <option value="Februari">Februari</option>
                        <option value="Maret">Maret</option>
                        <option value="April">April</option>
                        <option value="Mei">Mei</option>
                        <option value="Juni">Juni</option>
                        <option value="Juli">Juli</option>
                        <option value="Agustus">Agustus</option>
                        <option value="September">September</option>
                        <option value="Oktober">Oktober</option>
                        <option value="November">November</option>
                        <option value="Desember">Desember</option>
                      </select>
                    </div>
                    <div class="col-md-6">
                      <label>Tahun</label>
                      <select class="form-control" name="tahun">
                        <option value=""> Pilih </option>
                        <option value="2023">2023</option>
                        <option value="2024">2024</option>
                        <option value="2025">2025</option>
                      </select>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-12">
                      <label>Lampiran</label>
                      <input type="file" name="lampiran" id="lampiran" class="form-control" accept="application/pdf">
                      <p id="jumlah_halaman"></p>
                    </div>
                  </div>
                  <div class="row mt-2">
                    <div class="col-md-6">
                      <label>Perihal</label>
                      <input type="text" name="perihal" class="form-control">
                    </div>
                    <div class="col-md-6">
                      <label>Kepada / Tujuan</label>
                      <input type="text" name="kepada" class="form-control">
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
                          <textarea name="isi_surat" id="summernote"></textarea>
                        </div>
                      </div>
                    </div>
                  </div>

                  <div class="row mt-3">
                    <div class="col-md-8">
                      <label>Disahkan Oleh :</label>
                      <select class="select2" name="nip_pegawai[]" multiple="multiple" data-placeholder="Pilih Pegawai" style="width: 100%;" required="">
                        <?php foreach ($pegawai->result_array() as $pg): ?>
                          <option value="<?= $pg['nip_pegawai']; ?>">
                            <?= $pg['nama']; ?> | [PIMPINAN]
                          </option>
                        <?php endforeach; ?>
                      </select>
                    </div>
                  </div>
                </div>
                <hr>
                <a href="<?php echo base_url('surat/keluar') ?>" class="btn btn-secondary">Kembali</a>
                <button type="submit" class="btn btn-primary">Buat Surat</button>
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
