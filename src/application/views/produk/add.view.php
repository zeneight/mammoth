<h2 class="page-header">Tambah Produk</h2>
<?php
// Menampilkan Pesan error jika ada
if (isset($data["msg"])) {
	echo '
	<div class="alert alert-danger">
		<ul>';

	foreach ($data["msg"] as $error) {
		echo '<li>'.$error.'</li>';
	}

	echo '
		</ul>
	</div>';
}
?>

<form class="form-horizontal" method="post" action="<?= BASE_URL ?>produk/insert">
	<div class="form-group">
		<label class="control-label col-md-2">Nama Produk</label>
		<div class="col-md-4">
			<input type="text" name="nama" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2">Harga</label>
		<div class="col-md-4">
			<input type="number" name="harga" class="form-control">
		</div>
	</div>

	<button class="btn btn-primary">Simpan</button>
	<a href="<?= BASE_URL; ?>produk" class="btn btn-warning">Batal</a>
</form>