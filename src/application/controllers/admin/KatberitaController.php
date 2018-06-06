<?php
use src\application\controllers\AdminMainController;
/**
* 
*/
class KatberitaController extends AdminMainController
{
	
	function __construct()
	{
		parent::__construct();
		$this->model("katberita");
	}

	public function index() {
		// nama halaman
		$data = array();

		$this->template("admin/katberita", "katberita", $data);
	}

	public function listData() {
		require_once ROOT."/application/functions/function_action.php";
		
		$query 	= $this->katberita->selectAll("id_katberita", "DESC");
		$list 	= $this->katberita->getResult($query);
		
		$data 	= array();

		$no 	= 0;
		foreach ($list as $li) {
			$no ++;
			$row 	= array();
			$row[] 	= $no;
			$row[]	= $li["nama_katberita"];
			$row[]	= $li["slug"];
			$row[]	= create_action($li["id_katberita"]);
			$data[] = $row;
		}

		$output = array("data" => $data);
		echo json_encode($output);
	}

	public function edit($id) {
		$query 	= $this->katberita->selectWhere(array('id_katberita' => $id));
		$data 	= $this->katberita->getResult($query);
		echo json_encode($data[0]);
	}

	public function insert() {
		$data 	= array();
		$data["nama_katberita"] 	= $_POST["katberita"];
		$data["slug"] 			= $_POST["slug"];

		$simpan	= $this->katberita->insert($data);
	}

	public function update() {
		$data 	= array();
		$data["nama_katberita"] 	= $_POST["katberita"];
		$data["slug"] 			= $_POST["slug"];

		$id 	= $_POST["id"];
		$simpan	= $this->katberita->update($data, array('id_katberita' => $id));
	}

	public function delete($id) {
		$response = array('status'=>false);
		
		$hapus = $this->katberita->delete(array('id_katberita' => $id));
		if ($hapus && $id) $response['status'] = true;

		// Send JSON Data to AJAX Request
		echo json_encode($response);
	}
}