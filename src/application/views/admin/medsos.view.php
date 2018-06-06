<div class="container-fluid">
<?php
create_title("Media Sosial");

// membuat tabel
start_content();
	create_button("Tambah", "success", "addForm", "plus-sign", "sm");
	create_table(array("Ikon", "Nama Medsos", "Aksi"));
end_content();

// membuat form modal
start_modal("modal_form", "return saveData()");
	form_input("Nama Medsos", "nama_medsos", "text", 5, "", "required");
	form_input("Ikon", "ikon", "text", 5, "", "required");
	form_input("URL", "url", "text", 5, "", "required");
end_modal();
?>
</div>

<script type="text/javascript">
	var table, save_method;
	$('#addForm').click(addForm);

	// menampilkan data via ajax ke tabel
	$(function() {
		table = $('.table').DataTable({
			"processing": true,
			"ajax": {
				"url": "<?= BASE_URL; ?>admin/medsos/listData",
				"type": "POST"
			}
		});
	});

	// menampilkan form modal tambah data
	function addForm() {
		save_method = "add";
		$('#modal_form').modal('show');
		$('#modal_form form')[0].reset();
		$('.modal-title').text('Tambah Media Sosial');
	}

	// menampilkan form modal edit data
	function editForm(id) {
		var id = id;
		save_method = "edit";
		$('#modal_form form')[0].reset();
		$.ajax({
			url: "<?= BASE_URL; ?>admin/medsos/edit/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('#modal_form').modal('show');
				$('.modal-title').text('Edit Media Sosial');

				$('#id').val(data.id_medsos);
				$('#nama_medsos').val(data.nama_medsos);
				$('#url').val(data.url);
				$('#ikon').val(data.ikon);
			},

			error: function() {
				alert("Tidak dapat menampilkan data!");
			}
		});
	}

	// menyimpan data dengan ajax
	function saveData() {
		if (save_method == "add") url = "<?= BASE_URL; ?>admin/medsos/insert";
		else url = "<?= BASE_URL; ?>admin/medsos/update";

		$.ajax({
			url: url,
			type: "POST",
			data: $('#modal_form form').serialize(),
			success: function(data) {
				$('#modal_form').modal('hide');
				$('#modal_form form')[0].reset();
				table.ajax.reload();
				swal("Selamat!", "Data berhasil disimpan!", "success");
			},

			error: function() {
				swal("Aw, waduh!", "Data tidak dapat disimpan!", "error");
			}
		});
		return false;
	}

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
					url: "<?= BASE_URL; ?>admin/medsos/delete/"+id,
					type: "GET",
					dataType: "json", 
					success: function (response) {
						if( response.status === true ) {
							table.ajax.reload();
							swal("Wow!", "Data sudah dihapus!", "success");
						} else swal("Aw!", "Maaf, sepertinya ada kesalahan", "error");
					}
				});
			} else {
				swal("Kok gak jadi dihapus sih? Hadeh, mending tadi jangan diklik tombolnya");
			}
		});
	}
</script>