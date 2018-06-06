<div class="container-fluid">
<?php
create_title("Manajemen Menu");

// membuat tabel
start_content();
	create_button("Tambah", "success", "addForm", "plus-sign", "sm");
	create_table(array("Nama Menu", "Jenis Link", "Link", "Urutan", "Aksi"));
end_content();

// membuat form modal
start_modal("modal_form", "return saveData()");
	form_input("Nama Menu", "menu", "text", 5, "", "required");

	$list = array();
	foreach ($data as $d) {
		$key = $d["id_menu"];
		$list[$key] = $d["nama_menu"];
	}
	form_combobox("Induk", "induk", $list, 4);

	$list 	= array('modul'=>'Modul', 'kategori'=>'Kategori', 'informasi'=>'Informasi');
	form_combobox("Jenis Link", "jenis_link", $list, 4, '', "required");

	$list 	= array();
	form_combobox("Link", "link", $list, 5, '', "required");

	form_input("Urutan", "urutan", "number", 2, "", "required");

	// form_mediapicker("Gambar Berita", "gambar", 4, 0, "modal-form");
	// form_input("Hits", "hits", "number", 4, "", "required");
	// form_textarea("Deskripsi", "deskripsi");
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
				"url": "<?= BASE_URL; ?>admin/menu/listData",
				"type": "POST"
			}
		});

		$('#jenis_link').change(function(){
			getLink($(this).val());
		});
	});

	// fungsi getLink
	function getLink(val){
		$.ajax({
			url: "<?= BASE_PATH; ?>/admin/menu/datalink/"+val,
			type: "GET",
			success: function(data){
				$('#link').html(data);
			},
			error: function(){
				swal("Aw, waduh!", "Data tidak dapat ditampilkan!", "error");
			}
		});
	}

	// menampilkan form modal tambah data
	function addForm() {
		save_method = "add";
		// CKEDITOR.instances['deskripsi'].setData('');
		$('#modal_form').modal('show');
		$('#modal_form form')[0].reset();
		$('.modal-title').text('Tambah Menu');
		// $("#img-gambar img").remove();
	}

	// menampilkan form modal edit data
	function editForm(id) {
		var id = id;
		save_method = "edit";
		$('#modal_form form')[0].reset();
		$.ajax({
			url: "<?= BASE_URL; ?>admin/menu/edit/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('#modal_form').modal('show');
				$('.modal-title').text('Edit Menu');

				// ambil value dari JSON
				$('#id').val(data.id_menu);
				$('#menu').val(data.nama_menu);
				$('#induk').val(data.induk);
				$('#jenis_link').val(data.jenis_link);
				getLink(data.jenis_link);
				$('#link').val(data.link);
				$('#urutan').val(data.urutan);
				
				// decode htmlentities string
				// var deskripsi = he.decode(data.deskripsi);
				// CKEDITOR.instances['deskripsi'].setData(deskripsi);
			},
			error: function() {
				swal("Aw, waduh!", "Data tidak dapat ditampilkan!", "error");
			}
		});
	}

	// menyimpan data dengan ajax
	function saveData() {
		if (save_method == "add") url = "<?= BASE_URL; ?>admin/menu/insert";
		else url = "<?= BASE_URL; ?>admin/menu/update";

		// force update CKEDITOR
		/*for (instance in CKEDITOR.instances) {
			CKEDITOR.instances[instance].updateElement();
		}*/

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
			success: function(data) {
				$('#modal_form').modal('hide');
				$('#modal_form form')[0].reset();
				// CKEDITOR.instances['deskripsi'].setData('');
				table.ajax.reload();
				swal("Selamat!", "Data berhasil disimpan!", "success");
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
					url: "<?= BASE_URL; ?>admin/menu/delete/"+id,
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