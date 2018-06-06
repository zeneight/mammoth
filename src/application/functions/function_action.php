<?php
function create_action($id, $edit=true, $delete=true, $print=false) {
	$button = "";
	if ($edit) $button .= '
							<a class="btn btn-default btn-xs" onclick="editForm(\''.$id.'\')">
								<i class="glyphicon glyphicon-pencil"></i>
							</a>';

	if ($delete) $button .= '<a class="btn btn-danger btn-xs" onclick="hapusData(\''.$id.'\')">
								<i class="glyphicon glyphicon-trash"></i>
							</a>';

	if ($print) $button .= '<a class="btn btn-warning btn-xs" onclick="printData(\''.$id.'\')">
								<i class="glyphicon glyphicon-print"></i>
							</a>';

	return $button;
}