<?php
function format_tanggal_indo($tanggal) {
	$bulan = [
		1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
		'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
	];

  $pecah = explode('-', $tanggal); // [0]=tahun, [1]=bulan, [2]=hari
  return $pecah[2] . ' ' . $bulan[(int)$pecah[1]] . ' ' . $pecah[0];
}
