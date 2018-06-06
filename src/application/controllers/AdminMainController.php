<?php
namespace src\application\controllers;
use \Controller;

class AdminMainController extends Controller
{
	function __construct()
	{
		// cek session
		if (empty($_SESSION["username"]) AND empty($_SESSION["password"])) {
			$this->redirect("login");
		} else {
			$this->model("admin");
			$us = $_SESSION["username"];
			$ps = $_SESSION["password"];
		
			$qc 	= $this->admin->selectWhere(array('username' => $us, 'password' => $ps));
			$dc 	= $this->admin->getResult($qc);
			$jml 	= $this->admin->getRows($qc);

			if ($jml==0) {
				session_destroy();
				$this->redirect("login");
				exit();
			}
		}

		// ambil fungsi html
		require_once(ROOT.DS."src/application/functions/function_html.php");
	}

	public function template($viewName, $bc='', $data=array()) {
		// ========================================== //
		$textTitle 		= "Content Management System";
		$textMarquee	= "Yth. Bapak/Ibu, untuk melakukan PENGADUAN atau untuk permintaan INFORMASI teknis terkait pekerjaan silahkan menginventarisasi masalah terlebih dahulu  kemudian dibuat list permasalahan lalu sampaikan ke <a href=\"mailto:yanno@balimediakreasi.com\">yanno@balimediakreasi.com</a> agar mudah ditangani oleh tim kami.";
		// ========================================== //

		$pageTitle 	= ($bc == "") ? $textTitle : ucwords($bc) . " | " . $textTitle;

		$view = $this->view('admin/template');
		$view->bind('viewName', $viewName);
		$view->bind('breadcrumb', ucwords($bc));
		$view->bind('pageTitle', ucwords($pageTitle));
		$view->bind('marquee', $textMarquee);
		$view->bind('data', $data);
	}

	public function imageUploadHandler($gambar, $gambar_name, $gambar_tmp, $path_folder="produk") {
		/*global $_FILES["gambar"];
		global $_FILES["gambar"]['name'];
		global $_FILES["gambar"]['tmp_name'];*/

		$valid_extensions = array('jpeg', 'jpg', 'png', 'gif', 'bmp'); // valid extensions
		$path = "../public/assets/images/".$path_folder.DS; // upload directory

		if(isset($gambar))
		{
			$img = $gambar_name;
			$tmp = $gambar_tmp;
				
			// get uploaded file's extension
			$ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));
			
			// can upload same image using rand function
			$final_image = rand(1000,1000000).$img;
			
			// check's valid format
			if(in_array($ext, $valid_extensions)) {
				$filename 	= strtolower($final_image);
				$pathfinal 	= $path.$filename;

				if (file_exists($path) && file_exists($path."thumbs")) {
					move_uploaded_file($tmp, $pathfinal);
				} else {
					mkdir($path);
					mkdir($path."thumbs");

					chmod($path, 0777);
					chmod($path."thumbs", 0777);

					move_uploaded_file($tmp,$pathfinal);
				}

				// variables
				$srcFile 	= $path.$filename;
				$thumbFile 	= $path.'/thumbs/'.$filename;
				$thumbSize	= 200;

				/* Determine the File Type */
				$type = substr( $filename , strrpos( $filename , '.' )+1 );
				
				/* Create the Source Image */
				switch( $type ){
					case 'jpg' : case 'jpeg' :
						$src = imagecreatefromjpeg( $srcFile ); break;
					case 'png' :
						$src = imagecreatefrompng( $srcFile ); break;
					case 'gif' :
						$src = imagecreatefromgif( $srcFile ); break;
				}

				/* Determine the Image Dimensions */
				$oldW = imagesx( $src );
				$oldH = imagesy( $src );

				/* Calculate the New Image Dimensions */
				$limiting_dim = 0;
				if ( $oldH > $oldW ) {
					/* Portrait */
					$limiting_dim = $oldW;
				} else {
					/* Landscape */
					$limiting_dim = $oldH;
				}

				/* Create the New Image */
				$new = imagecreatetruecolor( $thumbSize , $thumbSize );
				
				/* Transcribe the Source Image into the New (Square) Image */
				imagecopyresampled( $new , $src , 0 , 0 , ($oldW-$limiting_dim )/2 , ( $oldH-$limiting_dim )/2 , $thumbSize , $thumbSize , $limiting_dim , $limiting_dim );

				// move image to folder 
				switch( $type ){
					case 'jpg' : case 'jpeg' :
						$src = imagejpeg( $new , $thumbFile ); break;
					case 'png' :
						$src = imagepng( $new , $thumbFile ); break;
					case 'gif' :
						$src = imagegif( $new , $thumbFile ); break;
				}

				// destroy temp image
				imagedestroy( $new );
				/*imagedestroy( $src );*/

				return $filename;
			} else {
				return false;
			}
		}
	}

	public function deleteImage($model, $id = array(), $path="produk", $kolom="gambar") {
		//hapus foto yg lama
		// $this->model($model);
		$query 	= $this->$model->selectWhere($id);
		$li 	= $this->$model->getResult($query);

		$gambarnya = $li[0][$kolom];

		if ($gambarnya) {
			unlink("../public/assets/images". DS . $path .DS. $gambarnya);
			unlink("../public/assets/images". DS . $path .DS. "thumbs" .DS. $gambarnya);
			return true;
		} else {
			return false;
		}
	}
}
