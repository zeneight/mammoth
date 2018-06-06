<div class="container-fluid">
<?php
create_title("Data Kategori");

// membuat tabel
start_content();
	create_button("Tambah", "success", "addForm", "plus-sign", "sm");
	create_table(array("Nama Kategori", "Slug", "Aksi"));
end_content();

// membuat form modal
start_modal("modal_form", "return saveData()");
	form_input("Nama Kategori", "kategori", "text", 5, "", "required");
	form_input("Slug", "slug", "text", 5, "", "required");
	form_textarea("Deskripsi", "deskripsi");
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
				"url": "<?= BASE_URL; ?>admin/kategori/listData",
				"type": "POST"
			}
		});
	});

	// menampilkan form modal tambah data
	function addForm() {
		save_method = "add";
		CKEDITOR.instances['deskripsi'].setData('');
		$('#modal_form').modal('show');
		$('#modal_form form')[0].reset();
		$('.modal-title').text('Tambah Kategori');
	}

	// menampilkan form modal edit data
	function editForm(id) {
		var id = id;
		save_method = "edit";
		$('#modal_form form')[0].reset();
		$.ajax({
			url: "<?= BASE_URL; ?>admin/kategori/edit/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('#modal_form').modal('show');
				$('.modal-title').text('Edit Kategori');

				$('#id').val(data.id_kategori);
				$('#kategori').val(data.nama_kategori);
				$('#slug').val(data.slug);

				// decode htmlentities string
				var deskripsi = he.decode(data.deskripsi);
				CKEDITOR.instances['deskripsi'].setData(deskripsi);
			},

			error: function() {
				alert("Tidak dapat menampilkan data!");
			}
		});
	}

	// menyimpan data dengan ajax
	function saveData() {
		if (save_method == "add") url = "<?= BASE_URL; ?>admin/kategori/insert";
		else url = "<?= BASE_URL; ?>admin/kategori/update";

		// force update CKEDITOR
		for (instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}

		$.ajax({
			url: url,
			type: "POST",
			data: $('#modal_form form').serialize(),
			success: function(data) {
				$('#modal_form').modal('hide');
				$('#modal_form form')[0].reset();
				CKEDITOR.instances['deskripsi'].setData('');
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
					url: "<?= BASE_URL; ?>admin/kategori/delete/"+id,
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