<?php
use \application\controllers\MainController;
/**
* Controller Produk
*/
class ProdukController extends MainController
{
	
	public function __construct()
	{
		$this->model("produk");
	}

	public function index() {
		$query 	= $this->produk->selectAll();
		$data 	= $this->produk->getResult($query);
		$this->template("produk/index", $data);
	}

	public function add() {
		$this->template("produk/add");
	}

	public function edit($id) {
		$data = $this->produk->show($id);
		$this->template("produk/edit", $data);
	}

	public function delete($id) {
		$hapus = $this->produk->delete($id);
		if ($hapus) $this->redirect("produk");
	}

	public function insert() {
		$error 	= array();

		$data 	= array();
		$data["nama_produk"] 	= $_POST["nama"];
		$data["harga"] 			= $_POST["harga"];

		if (empty($data["nama_produk"])) array_push($error, "Nama belum diisi!");
		if (empty($data["harga"])) array_push($error, "Harga belum diisi!");

		if (count($error)==0) {
			$simpan 	= $this->produk->insert($data);
			if ($simpan) $this->redirect("produk");
		} else {
			$this->template("produk/add", array("msg"=> $error));
		}
	}

	public function update() {
		$error 	= array();

		$data 	= array();
		$data["nama_produk"] 	= $_POST["nama"];
		$data["harga"] 			= $_POST["harga"];
		$id 		 			= $_POST["id"];

		if (empty($data["nama_produk"])) array_push($error, "Nama belum diisi!");
		if (empty($data["harga"])) array_push($error, "Harga belum diisi!");

		if (count($error)==0) {
			$simpan 	= $this->produk->update($data, $id);
			if ($simpan) $this->redirect("produk");
		} else {
			$data = $this->produk->show($id);
			$this->template("produk/edit", array("msg"=> $error, "data" => $data));
		}
	}

	public function listdata() {
		$query 	= $this->produk->selectAll();
		$list 	= $this->produk->getResult($query);
		$data 	= array();
		$no 	= 0;

		foreach ($list as $li) {
			$no++;
			$row 	= array();
			$row[]	= $no;
			$row[]	= $li["nama_produk"];
			$row[]	= $li["harga"];
			$row[]	= "<a class='btn btn-primary' href='".BASE_URL."produk/edit/".$li['id_produk']."'>Edit</a>
						<a class='btn btn-primary' onclick='deleteData(".$li['id_produk'].")'>Hapus</a>";

			$data[] = $row;
		}

		$output		= array("data" => $data);
		echo json_encode($output);
	}
}