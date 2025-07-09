<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Surat PMI</title>
  <style>
    body {
      font-family: 'Arial', sans-serif;
      margin: 40px;
      line-height: 1.6;
    }
    .header img {
      float: right;
      width: 100px;
    }
    .header h2 {
      margin: 0;
    }
    .clear {
      clear: both;
    }
    .kop {
      border-top: 8px solid red;
      padding-top: 10px;
      margin-bottom: 20px;
    }
    .ttd {
      margin-top: 40px;
    }
    .img_ttd{
      width: 10%;
      margin-top: -20px;
    }
  </style>
</head>
<body>

  <div class="header kop">
    <img src="<?= base_url('assets/upload/logopmi_1.jpeg'); ?>" alt="PMI Logo">
    <h2>Palang Merah Indonesia</h2>
  </div>
  <div class="clear"></div>

  <?php foreach ($sk->result_array() as $ck) : ?>

    <p>Tangerang, <?= format_tanggal_indo($ck['tgl_surat_keluar']); ?></p>

    <?php
    foreach ($keluar->result_array() as $row) :
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
      ?>
      <table style="border-collapse: collapse;">
        <tr>
          <td style="width: 100px;">No.</td>
          <td>: <?= $row['no_surat']; ?>/<?= $row['kode_surat']; ?>/<?= $bulan_romawi[$bulan]; ?>/<?= $tahun; ?></td>
        </tr>
        <tr>
          <td>Lampiran</td>
          <td>: 1 (satu) berkas</td>
        </tr>
        <tr>
          <td>Perihal</td>
          <td>: <strong><?= $ck['perihal']; ?></strong></td>
        </tr>
      </table>
    <?php endforeach; ?>

    <p>
      Kepada Yth,<br>
      <strong><?= $ck['kepada']; ?></strong><br>
      Di<br>
      Tempat
    </p>

    <p><?= $ck['isi_surat']; ?></p>

    <?php foreach ($pegawai->result_array() as $tp) : ?>
      <div class="ttd">
        <p>Pengurus<br>
          <strong>PALANG MERAH INDONESIA</strong><br>
          Kota Tangerang
        </p>
        <img class="img_ttd"src="<?= base_url('assets/upload/'); ?><?= $tp['ttd'];?>">
        <p><strong><?= $tp['nama']; ?></strong><br>
          <?= $tp['jabatan'];?></p>
        </div>
      <?php endforeach; ?>

    <?php endforeach; ?>


  </body>

  <script>
    window.onload = function () {
      window.print();
    };
  </script>
  </html>
