<?php
// fungsi panggil file CSS
function load_css($path, $url="") {
	if ($url=="") {
		$urlnya = BASE_PATH.$path;
	} else {
		$urlnya = $url;
	}

	echo '<link rel="stylesheet" type="text/css" href="'.$urlnya.'">';
	echo "\r\n";
}

// fungsi untuk memanggil file Javascript
function load_script($path) {
	echo '<script type="text/javascript" src="'.BASE_PATH.$path.'"></script>';
	echo "\r\n";
}

// fungsi membuat menu halaman admin
function create_menu($link, $icon, $title) {
	global $url;
	$class = ($link==$url) ? "active" : "";
	echo '<li class="'.$class.'">
			<a href="'.BASE_URL.$link.'">
				<i class="glyphicon glyphicon-'.$icon.'"></i> '.$title.'
			</a>
		</li>';
}

// ikon panel admin
function create_panel($color, $icon, $number, $text) {
	echo '
	<div class="col-xs-12 col-md-6 col-lg-3">
		<div class="panel panel-'.$color.' panel-widget">
			<div class="row no-padding">
				<div class="col-sm-3 col-lg-5 widget-left">
					<i class="glyphicon glyphicon-'.$icon.'"></i>
				</div>
				<div class="col-sm-9 col-lg-7 widget-right">
					<div class="large">'.$number.'</div>
					<div class="text-muted">'.$text.'</div>
				</div>
			</div>
		</div>
	</div>
	';
}

// judul halaman
function create_title($text) {
	echo '<h2 class="page-header">'.$text.'</h2>';
}

// awal halaman admin
function start_content() {
	echo '
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-default">
				<div class="panel-body">
	';
}

// akhir halaman admin
function end_content() {
	echo '
				</div>
			</div>
		</div>	
	</div>
	';
}

// tombol
function create_button($text, $color, $onclick, $icon, $size="md") {
	echo '
	<button class="btn btn-'.$color.' btn-'.$size.'" id="'.$onclick.'">
		<i class="glyphicon glyphicon-'.$icon.'"></i> 
		 '.$text.'
	</button>
	';
}

// tabel
function create_table($column, $content="") {
	echo '
	<hr>
	<div class="table-responsive">
		<table class="table table-stripped" width="100%">
			<thead>
				<tr>
					<th style="width: 10px;">No.</th>
	';
					foreach ($column as $col) {
						echo '<th>'.$col.'</th>';
					}
	echo '
				</tr>
			</thead>
			<tbody>
	';
				if (is_array($content)) {
					foreach ($content as $cnt) {
						echo '<td>'.$col.'</td>';
					}
				}

	echo '
			</tbody>
		</table>
	</div>
	<br/>
	';
}

// modal form
function start_modal($id, $action="") {
	echo '
	<div class="modal" 
		id="'.$id.'" 
		tabindex="-1" 
		role="dialog" 
		aria-hidden="true" 
		data-backdrop="static">

		<div class="modal-dialog modal-lg">
			<div class="modal-content" style="padding: 15px;">
				<form class="form-horizontal" method="post" enctype="multipart/formdata" onsubmit="'.$action.'">
					<div class="moda-header">
						<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"> &times; </span></button>
					</div>
					<h3 class="modal-title"></h3>
					<div class="modal-body">
						<input type="hidden" name="id" id="id">
	';
}
// modal end form
function end_modal($save=true, $special="") {
	echo '
		</div>
			<div class="modal-footer">';

	if ($save) {
		echo '
			<button type="submit" class="btn btn-primary btn-save">
				<i class="glyphicon glyphicon-floppy-disk"></i>
				Simpan
			</button>';
	}

	if ($special!="") {
		echo '
			<button type="button" class="btn btn-primary btn-'.$special.'">
				<i class="glyphicon glyphicon-print"></i>
				'.$special.'
			</button>';
	}

	echo '					
						<button type="button" class="btn btn-warning" 
								data-dismiss="modal" 
								aria-label="Close">
							<i class="glyphicon glyphicon-sign"></i>
							Batal
						</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	';
}

// kotak input
function form_input($label, $name, $type="text", $width="5", $class="", $attr="") {
	echo '
	<div class="form-group">
		<label for="'.$name.'" class="col-sm-2 control-label">'.$label.'</label>
		<div class="col-sm-'.$width.'">
			<input type="'.$type.'" class="form-control '.$class.'" id="'.$name.'" name="'.$name.'" '.$attr.'>
		</div>
	</div>
	';
}

