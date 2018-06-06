<?php
use \application\controllers\MainController;
/**
* Controller Portfolio
*/
class PortfolioController extends MainController
{
	
	public function __construct()
	{
		$this->model("produk");
		require_once(ROOT.DS."application/functions/function_frontweb.php");
	}

	public function index() {
		$query 	= $this->produk->selectAll("id_produk", "DESC", 2);
		$data 	= $this->produk->getResult($query);
		
		$halaman = array();
		$halaman["judul"] 		= "Portfolio";
		$halaman["deskripsi"] 	= "Beberapa Portfolio yang telah kami kerjakan";
		$halaman["controller"] 	= "portfolio";
		$halaman["tabel"] 		= "produk";
		$halaman["url"] 		= "portfolio/detail";
		
		$this->template("list", array("portfolio"=>$data, "halaman"=>$halaman));
	}

	public function detail($slug) {
		$query 	= $this->produk->selectWhere(array('slug'=>$slug));
		$produk = $this->produk->getResult($query);

		// $data = array();
		// $data["hits"] 	= $produk[0]["hits"]+1;
		// $uphit	= $this->produk->update($data, array('slug'=>$slug));

		$halaman = array();
		$halaman["tabel"] 		= "produk";
		
		$this->template("detail", array("detail"=>$produk, "halaman"=>$halaman));
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