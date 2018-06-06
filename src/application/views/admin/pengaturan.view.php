<div class="container-fluid">
<?php
create_title("Pengaturan");
?>
	<form id="form-pengaturan" class="form form-horizontal" method="POST">
		<?php
		$data 	= $data[0];

		start_content();
			form_input("Nama Website", "nama_website", "text", 5, "", "value='".$data["nama_website"]."'");
			form_mediapicker("Favicon", "gambar");

			form_input("e-mail", "email", "email", 5, "", "value='".$data["email"]."'");
			form_input("Alamat", "alamat", "text", 5, "", "value='".$data["alamat"]."'");
			form_input("Telp", "telp", "text", 5, "", "value='".$data["telp"]."'");

			form_input("Username Facebook", "widget_facebook", "text", 5, "", "value='".$data["widget_facebook"]."'");
			form_input("Username Twitter @", "widget_twitter", "text", 5, "", "value='".$data["widget_twitter"]."'");

			form_input("Judul Deskripsi", "judul", "text", 5, "", "value='".$data["judul"]."'");
			form_textarea("Deskripsi Singkat Website", "deskripsi", "", "", $data["deskripsi"]);

			echo "<div class='col-sm-offset-2'>";
			create_button("Simpan Perubahan", "primary", "", "floppy-disk");
			echo "</div>";
		end_content();
		?>
	</form>

</div>

<script type="text/javascript">
	$(function(){
		// $('#gambar').val('<?= $data['favicon'] ?>');
		$('#img-gambar').html('<br><img src="<?= BASE_PATH; ?>assets/images/pengaturan/<?= $data['favicon'] ?>" width="150">');

		$('#form-pengaturan').submit(function(){
			// force update CKEDITOR
			for (instance in CKEDITOR.instances) {
				CKEDITOR.instances[instance].updateElement();
			}

			var formData = new FormData($('#form-pengaturan')[0]);

			$.ajax({
				url: "<?= BASE_PATH ?>/admin/pengaturan/update",
				type: "POST",
				// data: $('#form-pengaturan').serialize(),
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				async: false,
				success: function(data) {
					if (data=='success') 
					{
						swal("Selamat!", "Data berhasil disimpan!", "success");
					}
					else
						swal("Aduh!", "Data tidak dapat disimpan karena "+data, "error");
				},

				error: function() {
					swal("Aw, waduh!", "Data tidak dapat disimpan!", "error");
				}
			});
			return false;
		});
	});
</script>