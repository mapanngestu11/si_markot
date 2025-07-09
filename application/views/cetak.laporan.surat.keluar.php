<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Laporan Surat Keluar</title>
  <style>
    body {
      font-family: "Times New Roman", Times, serif;
      margin: 20px;
    }

    table.kop {
      width: 100%;
      border-bottom: 3px solid black;
      padding-bottom: 10px;
      margin-bottom: 20px;
    }

    table.kop td {
      vertical-align: top;
    }

    .text-center {
      text-align: center;
    }

    .text-left {
      text-align: left;
    }

    table.laporan {
      width: 100%;
      border-collapse: collapse;
      margin-top: 10px;
    }

    table.laporan th, table.laporan td {
      border: 1px solid black;
      padding: 6px;
      font-size: 14px;
    }

    table.laporan th {
      background-color: #f2f2f2;
    }

    @media print {
      body {
        margin: 0;
      }
    }
  </style>
</head>
<body>

  <!-- Kop Surat -->
  <table class="kop">
    <tr>
      <td style="width: 17%;">
        <img src="<?= base_url('assets/upload/logopmi.jpg'); ?>" width="100%">
      </td>
      <td class="text-center">
        <h3 style="margin: 0;">PALANG MERAH INDONESIA</h3>
        <h4 style="margin: 0;">KOTA TANGERANG</h4>
        <p style="margin: 0; font-size: 14px;">
          Jl. Masjid Al-Hidayah No.2, RT.001/RW.001, Klp. Indah, <br>
          Kec. Tangerang, Kota Tangerang.
        </p>
      </td>
      <td style="width: 15%;"></td>
    </tr>
  </table>

  <!-- Judul Laporan -->
  <h4 class="text-center" style="text-decoration: underline;">LAPORAN SURAT KELUAR</h4>
  <p class="text-center">Periode: <?= $this->input->post('tgl_awal'); ?> s/d <?= $this->input->post('tgl_akhir'); ?></p>

  <!-- Tabel Data -->
  <table class="laporan">
    <thead>
      <tr>
        <th>No</th>
        <th>Tanggal Surat Keluar</th>
        <th>Nomor Surat</th>
        <th>Perihal</th>
        <th>Kepada</th>
        <th>Nama</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($laporan) && $laporan->num_rows() > 0): ?>
      <?php $no = 1; foreach ($laporan->result_array() as $row):
      $bulan = $row['bulan'];
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
      ?>
      <tr>
        <td><?= $no++; ?></td>
        <td><?= date('d-m-Y', strtotime($row['tgl_surat_keluar'])); ?></td>
        <td><?= $row['no_surat'];?>/<?php echo $row['kode_surat'];?>/<?php echo $bulan_romawi[$bulan];?>/<?php echo $tahun;?></td>
        <td><?= $row['perihal']; ?></td>
        <td><?= $row['kepada']; ?></td>
        <td><?= $row['nama']; ?></td>
      </tr>
    <?php endforeach; ?>
    <?php else: ?>
      <tr>
        <td colspan="8" class="text-center">Tidak ada data tersedia</td>
      </tr>
    <?php endif; ?>
  </tbody>
</table>

<br><br>
<script>
  window.onload = function () {
    window.print();
  };
</script>

</body>
</html>
