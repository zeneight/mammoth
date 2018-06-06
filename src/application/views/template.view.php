<?php
/*//////////////////////////////////////////////////////////*/
/*//////////////////PHP TEMPLATE START//////////////////////*/
/*//////////////////////////////////////////////////////////*/

// ============= konfigurasi header global ================ //
$metatag = array();
if ($viewName=="home" || $viewName=="") {
	$metatag["mtitle_c"]			= $pengaturan[0]["nama_website"];
	$metatag["mdescription_c"]     	= "Selamat Datang di mybaliku!";
	$metatag["mimage_c"]           	= "assets/images/bg.jpg";
	$metatag["murl_c"]             	= $pengaturan[0]["url_website"];
	$metatag["mtipe_c"]            	= "website";
	$metatag["keywords"]          	= "Website, Webdesign, Denpasar, Bali, Indonesia, Ary, Wira, Andika";
	$metatag["sitename"]           	= $pengaturan[0]["nama_website"];
	$metatag["article_author"]     	= $pengaturan[0]["widget_facebook"];
	$metatag["article_publisher"]  	= $pengaturan[0]["widget_facebook"];
	$metatag["twitter_site"]       	= "@".$pengaturan[0]["widget_twitter"];
	$metatag["twitter_creator"]    	= "@".$pengaturan[0]["widget_twitter"];

	$metatag["og_site_name"]		= $pengaturan[0]["nama_website"];
	$metatag["og_title"]			= "MyBaliku";
	$metatag["og_image"]			= "MyBaliku";
	$metatag["og_url"]				= "MyBaliku";
	$metatag["og_description"]		= "MyBaliku";
	$metatag["og_type"]				= "MyBaliku";
	$metatag["twitter_title"]		= "MyBaliku";
	$metatag["twitter_description"]		= "MyBaliku";
	$metatag["twitter_url"]			= "MyBaliku";
	$metatag["twitter_image"]		= "MyBaliku";
} else {
	$metatag["mtitle_c"]			= ucwords($data["halaman"]["judul"])." ~ ".$pengaturan[0]["nama_website"];
	$metatag["mdescription_c"]     	= "Selamat Datang di mybaliku!";
	$metatag["mimage_c"]           	= "assets/images/bg.jpg";
	$metatag["murl_c"]             	= $pengaturan[0]["url_website"];
	$metatag["mtipe_c"]            	= "website";
	$metatag["keywords"]          	= "Website, Webdesign, Denpasar, Bali, Indonesia, Ary, Wira, Andika";
	$metatag["sitename"]           	= $pengaturan[0]["nama_website"];
	$metatag["article_author"]     	= $pengaturan[0]["widget_facebook"];
	$metatag["article_publisher"]  	= $pengaturan[0]["widget_facebook"];
	$metatag["twitter_site"]       	= "@".$pengaturan[0]["widget_twitter"];
	$metatag["twitter_creator"]    	= "@".$pengaturan[0]["widget_twitter"];

	$metatag["og_site_name"]		= $pengaturan[0]["nama_website"];
	$metatag["og_title"]			= "MyBaliku";
	$metatag["og_image"]			= "MyBaliku";
	$metatag["og_url"]				= "MyBaliku";
	$metatag["og_description"]		= "MyBaliku";
	$metatag["og_type"]				= "MyBaliku";
	$metatag["twitter_title"]		= "MyBaliku";
	$metatag["twitter_description"]		= "MyBaliku";
	$metatag["twitter_url"]			= "MyBaliku";
	$metatag["twitter_image"]		= "MyBaliku";
}
	
$metatag["meta_author"]        = $pengaturan[0]["email"];
$metatag["favicon"]           = BASE_PATH."assets/images/pengaturan/thumbs/".$pengaturan[0]["favicon"];
// =============================================== //

// memanggil semua fungsi
$function = array("html", "rupiah", "frontweb", "metatag");
foreach ($function as $func) {
	require_once ROOT."/src/application/functions/function_".$func.".php";
}

// pengaturan slide template
if ($viewName=="home" || $viewName=="") {
	$kelastubuh = "class='landing'";
	$kelasheader = "class='alt'";
} else {
	$kelastubuh = "";
	$kelasheader = "";
}
/*//////////////////////////////////////////////////////////*/
/*////////////////////PHP TEMPLATE END//////////////////////*/
/*//////////////////////////////////////////////////////////*/

/*//////////////////////////////////////////////////////////*/
/*///////////////////HTML TEMPLATE START////////////////////*/
/*//////////////////////////////////////////////////////////*/
?>
<!DOCTYPE HTML>
<html>
<head>
<?php
// memanggil metatag
load_metatag($metatag);

