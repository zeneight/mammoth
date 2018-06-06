<?php
use src\application\controllers\AdminMainController;
/**
* 
*/
class PengaturanController extends AdminMainController
{
	function __construct()
	{
		parent::__construct();
		$this->model("pengaturan");
	}

	public function index() {
		$query 	= $this->pengaturan->selectAll();
		$data 	= $this->pengaturan->getResult($query);
		$this->template("admin/pengaturan", "pengaturan", $data);
	}

	public function update() {
		$id 	= 1;

		$data 	= array();
		if ($_FILES['gambar']['size'] != 0 && $_FILES['gambar']['error'] == 0) {
			$this->deleteImage("pengaturan", array('id_pengaturan' => $id), "pengaturan", "favicon");
			$data["favicon"] = $this->imageUploadHandler(
									$_FILES['gambar'], 
									$_FILES['gambar']['name'], 
									$_FILES['gambar']['tmp_name'],
									"pengaturan"
								);
		}

		$data["nama_website"] 		= $_POST["nama_website"];
		$data["email"] 				= $_POST["email"];
		$data["alamat"] 			= $_POST["alamat"];
		$data["telp"] 				= $_POST["telp"];

		$data["widget_facebook"] 	= $_POST["widget_facebook"];
		$data["widget_twitter"] 	= $_POST["widget_twitter"];

		$data["judul"] 				= $_POST["judul"];
		$data["deskripsi"] 			= $_POST["deskripsi"];

		// $data["konten"] 		= htmlentities(($_POST["deskripsi"]));

		$simpan	= $this->pengaturan->update($data, array('id_pengaturan' => $id));

		if ($simpan) 
			echo "success";
		else 
			echo $this->pengaturan->getError();
	}

	public function delete($id) {
		$response = array('status'=>false);
		// $this->deleteImage("berita", array('id_berita' => $id), "berita");
		
		$hapus = $this->pengaturan->delete(array('id_pengaturan' => $id));
		if ($hapus && $id) $response['status'] = true;

		// Send JSON Data to AJAX Request
		echo json_encode($response);
	}
}