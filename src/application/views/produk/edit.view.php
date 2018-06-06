<h2 class="page-header">Edit Produk</h2>
<?php
$data 	= $data[0];

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

	$data 	= $data["data"];
}
?>

<form class="form-horizontal" method="post" action="<?= BASE_URL ?>produk/update">
	<input type="hidden" name="id" value="<?= $data["id_produk"]; ?>">
	<div class="form-group">
		<label class="control-label col-md-2">Nama Produk</label>
		<div class="col-md-4">
			<input type="text" name="nama" value="<?= $data["nama_produk"]; ?>" class="form-control">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-md-2">Harga</label>
		<div class="col-md-4">
			<input type="number" name="harga" value="<?= $data["harga"]; ?>" class="form-control">
		</div>
	</div>

	<button class="btn btn-primary">Edit</button>
	<a href="<?= BASE_URL; ?>produk" class="btn btn-warning">Batal</a>
</form>