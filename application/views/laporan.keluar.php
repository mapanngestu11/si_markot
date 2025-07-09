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
                  <form action="<?php echo base_url('laporan/proses_laporan_surat_keluar') ?>" method="POST" target="_blank">
                    <div class="row form-group">
                      <div class="col-md-6">
                        <label>Tanggal Awal</label>
                        <input type="date" name="tgl_awal" class="form-control" required="">
                      </div>
                      <div class="col-md-6">
                        <label>Tanggal akhir</label>
                        <input type="date" name="tgl_akhir" class="form-control" required="">
                      </div>
                    </div>
                    <div class="row">
                      <div class="col-md-6">
                       <button type="submit" class="btn btn-primary">Buat Laporan</button>
                     </div>
                   </div>
                 </form>
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
