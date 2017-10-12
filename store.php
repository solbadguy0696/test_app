<?php
require('functions.php');
//create($_POST);
//checkReferer();
$res = checkReferer();
if ($res != 'back') {
  header('location: ./index.php');  //リダイレクト先の指定を行う
} else if ($res == 'index') {
  header('location: ./index.php');
} else {
  header('location: '.$_SERVER['HTTP_REFERER'].'');  //リダイレクト先の指定を行う
}
?>