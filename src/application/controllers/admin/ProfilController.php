<?php
use src\application\controllers\AdminMainController;
/**
* 
*/
class ProfilController extends AdminMainController
{
	function __construct()
	{
		parent::__construct();
		$this->model("admin");
	}

	public function index() {
		$query 	= $this->admin->selectAll();
		$data 	= $this->admin->getResult($query); 
		$this->template("admin/profil", "profil", $data);
	}

	public function update() {
		$data 	= array();
		$data["password"] = md5($_POST['baru']);
		$lama 	= md5($_POST['lama']);

		$query 	= $this->admin->selectWhere(array('username' => $_SESSION['username']));
		$cek 	= $this->admin->getResult($query);

		if ($cek[0]['password'] != $lama) {
			echo "Password Lama Salah!";
			exit();
		} else {
			$simpan = $this->admin->update($data, array('username' => $_SESSION['username']));
			if ($simpan) echo "success";
		}
	}
}