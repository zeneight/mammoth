<?php
/**
* Controller Class 
*/
class Controller {
	protected function view($viewName) {
		return new View($viewName);
	}

	protected function model($modelName) {
		require_once ROOT."/src/application/models/".$modelName.".model.php";
		$className = ucfirst($modelName)."Model";
		$this->$modelName = new $className();
	}

	protected function template($viewName, $data=array()) {
		$view = $this->view('template');
		$view->bind('viewName', $viewName);
		$view->bind('data', $data);
	}

	public function back() {
		echo '<script>history.go(-1)</script>';
	}

	public function redirect($url="") {
		header('location: '.BASE_URL.$url);
		exit();
	}

	protected function validate($data) {
		return htmlentities(trim(strip_tags($data)));
	}

	protected function uploadFileHandler() {
		require_once ROOT."/public/php/UploadHandler.php";
		$this->$UploadHandler = new UploadHandler();
	}
	
}