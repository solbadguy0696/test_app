<?php
require('functions.php');
//create($_POST);
//checkReferer();
$res = checkReferer();
if ($res == 'index') {
  header('location: ./index.php');  //リダイレクト先の指定を行う
}
  header('location: '.$_SERVER['HTTP_REFERER'].'');  //リダイレクト先の指定を行う
?>