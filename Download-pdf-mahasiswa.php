<?php

require __DIR__ . '/vendor/autoload.php';
require 'config/App.php';

use Spipu\Html2Pdf\Html2Pdf;

$data_mahasiswa = select("SELECT * FROM mahasiswa");


$content .= '
    <style type="text/css">
        table {
            border-collapse: collapse;
            max-width: max-content;
        }
        tr, th, td {
            padding: 10px;
        }
        .foto {
            width: 50px;
        }
    </style>';

$content .= '
<page>
    <table border="1" align="center" border-collapsed="collapsed">
        <tr>
            <th>No</th>
            <th>Nama</th>
            <th>Program Studi</th>
            <th>Jenis Kelamin</th>
            <th>Telepon</th>
            <th>Email</th>
            <th>Foto</th>
        </tr>';
$no = 1;
foreach ($data_mahasiswa as $mahasiswa) {
    $content .= '
        <tr>
            <td>' . $no++ . '</td>
            <td>' . $mahasiswa['nama'] . '</td>
            <td>' . $mahasiswa['prodi'] . '</td>
            <td>' . $mahasiswa['jenis_kelamin'] . '</td>
            <td>' . $mahasiswa['telepon'] . '</td>
            <td>' . $mahasiswa['email'] . '</td>
            <td><img src="assets/img/' . $mahasiswa['foto'] . '" class="foto"></td>
        </tr>';
}

$content .= '
    </table>
</page>';

$html2pdf = new Html2Pdf();
$html2pdf->writeHTML($content);
ob_start();
$html2pdf->output('laporan-data-mahasiswa.pdf');
