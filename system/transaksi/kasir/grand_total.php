<?php 
        $sub_total = 0;
        $total = 0;

        if (isset($_POST['kode_barang']) && isset($_POST['qty']) && isset($_POST['harga'])) {

            for ($i = 0; $i < count($_POST['kode_barang']); $i++) {

                $harga_jual_temp = $_POST['harga'][$i];
                $harga_jual = (int) preg_replace("/[^0-9]/", "", $harga_jual_temp);

                $qty_temp =  $_POST['qty'][$i];
                $qty = (int) $qty_temp;

                $perhitungan = $harga_jual * $qty;

                $sub_total = $sub_total + $perhitungan;
            }

            $total = $sub_total;
        }
        if($total == 0)
        {
            $total = " ";
        }
        echo $total;

?>