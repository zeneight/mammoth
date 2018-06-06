<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="">
<meta name="author" content="">
<link rel="shortcut icon" href="assets/ico/icon.png">

<title><?php echo $pageTitle; ?></title>

<!-- CSS -->
<?php
load_css("assets/css/bootstrap.css");
load_css("assets/css/temanya.css");
load_css("assets/css/font-awesome.min.css");

load_css("assets/css/bootstrap-datetimepicker.min.css");
load_css("assets/css/datepicker.css");
load_css("assets/dataTables/css/dataTables.bootstrap.min.css");
load_css("assets/css/jquery.fileupload.css");

load_script("assets/js/jquery-3.2.1.min.js");
?>
<!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!--[if lt IE 9]>
  <script src="assets/js/html5shiv.js"></script>
  <script src="assets/js/respond.min.js"></script>
<![endif]-->
</head>

<body>
<!-- <div id="loading">
	<div class="bubblingG">
		<span id="bubblingG_1">
		</span>
		<span id="bubblingG_2">
		</span>
		<span id="bubblingG_3">
		</span>
	</div>
</div> -->

<!-- // menu -->
<?php
require_once(ROOT.DS."src/application/functions/function_frontweb.php");
require_once(ROOT.DS."src/application/functions/listmenu.php");
echo "\n";
?>

<!-- // konten -->
<div class="container">
	<div class="teks-berjalan">
		<marquee onmouseover="this.stop()" onMouseOut="this.start()" direction="left" scrollamount="5" width="100%">
		<?php echo $marquee; ?>
		</marquee>
	</div> <!-- .teks-berjalan -->

	<?php
		// get modul
		$view = new View($viewName);
		$view->bind('data', $data);
		$view->render();
	?>
</div>
<!-- .container -->

<!-- // js -->
<?php
load_script("assets/js/bootstrap-datepicker.js");
load_script("assets/js/bootstrap-datepicker.id.js");

load_script("assets/js/bootstrap.min.js");
load_script("assets/js/bootstrap-datetimepicker.js");
load_script("assets/dataTables/js/jquery.dataTables.min.js");
load_script("assets/dataTables/js/dataTables.bootstrap.min.js");
load_script("assets/js/sweetalert.min.js");

load_script("assets/ckeditor/ckeditor.js");
load_script("assets/he-master/he.js");
?>

<script type="text/javascript">
	$('.form_datetime').datetimepicker({
		language:  'en',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
		showMeridian: 1
	});
	//this is for Date only	
	$('.form_date').datetimepicker({
		language:  'en',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
	});
	//this is for Time Only	
	$('.form_time').datetimepicker({
		language:  'en',
		weekStart: 1,
		todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
	});

	// $(window).on('load', function() { $("#loading").fadeOut("slow"); })

    CKEDITOR.replace('deskripsi', {
			extraPlugins: 'imageuploader'
	});

	CKEDITOR.plugins.add( 'imageuploader', {
	    init: function( editor ) {
	        editor.config.filebrowserBrowseUrl = '../public/assets/ckeditor/plugins/imageuploader/imgbrowser.php';
	    }
	});
</script>	
</body>
</html>