<style type="text/css">
	.card {
		display: flex;
	    box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2);
	    max-width: 420px;
	    margin: auto;
	    text-align: center;
	}
	.card h1 {
		margin-top: 5px;
		margin-bottom: 3px;
		font-size: 24px;
	}
	.card #foto {
		padding: 9px;
	}
	.card #kartu-barcode {
		padding-top: 15px;
	}
	.card #kartu-alamat {
		margin-bottom: 0;
	}
	.card #kartu-telp {
		font-size: 12px;
	}

	.card .title {
	    color: grey;
	    font-size: 16px;
	}

	.card .left {
		width: 25%;
		display: inline-table;
		padding: 10px;
	}
	.card .right {
		width: 74%;
		display: inline-table;
		padding: 10px;
	}

	.card button {
	    border: none;
	    outline: 0;
	    display: inline-block;
	    padding: 8px;
	    color: white;
	    background-color: #000;
	    text-align: center;
	    cursor: pointer;
	    width: 100%;
	    font-size: 18px;
	}

	.card a {
	    text-decoration: none;
	    font-size: 22px;
	    color: black;
	}

	.card button:hover, .card a:hover {
	    opacity: 0.7;
	}
</style>
<div class="container-fluid">
<?php
create_title("Data Member");

// membuat tabel
start_content();
	create_button("Tambah", "success", "addForm", "plus-sign", "sm");
	create_table(array("Gambar", "Detail Member", "Barcode", "Aksi"));
end_content();

// membuat form modal
start_modal("modal_form", "return saveData()");
	form_input("ID Member", "barcode", "text", 5, "", "readonly");
	form_input("Nama Member", "member", "text", 5, "", "required");
	form_input("Alamat", "alamat", "text", 5, "", "required");
	form_input("Tempat Lahir", "tempat_l", "text", 5, "", "required");
	form_input("Tanggal Lahir", "tgl_l", "text", 5, "", "required");
	form_input("Telpon", "telp", "text", 5, "", "required");
	form_input("Nomor KTP", "no_ktp", "text", 5, "", "required");
	form_mediapicker("Gambar Member", "gambar", 4, 0, "modal-form");

	/*$list = array();
	foreach ($data as $d) {
		$key = $d["id_katberita"];
		$list[$key] = $d["nama_katberita"];
	}*/
	// form_combobox("Kategori Berita", "kategori", $list, 4);
	// form_textarea("Deskripsi", "deskripsi");
end_modal();

start_modal("modal_print", "");
	echo '
	<div class="card">
		<div class="left">
			<div id="foto"></div>
			<div id="kartu-barcode"></div>
		</div>
		<div class="right">
			<h1 id="kartu-nama"></h1>
			<p class="title">Member of Mammoth Art Gallery</p>
			<p id="kartu-alamat"></p>
			<b><p id="kartu-telp"></p></b>
			<a href="#"><i class="fa fa-dribbble"></i></a> 
			<a href="#"><i class="fa fa-twitter"></i></a> 
			<a href="#"><i class="fa fa-linkedin"></i></a> 
			<a href="#"><i class="fa fa-facebook"></i></a> 
			<!--<p><button>Contact</button></p>-->
		</div>
	</div>
	';
end_modal(false, "Print");
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
				"url": "<?= BASE_URL; ?>admin/member/listData",
				"type": "POST"
			}
		});
	});

	// menampilkan form modal tambah data
	function addForm() {
		save_method = "add";
		// CKEDITOR.instances['deskripsi'].setData('');
		$('#modal_form').modal('show');
		$('#modal_form form')[0].reset();
		$('.modal-title').text('Tambah Member');
		$("#img-gambar img").remove();
		$("#barcode").val('Nomor akan digenerate otomatis');
	}

	// menampilkan form modal edit data
	function editForm(id) {
		var id = id;
		save_method = "edit";
		$('#modal_form form')[0].reset();
		$.ajax({
			url: "<?= BASE_URL; ?>admin/member/edit/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('#modal_form').modal('show');
				$('.modal-title').text('Edit Member');

				// ambil value dari JSON
				$('#id').val(data.id_member);
				$('#member').val(data.nama_member);
				$('#alamat').val(data.alamat);
				$('#tempat_l').val(data.tempat_l);
				$('#tgl_l').val(data.tgl_l);
				$('#telp').val(data.telp);
				$('#no_ktp').val(data.no_ktp);
				$('#barcode').val(data.barcode);
				
				$('#img-gambar').html('<img src="<?php echo BASE_PATH; ?>assets/images/member/'+data.gambar+'" width="300">');
				
				// decode htmlentities string
				/*var deskripsi = he.decode(data.deskripsi);
				CKEDITOR.instances['deskripsi'].setData(deskripsi);*/
			},
			error: function() {
				swal("Aw, waduh!", "Data tidak dapat ditampilkan!", "error");
			}
		});
	}

	// menyimpan data dengan ajax
	function saveData() {
		if (save_method == "add") url = "<?= BASE_URL; ?>admin/member/insert";
		else url = "<?= BASE_URL; ?>admin/member/update";

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
					url: "<?= BASE_URL; ?>admin/member/delete/"+id,
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

	function printData(id) {
		var id = id;
		save_method = "edit";
		// $('#modal_form form')[0].reset();
		$.ajax({
			url: "<?= BASE_URL; ?>admin/member/edit/"+id,
			type: "GET",
			dataType: "JSON",
			success: function(data) {
				$('#modal_print').modal('show');
				$('.modal-title').text('View Kartu Member');

				/*// ambil value dari JSON
				$('#id').val(data.id_member);
				$('#member').val(data.nama_member);
				$('#alamat').val(data.alamat);
				$('#tempat_l').val(data.tempat_l);
				$('#tgl_l').val(data.tgl_l);
				$('#telp').val(data.telp);
				$('#no_ktp').val(data.no_ktp);
				$('#barcode').val(data.barcode);
				*/
				$('#kartu-barcode').html('<img src="<?php echo BASE_PATH; ?>barcode/barcode.php?text='+data.barcode+'&print=true&size=40">');
				$('#foto').html('<img src="<?php echo BASE_PATH; ?>assets/images/member/'+data.gambar+'" width="100%">');
				$('#kartu-nama').html(data.nama_member);
				$('#kartu-alamat').html('~ '+data.alamat+' ~');
				$('#kartu-telp').html(data.telp);
				
				// decode htmlentities string
				/*var deskripsi = he.decode(data.deskripsi);
				CKEDITOR.instances['deskripsi'].setData(deskripsi);*/
			},
			error: function() {
				swal("Aw, waduh!", "Data tidak dapat ditampilkan!", "error");
			}
		});
	}
</script>