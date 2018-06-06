<?php
$detail = $data["detail"][0];
$h = $data["halaman"];
?>
<!-- Main -->
	<article id="main">
		<header>
			<h2><?php echo $detail["nama_".$h["tabel"]]; ?></h2>
			<?php
			/*
			<p><i class="fa fa-user"></i> <?php echo $detail["entry_by"]; ?> || <i class="fa fa-calendar"></i> <?php echo format_date_in(2,substr ($detail['date'], 0, 10));?></p>
			*/
			?>
		</header>
		<section class="wrapper style5">
			<div class="inner">
				<p>
					<span class="image left">
						<img src="<?php echo getThumbnail($detail["gambar"], $h["tabel"], true) ?>" alt="<?php echo $detail["nama_".$h["tabel"]]; ?>" />
					</span>
					<?php echo html_entity_decode($detail["deskripsi"]); ?>
				</p>
				<br/>
				<?php //echo shareButton();?>
				<?php echo komentarFB(); ?>
			</div> <!-- inner -->
		</section> <!-- wrapper -->
	</article>