// memanggil css & js
load_css("assets/tema/css/main.css");
load_script("assets/tema/js/jquery.min.js");
?>
<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
<!--[if lte IE 8]><link rel="stylesheet" href="assets/css/ie8.css" /><![endif]-->
<!--[if lte IE 9]><link rel="stylesheet" href="assets/css/ie9.css" /><![endif]-->
<style type="text/css">
	body.landing #page-wrapper {
		background-image: -moz-linear-gradient(top, rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url("<?php echo BASE_PATH; ?>assets/images/slider/<?php echo $slider[0]['gambar']; ?>");
		background-image: -webkit-linear-gradient(top, rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url("<?php echo BASE_PATH; ?>assets/images/slider/<?php echo $slider[0]['gambar']; ?>");
		background-image: -ms-linear-gradient(top, rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url("<?php echo BASE_PATH; ?>assets/images/slider/<?php echo $slider[0]['gambar']; ?>");
		background-image: linear-gradient(top, rgba(0,0,0,0.5), rgba(0,0,0,0.5)), url("<?php echo BASE_PATH; ?>assets/images/slider/<?php echo $slider[0]['gambar']; ?>");
	}

	body.is-mobile.landing #banner,
	body.is-mobile.landing .wrapper.style4 {
		background-image: -moz-linear-gradient(top, 
												rgba(0,0,0,0.5), 
												rgba(0,0,0,0.5)), 
												url("<?php echo BASE_PATH; ?>assets/images/slider/<?php echo $slider[0]['gambar']; ?>");
		background-image: -webkit-linear-gradient(top, 
												rgba(0,0,0,0.5), 
												rgba(0,0,0,0.5)), 
												url("<?php echo BASE_PATH; ?>assets/images/slider/<?php echo $slider[0]['gambar']; ?>");
		background-image: -ms-linear-gradient(top, 
												rgba(0,0,0,0.5), 
												rgba(0,0,0,0.5)), 
												url("<?php echo BASE_PATH; ?>assets/images/slider/<?php echo $slider[0]['gambar']; ?>");
		background-image: linear-gradient(top, rgba(0,0,0,0.5), 
											rgba(0,0,0,0.5)), 
											url("<?php echo BASE_PATH; ?>assets/images/slider/<?php echo $slider[0]['gambar']; ?>");
	}
</style>
</head>
<body <?= $kelastubuh; ?>>
	<!-- Page Wrapper -->
		<div id="page-wrapper">
			<!-- Header -->
			<header id="header" <?= $kelasheader; ?>>
				<h1><a href="<?= BASE_URL; ?>">MyBaliku</a></h1>
				<nav id="nav">
					<ul>
						<li class="special">
							<a href="#menu" class="menuToggle"><span>Menu</span></a>
							<div id="menu">
								<ul>
									<li><a href="<?= BASE_URL; ?>">Beranda</a></li>
									<li><a href="<?= BASE_URL; ?>portfolio">Portfolio</a></li>
									<li><a href="<?= BASE_URL; ?>blog">Blog</a></li>
									<li><a href="#!">Kontak</a></li>
								</ul>
							</div>
						</li>
					</ul>
				</nav>
			</header>

			<!-- Content Section -->
			<?php
			$view = new View($viewName);
			$view->bind('data', $data);
			$view->render();
			?>

			<!-- CTA -->
				<section id="cta" class="wrapper style4">
					<div class="inner">
						<header>
							<h2>MyBaliku</h2>
							<p>Jasa <i>design</i>, konsultan dan pembuatan aplikasi web profesional.</p>
						</header>
						<ul class="actions vertical">
							<li><a href="<?= BASE_URL ?>portfolio" class="button fit special">Portfolio</a></li>
							<li><a href="<?= BASE_URL ?>kontak" class="button fit">Kontak Kami</a></li>
						</ul>
					</div>
				</section>

			<!-- Footer -->
				<footer id="footer">
					<ul class="icons">
						<?php
						foreach ($medsos as $ms) {
							echo '
								<li><a target="_BLANK" href="'.$ms["url"].'" class="icon '.$ms["ikon"].'"><span class="label">'.$ms["nama_medsos"].'</span></a></li>
							';
						}
						?>
					</ul>
					<ul class="copyright">
						<li>&copy; Untitled</li><li>Design: <a href="#!">HTML5 UP</a></li>
					</ul>
				</footer>

		</div>

	<!-- Scripts -->
	<script src="<?= BASE_PATH; ?>assets/tema/js/jquery.scrollex.min.js"></script>
	<script src="<?= BASE_PATH; ?>assets/tema/js/jquery.scrolly.min.js"></script>
	<script src="<?= BASE_PATH; ?>assets/tema/js/skel.min.js"></script>
	<script src="<?= BASE_PATH; ?>assets/tema/js/util.js"></script>
	<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
	<script src="<?= BASE_PATH; ?>assets/tema/js/main.js"></script>
</body>
</html>
<?php
/*//////////////////////////////////////////////////////////*/
/*///////////////////HTML TEMPLATE END////////////////////*/
/*//////////////////////////////////////////////////////////*/
?>