<?php
use src\application\controllers\AdminMainController;
/**
* 
*/
class MemberController extends AdminMainController
{
	function __construct()
	{
		parent::__construct();
		$this->model("member");
	}

	public function index() {
		/*$this->model("katmember");
		$query 	= $this->katmember->selectAll();
		$data 	= $this->katmember->getResult($query);*/

		$this->template("admin/member", "member");
	}

	public function print() {
		$this->template("admin/print", "print");
	}

	public function listData() {
		require_once ROOT."/src/application/functions/function_action.php";
		require_once ROOT."/src/application/functions/function_rupiah.php";

		$query 	= $this->member->selectAll("id_member", "DESC");
		$list 	= $this->member->getResult($query);
		$data 	= array();

		$no 	= 0;
		foreach ($list as $li) {
			$no ++;
			$row 	= array();
			$row[] 	= $no.".";
			$row[] 	= "<img height='80px' width='80px' src='".BASE_PATH."assets/images/member/thumbs/$li[gambar]'>";
			$row[]	= "Nama: <b>".$li["nama_member"]."</b><br>Alamat: <b>".$li["alamat"]."</b><br>No. KTP: <b>".$li["no_ktp"]."</b>";
			$row[]	= "<img src='".BASE_PATH."barcode/barcode.php?text=$li[barcode]&print=true&size=40'>";
			$row[]	= create_action($li["id_member"], true, true, true);
			$data[] = $row;
		}

		$output = array("data" => $data);
		echo json_encode($output);
	}

	public function edit($id) {
		$query 	= $this->member->selectWhere(array('id_member' => $id));
		$data 	= $this->member->getResult($query);
		echo json_encode($data[0]);
	}

	public function insert() {
		$data 	= array();
		if ($_FILES['gambar']['size'] != 0 && $_FILES['gambar']['error'] == 0) {
			$data["gambar"] = $this->imageUploadHandler(
									$_FILES['gambar'], 
									$_FILES['gambar']['name'], 
									$_FILES['gambar']['tmp_name'],
									"member"
								);
		} else {
			$data["gambar"] 	= "no-image.jpg";
		}

		$lastId = $this->member->getId("barcode");
		$letter = $lastId[0];
		// echo $letter;
		$number = $lastId[1].$lastId[2].$lastId[3];
		// echo $number;

		if ($number < 999) {
		    $newId = $letter.sprintf("%03d", $number+1);
		} else {
		    $ascii = ord($letter);
		    $newLetter = chr($ascii+1);
		    $newId = $newLetter.'001';
		}

		$data["barcode"] 		= $newId;
		$data["create_date"] 	= date("Y-m-d");

		$data["nama_member"] 	= $_POST["member"];
		$data["alamat"] 		= $_POST["alamat"];
		$data["tempat_l"] 		= $_POST["tempat_l"];
		$data["tgl_l"] 			= $_POST["tgl_l"];
		$data["telp"] 			= $_POST["telp"];
		$data["no_ktp"] 		= $_POST["no_ktp"];
		// $data["deskripsi"] 		= htmlentities(($_POST["deskripsi"]));

		$simpan	= $this->member->insert($data);
		if ($simpan) echo "success";
	}

	public function update() {
		$id 	= $_POST["id"];

		$data 	= array();
		if ($_FILES['gambar']['size'] != 0 && $_FILES['gambar']['error'] == 0) {
			$this->deleteImage("member", array('id_member' => $id), "member");
			$data["gambar"] = $this->imageUploadHandler(
									$_FILES['gambar'], 
									$_FILES['gambar']['name'], 
									$_FILES['gambar']['tmp_name'],
									"member"
								);
		}

		$data["nama_member"] 	= $_POST["member"];
		$data["alamat"] 		= $_POST["alamat"];
		$data["tempat_l"] 		= $_POST["tempat_l"];
		$data["tgl_l"] 			= $_POST["tgl_l"];
		$data["telp"] 			= $_POST["telp"];
		$data["no_ktp"] 		= $_POST["no_ktp"];

		$simpan	= $this->member->update($data, array('id_member' => $id));
	}

	public function delete($id) {
		$response = array('status'=>false);
		$this->deleteImage("member", array('id_member' => $id), "member");
		
		$hapus = $this->member->delete(array('id_member' => $id));
		if ($hapus && $id) $response['status'] = true;

		// Send JSON Data to AJAX Request
		echo json_encode($response);
	}
}