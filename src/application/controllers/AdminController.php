<?php
/**
* Controller Administrator
*/
class AdminController extends Controller
{
	private function getController($controller, $action='', $parameter='') {
		$controllerPath = ROOT .DS. "src/application" .DS. "controllers" .DS. "admin" .DS.ucfirst($controller . "Controller.php");

		if(file_exists($controllerPath)) {
			require_once($controllerPath);
			$controllerName 	= ucfirst($controller). "Controller";
			$object 			= new $controllerName();

			$act 	= ($action!='') ? $action : "index";

			$param 	= array($parameter);

			if(method_exists($controllerName, $act)) {
				call_user_func_array(array($object, $act), $param);
			} else die("Aksi tidak ditemukan!");
		} else die ("Controller tidak ditemukaaan!!!!");
	}

	public function index() {
		$this->getController('dashboard');
	}

	public function login($action='') {
		$this->getController('login', $action);
	}

	public function kategori($action='', $parameter='') {
		$this->getController('kategori', $action, $parameter);
	}

	public function katberita($action='', $parameter='') {
		$this->getController('katberita', $action, $parameter);
	}

	public function member($action='', $parameter='') {
		$this->getController('member', $action, $parameter);
	}

	public function produk($action='', $parameter='') {
		$this->getController('produk', $action, $parameter);
	}

	public function berita($action='', $parameter='') {
		$this->getController('berita', $action, $parameter);
	}

	public function slider($action='', $parameter='') {
		$this->getController('slider', $action, $parameter);
	}

	public function medsos($action='', $parameter='') {
		$this->getController('medsos', $action, $parameter);
	}

	public function menu($action='', $parameter='') {
		$this->getController('menu', $action, $parameter);
	}

	public function informasi($action='', $parameter='') {
		$this->getController('informasi', $action, $parameter);
	}

	public function pesan($action='', $parameter='') {
		$this->getController('pesan', $action, $parameter);
	}

	public function profil($action='', $parameter='') {
		$this->getController('profil', $action, $parameter);
	}

	public function pengaturan($action='', $parameter='') {
		$this->getController('pengaturan', $action, $parameter);
	}

	public function laporan($action='', $parameter='') {
		$this->getController('laporan', $action, $parameter);
	}

	public function logout() {
		session_destroy();
		$this->redirect('login');
	}
}