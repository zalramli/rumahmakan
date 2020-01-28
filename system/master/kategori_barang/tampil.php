<?php 
if(isset($_POST['simpan']))
{

    $nama_kategori = $_POST['nama_kategori'];
    $query_insert = mysqli_query($koneksi, "INSERT INTO kategori_barang (kode_kategori_barang,nama_kategori) VALUES (NULL,'$nama_kategori') ");
    if ($query_insert) {
        echo "<script>Swal.fire('Sukses','Data Berhasil Ditambahkan','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=kategori_barang';
		});</script>";
    }
}

if(isset($_POST['update']))
{

    $kode_kategori_barang = $_POST['kode_kategori_barang'];
    $nama_kategori = $_POST['nama_kategori'];
    $query_update = mysqli_query($koneksi,"UPDATE kategori_barang SET nama_kategori='$nama_kategori' WHERE kode_kategori_barang='$kode_kategori_barang'");
    if ($query_update) {
		echo "<script>Swal.fire('Sukses','Data Berhasil Diupdate','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=kategori_barang';
		});</script>";
    }
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM kategori_barang WHERE kode_kategori_barang='$id'");
    if ($query_hapus) {
		echo "<script>Swal.fire('Sukses','Data Berhasil Dihapus','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=kategori_barang';
		});</script>";
    }
}
?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Daftar Kategori Menu</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Data Kategori Menu</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="" method="post">
						<div class="modal-body">
							<div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Nama Kategori Menu</label>
                                    <input type="text" name="nama_kategori"
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan nama kategori menu" required>
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
							<th class="text-center">No</th>
							<th class="text-center">Nama</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $no=1;
                    $query = mysqli_query($koneksi, "SELECT * FROM kategori_barang ORDER BY kode_kategori_barang ASC");
                    foreach ($query as $data) :
                        ?>
						<tr>
							<td class="text-center"><?php echo $no++ ?></td>
							<td><?php echo $data['nama_kategori'] ?></td>
							<td class="text-center">
                                <a style="cursor:pointer" class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                        data-target="#modal-edit<?= $data['kode_kategori_barang'] ?>">Edit</a>
                                <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=kategori_barang&hapus=<?= $data['kode_kategori_barang'] ?>" class="btn btn-sm btn-danger">Hapus</a>
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
<div id="modal-edit<?=$data['kode_kategori_barang'];?>" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data Kategori Menu</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="POST">
			<div class="modal-body">
				<div class="form-row">
					<div class="form-group col-sm-6">
						<label for="inputEmail2">Nama </label>
						<input type="hidden" name="kode_kategori_barang" value="<?php echo $data['kode_kategori_barang'] ?>">
						<input type="text" name="nama_kategori" value="<?php echo $data['nama_kategori'] ?>"
							class="form-control form-control-sm" id="inputEmail2"
							placeholder="Masukan nama kategori menu" required>
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
