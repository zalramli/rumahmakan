<?php 
if(isset($_POST['simpan']))
{
	$nama_user = addslashes($_POST['nama_user']);
	$no_hp = $_POST['no_hp'];
	$alamat = $_POST['alamat'];
	$akses = $_POST['akses'];
	$username = $_POST['username'];
	$password = password_hash($_POST["password"], PASSWORD_DEFAULT); // fungsi mengenkripsi data
    $query_insert = mysqli_query($koneksi, "INSERT INTO user (kode_user,nama_user,no_hp,alamat,akses,username,password) VALUES (NULL,'$nama_user','$no_hp','$alamat','$akses','$username','$password') ");
    if ($query_insert) {
        echo "<script>Swal.fire('Sukses','Data Berhasil Ditambahkan','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=user';
		});</script>";
    }
}

if(isset($_POST['update']))
{
	$kode_user = $_POST['kode_user'];
	$nama_user = addslashes($_POST['nama_user']);
	$no_hp = $_POST['no_hp'];
	$alamat = $_POST['alamat'];
	$akses = $_POST['akses'];
	$username = $_POST['username'];
	$password = password_hash($_POST["password"], PASSWORD_DEFAULT); // fungsi mengenkripsi data
    $query_update = mysqli_query($koneksi,"UPDATE user SET nama_user='$nama_user',no_hp='$no_hp',alamat='$alamat',akses='$akses',username='$username',password='$password' WHERE kode_user='$kode_user'");
    if ($query_update) {
		echo "<script>Swal.fire('Sukses','Data Berhasil Diupdate','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=user';
		});</script>";
    }
}
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    $query_hapus = mysqli_query($koneksi, "DELETE FROM user WHERE kode_user='$id'");
    if ($query_hapus) {
		echo "<script>Swal.fire('Sukses','Data Berhasil Dihapus','success')
		.then(function(){
		window.location = window.location = 'admin.php?halaman=user';
		});</script>";
    }
}
?>
<div class="container-fluid">
	<div class="card shadow mb-4">
		<div class="card-header py-3">
			<h6 class="m-0 font-weight-bold text-primary">Daftar User</h6>
		</div>
		<div class="card-body">
			<button type="button" class="btn btn-sm btn-primary mb-3" data-toggle="modal"
				data-target=".bd-example-modal-lg">Tambah</button>
			<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
				aria-hidden="true">
				<div class="modal-dialog modal-lg">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Tambah Data User</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<form action="" method="post">
						<div class="modal-body">
							<div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Nama User</label>
                                    <input type="text" name="nama_user"
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan nama kategori menu" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Akses</label>
                                    <select name="akses" class="form-control form-control-sm" required>
									<option value="Kasir">Kasir</option>
									<option value="Admin">Admin</option>
									</select>
                                </div>
                            </div>
							<div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">No Hp</label>
                                    <input type="text" name="no_hp"
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan no hp" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Alamat</label>
                                    <input type="text" name="alamat"
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan alamat" required>
                                </div>
                            </div>
							<div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Username</label>
                                    <input type="text" name="username"
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan username" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Password</label>
                                    <input type="password" name="password"
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan password" required>
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
							<th class="text-center">Username</th>
							<th class="text-center">Akses</th>
							<th class="text-center">No Hp</th>
							<th class="text-center">Alamat</th>
							<th class="text-center">Aksi</th>
						</tr>
					</thead>
					<tbody>
                    <?php
                    $no=1;
                    $query = mysqli_query($koneksi, "SELECT * FROM user ORDER BY kode_user ASC");
                    foreach ($query as $data) :
                        ?>
						<tr>
							<td class="text-center"><?php echo $no++ ?></td>
							<td><?php echo $data['nama_user'] ?></td>
							<td><?php echo $data['username'] ?></td>
							<td><?php echo $data['akses'] ?></td>
							<td><?php echo $data['no_hp'] ?></td>
							<td><?php echo $data['alamat'] ?></td>
							<td class="text-center">
                                <a style="cursor:pointer" class="btn btn-sm btn-warning text-white" data-toggle="modal"
                                        data-target="#modal-edit<?= $data['kode_user'] ?>">Edit</a>
                                <a onclick="return confirm('Yakin ingin menghapus data ?')" href="?halaman=user&hapus=<?= $data['kode_user'] ?>" class="btn btn-sm btn-danger">Hapus</a>
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
<div id="modal-edit<?=$data['kode_user'];?>" class="modal fade">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Edit Data User</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="" method="POST">
			<div class="modal-body">
							<div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Nama User</label>
									<input type="hidden" name="kode_user" value="<?php echo $data['kode_user'] ?>">
                                    <input type="text" name="nama_user"
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan nama kategori menu" required  value="<?php echo $data['nama_user'] ?>">
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Akses</label>
                                    <select name="akses" class="form-control form-control-sm" required>
									<option value="Kasir" <?php if($data['akses'] == 'Kasir') {echo "selected";} ?>>Kasir</option>
									<option value="Admin" <?php if($data['akses'] == 'Admin') {echo "selected";} ?>>Admin</option>
									</select>
                                </div>
                            </div>
							<div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">No Hp</label>
                                    <input type="text" name="no_hp" value="<?php echo $data['no_hp'] ?>"
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan no hp" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Alamat</label>
                                    <input type="text" name="alamat"
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan alamat"  value="<?php echo $data['alamat'] ?>" required>
                                </div>
                            </div>
							<div class="form-row">
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Username</label>
                                    <input type="text" name="username"
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan username"  value="<?php echo $data['username'] ?>" required>
                                </div>
                                <div class="form-group col-sm-6">
                                    <label for="inputEmail2">Password</label>
                                    <input type="password" name="password" 
                                        class="form-control form-control-sm" id="inputEmail2"
                                        placeholder="Masukan password" required>
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
