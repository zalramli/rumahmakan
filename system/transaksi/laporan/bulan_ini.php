<?php 
include "../../../koneksi/koneksi.php";
include "../../../koneksi/function.php";
$tgl = date('F Y');
$tgl_judul = date('F-Y');
$html = '
<h2>Laporan Penjualan Bulan '.$tgl.'</h2>
<table border="1" width="100%" cellspacing="0">
						<thead>
							<tr style="background-color:black;color:white;">
								<th style="text-align:center"><p style="font-size:20px;">Kode Penjualan</p></th>
								<th style="text-align:center"><p>Tanggal</p></th>
								<th style="text-align:center"><p>Yang Melayani</p></th>
								<th style="text-align:center"><p>Total Harga</p></th>
							</tr>
						</thead>
                        <tbody>';
                        $grand_total = 0;
                        $query_hari = mysqli_query($koneksi, "SELECT * FROM penjualan JOIN user USING(kode_user) WHERE MONTH(tanggal_penjualan) = MONTH(CURDATE()) AND YEAR(tanggal_penjualan) = YEAR(CURDATE()) ORDER BY kode_penjualan DESC");
                        foreach ($query_hari as $data_hari) :
                            $grand_total += $data_hari['total_harga'];
                        $html.='
							<tr>
                                <td>'.$data_hari['kode_penjualan'].'</td>
                                <td>'. tgl_indo($data_hari['tanggal_penjualan']) .'</td>
                                <td>'.$data_hari['nama_user'].'</td>
                                <td style="text-align:right">'.rupiah($data_hari['total_harga']).'</td>
							</tr>';
                        endforeach;
                        $html.='
                        <tr>
                        <td style="text-align:right" colspan="3">Grand Total</td>
                        <td style="text-align:right">'.rupiah($grand_total).'</td>
                        </tr>
                        </tbody>
					</table>';
$filename = "Laporan_".$tgl_judul;

// include autoloader
require_once '../../../assets/library/dompdf/autoload.inc.php';

// reference the Dompdf namespace
use Dompdf\Dompdf;

// instantiate and use the dompdf class
$dompdf = new Dompdf();

$dompdf->loadHtml($html);

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream($filename,array("Attachment"=>0));
?>