// textarea
function form_textarea($label, $name, $class="", $attr="", $content="") {
	echo '
	<div class="form-group">
		<label for="'.$name.'" class="col-sm-2 control-label">'.$label.'</label>
		<div class="col-sm-10">
			<textarea class="form-control '.$class.'" rows="8" name="'.$name.'" id="'.$name.'" '.$attr.'>
			'.$content.'
			</textarea>
		</div>
	</div>
	';
}

function form_combobox($label, $name, $list, $width='5', $class="", $attr="") {
	echo '
	<div class="form-group">
		<label for="'.$name.'" class="col-sm-2 control-label">'.$label.'</label>
		<div class="col-sm-'.$width.'">
			<select class="form-control '.$class.'" id="'.$name.'" name="'.$name.'" '.$attr.'>
			<option calue=""> - Pilih - </option>';

			foreach ($list as $key => $val) {
				echo '<option value='.$key.'>'.$val.'</option>';
			}

	echo '
			</select>
		</div>
	</div>
	';
}

function form_radio($label, $nama, $value="") {

	if ($value=="Show") {
		$status1 = "checked";
		$status2 = "none";
	} elseif ($value=="Hide") {
		$status1 = "none";
		$status2 = "checked";
	} else {
		$status1 = "none";
		$status2 = "none";
	}

	echo '
	<div class="form-group">
		<label class="col-lg-2 control-label">'.$label.'</label>
		<div class="col-lg-10">
			<div class="radio">
				<label>
					<input type="radio" name="'.$nama.'" id="status1" value="Show" checked="'.$status1.'">
					Show
				</label>
			</div>
			<div class="radio">
				<label>
					<input type="radio" name="'.$nama.'" id="status2" value="Hide" checked="'.$status2.'">
					Hide
				</label>
			</div>
		</div>
	</div>
	';
}

function form_mediapicker($label, $nama, $lebar='4', $tipe='0', $modal_id='') {
	echo '
	<div class="form-group">
		<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
		<div class="col-sm-'.$lebar.'">
			<div id="img-'.$nama.'"></div>
			<input id="'.$nama.'" type="file" name="'.$nama.'">
		</div>
	</div>
	';

	/*echo '
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<!-- The global progress bar -->
		    <div id="progress" class="progress">
		        <div class="progress-bar bg-danger"></div>
		    </div>

		    <!-- The container for the uploaded files -->
		    <div id="files" class="files"></div>
		</div>
	</div>
	';*/
}

/*
function form_mediapicker($label, $nama, $lebar='4', $tipe="0", $modal_id="") {
?>
<script type="text/javascript">
	$(function() {
		$('#filemanager-<?php echo $nama; ?>').on('hidden.bs.modal', function (e) {
			var url = $('#<?php echo $modal_id; ?>').val();
			$('#img-<?php echo $nama ?>').html('<br><img src="<?php echo BASE_PATH; ?>assets/images/thumbs/'+url+'">');
		});
	});
</script>

<?php
	echo '
	<div class="form-group">
		<label for="'.$nama.'" class="col-sm-2 control-label">'.$label.'</label>
		<div class="col-sm-'.$lebar.'">
			<div class="input-group">
			<input type="text" class="form-control input-'.$nama.'" id="'.$nama.'" name="'.$nama.'" readonly>
			<a data-toggle="modal" data-target="#filemanager-'.$nama.'" class="input-group-addon btn btn-primary pilih-'.$nama.'">...</a>
			</div>
		</div>
		<div id="img-'.$nama.'"></div>
	</div>
	';

	echo '
	<div class="modal" id="filemanager-'.$nama.'" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">

				<div class="modal-header">
					<button type="button" class="close" aria-label="close"><span aria-hidden="true">&times;</span>
					</button>

					<h4 class="title" id="myModalLabel">File Manager</h4>
				</div>

				<div class="modal-body">
				<iframe src="'.BASE_PATH.'assets/filemanager/dialog.php?type='.$tipe.'&field_id='.$nama.'&relative_url=1" width="100%" height="400" style="border: 0"></iframe>
				</div>

			</div>
		</div>
	</div>
	';
}
*/
?>