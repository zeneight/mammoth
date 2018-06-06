<?php
/**
* Controller Login
*/
class LoginController extends Controller
{
	function __construct()
	{
		// cek session
		$this->model("admin");
		if (!empty($_SESSION["username"]) AND !empty($_SESSION["password"])) {
			$us = $_SESSION["username"];
			$ps = $_SESSION["password"];

			$qc 	= $this->admin->selectWhere(array('username' => $us, 'password' => $ps));
			$dc 	= $this->admin->getResult($qc);
			$jml 	= $this->admin->getRows($qc);

			if ($jml>0) {
				$this->redirect("admin");
				exit();
			} else {
				session_destroy();
				$this->redirect("login");
				exit();
			}
		}
	}

	// untuk menampilkan halaman login
	public function index() {
		$this->view("admin/login");
	}

	public function check() {
		$user_post = (isset($_POST["username"])) ? $_POST["username"] : "";
		$pass_post = (isset($_POST["password"])) ? $_POST["password"] : "";
		
		$username = $this->validate($user_post);
		$password = md5($this->validate($pass_post));

		$query 	= $this->admin->selectWhere(array('username' => $username, 'password' => $password));
		$data 	= $this->admin->getResult($query);
		$jml 	= $this->admin->getRows($query);

		if ($jml>0) {
			$data = $data[0];

			$_SESSION['username'] = $data['username'];
			$_SESSION['password'] = $data['password'];

			$this->redirect("admin");
		} else {
			$view = $this->view("admin/login");
			$view->bind("msg", "Username atau Password salah!");
		}
	}
}