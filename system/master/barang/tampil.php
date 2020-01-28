<?php 
if(isset($_POST['simpan']))
{
    // Membuat Kode otomatis
    $sql = mysqli_query($koneksi, "SELECT max(kode_barang) FROM barang");
    $kode_faktur = mysqli_fetch_array($sql);
    if ($kode_faktur) {
        $nilai = substr($kode_faktur[0], 3);
        $kode = (int) $nilai;
        //tambahkan sebanyak + 1
        $kode = $kode + 1;
        $auto_kode = "BRG" . str_pad($kode, 3, "0",  STR_PAD_LEFT);
    } else {
        $auto_kode = "BRG001";
    }

    $kode_kategori_barang = $_POST['kode_kategori_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_jual = str_replace(".", "", $_POST['harga_jual']);

    $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
    $photo = $_FILES['photo']['name'];
    $x = explode('.', $photo);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['photo']['size'];
    $file_tmp = $_FILES['photo']['tmp_name'];	

     if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 1044070){			
            move_uploaded_file($file_tmp, 'assets/img/'.$photo);
        }else{
            echo "<script>Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Ukuran foto terlalu besar!'
            })</script>";
        }
    }else{
            echo "<script>Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Ekstensi file tidak diperbolehkan'
            })</script>";
        
    }


    $query_insert = mysqli_query($koneksi, "INSERT INTO barang (kode_barang,kode_kategori_barang,nama_barang,harga_jual,photo) VALUES ('$auto_kode','$kode_kategori_barang','$nama_barang','$harga_jual','$photo') ");
    if ($query_insert) {
        echo "<script>Swal.fire('Sukses','Data Berhasil Ditambahkan','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=barang';
		});</script>";
    }
}

if(isset($_POST['update']))
{
    $ekstensi_diperbolehkan	= array('png','jpg','jpeg');
    $photo = $_FILES['photo']['name'];
    $x = explode('.', $photo);
    $ekstensi = strtolower(end($x));
    $ukuran	= $_FILES['photo']['size'];
    $file_tmp = $_FILES['photo']['tmp_name'];	

    if(in_array($ekstensi, $ekstensi_diperbolehkan) === true){
        if($ukuran < 1044070){			
            move_uploaded_file($file_tmp, 'assets/img/'.$photo);
        }else{
            echo "<script>Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Ukuran foto terlalu besar!'
            })</script>";
        }
    }else{
            echo "<script>Swal.fire({
            icon: 'error',
            title: 'Gagal',
            text: 'Ekstensi file tidak diperbolehkan'
            })</script>";
        
    }

    $kode_barang = $_POST['kode_barang'];
    $kode_kategori_barang = $_POST['kode_kategori_barang'];
    $nama_barang = $_POST['nama_barang'];
    $harga_jual = str_replace(".", "", $_POST['harga_jual']);
    $query_update = mysqli_query($koneksi,"UPDATE barang SET nama_barang='$nama_barang',kode_kategori_barang='$kode_kategori_barang',harga_jual='$harga_jual',photo='$photo' WHERE kode_barang='$kode_barang'");
    if ($query_update) {
        echo "<script>Swal.fire('Sukses','Data Berhasil Diupdate','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=barang';
		});</script>";
    }
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM barang WHERE kode_barang='$id'");
    if ($query_hapus) {
        echo "<script>Swal.fire('Sukses','Data Berhasil Dihapus','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=barang';
		});</script>";
    }
}
?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Daftar Menu</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Data Menu</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="" method="post" enctype="multipart/form-data">
						<div class="modal-body">
							<div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Nama </label>
                                    <input type="text" name="nama_barang"
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan nama menu" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="">Kategori</label>
                                    <select name="kode_kategori_barang" id="" class="form-control form-control-sm">
                                    <?php 
                                    $query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori_barang ORDER BY kode_kategori_barang ASC");
                                    foreach($query_kategori as $data_kategori) {
                                    ?>
                                        <option value="<?php echo $data_kategori['kode_kategori_barang'] ?>"><?php echo $data_kategori['nama_kategori'] ?></option>
                                    <?php } ?>
                                    </select>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Harga Jual </label>
                                    <input type="text" name="harga_jual"
                                        class="form-control form-control-sm rupiah" id="inputEmail2"
                                        placeholder="Masukan harga jual" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Foto Menu </label>
                                    <input type="file" name="photo"
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan foto menu" required>
                                </div>
                            </div>
						</div>
                        <div class="modal-footer">
                            <button type="submit" name="simpan" class="btn btn-sm btn-success">Simpan</button>
                            <button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Kembali</button>
                        </div>
                        </form>
					</div>
				</div>
			</div>
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th class="text-center">Kode</th>
							<th class="text-center">Nama</th>
							<th class="text-center">Kategori</th>
							<th class="text-center">Harga Jual</th>
							<th class="text-center">Foto</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $query = mysqli_query($koneksi, "SELECT * FROM barang JOIN kategori_barang USING(kode_kategori_barang) ORDER BY kode_barang ASC");
                    foreach ($query as $data) :
                        ?>
						<tr>
							<td><?php echo $data['kode_barang'] ?></td>
							<td><?php echo $data['nama_barang'] ?></td>
							<td><?php echo $data['nama_kategori'] ?></td>
							<td class="text-right"><?php echo rupiah($data['harga_jual']) ?></td>
							<td class="text-center"><img width="100" height="100" src="<?php echo "assets/img/".$data['photo']; ?>"></td>
							<td class="text-center">
                                <a style="cursor:pointer" class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                        data-target="#modal-edit<?= $data['kode_barang'] ?>">Edit</a>
                                <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=barang&hapus=<?= $data['kode_barang'] ?>" class="btn btn-sm btn-danger">Hapus</a>
                            </td>
						</tr>
                        <?php endforeach; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


