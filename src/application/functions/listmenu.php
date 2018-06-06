<style type="text/css">
	.navbar-inverse .navbar-toggle .icon-bar {
		background-color: #000;
	}
</style>

<?php 
if ($_SESSION["username"]=="operator") {
	$pengaturan 	= ($_SESSION["hak_pengaturan"]=="tidak") ? "class='hidden'" : "";
	$legislatif 	= ($_SESSION["hak_legislatif"]=="tidak") ? "class='hidden'" : "";
	if ($pengaturan!="" && $legislatif!="") {$profil = "hidden";} else {$profil ="";}

	$pendaftaran 	= ($_SESSION["hak_pendaftaran"]=="tidak") ? "class='hidden'" : "";
	$agenda 		= ($_SESSION["hak_agenda"]=="tidak") ? "class='hidden'" : "";
	$artikel 		= ($_SESSION["hak_artikel"]=="tidak") ? "class='hidden'" : "";

	$kategori 		= ($_SESSION["hak_kategori"]=="tidak") ? "class='hidden'" : "";
	if ($kategori!="") {$mberita = "hidden";} else {$mberita ="";}
	// $berita 		= ($_SESSION["hak_berita"]=="tidak") ? "class='hidden'" : "";

	$video 			= ($_SESSION["hak_video"]=="tidak") ? "class='hidden'" : "";
	$foto 			= ($_SESSION["hak_foto"]=="tidak") ? "class='hidden'" : "";
	if ($video!="" && $foto!="") {$galeri = "hidden";} else {$galeril ="";}

	$tentang_kita 	= ($_SESSION["hak_tentang_kita"]=="tidak") ? "class='hidden'" : "";
	$info_dpc 		= ($_SESSION["hak_info_dpc"]=="tidak") ? "class='hidden'" : "";
	if ($tentang_kita!="" && $info_dpc!="") {$menu = "hidden";} else {$menu ="";}

	$slider 		= ($_SESSION["hak_slider"]=="tidak") ? "class='hidden'" : "";
	$running_text 	= ($_SESSION["hak_running_text"]=="tidak") ? "class='hidden'" : "";
	$situs_terkait 	= ($_SESSION["hak_situs_terkait"]=="tidak") ? "class='hidden'" : "";
	$download 		= ($_SESSION["hak_download"]=="tidak") ? "class='hidden'" : "";
	$media_sosial 	= ($_SESSION["hak_media_sosial"]=="tidak") ? "class='hidden'" : "";
	$kontak_email 	= ($_SESSION["hak_kontak_email"]=="tidak") ? "class='hidden'" : "";
	$popup 			= ($_SESSION["hak_popup"]=="tidak") ? "class='hidden'" : "";
	if ($slider!="" && $running_text!="" && $situs_terkait!="" && $download!="" && $download!="" && $media_sosial!="" && $kontak_email!="" && $popup!="") {$ekstra = "hidden";} else {$ekstra ="";}
} else {
	$pengaturan 	= "";
	$legislatif 	= "";
	$profil 		= "";

	$pendaftaran 	= "";
	$agenda 		= "";
	$artikel 		= "";

	$kategori 		= "";
	$mberita 		= "";

	$video 			= "";
	$foto 			= "";
	$galeril 		= "";

	$tentang_kita 	= "";
	$info_dpc 		= "";
	$menu 			= "";

	$slider 		= "";
	$running_text 	= "";
	$situs_terkait 	= "";
	$download 		= "";
	$media_sosial 	= "";
	$kontak_email 	= "";
	$popup 			= "";
	$ekstra 		= "";
}
?>
<div class="navbar navbar-inverse navbar-fixed-top">
	<div class="container">
		<div class="navbar-header">
			<a href="index" class="navbar-brand">Dashboard</a>
			<button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</button>
		</div>
		<div class="navbar-collapse collapse" id="navbar-main">
			<ul class="nav navbar-nav">
				<?php
				/*
				<li class="dropdown <?php echo $profil; ?>">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Pengaturan<span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="download">
						<li><a tabindex="-1" href="<?php echo BASE_URL; ?>admin/menu">Manajemen Menu</a></li>
					</ul>
				</li>
				<li class="dropdown <?php echo $mberita; ?>">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Blog <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="download">
						<li><a href="<?php echo BASE_URL; ?>admin/katberita">Kategori</a></li>
						<li><a href="<?php echo BASE_URL; ?>admin/berita">Blog</a></li>
					</ul>
				</li>
				*/
				?>

				<li class="dropdown <?php echo $mberita; ?>">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Produk <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="download">
						<li><a href="<?php echo BASE_URL; ?>admin/kategori">Kategori</a></li>
						<li><a href="<?php echo BASE_URL; ?>admin/produk">Produk</a></li>
					</ul>
				</li>

				<li class="dropdown <?php echo $mberita; ?>">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Member <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="download">
						<li><a href="<?php echo BASE_URL; ?>admin/member">Member</a></li>
					</ul>
				</li>

				<!-- <li><a href="index.php?module=agenda&page=list">Agenda</a></li> -->

				<li class="dropdown <?php echo $ekstra; ?>">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="download">Ekstra<span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="download">
						<li <?php echo $slider; ?>><a tabindex="-1" href="<?php echo BASE_URL; ?>admin/slider">Slider</a></li>
						<li <?php echo $slider; ?>><a tabindex="-1" href="<?php echo BASE_URL; ?>admin/pesan">Pesan</a></li>
						<li <?php echo $media_sosial; ?>><a tabindex="-1" href="<?php echo BASE_URL; ?>admin/medsos">Media Sosial</a></li>
						<li <?php echo $kontak_email; ?>><a tabindex="-1" href="<?php echo BASE_URL; ?>admin/kontak">Kontak Email</a></li>
						<!-- <li <?php echo $popup; ?>><a tabindex="-1" href="index.php?module=popup&page=list">Popup</a></li> -->
					</ul>
				</li>
			</ul>

			<ul class="nav navbar-nav navbar-right">
				<li style="background:#e7e7e7;"><a href="index.php?module=report"><i class="fa fa-life-buoy"></i>&nbsp; Technical Support</a></li>
				<li class="dropdown">
					<a class="dropdown-toggle" data-toggle="dropdown" href="#" id="directory">Akun <span class="caret"></span></a>
					<ul class="dropdown-menu" aria-labelledby="directory">
						<li><a tabindex="-1" href="<?php echo BASE_URL; ?>admin/profil"><i class="fa fa-user"></i> Profil</a></li>
						<li><a tabindex="-1" href="<?php echo BASE_URL; ?>admin/pengaturan"><i class="fa fa-wrench"></i> Pengaturan</a></li>
						<li class="divider"></li>
						<li><a tabindex="-1" href="<?php echo BASE_URL; ?>admin/logout"><i class="fa fa-shutdown"></i> Logout</a></li>
					</ul>
				</li>
			</ul>
		</div> <!-- .navbar-collapse collapse -->
	</div> <!-- .container -->
</div> <!-- .navbar navbar-inverse -->