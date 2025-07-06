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
              <h1>Update Surat Keluar</h1>
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
                  Update Surat Keluar
                </h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="form-group">
                  <form action="<?php echo base_url('surat/proses_update_surat_keluar') ?>" method="POST" enctype="multipart/form-data">
                    <?php 

                    foreach ($sk->result_array() as $data_sk) :?>

                      <div class="row">
                        <div class="col-md-4">
                          <label>Tanggal Surat keluar</label>
                          <input type="date" name="tgl_surat_keluar" class="form-control" value="<?php echo $data_sk['tgl_surat_keluar'];?>">
                        </div>
                        <?php 
                        foreach ($skid->result_array() as $kdid) :?>
                          <div class="col-md-3">
                            <label>Nomor Surat</label>
                            <input type="text" name="no_surat" class="form-control" id="no_surat" value="<?php echo $kdid['no_surat'];?>" readonly="">
                          </div>
                          <div class="col-md-5">
                            <label>Kode Surat</label>
                            <select class="form-control" name="id_kode" id="cek_kode">
                              <option value="<?php echo $kdid['id_kode'];?>"> <?php echo $kdid['kode_surat'];?> </option>
                              <?php foreach ($kode_surat->result_array() as $ks ):
                                $kode_surat = $ks['kode_surat'];
                                $idks    = $ks['id_kode'];
                                ?> 
                                <option value="<?php echo $idks;?>"><?php echo $kode_surat;?></option>
                              <?php endforeach;?>
                            </select>
                          </div>
                        <?php endforeach; ?>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-6">
                          <label>Bulan</label>
                          <select class="form-control" name="bulan">
                            <option value="<?php echo $data_sk['bulan'];?>"> <?php echo $data_sk['bulan'];?> </option>
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
                            <option value="<?php echo $data_sk['tahun'];?>"> <?php echo $data_sk['tahun'];?> </option>
                            <option value="2023">2023</option>
                            <option value="2024">2024</option>
                            <option value="2025">2025</option>
                          </select>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-8"> 
                          <label>Lampiran</label>
                          <input type="file" name="lampiran" id="lampiran" class="form-control" accept="application/pdf">
                          <p id="jumlah_halaman"></p>
                        </div>
                        <div class="col-md-4">
                          <label>Download File Surat</label>
                          <br>
                          <a href="<?php echo base_url()."assets/upload/"; ?><?php echo $data_sk['lampiran'];?>">Link Download</a>
                        </div>
                      </div>
                      <div class="row mt-2">
                        <div class="col-md-6">
                          <label>Perihal</label>
                          <input type="text" name="perihal" class="form-control" value="<?php echo $data_sk['perihal'];?>">
                        </div>
                        <div class="col-md-6">
                          <label>Kepada / Tujuan</label>
                          <input type="text" name="kepada" class="form-control" value="<?php echo $data_sk['kepada'];?>">
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
                              <textarea name="isi_surat" id="summernote"><?php echo $data_sk['isi_surat'];?></textarea>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="row mt-3">
                        <div class="col-md-8">
                          <label>Disahkan Oleh :</label>

                          <?php

                          $hak_akses =  $this->session->userdata('user_level');
                          $nama_login =  $this->session->userdata('nama');
                          $nip_login =  $this->session->userdata('nip_pegawai');    
                          
                          if ($hak_akses == '1') { ?>
                            <input type="text" class="form-control" readonly="" value="<?php echo $nama_login;?>">
                            <input type="hidden" name="nip_pegawai" class="form-control" value="<?php echo $nip_login;?>">
                          <?php }else{ ?>
                            <select class="select2" name="nip_pegawai[]" multiple="multiple" data-placeholder="Select a State" style="width: 100%;"  required="">
                              <?php foreach ($pegawai->result_array() as $pg): ?>
                                <option value="<?php echo $pg['nip_pegawai']; ?>">
                                  <?php echo $pg['nama']; ?> | [PIMPINAN]
                                </option>
                              <?php endforeach; ?>
                            </select>
                          <?php }?>
                        </div>
                        <div class="col-md-4">
                          <label>Status Surat</label>

                          <?php

                          $hak_akses =  $this->session->userdata('user_level');
                          if ($hak_akses == '1') { ?>
                            <select class="form-control" name="status" required="">
                              <option value=""> Pilih </option>
                              <option value="Pending">Pending</option>
                              <option value="Accept">Accept</option>
                            </select>
                          <?php }else{ ?>
                            <?php 
                            $status = $data_sk['status'];
                            if ($status == 'Pending') { ?>
                              <input type="text" name="status" class="form-control bg-warning" value="<?php echo $status;?>" readonly>
                            <?php }else{?>
                              <input type="text" name="status" class="form-control bg-success" value="<?php echo $status;?>" readonly>
                            <?php } ?>
                          <?php }?>
                        </div>
                      </div>
                    </div>
                    <hr>
                    <a href="<?php echo base_url('surat/keluar') ?>" class="btn btn-secondary">Kembali</a>
                    <button type="submit" class="btn btn-primary">Update Surat</button>
                  </div>
                <?php endforeach;?>
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
