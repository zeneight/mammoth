<?php
function hurufKecil($text) {
	$kecil 	= strtolower($text);
	$res 	= ucwords($kecil);
	return $res;
}

// fungsi ambil foto thumbnail
function getThumbnail($value, $path, $big=false) { 
	if ($value=="") {
		$alamat_img = BASE_PATH."assets/images/notexists.jpg"; 
	} else {
		$lokasi="assets/images/$path/".$value;
		if (!file_exists($lokasi)) {
			$alamat_img = BASE_PATH."assets/images/notexists.jpg";
		} else {
			if ($big) $alamat_img = BASE_PATH."assets/images/$path/".$value;
			else $alamat_img = BASE_PATH."assets/images/$path/thumbs/".$value;
		}
	}
	return $alamat_img;
}

function getThumbnail2($value, $path) {

	if ($value=="") {
		$alamat_img = BASE_PATH."assets/images/null.png";
	} else {
		$lokasi="assets/$path/".$value;
		if (!file_exists($lokasi)) {
			$alamat_img = BASE_PATH."assets/images/notexists.png";
		} else {
			$alamat_img = BASE_PATH."assets/$path/".$value;
			return $alamat_img;
		}
	}
}

function getPermalink($link)
{
	$filter = array('~', '`', '!', '@', '#', '$', '%', '^', '&','*','*','(',')','-','_','=','+','.',',','/','?','"','[','{','}',']',"'","\\",'"',';','<','>','|',':');
        $link= str_replace(" ","-",trim(str_replace($filter,'',$link)));
					
	return $link.".html";
}

