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
              <h1>Buat Surat Masuk</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Surat Masuk</li>
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
                  Buat Surat Masuk
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <form action="<?php echo base_url('surat/proses_add_surat_masuk') ?>" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <div class="row">
                      <div class="col-md-6">
                        <label>Sifat Surat</label>
                        <select class="form-control" name="sifat_surat" required="">
                          <option value=""> Pilih </option>
                          <option value="Rahasia"> Rahasia </option>
                          <option value="Penting"> Penting </option>
                          <option value="Rutin/Biasa"> Rutin/Biasa </option>
                          <option value="Segera/Darurat"> Segera/Darurat </option>
                        </select>
                      </div>
                      <div class="col-md-6">
                        <label>Tanggal Terima</label>
                        <input type="date" name="tgl_terima" class="form-control" required="">
                      </div>
                    </div>
                    <div class="row mt-2">
                      <div class="col-md-12">
                       <label>Nomor Agenda</label>
                       <input type="text" name="no_agenda" class="form-control" value="<?php echo $no_agenda;?>" readonly>
                     </div>
                   </div>
                   <div class="row mt-2">
                     <div class="col-md-12">
                       <label>Perihal</label>
                       <input type="text" name="perihal" class="form-control" required="" placeholder="Hal.">
                     </div>
                   </div>
                   <div class="row mt-2">
                    <div class="col-md-12">
                     <label>Nomor Surat.</label>
                     <input type="text" name="no_surat" class="form-control">
                   </div>
                 </div>
                 <div class="row mt-2">
                  <div class="col-md-6">
                    <label>Tanggal Surat</label>
                    <input type="date" name="tgl_surat_masuk" class="form-control" required="">
                  </div>
                  <div class="col-md-6">
                    <label>Asal Surat</label>
                    <input type="text" name="asal_surat" class="form-control" required="" placeholder="Asal Surat">
                  </div>
                </div>
                <div class="row mt-2">
                  <div class="col-md-12"> 
                    <label>File Surat Masuk</label>
                    <input type="file" name="file_surat_masuk" id="file_surat_masuk" class="form-control" accept="application/pdf">
                    <p id="jumlah_halaman"></p>
                  </div>
                </div>
                <div class="row mt-3">
                 <div class="col-md-8">
                  <label>Disposisi Kepada :</label>
                  <select class="select2" name="nip_pegawai[]" multiple="multiple" data-placeholder="Pilih Pimpinan" style="width: 100%;">
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
            <a href="<?php echo base_url('surat/masuk') ?>" class="btn btn-secondary">Kembali</a>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.4.120/pdf.min.js"></script>

<script>
  document.getElementById('file_surat_masuk').addEventListener('change', function(e) {
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
