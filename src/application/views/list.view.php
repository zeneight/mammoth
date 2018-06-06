<?php
$d = $data["halaman"];
?>
<article id="main">
	<header>
		<h2><?= $d["judul"]; ?></h2>
		<p><?= $d["deskripsi"]; ?></p>
	</header>

	<section id="two" class="wrapper alt style2">
		<?php
			// loop berita
			foreach ($data[$d["controller"]] as $dt) {
				$urlnya = BASE_URL.$d["url"].DS.$dt["slug"];
		?>

		<section class="spotlight">
			<div class="image">
				<img src="<?php echo getThumbnail($dt["gambar"], $d["tabel"]); ?>" 
					alt="<?php echo getPermalink($dt["nama_".$d["tabel"]]); ?>" />
			</div>
			<div class="content">
				<h2><a href="<?= $urlnya; ?>"><?= $dt["nama_".$d["tabel"]]; ?></a></h2>
				<?= substr(strip_tags(html_entity_decode($dt["deskripsi"])), 0, 200)."..."; ?>
			</div>
		</section>

		<?php 
			}
		?>
	</section>
	<section>
		<div class="col-xs-12 text-center">
			<div class="loading">LOADING...</div>
		</div>
		<div class="col-xs-12 text-center">
			<a href="#!" class="button btn-load fit special" data-posisi="2">Load More</a>
			<?php
				/*$link = $baseurl."blog/"; // Page name
				$paging->setMaxPages(3); // Number of paging links that will be displayed per page

				// Create links for paging
				echo $paging->createPaging($link);*/
			?>
		</div>
	</section>
</article>

<script type="text/javascript">
	var posisi;
	$(function(){
		$('.loading').hide();
		$('.btn-load').click(function(){
			$('.loading').show();
			posisi = parseInt($(this).attr('data-posisi'));
			$.ajax({
				url: "<?= BASE_URL.$d["controller"].DS; ?>load/"+posisi,
				type: "GET",
				success: function(data){
					$('#two').append(data);
					$('.btn-load').attr('data-posisi', posisi+2);
					$('.loading').hide();
				}
			});
		});
	});
</script>