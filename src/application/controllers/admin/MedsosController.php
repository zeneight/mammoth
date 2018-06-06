<?php
use src\application\controllers\AdminMainController;
/**
* 
*/
class MedsosController extends AdminMainController
{
	
	function __construct()
	{
		parent::__construct();
		$this->model("medsos");
	}

	public function index() {
		// nama halaman
		$data = array();

		$this->template("admin/medsos", "medsos", $data);
	}

	public function listData() {
		require_once ROOT."/application/functions/function_action.php";
		
		$query 	= $this->medsos->selectAll("id_medsos", "DESC");
		$list 	= $this->medsos->getResult($query);
		
		$data 	= array();

		$no 	= 0;
		foreach ($list as $li) {
			$no ++;
			$row 	= array();
			$row[] 	= $no;
			$row[]	= $li["ikon"];
			$row[]	= $li["nama_medsos"];
			$row[]	= create_action($li["id_medsos"]);
			$data[] = $row;
		}

		$output = array("data" => $data);
		echo json_encode($output);
	}

	public function edit($id) {
		$query 	= $this->medsos->selectWhere(array('id_medsos' => $id));
		$data 	= $this->medsos->getResult($query);
		echo json_encode($data[0]);
	}

	public function insert() {
		$data 	= array();
		$data["nama_medsos"]	 	= $_POST["nama_medsos"];
		$data["url"] 				= $_POST["url"];
		$data["ikon"] 				= $_POST["ikon"];

		$simpan	= $this->medsos->insert($data);
	}

	public function update() {
		$data 	= array();
		$data["nama_medsos"] 	= $_POST["nama_medsos"];
		$data["url"] 			= $_POST["url"];
		$data["ikon"] 			= $_POST["ikon"];

		$id 	= $_POST["id"];
		$simpan	= $this->medsos->update($data, array('id_medsos' => $id));
	}

	public function delete($id) {
		$response = array('status'=>false);
		
		$hapus = $this->medsos->delete(array('id_medsos' => $id));
		if ($hapus && $id) $response['status'] = true;

		// Send JSON Data to AJAX Request
		echo json_encode($response);
	}
}