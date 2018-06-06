<?php
use src\application\controllers\AdminMainController;
/**
* 
*/
class BeritaController extends AdminMainController
{
	function __construct()
	{
		parent::__construct();
		$this->model("berita");
	}

	public function index() {
		$this->model("katberita");
		$query 	= $this->katberita->selectAll();
		$data 	= $this->katberita->getResult($query);

		$this->template("admin/berita", "berita", $data);
	}

	public function listData() {
		require_once ROOT."/application/functions/function_action.php";
		require_once ROOT."/application/functions/function_rupiah.php";

		$query 	= $this->berita->selectJoin(
										array("katberita"), 
										"LEFT JOIN", 
										array('berita.id_kategori' => 'katberita.id_katberita'),
										"",
										"berita.id_berita", 
										"DESC"
											);

		$list 	= $this->berita->getResult($query);
		$data 	= array();

		$no 	= 0;
		foreach ($list as $li) {
			$no ++;
			$row 	= array();
			$row[] 	= $no;
			$row[] 	= "<img height='80px' width='80px' src='".BASE_PATH."assets/images/berita/thumbs/$li[gambar]'>";
			$row[]	= $li["nama_berita"];
			$row[]	= $li["nama_katberita"];
			$row[]	= $li["hits"];
			$row[]	= create_action($li["id_berita"]);
			$data[] = $row;
		}

		$output = array("data" => $data);
		echo json_encode($output);
	}

	public function edit($id) {
		$query 	= $this->berita->selectWhere(array('id_berita' => $id));
		$data 	= $this->berita->getResult($query);
		echo json_encode($data[0]);
	}

	public function insert() {
		$data 	= array();
		if ($_FILES['gambar']['size'] != 0 && $_FILES['gambar']['error'] == 0) {
			$data["gambar"] = $this->imageUploadHandler(
									$_FILES['gambar'], 
									$_FILES['gambar']['name'], 
									$_FILES['gambar']['tmp_name'],
									"berita"
								);
		}

		$data["nama_berita"] 	= $_POST["berita"];
		$data["slug"] 			= $_POST["slug"];
		$data["id_kategori"] 	= $_POST["kategori"];
		$data["hits"] 			= $_POST["hits"];
		$data["deskripsi"] 		= htmlentities(($_POST["deskripsi"]));

		$simpan	= $this->berita->insert($data);
		if ($simpan) echo "success";
	}

	public function update() {
		$id 	= $_POST["id"];

		$data 	= array();
		if ($_FILES['gambar']['size'] != 0 && $_FILES['gambar']['error'] == 0) {
			$this->deleteImage("berita", array('id_berita' => $id), "berita");
			$data["gambar"] = $this->imageUploadHandler(
									$_FILES['gambar'], 
									$_FILES['gambar']['name'], 
									$_FILES['gambar']['tmp_name'],
									"berita"
								);
		}

		$data["nama_berita"] 	= $_POST["berita"];
		$data["slug"] 			= $_POST["slug"];
		$data["id_kategori"] 	= $_POST["kategori"];
		$data["hits"] 			= $_POST["hits"];
		$data["deskripsi"] 		= htmlentities(($_POST["deskripsi"]));

		$simpan	= $this->berita->update($data, array('id_berita' => $id));
	}

	public function delete($id) {
		$response = array('status'=>false);
		$this->deleteImage("berita", array('id_berita' => $id), "berita");
		
		$hapus = $this->berita->delete(array('id_berita' => $id));
		if ($hapus && $id) $response['status'] = true;

		// Send JSON Data to AJAX Request
		echo json_encode($response);
	}
}