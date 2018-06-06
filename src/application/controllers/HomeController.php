<?php
use \src\application\controllers\MainController;

/**
* Controller Home
*/
class HomeController extends MainController
{
	
	public function __construct()
	{
		$this->model("pengaturan");
		$this->model("produk");
		$this->model("kategori");
		require_once(ROOT.DS."src/application/functions/function_frontweb.php");
	}

	public function index() {
		// pengaturan
		$qpengaturan 	= $this->pengaturan->selectAll();
		$dpengaturan 	= $this->pengaturan->getResult($qpengaturan);

		// kategori
		$qkategori 		= $this->kategori->selectAll();
		$dkategori 		= $this->kategori->getResult($qkategori);

		// produk
		$qproduk 	= $this->produk->selectAll("id_produk", "DESC", 4);
		$dproduk 	= $this->produk->getResult($qproduk);

		$this->template("home", array('pengaturan'=>$dpengaturan, 'produk'=>$dproduk, 'kategori'=>$dkategori));
	}

	public function load($posisi) {
		$query 	= $this->produk->selectAll("id_produk", "DESC", $posisi.", 2");
		$dataproduk 	= $this->produk->getResult($query);

		foreach ($dataproduk as $produk) {
			$urlnya = BASE_URL."portfolio/detail/".$produk["slug"];
			echo '
				<section class="spotlight">
					<div class="image">
						<img src="'.getThumbnail($produk["gambar"], "produk").'" 
							alt="'.getPermalink($produk["nama_produk"]).'" />
					</div>
					<div class="content">
						<h2><a href="'.$urlnya.'">'.$produk["nama_produk"].'</a></h2>
						'.substr(strip_tags(html_entity_decode($produk["deskripsi"])), 0, 200).'...
					</div>
				</section>
			';
		}
	}
}