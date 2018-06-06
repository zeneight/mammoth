<?php
use src\application\controllers\AdminMainController;
/**
* 
*/
class KategoriController extends AdminMainController
{
	
	function __construct()
	{
		parent::__construct();
		$this->model("kategori");
	}

	public function index() {
		// nama halaman
		$data = array();
		$this->template("admin/kategori", "kategori", $data);
	}

	public function listData() {
		require_once ROOT."/application/functions/function_action.php";
		
		$query 	= $this->kategori->selectAll("id_kategori", "DESC");
		$list 	= $this->kategori->getResult($query);
		
		$data 	= array();

		$no 	= 0;
		foreach ($list as $li) {
			$no ++;
			$row 	= array();
			$row[] 	= $no;
			$row[]	= $li["nama_kategori"];
			$row[]	= $li["slug"];
			$row[]	= create_action($li["id_kategori"]);
			$data[] = $row;
		}

		$output = array("data" => $data);
		echo json_encode($output);
	}

	public function edit($id) {
		$query 	= $this->kategori->selectWhere(array('id_kategori' => $id));
		$data 	= $this->kategori->getResult($query);
		echo json_encode($data[0]);
	}

	public function insert() {
		$data 	= array();
		$data["nama_kategori"] 	= $_POST["kategori"];
		$data["deskripsi"] 		= $_POST["deskripsi"];
		$data["slug"] 			= $_POST["slug"];

		$simpan	= $this->kategori->insert($data);
	}

	public function update() {
		$data 	= array();
		$data["nama_kategori"] 	= $_POST["kategori"];
		$data["deskripsi"] 		= $_POST["deskripsi"];
		$data["slug"] 			= $_POST["slug"];

		$id 	= $_POST["id"];
		$simpan	= $this->kategori->update($data, array('id_kategori' => $id));
	}

	public function delete($id) {
		$response = array('status'=>false);
		
		$hapus = $this->kategori->delete(array('id_kategori' => $id));
		if ($hapus && $id) $response['status'] = true;

		// Send JSON Data to AJAX Request
		echo json_encode($response);
	}
}