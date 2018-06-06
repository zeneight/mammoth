<?php
use src\application\controllers\AdminMainController;
/**
* 
*/
class SliderController extends AdminMainController
{
	
	function __construct()
	{
		parent::__construct();
		$this->model("slider");
	}

	public function index() {
		$this->template("admin/slider", "slider");
	}

	public function listData() {
		require_once ROOT."/src/application/functions/function_action.php";
		// require_once ROOT."/application/functions/function_rupiah.php";

		$query 	= $this->slider->selectAll("id_slider", "DESC");
		$list 	= $this->slider->getResult($query);
		$data 	= array();

		$no 	= 0;
		foreach ($list as $li) {
			$no ++;
			$row 	= array();
			$row[] 	= $no;
			$row[] 	= "<img src='".BASE_PATH."assets/images/slider/thumbs/$li[gambar]'>";
			$row[] 	= $li["nama_slider"];
			$row[]	= create_action($li["id_slider"]);
			$data[] = $row;
		}

		$output = array("data" => $data);
		echo json_encode($output);
	}

	public function edit($id) {
		$query 	= $this->slider->selectWhere(array('id_slider' => $id));
		$data 	= $this->slider->getResult($query);
		echo json_encode($data[0]);
	}

	public function insert() {
		$response 	= array('status'=>false);
		$data 		= array();
		if ($_FILES['gambar']['size'] != 0 && $_FILES['gambar']['error'] == 0) {
			$response_handler = $this->imageUploadHandler(
									$_FILES['gambar'], 
									$_FILES['gambar']['name'], 
									$_FILES['gambar']['tmp_name'],
									"slider"
								);
			$data["gambar"] = $response_handler;
		}

		$data["nama_slider"] 	= $_POST["nama_slider"];
		$data["deskripsi"] 		= htmlentities($_POST["deskripsi"]);
		$data["status"] 		= $_POST["status"];

		$simpan	= $this->slider->insert($data);
		
		if ($simpan) $response['status'] = true; else $response['status'] = false;
		echo json_encode($response);
	}

	public function update() {
		$response 	= array('status'=>false);
		$data 		= array();
		$id 		= $_POST["id"];

		if ($_FILES['gambar']['size'] != 0 && $_FILES['gambar']['error'] == 0) {
			$this->deleteImage("slider", array('id_slider' => $id), "slider");

			$response_handler = $this->imageUploadHandler(
									$_FILES['gambar'], 
									$_FILES['gambar']['name'], 
									$_FILES['gambar']['tmp_name'],
									"slider"
								);
			$data["gambar"] = $response_handler;
		}

		$data["nama_slider"] 	= $_POST["nama_slider"];
		$data["deskripsi"] 		= htmlentities($_POST["deskripsi"]);
		$data["status"] 		= $_POST["status"];

		$simpan	= $this->slider->update($data, array('id_slider' => $id));

		if ($simpan) $response['status'] = true; else $response['status'] = false;
		echo json_encode($response);
	}

	public function delete($id) {
		$response = array('status'=>false);

		$this->deleteImage("slider", array('id_slider' => $id), "slider");
		$hapus = $this->slider->delete(array('id_slider' => $id));
		if ($hapus && $id) $response['status'] = true;

		// Send JSON Data to AJAX Request
		echo json_encode($response);
	}
}