<div class="container-fluid">
<?php
create_title("Profil");
?>
	
	<form id="form-setting" class="form form-horizontal" method="POST">
		<?php
		$data 	= $data[0];

		start_content();
			form_input("Nama Lengkap", "nama_lengkap", "text", 4, "", "value='".$data["nama_lengkap"]."' readonly");
			form_input("Username", "username", "text", 4, "", "value='".$data["username"]."' readonly");
			form_input("Password Lama", "lama", "password", 4, "", "required");
			form_input("Password Baru", "baru", "password", 4, "", "required");
			form_input("Ulang Password", "ulang", "password", 4, "", "required");

			echo "<div class='col-sm-offset-2'>";
			create_button("Simpan Perubahan", "primary", "", "floppy-disk");
			echo "</div>";
		end_content();
		?>
	</form>

</div>

<script type="text/javascript">
	$(function(){
		$('#form-setting').submit(function(){
			if($('#baru').val() != $('#ulang').val()) {
				swal("Wadaw!", "Password baru tidak sama dengan Ulang Password!", "warning");
			} else {
				$.ajax({
					url: "<?= BASE_PATH ?>/admin/profil/update",
					type: "POST",
					data: $('#form-setting').serialize(),
					success: function(data) {
						if (data=='success') 
							swal("Selamat!", "Data berhasil disimpan!", "success");
						else
							swal("Aduh!", "Data tidak dapat disimpan karena "+data, "error");
					},

					error: function() {
						swal("Aw, waduh!", "Data tidak dapat disimpan!", "error");
					}
				});
			}
			return false;
		});
	});
</script>