// fungsi ambil id video youtube
function yt_id($url) {
	$pattern = 
		'%^# Match any youtube URL
		(?:https?://)?  # Optional scheme. Either http or https
		(?:www\.)?      # Optional www subdomain
		(?:             # Group host alternatives
		  youtu\.be/    # Either youtu.be,
		| youtube\.com  # or youtube.com
		  (?:           # Group path alternatives
			/embed/     # Either /embed/
		  | /v/         # or /v/
		  | /watch\?v=  # or /watch\?v=
		  )             # End path alternatives.
		)               # End host alternatives.
		([\w-]{10,12})  # Allow 10-12 for 11 char youtube id.
		$%x'
		;

	$result = preg_match($pattern, $url, $matches);
	if ($result) {
		return $matches[1];
	}
	return false;
}

function legendList($tanggal, $kategori) {
	echo '
		<ul class="list-inline small font-weight-600 myriadpro">
			<li><i class="fa fa-calendar"></i> '.format_date_in(2,substr ($tanggal, 0, 10)).'</li>
			<li><i class="fa fa-map-marker"></i> '.$kategori.'</li>
		</ul>';
}


function get_menu_footer($data, $parent = 0) {
	static $i = 1;
	$tab = str_repeat("\t\t", $i);
	if (isset($data[$parent])) {
		if($i==1) {

			$html = "\n$tab";

		} else {

			$html = "\n$tab";

		}



		$i++;



		foreach ($data[$parent] as $v) {



			if (strpos($v->url, 'BU') !== false) {

			    $baseurl 	= 'true';

			    $baseurl2 	= 'false';

			    $idnya 		= explode(":", $v->url);

			} else if (strpos($v->url, 'BASEURL') !== false) {

			    $baseurl2 	= 'true';

			    $baseurl 	= 'false';

			    $idnya2 	= explode(":", $v->url);

			} else {

				$baseurl 	= 'false';

				$baseurl2 	= 'false';

			}

			

			if($v->url=="" || $v->url=="#"){

				$urlnya 	= BASEURL."menu/".$v->id."/".getPermalink($v->title);

				$targetnya 	= "_self";



			} else if($baseurl=="true") {

				$urlnya=BASEURL."unit/".$idnya[1]."/".getPermalink($v->title);

				$targetnya="_self";



			} else if($baseurl2=="true") {

				$urlnya=BASEURL.$idnya2[1];

				$targetnya="_self";



			}else{

				$urlnya=$v->url;

				$targetnya=$v->target;

			}



			$html .= "\n\t$tab<li>";



			if ($v->parent_id==0) {

				$html .= '<a href="'.$urlnya.'" target="'.$targetnya.'">'.$v->title.'</a>';

			} else {

				$html .= '<a href="'.$urlnya.'" target="'.$targetnya.'">'.$v->title.'</a>';

			}

			

			$html .= '</li>';

		}

		return $html;

	} else {

		// return false;

	}

}



function get_menu($data, $parent = 0) {

	static $i = 1;

	$tab = str_repeat("\t\t", $i);

	if (isset($data[$parent])) {

		

		if($i==1){

			$html = "\n$tab";

		}else{

			$html = "\n$tab<ul class='dropdown-menu'>";

		}

		$i++;

								

		foreach ($data[$parent] as $v) {

			

			if (strpos($v->url, 'BU') !== false) {

			    $baseurl 	= 'true';

			    $baseurl2 	= 'false';

			    $idnya 		= explode(":", $v->url);

			} else if (strpos($v->url, 'BASEURL') !== false) {

			    $baseurl2 	= 'true';

			    $baseurl 	= 'false';

			    $idnya2 	= explode(":", $v->url);

			} else {

				$baseurl 	= 'false';

				$baseurl2 	= 'false';

			}

			

			if($v->url=="" || $v->url=="#"){

				$urlnya 	= BASEURL."menu/".$v->id."/".getPermalink($v->title);

				$targetnya 	= "_self";



			} else if($baseurl=="true") {

				$urlnya=BASEURL."unit/".$idnya[1]."/".getPermalink($v->title);

				$targetnya="_self";



			} else if($baseurl2=="true") {

				$urlnya=BASEURL.$idnya2[1];

				$targetnya="_self";



			}else{

				$urlnya=$v->url;

				$targetnya=$v->target;

			}

			

			$child = get_menu($data, $v->id);

			$html .= "\n\t$tab<li class=\"dropdown\">";



			if ($v->top_menu!=0) {

				$html .= '<a class="dropdown-toggle" data-toggle="dropdown" href="'.$urlnya.'" target="'.$targetnya.'">'.$v->title.' <i class="fa fa-angle-down"></i> </a>';

			} else {

				$html .= '<a href="'.$urlnya.'" target="'.$targetnya.'">'.$v->title.'</a>';

			}

			

			if ($child) {

				$i--;

				$html .= $child;

				$html .= "\n\t$tab";

			}

			$html .= '</li>';

		}

		$html .= "\n$tab</ul>";

		return $html;

	} else {

		// return false;

	}

}



function get_menuMobile($data, $parent = 0) {

	static $i = 1;

	$tab = str_repeat("\t\t", $i);

	if (isset($data[$parent])) {

		

		if($i==1){

			$html = "\n$tab";

		}else{

			$html = "\n$tab<ul>";

		}

		$i++;

								

		foreach ($data[$parent] as $v) {

			

			if($v->url=="" || $v->url=="#"){

				$urlnya=BASEURL."menu/".$v->id."/".getPermalink($v->title);

				$targetnya="_self";

			}else{

				$urlnya=$v->url;

				$targetnya=$v->target;

			}

			

			$child = get_menu($data, $v->id);

			$html .= "\n\t$tab<li>";



			if ($v->parent_id==0) {

				$html .= '<a href="'.$urlnya.'" target="'.$targetnya.'">'.$v->title.'</a>';

			} else {

				$html .= '<a href="'.$urlnya.'" target="'.$targetnya.'">'.$v->title.'</a>';

			}

			

			if ($child) {

				$i--;

				$html .= $child;

				$html .= "\n\t$tab";

			}

			$html .= '</li>';

		}

		$html .= "\n$tab</ul>";

		return $html;

	} else {

		return false;

	}

}



function cariKonten($path) {

	$html = "";

	$html .= '

	<div class="well margin-bottom-15">

		<form method="post" action="'.BASEURL.$path.'/" target="_self">

			<select name="month" class="form-control" id="month">

				<option selected="selected" value=""> - Bulan - </option>

				<option value="01">Januari</option>

				<option value="02">Februari</option>

				<option value="03">Maret</option>

				<option value="04">April</option>

				<option value="05">Mei</option>

				<option value="06">Juni</option>

				<option value="07">Juli</option>

				<option value="08">Agustus</option>

				<option value="09">September</option>

				<option value="10">Oktober</option>

				<option value="11">November</option>

				<option value="12">Desember </option>

			</select>&nbsp;

			<select name="years" class="form-control" id="years">

				<option selected="selected" value=""> - Tahun - </option>';

					for ($i=2007;$i<=date('Y');$i++) {

						if($i% 1==0) {

							$html .= "<option value=".$i.">".$i."</option>";

						}

					}

	$html .= '

			</select>

			<hr />

			<input value="Cari" name="cari" id="submit" type="submit" class="btn btn-primary btn-lg btn-block"/>

		</form>

	</div>';



	return $html;

}



function kontenTerkait($text, $path, $where="", $orderby="", $limit="") {

	$html="";

	$html .= 

		'<div class="list-group margin-top-0">';

			$listberitalainnya = DB::run("SELECT * FROM $text $where $orderby $limit");

			foreach( $listberitalainnya as $listberitalainnya ) :



			$html .=

			'<a href="'.BASEURL.$path.'/'.$listberitalainnya['id'].'/'.getPermalink($listberitalainnya['title']).'" class="list-group-item">

				<h4 class="list-group-item-heading">

					'.hurufKecil($listberitalainnya['title']).'

				</h4>

				<p class="list-group-item-text" style="font-size: 10px;">

					'.format_date_in(2,substr ($listberitalainnya['date'], 0, 10)).'

				</p>

			</a>';

				endforeach;

		$html .= 

		'</div>';

	return $html;

}



function komentarFB() {
	echo '<div id="disqus_thread"></div>';
	echo "<div id=\"disqus_thread\"></div>
<script>
/**
*  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR PLATFORM OR CMS.
*  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: https://disqus.com/admin/universalcode/#configuration-variables*/
/*
var disqus_config = function () {
this.page.url = PAGE_URL;  // Replace PAGE_URL with your page's canonical URL variable
this.page.identifier = PAGE_IDENTIFIER; // Replace PAGE_IDENTIFIER with your page's unique identifier variable
};
*/
(function() { // DON'T EDIT BELOW THIS LINE
var d = document, s = d.createElement('script');
s.src = 'https://mybaliku-com.disqus.com/embed.js';
s.setAttribute('data-timestamp', +new Date());
(d.head || d.body).appendChild(s);
})();
</script>
<noscript>Please enable JavaScript to view the <a href=\"https://disqus.com/?ref_noscript\">comments powered by Disqus.</a></noscript>";
	/*
	echo '
	<div id="fb-root"></div>
	<div class="fb-comments" data-href="'.$url=HTTP.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'].'" data-num-posts="20" width="100%">
	</div>';
	*/
}

function breadcrumbKonten($text, $path) {



	echo 

	'<div class="breadcrumb-wrapper bg-medium">

		<div class="container-fluid">

			<div class="row">

				<div class="col-xs-12">

					<ol class="breadcrumb">

						<li><a href="'.BASEURL.'home">Beranda</a></li>

						<li><a href="'.BASEURL.$path.'">'.$text.'</a></li>

					</ol>

				</div> <!-- .col-md-12 -->

			</div> <!-- .row -->

		</div> <!-- .container -->

	</div> <!-- .breadcrumb-wrapper -->';

}

?>