<?php
use src\application\controllers\AdminMainController;
/**
* 
*/
class InformasiController extends AdminMainController
{
	function __construct()
	{
		parent::__construct();
		$this->model("informasi");
	}

	public function index() {
		$this->template("admin/informasi", "informasi");
	}

	public function listData() {
		require_once ROOT."/application/functions/function_action.php";

		$query 	= $this->informasi->selectAll("id_informasi", "DESC");
		$list 	= $this->informasi->getResult($query);
		$data 	= array();

		$no 	= 0;
		foreach ($list as $li) {
			$no ++;
			$row 	= array();
			$row[] 	= $no;
			$row[]	= $li["judul"];
			$row[]	= $li["slug"];
			$row[]	= create_action($li["id_informasi"]);
			$data[] = $row;
		}

		$output = array("data" => $data);
		echo json_encode($output);
	}

	public function edit($id) {
		$query 	= $this->informasi->selectWhere(array('id_informasi' => $id));
		$data 	= $this->informasi->getResult($query);
		echo json_encode($data[0]);
	}

	public function insert() {
		$data 	= array();
		/*if ($_FILES['gambar']['size'] != 0 && $_FILES['gambar']['error'] == 0) {
			$data["gambar"] = $this->imageUploadHandler(
									$_FILES['gambar'], 
									$_FILES['gambar']['name'], 
									$_FILES['gambar']['tmp_name'],
									"berita"
								);
		}*/

		$data["judul"] 			= $_POST["judul"];
		$data["slug"] 			= $_POST["slug"];
		$data["konten"] 		= htmlentities(($_POST["deskripsi"]));

		$simpan	= $this->informasi->insert($data);
		if ($simpan) echo "success";
	}

	public function update() {
		$id 	= $_POST["id"];

		$data 	= array();
		$data["judul"] 			= $_POST["judul"];
		$data["slug"] 			= $_POST["slug"];
		$data["konten"] 		= htmlentities(($_POST["deskripsi"]));

		$simpan	= $this->informasi->update($data, array('id_informasi' => $id));
	}

	public function delete($id) {
		$response = array('status'=>false);
		// $this->deleteImage("berita", array('id_berita' => $id), "berita");
		
		$hapus = $this->informasi->delete(array('id_informasi' => $id));
		if ($hapus && $id) $response['status'] = true;

		// Send JSON Data to AJAX Request
		echo json_encode($response);
	}
}