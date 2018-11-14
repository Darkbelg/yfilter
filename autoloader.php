<?php
require_once 'vendor/autoload.php';
include_once '.youtube/apiKey.php';

$loader = new Twig_Loader_Filesystem('presentation');
$twig = new Twig_Environment($loader);
