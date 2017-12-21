<?php
$data = simplexml_load_file('search.xml');
define(LEN, 1000);

echo '<div class="article-inner article-entry"><h2>Search Results for: ' . $_GET["s"] . '</h2></div>';

foreach($data->entry as $a) {
	// echo $a->title;
// echo preg_replace("/http:\/\/(.*)\//","<a href=\"\${0}\">\${0}</a>","$a");

	$pattern = "/" . $_GET["s"] . "/i";
	$replace = '<span class=hl>' . $_GET["s"] . '</span>';
	// echo $pattern . "<BR>";
	// echo $replace . "<BR>";

	if(preg_match($pattern, $a->title)  or preg_match($pattern, $a->content)) {
		echo '<div class="article-inner article-entry" itemprop="articleBody"><a href=' . $a->url . '><h3>' . preg_replace($pattern, $replace, $a->title) . '</h3></a>';
		$hl_keys = preg_replace($pattern, $replace, $a->content);

		$strpos = stripos($a->content,  $_GET['s']);
		$len = min(LEN, strlen($a->content) - $strpos - 1);

		echo '<p>' . mb_strcut($hl_keys, $strpos, $len, "utf-8") . ' <span class=article-more-link><a href='. $a->url .'> Detial>></a></span></p></div>';
	}

}
?>