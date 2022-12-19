<?php

$_SG['connectServer'] = true;
$_SG['openSession'] = true;
$_SG['caseSensitive'] = false;
$_SG['alwaysValidate'] = true;

$_SG['server'] = 'localhost';
$_SG['user'] = 'meuimc';
$_SG['pwd'] = 'O_XP3UaI5hY30)Qg';
$_SG['db'] = 'meuimc';
$_SG['loginPage'] = 'home';
$_SG['userTable'] = 'user';
$_SG['userTypeTable'] = 'user_type';
$_SG['imcTable'] = 'imc';

$_SG['clientId'] = null;

date_default_timezone_set('America/Sao_Paulo');

if ($_SG['connectServer'] == true) {
  $_SG['link'] = mysqli_connect($_SG['server'], $_SG['user'], $_SG['pwd'], $_SG['db']) or die("MySQL: Não foi possível conectar-se ao servidor [".$_SG['server']."].");
}

if ($_SG['openSession'] == true) {
  session_start();
}

include 'functions.php';
