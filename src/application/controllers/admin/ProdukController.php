<?php
use src\application\controllers\AdminMainController;
/**
* 
*/
class ProdukController extends AdminMainController
{	
	function __construct()
	{
		parent::__construct();
		$this->model("produk");
	}

	public function index() {
		$this->model('kategori');
		$query 	= $this->kategori->selectAll();
		$data 	= $this->kategori->getResult($query);

		$this->template("admin/produk", "produk", $data);
	}

	public function listData() {
		require_once ROOT."/application/functions/function_action.php";
		require_once ROOT."/application/functions/function_rupiah.php";

		$query 	= $this->produk->selectJoin(
										array("kategori"), 
										"LEFT JOIN", 
										array('produk.id_kategori' => 'kategori.id_kategori'),
										"",
										"produk.id_produk", 
										"DESC"
											);

		$list 	= $this->produk->getResult($query);
		$data 	= array();

		$no 	= 0;
		foreach ($list as $li) {
			$no ++;
			$row 	= array();
			$row[] 	= $no.".";
			$row[] 	= "<img src='".BASE_PATH."assets/images/produk/thumbs/$li[gambar]'>";
			$row[]	= $li["nama_produk"];
			$row[]	= $li["nama_kategori"];
			$row[]	= $li["berat"];
			$row[]	= $li["stok"];
			$row[]	= "Rp ".format_rupiah($li["harga"]);
			$row[]	= create_action($li["id_produk"]);
			$data[] = $row;
		}

		$output = array("data" => $data);
		echo json_encode($output);
	}

	public function edit($id) {
		$query 	= $this->produk->selectWhere(array('id_produk' => $id));
		$data 	= $this->produk->getResult($query);
		echo json_encode($data[0]);
		// $data[0]['gambar'];
	}

	public function insert() {
		$data 	= array();
		if ($_FILES['gambar']['size'] != 0 && $_FILES['gambar']['error'] == 0) {
			$data["gambar"] = $this->imageUploadHandler(
									$_FILES['gambar'], 
									$_FILES['gambar']['name'], 
									$_FILES['gambar']['tmp_name']
								);
		}

		$data["nama_produk"] 	= $_POST["produk"];
		$data["slug"] 			= $_POST["slug"];
		$data["id_kategori"] 	= $_POST["kategori"];
		$data["stok"] 			= $_POST["stok"];
		$data["harga"] 			= $_POST["harga"];
		$data["berat"] 			= $_POST["berat"];
		$data["deskripsi"] 		= htmlentities(($_POST["deskripsi"]));

		$simpan	= $this->produk->insert($data);
		if ($simpan) echo "success";
	}

	public function update() {
		$id 	= $_POST["id"];

		$data 	= array();
		if ($_FILES['gambar']['size'] != 0 && $_FILES['gambar']['error'] == 0) {
			$this->deleteImage("produk", array('id_produk' => $id));
			$data["gambar"] = $this->imageUploadHandler(
									$_FILES['gambar'], 
									$_FILES['gambar']['name'], 
									$_FILES['gambar']['tmp_name']
								);
		}

		$data["nama_produk"] 	= $_POST["produk"];
		$data["slug"] 			= $_POST["slug"];
		$data["id_kategori"] 	= $_POST["kategori"];
		$data["stok"] 			= $_POST["stok"];
		$data["harga"] 			= $_POST["harga"];
		$data["berat"] 			= $_POST["berat"];
		$data["deskripsi"] 		= htmlentities(($_POST["deskripsi"]));

		$simpan	= $this->produk->update($data, array('id_produk' => $id));
	}

	public function delete($id) {
		$response = array('status'=>false);
		
		$hapusgambar = $this->deleteImage("produk", array('id_produk' => $id));
		$hapus = $this->produk->delete(array('id_produk' => $id));
		if ($hapus && $id) $response['status'] = true;

		// Send JSON Data to AJAX Request
		echo json_encode($response);
	}
}