<?php
require_once "autoloader.php";

$html = null;
$search = null;
$time = null;
/*$channelType = null;*/
$type = null;
//$eventType = null;
$maxResults =null;

require_once "search.php";

echo $twig->render('search.twig',
    array('html' => $html, 'search' => $search,'time' => $time, 'type' => $type,'maxResults' => $maxResults));
//include_once ("Presentation/search.phtml");
