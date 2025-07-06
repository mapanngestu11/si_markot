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
              <h1>Data Surat Keluar</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Data Surat Keluar</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">

              <!-- /.card -->
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Data Surat Keluar</h3>
                </div>
                <!-- /.card-header -->

                <div class="card-body">
                 <?php 
                 $hak_akses =  $this->session->userdata('user_level');
                 ?>
                 <?php if ($hak_akses == '2') { ?>
                  <a href="<?= site_url('surat/create_surat_keluar') ?>" class="btn btn-primary"><i class="fas fa-plus"></i> Buat Surat Keluar</a>
                <?php }?>
                <br>
                <br>

                <table id="example1" class="table table-bordered table-striped" style="width: 100%">
                  <thead>
                    <tr>
                      <th>No.</th>
                      <th>Nomor Surat</th>
                      <th>perihal</th>
                      <th>Kepada</th>
                      <th>Ditujukan Oleh</th>
                      <th>Status</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
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
                      <tr>
                        <td style="width: 5%"><?php echo $no;?></td>
                        <td><?php echo $row['no_surat'];?>/<?php echo $row['kode_surat'];?>/<?php echo $bulan_romawi[$bulan];?>/<?php echo $tahun;?></td>
                        <td><?php echo $perihal;?></td>
                        <td><?php echo $kepada;?></td>
                        <td><?php echo $nama;?></td>
                        <td>
                          <?php if ($status == 'Pending') { ?>
                            <span class="badge badge-warning" style="color: white;">Belum Verifikasi</span>
                          <?php }else{?>
                            <span class="badge badge-success">Sudah</span>
                          <?php } ?>
                        </td>
                        <td>
                          <?php if ($status == 'Pending') { ?>
                            <!-- tidak ada tombol -->
                          <?php }else{ ?>
                            <button class="btn btn-primary">Cetak</button>
                          <?php } ?>
                          <?php if ($hak_akses == '2' || $hak_akses == '1') { ?>
                            <a href="<?= site_url('surat/update_surat_keluar/' . $id_surat_keluar); ?>" class="btn btn-warning" style="color: white"> Edit </a> 
                            <button class="btn btn-danger" data-toggle="modal" data-target="#modal-hapus<?php echo $id_surat_keluar;?>"> Hapus</button> 
                          <?php }else{ ?>
                            <a href="<?= site_url('surat/view_surat_keluar/' . $id_surat_keluar); ?>" class="btn btn-primary">Lihat Surat</a>
                          <?php } ?>
                        </td>
                      </tr>

                    <?php endforeach; ?>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->


    <!-- /.modal -->

    <style type="text/css">
      .photo{
        width: 300px;
        height: 150px;
        border: 2px solid #000;
      }
    </style>
    <?php
    $no = 0;
    foreach ($keluar->result_array() as $row) :

      $no++;
      $id_surat_keluar           = $row['id_surat_keluar'];
      $tgl_surat_keluar          = $row['tgl_surat_keluar'];
      $id_kode                   = $row['id_kode'];

      ?>
      <!-- awal modal -->
      <div class="modal fade" id="modal-hapus<?php echo $id_surat_keluar;?>">
        <div class="modal-dialog modal-lg">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Hapus Data Surat Keluar</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form action="<?= site_url('surat/proses_delete_surat_keluar') ?>" method="POST" enctype="multipart/form-data">
               <div class="form-group">
                <p>Apakah Kamu yakin ingin menghapus surat keluar pada tanggal, <strong><?php echo $tgl_surat_keluar;?></strong></p>
                <input type="hidden" name="tgl_surat_keluar" value="<?php echo $tgl_surat_keluar;?>">
                <input type="hidden" name="id_kode" value="<?php echo $id_kode;?>">
              </div>
            </div>
            <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </div>
        </form>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>

  <?php endforeach;?>




</div>

<?php include 'layouts/footer.php';?>

<!-- Control Sidebar -->
<aside class="control-sidebar control-sidebar-dark">
  <!-- Control sidebar content goes here -->
</aside>
<!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<?php include 'layouts/js.php';?>
</body>
</html>
