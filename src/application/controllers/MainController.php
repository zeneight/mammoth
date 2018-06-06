<?php
namespace src\application\controllers;
use Controller;
/**
* Main Controller untuk template ini
*/
class MainController extends Controller
{	
	public function template($viewName, $data=array())
	{
		// ========= menyiapkan model =========== //
		$this->model("pengaturan");
		$this->model("menu");
		$this->model("kategori");
		$this->model("informasi");
		$this->model("produk");
		$this->model("katberita");
		$this->model("berita");
		$this->model("slider");
		$this->model("medsos");

		
		// ======== query ========== //
		$query = $this->pengaturan->selectAll();
		$datapengaturan = $this->pengaturan->getResult($query);

		$query = $this->katberita->selectAll();
		$datakatberita = $this->katberita->getResult($query);

		$query = $this->berita->selectAll();
		$databerita = $this->pengaturan->getResult($query);

		$query = $this->informasi->selectAll();
		$datainformasi = $this->informasi->getResult($query);

		$query = $this->medsos->selectAll();
		$datamedsos = $this->medsos->getResult($query);

		$query = $this->slider->selectAll("RAND()");
		$dataslide = $this->slider->getResult($query);

		
		// ========= menu ========= //
		$query = $this->menu->selectWhere(array('induk'=>0), 'urutan', 'ASC');
		$menu = $this->menu->getResult($query);


		// ======== bind data ========== //
		$view = $this->view("template");
		$view->bind("viewName", $viewName);
		$view->bind("pengaturan", $datapengaturan);
		$view->bind("medsos", $datamedsos);
		$view->bind("slider", $dataslide);

		$view->bind("data", array_merge($data, array(
			"menu"=>$menu,
			"informasi"=>$datainformasi,
			"katberita"=>$datakatberita,
			"slider"=>$dataslide
		)));
	}

	// ====== target menu ========== //
	function get_link($datajenis, $datalink) {
		$link = "";
		if ($datajenis == "kategori") {
			$qkat 	= $this->kategori->selectWhere(array("id_kategori"=>$datalink));
			$dkat 	= $this->kategori->getResult($qkat);
			$jml 	= $this->kategori->getRows($qkat);
			if ($jml>=1) $link = BASE_PATH. "produk/kategori/".$dkat[0]["slug"];

		} elseif ($datajenis == "katberita") {
			$qkb 	= $this->katberita->selectWhere(array("id_informasi"=>$datalink));
			$dkb 	= $this->katberita->getResult($qkb);
			$jml 	= $this->katberita->getRows($qkb);
			if ($jml>=1) $link = BASE_PATH. "produk/informasi/".$dkb[0]["slug"];

		} elseif ($datajenis == "informasi") {
			$qinfo 	= $this->informasi->selectWhere(array("id_informasi"=>$datalink));
			$dinfo 	= $this->informasi->getResult($qinfo);
			$jml 	= $this->informasi->getRows($qinfo);
			if ($jml>=1) $link = BASE_PATH. "produk/informasi/".$dkat[0]["slug"];
			
		} else {
			$link = BASE_PATH."/".$datalink;
		}
		return $link;
	}

	// fungsi ambil data
	function metatagdata($id, $table, $url="", $path="") {
		$q = DB::run("SELECT * FROM $table WHERE id = ?", array($id))->fetch();	
		$urlnya 	= ($url=="") ? $table : $url;
		
		$pathnya 	= ($path=="") ? "assets/$table/$q[img]" : "assets/$path/$q[img]";

		$mtitle 			= $q["title$lang"]." | ".COMPANY;
		$mdescription 		= substr(strip_tags($q['content']),0,400);
		$mimage 			= $pathnya;
		$murl 				= BASEURL."$urlnya/".$q['id']."/".getPermalink($q['title']);
		$mtipe				= "article";

		return array($mtitle, $mdescription, $mimage, $murl, $mtipe);
	}
}