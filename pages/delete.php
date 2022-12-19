<?php
if ( !isset($page) ) exit;
include 'config.php';
protectPage();

$params = explode('=', parse_url($_SERVER["REQUEST_URI"], PHP_URL_QUERY));
var_dump($params);

if ($params[0] == 'userId') {
  $userId = $params[1];
  deleteUser($userId);
  header('Location: ./dashboard');
} else if ($params[0] == 'imcId') {
  $imcId = $params[1];
  deleteImc($imcId);
  header('Location: '.$_SERVER['HTTP_REFERER']);
}

?>
