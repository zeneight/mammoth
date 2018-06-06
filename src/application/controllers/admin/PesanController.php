<?php
use src\application\controllers\AdminMainController;
/**
* 
*/
class PesanController extends AdminMainController
{
	function __construct()
	{
		parent::__construct();
		$this->model("pesan");
	}

	public function index() {
		$this->template("admin/pesan", "pesan");
	}

	public function listData() {
		require_once ROOT."/application/functions/function_action.php";
		require_once ROOT."/application/functions/function_date.php";


		$query 	= $this->pesan->selectAll("id_pesan", "DESC");
		$list 	= $this->pesan->getResult($query);
		$data 	= array();

		$no 	= 0;
		foreach ($list as $li) {
			$no ++;
			$tanggal = tgl_indonesia($li["tanggal"]);

			$row 	= array();
			$row[] 	= $no;

			if ($li["dibaca"]=="N") {
				$row[] = "<b>$li[nama] (<a href='mailto:$li[email]'>$li[email]</a>) </b>";
				$row[] = "<b>$li[subjek] <br> $tanggal <br> $li[pesan] </b>";
			} else {
				$row[] = "$li[nama] (<a href='mailto:$li[email]'>$li[email]</a>)";
				$row[] = "$li[subjek] <br> $tanggal <br> $li[pesan]";
			}

			$row[]	= create_action($li["id_pesan"], false);
			$data[] = $row;
		}

		// $this->pesan->update($data, array('dibaca'=>"Y"));

		$output = array("data" => $data);
		echo json_encode($output);
	}

	public function delete($id) {
		$response = array('status'=>false);
		// $this->deleteImage("berita", array('id_berita' => $id), "berita");
		
		$hapus = $this->pesan->delete(array('id_pesan' => $id));
		if ($hapus && $id) $response['status'] = true;

		// Send JSON Data to AJAX Request
		echo json_encode($response);
	}
}