<?php foreach($query as $data):  ?>
<div id="modal-edit<?=$data['kode_barang'];?>" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="POST" enctype="multipart/form-data">
			<div class="modal-body">
				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="inputEmail2">Nama </label>
						<input type="hidden" name="kode_barang" value="<?php echo $data['kode_barang'] ?>">
						<input type="text" name="nama_barang" value="<?php echo $data['nama_barang'] ?>"
							class="form-control form-control-sm" id="inputEmail2"
							placeholder="Masukan nama menu" required>
					</div>
                    <div class="form-group col-sm-6">
                        <label for="">Kategori</label>
                        <select name="kode_kategori_barang" id="" class="form-control form-control-sm">
                        <?php 
                        $query_kategori = mysqli_query($koneksi, "SELECT * FROM kategori_barang ORDER BY kode_kategori_barang ASC");
                        foreach($query_kategori as $data_kategori) {
                        ?>
                            <option value="<?php echo $data_kategori['kode_kategori_barang'] ?>" <?php if($data['kode_kategori_barang'] == $data_kategori['kode_kategori_barang']){ echo "selected";} ?>><?php echo $data_kategori['nama_kategori'] ?></option>
                        <?php } ?>
                        </select>
                    </div>
				</div>
                <div class="form-row">
					<div class="form-group col-sm-6">
						<label for="inputEmail2">Harga Jual </label>
						<input type="text" name="harga_jual" value="<?php echo rupiah($data['harga_jual']) ?>"
							class="form-control form-control-sm rupiah" id="inputEmail2"
							placeholder="Masukan harga jual" required>
					</div>
                    <div class="form-group col-sm-6">
						<label for="inputEmail2">Foto Menu </label>
						<input type="file" name="photo"
							class="form-control form-control-sm" id="inputEmail2"
							placeholder="Masukan foto menu" required>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="submit" name="update" class="btn btn-sm btn-success">Update</button>
				<button type="button" class="btn btn-sm btn-link" data-dismiss="modal">Kembali</button>
			</div>
			</form>
		</div>
	</div>
</div>
<?php endforeach; ?>
