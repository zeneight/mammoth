<h2 class="page-header">Tampil Produk</h2>
<a class="btn btn-primary" href="<?= BASE_URL ?>produk/add">Tambah</a>
<br><br>

<table class="table table-striped table-bordered">
	<thead>
		<tr>
			<td width="25">No</td>
			<td>Nama Produk</td>
			<td>Harga</td>
			<td>Aksi</td>
		</tr>
	</thead>
	<tbody>
		
	</tbody>
</table>

<script type="text/javascript">
	var table, save_method;
	$(function(){
		table = $('.table').DataTable({
			"processing" : true,
			"ajax" : {
				"url" : "<?= BASE_URL ?>produk/listData",
				"type" : "POST"
			}
		});
	});
</script>