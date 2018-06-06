<div class="container-fluid">
<?php
create_title("Data Slide");

// membuat tabel
start_content();
	create_button("Tambah", "success", "addForm", "plus-sign", "sm");
	create_table(array("Gambar Slider", "Nama Slider", "Aksi"));
end_content();

// membuat form modal
start_modal("modal_form", "return saveData()");
	form_input("Nama Slide", "nama_slider", "text", 5, "", "required");

/*	$list = array();
	foreach ($data as $d) {
		$key = $d["id_kategori"];
		$list[$key] = $d["nama_kategori"];
	}
	form_combobox("Kategori Produk", "kategori", $list, 4);*/

	form_mediapicker("Gambar Slide", "gambar", 10, 0, "modal-form");
	form_textarea("Deskripsi", "deskripsi");
	form_radio("Status", "status");
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
				"url": "<?= BASE_URL; ?>admin/slider/listData",
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
		$('.modal-title').text('Tambah slider');
		$("#img-gambar img").remove();
	}

	// menampilkan form modal edit data
	function editForm(id) {
		var id = id;
		save_method = "edit";
		$('#modal_form form')[0].reset();
		$("#img-gambar img").remove();
		$.ajax({
			url: "<?= BASE_URL; ?>admin/slider/edit/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('#modal_form').modal('show');
				$('.modal-title').text('Edit slider');

				// ambil value dari JSON
				$('#id').val(data.id_slider);
				$('#nama_slider').val(data.nama_slider);
				$('#img-gambar').html('<img src="<?php echo BASE_PATH; ?>assets/images/slider/'+data.gambar+'" width="100%" height="auto">');

				if (data.status=="Show") {
					$('#status1').attr('checked', 'checked');
				} else if (data.status=="Hide") {
					$('#status2').attr('checked', 'checked');
				}

				// decode htmlentities string
				var deskripsi = he.decode(data.deskripsi);
				CKEDITOR.instances['deskripsi'].setData(deskripsi);
			},
			error: function() {
				swal("Aw, waduh!", "Data tidak dapat ditampilkan!", "error");
			}
		});
	}

	// menyimpan data dengan ajax
	function saveData() {
		if (save_method == "add") url = "<?= BASE_URL; ?>admin/slider/insert";
		else url = "<?= BASE_URL; ?>admin/slider/update";

		// force update CKEDITOR
		for (instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}

		var formData = new FormData($('#modal_form form')[0]);

		$.ajax({
			url: url,
			type: "POST",
			/*data: $('#modal_form form').serialize(),*/
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			async: false,
			success: function(response) {
				$('#modal_form').modal('hide');
				$('#modal_form form')[0].reset();
				CKEDITOR.instances['deskripsi'].setData('');
				table.ajax.reload();
				swal("Yeah!", "Data sudah disimpan!", "success");
			},

			error: function() {
				swal("Aw, waduh!", "Data tidak dapat disimpan!", "error");
			}
		});
		return false;
	}

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
					url: "<?= BASE_URL; ?>admin/slider/delete/"+id,
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