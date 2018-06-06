<?php
$datur = $data["pengaturan"][0];
?>
<!-- Banner -->
	<section id="banner">
		<div class="inner">
			<h2><?= $datur["nama_website"]; ?></h2>
			<p>Web Design</p>
			<p>Provided by <a target="_BLANK" href="http://zen8.tk">zeneight</a>.</p>
			<ul class="actions">
				<li><a href="#!" class="button special">Kontak</a></li>
			</ul>
		</div>
		<a href="#one" class="more scrolly">Cari tahu</a>
	</section>

<!-- One -->
	<section id="one" class="wrapper style1 special">
		<div class="inner">
			<header class="major">
				<h2><?= $datur["judul"]; ?></h2>
				<p><?= $datur["deskripsi"]; ?></p>
			</header>
			<ul class="icons major">
				<li><span class="icon fa-diamond major style1"><span class="label">Lorem</span></span></li>
				<li><span class="icon fa-heart-o major style2"><span class="label">Ipsum</span></span></li>
				<li><span class="icon fa-code major style3"><span class="label">Dolor</span></span></li>
			</ul>
		</div>
	</section>

<!-- Three -->
	<section id="three" class="wrapper style3 special">
		<div class="inner">
			<header class="major">
				<h2>Accumsan mus tortor nunc aliquet</h2>
				<p>Aliquam ut ex ut augue consectetur interdum. Donec amet imperdiet eleifend<br />
				fringilla tincidunt. Nullam dui leo Aenean mi ligula, rhoncus ullamcorper.</p>
			</header>
			<ul class="features">
				<?php
					$icons = array("fa-paper-plane-o", "fa-laptop", "fa-code");
					$no = 0;
					// loop kategori produk
					foreach ($data["kategori"] as $dt) {
						$urlnya = BASE_URL."portfolio/kategori/".$dt["slug"];
						
						echo '
							<li class="icon '.$icons[$no].'">
								<h3>'.$dt["nama_kategori"].'</h3>
								'.html_entity_decode($dt["deskripsi"]).'
							</li>
						';
						$no++;
					}
				?>
				<?php
				/*
				<li class="icon fa-laptop">
					<h3>Ac Augue Eget</h3>
					<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
				</li>
				<li class="icon fa-code">
					<h3>Mus Scelerisque</h3>
					<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
				</li>
				<li class="icon fa-headphones">
					<h3>Mauris Imperdiet</h3>
					<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
				</li>
				<li class="icon fa-heart-o">
					<h3>Aenean Primis</h3>
					<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
				</li>
				<li class="icon fa-flag-o">
					<h3>Tortor Ut</h3>
					<p>Augue consectetur sed interdum imperdiet et ipsum. Mauris lorem tincidunt nullam amet leo Aenean ligula consequat consequat.</p>
				</li>
				*/
				?>
			</ul>
		</div>
	</section>

<!-- Two -->
	<section id="two" class="wrapper alt style2">

		<?php
			// loop produk
			foreach ($data["produk"] as $dt) {
				$urlnya = BASE_URL."portfolio/detail/".$dt["slug"];
		?>
		<section class="spotlight">
			<div class="image">
				<img src="<?php echo getThumbnail($dt["gambar"], "produk"); ?>" 
					alt="<?php echo getPermalink($dt["nama_produk"]); ?>" />
			</div>
			<div class="content">
				<h2><a href="<?= $urlnya; ?>"><?= $dt["nama_produk"]; ?></a></h2>
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
			<a href="#!" class="button btn-load fit special" data-posisi="4">Load More</a>
		</div>
	</section>

<script type="text/javascript">
	var posisi;
	$(function(){
		$('.loading').hide();
		$('.btn-load').click(function(){
			$('.loading').show();
			posisi = parseInt($(this).attr('data-posisi'));
			$.ajax({
				url: "<?= BASE_URL ?>home/load/"+posisi,
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