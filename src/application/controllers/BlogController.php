<?php
use \application\controllers\MainController;
/**
* Controller BLOG
*/
class BlogController extends MainController
{
	
	public function __construct()
	{
		$this->model("berita");
		require_once(ROOT.DS."application/functions/function_frontweb.php");
	}

	public function index() {
		$query 	= $this->berita->selectAll("id_berita", "DESC", 2);
		$data 	= $this->berita->getResult($query);
		
		$halaman = array();
		$halaman["judul"] 		= "Blog";
		$halaman["deskripsi"] 	= "Tips dan informasi seputar Teknologi & Bali";
		$halaman["controller"] 	= "blog";
		$halaman["tabel"] 		= "berita";
		$halaman["url"] 		= "blog/baca";
		
		$this->template("list", array("blog"=>$data, "halaman"=>$halaman));
	}

	public function baca($slug) {
		$query 	= $this->berita->selectWhere(array('slug'=>$slug));
		$berita = $this->berita->getResult($query);

		$data = array();
		$data["hits"] 	= $berita[0]["hits"]+1;
		$uphit	= $this->berita->update($data, array('slug'=>$slug));

		$halaman = array();
		$halaman["tabel"] 		= "berita";

		$this->template("detail", array("detail"=>$berita, "halaman"=>$halaman));
	}

	public function load($posisi) {
		$query 	= $this->berita->selectAll("id_berita", "DESC", $posisi.", 2");
		$databerita 	= $this->berita->getResult($query);

		foreach ($databerita as $berita) {
			$urlnya = BASE_URL."blog/baca/".$berita["slug"];
			echo '
				<section class="spotlight">
					<div class="image">
						<img src="'.getThumbnail($berita["gambar"], "berita").'" 
							alt="'.getPermalink($berita["nama_berita"]).'" />
					</div>
					<div class="content">
						<h2><a href="'.$urlnya.'">'.$berita["nama_berita"].'</a></h2>
						'.substr(strip_tags(html_entity_decode($berita["deskripsi"])), 0, 200).'...
					</div>
				</section>
			';
		}
	}
}