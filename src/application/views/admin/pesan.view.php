<div class="container-fluid">
<?php
create_title("Data Pesan");

// membuat tabel
start_content();
	create_table(array("Pengirim", "Pesan", "Aksi"));
end_content();
?>
</div>

<script type="text/javascript">
	var table, save_method;

	// menampilkan data via ajax ke tabel
	$(function() {
		table = $('.table').DataTable({
			"processing": true,
			"ajax": {
				"url": "<?= BASE_URL; ?>admin/pesan/listData",
				"type": "POST"
			}
		});
	});

	// menghapus data dengan ajax
	function hapusData(id) {
		swal({
			title: "Apa Anda yakin?",
			text: "Ketika sudah dihapus, data ini tidak dapat dikembalikan!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
			if (willDelete) {
				$.ajax({
					url: "<?= BASE_URL; ?>admin/pesan/delete/"+id,
					type: "GET",
					dataType: "json", 
					success: function (response) {
						if( response.status === true ) {
							table.ajax.reload();
							swal("Wow!", "Data sudah dihapus!", "success");
						} else swal("Aw!", "Maaf, sepertinya ada kesalahan", "error");
					},
					error: function() {
						swal("Gawat!", "Data tidak dapat dihapus!", "error");
					}
				});
			}
		});
		return false;
	}
</script>