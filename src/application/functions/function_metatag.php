<?php
function load_metatag($data=array()) {

echo '<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
<meta name="robots" content="index, follow" />
<link rel="shortcut icon" href="'.$data["favicon"].'">
<meta name="author" content="'.$data["meta_author"].'">
<meta name="content_type" content="Standard" />
<title>'.$data["mtitle_c"].'</title>
<meta name="description" content="'.$data["mdescription_c"].'">
<meta name="keywords" content="'.$data["keywords"].'">
<meta property="fb:app_id" content="1567214813399392" />
<meta property="og:site_name" content="'.$data["og_site_name"].'"/>
<meta property="og:title" content="'.$data["og_title"].'" />
<meta property="og:image" content="'.BASE_PATH."assets/images/".$data["og_image"].'" />
<meta property="og:url" content="'.$data["og_url"].'"/>
<meta property="og:description" content="'.$data["og_description"].'" />
<meta property="og:type" content="'.$data["og_type"].'" />
<meta property="article:author" content="'.$data["article_author"].'" />
<meta property="article:publisher" content="'.$data["article_publisher"].'" />
<meta name="twitter:card" content="summary" />
<meta name="twitter:site" content="'.$data["twitter_site"].'" />
<meta name="twitter:creator" content="'.$data["twitter_creator"].'" />
<meta name="twitter:title" content="'.$data["twitter_title"].'" />
<meta name="twitter:description" content="'.$data["twitter_description"].'" />
<meta name="twitter:url" content="'.$data["twitter_url"].'" />
<meta name="twitter:image" content="'.BASE_PATH."assets/images/".$data["twitter_image"].'"/>
';

}
?>